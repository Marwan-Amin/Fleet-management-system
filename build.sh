#!/bin/bash
start=`date +%s`

#### START Cleaning docker environment during development
sudo rm -r booking_system_database/
docker rm booking_system_app booking_system_database booking_system_phpmyadmin -f
docker system prune -f
docker image prune -f
docker container prune -f
docker volume prune -f
#### END Cleaning docker environment during development

#### START Builing docker containers -------------------------------

cd booking_system && composer install && cd ..
docker-compose up -d
sudo chmod -R 777 booking_system_database/
#### END Builing docker containers ---------------------------------

#### START Configuring (booking_system_app) microservice ----------------------
while ! docker exec booking_system_database mysqladmin --user=root --password=secret --host "127.0.0.1" ping --silent &> /dev/null ; do
    echo "... Waiting for booking_system's database to be deployed ..."
    sleep 10
done
echo "... booking_system's database has been deployed successfully ..."

docker exec -it booking_system_app chmod -R 777 /var/www/html
docker exec -it booking_system_app cp .env.example .env
docker exec -it booking_system_app composer dump-autoload
docker exec -it booking_system_app php artisan key:generate
docker exec -it booking_system_app php artisan migrate:fresh --seed
docker exec -it booking_system_app php artisan config:cache
docker exec -it booking_system_app php artisan route:cache
#### END Configuring (booking_system_app) microservice ----------------------

end=`date +%s`
runtime=$((end-start))
echo "booking_system is successfully deployed in" $runtime "seconds"