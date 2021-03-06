<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use Illuminate\Http\Request;

class AgentController extends Controller
{

    protected $users;
    public function __construct()
    {
        $this->users = new UserRepository();
    }

    public function index(){
        return view('pages.agent.index',
            ['users' => $this->users->getUsers()]);
    }
}
