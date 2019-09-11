<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stores;
use Illuminate\Support\Facades\Validator; 
use Symfony\Component\HttpFoundation\Response;

class StoresController extends Controller
{
    
    private $model;

    public function __construct(Stores $stores)
    {
        $this->model = $stores;
    }

    public function getAll(){

        try{
            $stores = $this->model->all();
            if(count($stores) > 0){
                return response()->json($stores, Response::HTTP_OK);
            }else{
                return response()->json([], Response::HTTP_OK);
            }
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

       

        
    }

    public function get($id){
        
        try{
            $store = $this->model->find($id);
            if($store!==null){
                return response()->json($store, Response::HTTP_OK);
            }else{
                return response()->json(null, Response::HTTP_OK);
            }
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    
    }

    public function store(Request $req){
        $validator = Validator::make(
            $req->all(),
            [
                'name' => 'required | max:40 | min:3'
            ]
        );
        try{
            $store = $this->model->create($req->all());
            return response()->json($store, Response::HTTP_CREATED);
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        
    }

   public function update($id, Request $req){
            try{
                $store = $this->model->find($id)
                    ->update($req->all());
        
                return response()->json($store, Response::HTTP_OK);
            }catch (QueryException $exception){
                return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }    

        
   }

   public function destroy($id){

        try{
            $store = $this->model->delete($id);
            return response()->json(null, Response::HTTP_OK);
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
   }

}
