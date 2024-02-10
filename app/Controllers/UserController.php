<?php

namespace App\Controllers;

use App\Models\User;
use Core\BaseController;

class UserController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }
    
    public function getAll()
    {
        $users = $this->userModel->get();
        return $this->response(200, $users);
    }

    public function getById($id)
    {
        $user = $this->userModel->getById($id);
        return $this->response(200, $user);
    }

    public function create()
    {
        $userData = $this->request->body();
        $user = $this->userModel->create($userData);
        return $this->response(200, [], ['title' => 'User successfully created.']);
    }

    public function update($userId)
    {
        $userData = $this->request->parameters();
        $user = $this->userModel->update($userData, $userId);
        return $this->response(200, [], ['title' => 'User successfully updated.']);
    }
}
