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
    
    public function getAll()
    {
        return $this->response(200, $this->model->get());
    }

    public function getById($id)
    {
        return $this->response(200, $this->model->getById($id));
    }
}
