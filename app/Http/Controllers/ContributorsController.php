<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contributors;
use Illuminate\Support\Facades\Validator; 
use Symfony\Component\HttpFoundation\Response;

class ContributorsController extends Controller
{
    
    public function getAll(){

        try{
            $contributors = Contributors::all();
            return response()->json($contributors, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'DATABASE ERROR'], 500);
        }

    }

    public function get($id){
        
        try{
            $contributor = Contributors::find($id);            
            return response()->json($contributor, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'CONTRIBUTOR NOT FOUND'], 500);
        }
    
    }

    public function store(Request $req){
         $this->validate(
            $req,
            [
                'name' => 'required|max:40|min:3',
                'email' => 'required|regex:/^.+@.+$/i',
                'store_id' => 'required'
            ]
        );
        try{

            $contributor = new Contributors();
            $contributor->fill($req->all());
            $contributor->save();
            
            return response()->json($contributor, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'CONTRIBUTOR ERROR'], 500);
        } 
        
    }

   public function update($id, Request $req){
            $this->validate(
                $req,
                [
                    'name' => 'required|max:40|min:3',
                    'email' => 'required|regex:/^.+@.+$/i'
                ]
            );

            try{
                
                $contributor = Contributors::find($id)
                    ->update($req->all());
        
                return response()->json(Contributors::find($id), 200);
            }catch (QueryException $exception){
                return response()->json(['error' => 'CONTRIBUTOR NOT FOUND'], 500);
            }    

        
   }

   public function destroy($id){

        try{
            $contributor = Contributors::where('id', $id)->first();
            $contributor->delete();
            return response()->json(['message' => 'CONTRIBUTOR DELETED'], 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'CONTRIBUTOR NOT FOUND'], 500);
        }
        
   }

}
