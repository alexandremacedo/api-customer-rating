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
            return response()->json($clients, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'DATABASE ERROR'], 500);
        }
    }
    public function get($id){
        try{
            $client = Clients::find($id);
            return response()->json($client, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'CLIENT NOT FOUND'], 500);
        }
    }

    public function store(Request $req){
         $this->validate(
            $req,
            [
                'name' => 'required|max:40|min:3',
                'email' => 'required|regex:/^.+@.+$/i',
                'phone' => 'required|max:13|min:10',
                'cpf' => 'required|max:11|min:11'
            ]
        );
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
            $this->validate(
                $req,
                [
                    'name' => 'max:40|min:3',
                    'email' => 'regex:/^.+@.+$/i',
                    'phone' => 'max:13|min:10',
                    'cpf' => 'max:11|min:11'
                ]
            );

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
            $client->delete();
            return response()->json(['message' => 'CLIENT DELETED'], 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'CLIENT NOT FOUND'], 500);
        }

    }

}
