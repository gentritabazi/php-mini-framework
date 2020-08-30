<?php

namespace App\Controllers;

use App\Models\User;
use Core\BaseController;

class UserController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
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

    public function create()
    {
        $user = $this->model->create($this->request->body());
        
        return $this->response(200, $user);
    }
}
