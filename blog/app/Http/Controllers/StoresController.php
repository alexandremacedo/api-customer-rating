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
            return response()->json($stores, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'DATABASE ERROR'], 500);
        }

    }

    public function get($id){
        
        try{
            $store = Stores::find($id);            
            return response()->json($store, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'STORE NOT FOUND'], 500);
        }
    
    }

    public function store(Request $req){
         $this->validate(
            $req,
            [
                'name' => 'required|max:40|min:3'
            ]
        );
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
            $this->validate(
                $req,
                [
                    'name' => 'required|alpha|max:40|min:3'
                ]
            );

            try{
                
                $store = Stores::find($id)
                    ->update($req->all());
        
                return response()->json($store, 200);
            }catch (QueryException $exception){
                return response()->json(['error' => 'STORE NOT FOUND'], 500);
            }    

        
   }

   public function destroy($id){

        try{
            $store = Stores::delete($id);
            return response()->json(['message' => 'STORE DELETED'], 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'STORE NOT FOUND'], 500);
        }
        
   }

}
