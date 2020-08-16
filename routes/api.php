<?php

use Core\Router;
use App\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| Enjoy building your API!
|
*/

$router = new Router();
$userController = new UserController();

// Users
$router->respond('GET', '/users', function () use ($userController) {
    echo $userController->all();
});
$router->respond('GET', '/users/(int:id)', function ($id) use ($userController) {
    echo $userController->getById($id);
});
$router->respond('POST', '/users', function () use ($userController) {
    echo $userController->create();
});
$router->respond('PUT', '/users/(int:id)', function ($id) use ($userController) {
    echo $userController->update($id);
});
$router->respond('DELETE', '/users/(int:id)', function ($id) use ($userController) {
    echo $userController->delete($id);
});
