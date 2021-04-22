<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use \JsonMachine\JsonMachine;

class UsersController extends Controller
{

    public function all(Request $request){
        // Read from json File
         $dataFromX = JsonMachine::fromFile(base_path('jsons/DataProviderX.json'));
         $dataFromX=iterator_to_array($dataFromX);

         $dataFromY = JsonMachine::fromFile(base_path('jsons/DataProviderY.json'));
         $dataFromY=iterator_to_array($dataFromY);

         foreach($dataFromX as &$item){
            $item['status']=$this->readStatus($item['statusCode']);
            $item['dataProvider']='DataProviderX';
            $item['balance']=$item['parentAmount'];
            $item['email']=$item['parentEmail'];
            $item['id']=$item['parentIdentification'];
            $item['created_at']=date("d/m/Y", strtotime($item['registerationDate']));
            unset($item['parentEmail'],$item['registerationDate'],$item['statusCode'],$item['parentIdentification'],$item['parentAmount']);
        }
        foreach($dataFromY as &$item){
            $item['dataProvider']='DataProviderY';
            $item['status']=$this->readStatus($item['status']);

        }
        $mixed_users_data=(array_merge(($dataFromX),($dataFromY)));
        $data = collect($mixed_users_data);

        if($request->dataProvider) $data=$data->where('dataProvider',$request->dataProvider);
        if($request->currency) $data=$data->where('Currency',$request->currency);
        if($request->statusCode) $data=$data->where('status',$request->statusCode);
        if($request->balanceMin) $data=$data->where('balance','>=',$request->balanceMin);
        if($request->balanceMax) $data=$data->where('balance','<=',$request->balanceMax);

        return UserResource::collection($data);
    }
    private function readStatus($statusCode)
    {
        if($statusCode==1 || $statusCode ==100){
            return 'authorised';
        }
        else if($statusCode==1 || $statusCode ==100){
            return 'decline';

        }else return 'refunded';
    }

}
