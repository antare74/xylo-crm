<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CustomerRepository;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customer;
    public function __construct(){
        $this->customer = new CustomerRepository();
    }

    public function index()
    {
        return view('pages.contacts.index', ['customers' => $this->customer->getCustomer()]);
    }

    public function store(Request $request, $id)
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
