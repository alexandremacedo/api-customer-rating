<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;


class ClientsController extends Controller
{
    
    private $model;

    public function __construct(Clients $clients)
    {
        $this->model = $clients;
    }

    public function getAll(){
        $clients = $this->model->all();
        return response()->json($clients);
    }

    public function get($id){
        $client = $this->model->find($id);
        return response()->json($client);
    }

    public function store(Request $req){
        $client = $this->model->create($req->all());
        return response()->json($client);
    }

   public function update($id, Request $req){
        $client = $this->model->find($id)
            ->update($req->all());
        return response()->json($client);
   }

   public function destroy($id){
        $client = $this->model->delete($id);
        return response()->json(null);
   }

}
