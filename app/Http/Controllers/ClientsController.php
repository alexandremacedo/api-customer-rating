<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ClientsController extends Controller
{

    public function getAll(){
        try{
            $clients = Clients::all();
            if(count($clients) === 0){
                return response()->json(['error' => false, 'message' => 'There are no clients'], 200);
            }
            return response()->json($clients, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => true, 'message' => 'DATABASE ERROR'], 500);
        }
    }

    public function get($id){
        try{
            $client = Clients::find($id);
            if(empty($client)){
                return response()->json(['error' => true, 'message' => 'CLIENT NOT FOUND'], 400);
            }
            return response()->json($client, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => true, 'message' => 'CLIENT NOT FOUND'], 500);
        }
    }

    public function store(Request $req){
        $validator = Validator::make(
            $req->all(),
            [
                'name' => 'required|max:40|min:3',
                'email' => 'required|email',
                'phone' => 'required|max:13|min:10',
                'cpf' => 'required|string|cpf|unique:clients|max:11|min:11'
            ]
        );

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        try{
            $client = new Clients();
            $client->fill($req->all());
            $client->save();
            return response()->json($client, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'CLIENT ERROR'], 500);
        }
    }

   public function update($id, Request $req){

            $validator = Validator::make(
                $req->all(),
                [
                    'name' => 'max:40|min:3',
                    'email' => 'email',
                    'phone' => 'max:13|min:10',
                    'cpf' => 'string|unique:clients|cpf|max:11|min:11'
                ]
            );

            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }

            try{
                $client = Clients::find($id)
                    ->update($req->all());
                return response()->json(Clients::find($id), 200);
            }catch (QueryException $exception){
                return response()->json(['error' => 'CLIENT NOT FOUND'], 500);
            }


   }

    public function destroy($id){

        try{
            $client = Clients::where('id', $id)->first();
            if(empty($client)){
                return response()->json(['error' => true, 'message' => 'CLIENT NOT FOUND'], 400);
            }
            $client->delete();
            return response()->json(['message' => 'CLIENT DELETED'], 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'CLIENT NOT FOUND'], 500);
        }

    }

}
