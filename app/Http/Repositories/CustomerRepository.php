<?php
namespace App\Http\Repositories;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerRepository{

    public function storeCustomer($request, $id = ''){
        $result = ['status' => false, 'message' => ''];
        try {
            $request->only(['name', 'phone', 'email', 'agent', 'status']);

            $validator  = Validator::make($request->all(), [
                'name'  => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email'],
            ]);

            if ($validator->fails()){
                $result['message'] = $validator->errors()->all();
                return $result;
            }
            DB::beginTransaction();

            $status     = new StatusRepository();
            $addStatus  = $status->storeStatus($request, $id);

            if (!$addStatus['status']){
                $result['message'] = __('message.failed status');
                return $result;
            }
            $customer   = new Customer();
            $result['message'] = __('message.store customer');

            if ($id){
                $customer = $this->findCustomer($id);
                $result['message'] = __('message.update customer');
            }

            $customer->name      = $request->name;
            $customer->phone     = $request->phone;
            $customer->email     = $request->email;
            $customer->status_id = $addStatus['message']->id;
            $customer->save();

            DB::commit();

            $result['status'] = true;
            return $result;
        }catch (\Exception $e){
            $result['message'] = $e->getMessage();
            return $result;
        }
    }

    public function deleteCustomer($id){
        $result = ['status' => false, 'message' => ''];
        try {
            $customer = $this->findCustomer($id);
            $customer->delete();
            $result['status'] = true;
            $result['message'] = __('message.delete customer');
            return $result;
        }catch (\Exception $e){
            $result['message'] = $e->getMessage();
            return $result;
        }
    }

    public function findCustomer($id){
        return Customer::with(['status'])->find($id);
    }

    public function getCustomer(){
        return Customer::with(['status'])->get();
    }
}
