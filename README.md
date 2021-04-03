# Technology stack used

 
- PHP 7.4
- Laravel 8 latest version
- MySQL latest version
- Docker


# Deployment steps

 
- You can run the application with one command in the terminal by executing this bash script to make all the work done for you.
	> sudo bash build.sh

- If you want to run the application outside docker, just follow these steps:
	> git clone git@github.com:Marwan-Amin/fleet-management-system.git

	> cd fleet-management-systemcd booking_system

	> cd booking_system

	> composer install

	> php artisan migrate:fresh --seed

	> php artisan serve
