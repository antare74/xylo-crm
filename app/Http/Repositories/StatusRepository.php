<?php
namespace App\Http\Repositories;

use App\Models\Status;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StatusRepository{

    public function storeStatus($request, $id = ''){
        $result = ['status' => false, 'message' => ''];
        try {
            $validator  = Validator::make($request->all(), [
                'agent' => ['required', 'integer'],
                'status'=> ['required', 'string', Rule::in(['waiting', 'follow up', 'done'])],
            ]);

            if ($validator->fails()){
                $result['message'] = $validator->errors()->all();
                return $result;
            }

            $status = new Status();
            if ($id){
                $status = $this->findStatus($id);
            }
            $status->status     = $request->status;
            $status->agent_id   = $request->agent;
            $status->save();

            $result['status']   = true;
            $result['message']  = $status;
            return $result;
        }catch (\Exception $e){
            $result['message'] = $e->getMessage();
            return $result;
        }
    }

    public function findStatus($id){
        return Status::with([])->find($id);
    }
}
