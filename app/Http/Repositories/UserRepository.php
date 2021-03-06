<?php
namespace App\Http\Repositories;

use App\Models\User;

class UserRepository{

    public function getUsers(){
        return User::with([])->paginate(25);
    }
}
