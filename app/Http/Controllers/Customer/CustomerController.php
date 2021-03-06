<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CustomerRepository;
use App\Http\Repositories\UserRepository;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customer;
    protected $user;
    public function __construct(){
        $this->customer = new CustomerRepository();
        $this->user     = new UserRepository();
    }

    public function index()
    {
        return view('pages.contacts.index', [
            'customers' => $this->customer->getCustomer(),
            'users'     => $this->user->getUsers()
        ]);
    }

    public function store(Request $request, $id = '')
    {
        $store = $this->customer->storeCustomer($request, $id);
        return back()->with([$store]);
    }

    public function destroy($id)
    {
        $delete = $this->customer->deleteCustomer($id);
        return back()->with([$delete]);
    }
}
