<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\ResponseFactory;

class ApiResponse
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var ResponseFactory
     */
    protected $response;

    /**
     * @var array
     */
    protected $body;

    public function __construct(ResponseFactory $response)
    {
        $this->response = $response;
    }

    public function setData($data = null): object
    {
        $this->body['data'] = $data;
        $this->body['user'] = auth()->user();
        return $this;
    }

    public function setError($error): object
    {
        $this->body['status'] = false;
        $this->body['message'] = $error;
        return $this;
    }

    public function setSuccess($message): object
    {
        $this->body['status'] = true;
        $this->body['message'] = $message;
        return $this;
    }

    public function returnJSON(): JsonResponse
    {
        $responsecode = 200;
        return $this->response->json($this->body, $responsecode, [], JSON_NUMERIC_CHECK);
    }

    public function notAuthenticatedResponse()
    {
        $this->body['status'] = false;
        $this->body['message'] = __('api.notauthenticated');
        return $this;
    }
}
