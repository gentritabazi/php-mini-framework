<?php

namespace App\Controllers;

use Core\Request;
use App\Models\User;
use Core\BaseController;

class UserController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }
    
    public function all()
    {
        return $this->response(200, $this->model->get());
    }

    public function update()
    {
        return $this->response(200, $this->request->getBody());

        return $this->response(200, [
            'id' => 1
        ]);
    }

    public function create()
    {
        return $this->response(200, $this->request->getBody());

        return $this->response(200, [
            'id' => 1
        ]);
    }
}
