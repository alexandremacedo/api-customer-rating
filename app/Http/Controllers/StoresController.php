<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stores;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class StoresController extends Controller
{

    public function getAll(){
        try{
            $stores = Stores::all();
            if(count($stores) === 0){
                return response()->json(['error' => true, 'message' => 'There are no stores'], 200);
            }
            return response()->json($stores, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'DATABASE ERROR'], 500);
        }
    }

    public function get($id){

        try{
            $store = Stores::find($id);
            if(empty($store)){
                return response()->json(['error' => true, 'message' => 'STORE NOT FOUND'], 400);
            }
            return response()->json($store, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'STORE NOT FOUND'], 500);
        }

    }

    public function store(Request $req){
        $validator = Validator::make(
            $req->all(),
            [
                'name' => 'required|max:40|min:3'
            ]
        );

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        try{
            $store = new Stores();
            $store->fill($req->all());
            $store->save();
            return response()->json($store, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'STORE ERROR'], 500);
        }

    }

   public function update($id, Request $req){
            $validator = Validator::make(
                $req->all(),
                [
                    'name' => 'max:40|min:3'
                ]
            );

            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }

            try{

                $store = Stores::find($id)
                    ->update($req->all());
                return response()->json(Stores::find($id), 200);
            }catch (QueryException $exception){
                return response()->json(['error' => 'STORE NOT FOUND'], 500);
            }


   }

   public function destroy($id){

        try{
            $store = Stores::where('id', $id)->first();
            if(empty($store)){
                return response()->json(['error' => true, 'message' => 'STORE NOT FOUND'], 400);
            }
            $store->delete();
            return response()->json(['message' => 'STORE DELETED'], 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'STORE NOT FOUND'], 500);
        }

   }

}
