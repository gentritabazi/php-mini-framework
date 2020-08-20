<?php

namespace App\Models;

use Core\BaseModel;

class User extends BaseModel
{
    // Table name.
    protected $table_name = "users";
  
    // The attributes that are mass assignable.
    protected $fillable = ['first_name', 'last_name', 'email', 'password'];
   
    // The attributes that should be hidden for arrays.
    protected $hidden = ['password'];
}
