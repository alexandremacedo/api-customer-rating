<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contributors;
use Illuminate\Support\Facades\Validator; 
use Symfony\Component\HttpFoundation\Response;

class ContributorsController extends Controller
{
    
    private $model;

    public function __construct(Contributors $contributors)
    {
        $this->model = $contributors;
    }

    public function getAll(){

        try{
            $contributors = $this->model->all();
            if(count($contributors) > 0){
                return response()->json($contributors, Response::HTTP_OK);
            }else{
                return response()->json([], Response::HTTP_OK);
            }
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

       

        
    }

    public function get($id){
        
        try{
            $contributor = $this->model->find($id);
            if($contributor!==null){
                return response()->json($contributor, Response::HTTP_OK);
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
                'name' => 'required | max:40 | min:3',
                'email' => 'required | max:60 | min:3',
                'phone' => 'required | max:13 | min:12',
                'cpf' => 'required | max:11 | min:11',
            ]
        );
        try{
            $contributor = $this->model->create($req->all());
            return response()->json($contributor, Response::HTTP_CREATED);
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        
    }

   public function update($id, Request $req){
            try{
                $contributor = $this->model->find($id)
                    ->update($req->all());
        
                return response()->json($contributor, Response::HTTP_OK);
            }catch (QueryException $exception){
                return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }    

        
   }

   public function destroy($id){

        try{
            $contributor = $this->model->delete($id);
            return response()->json(null, Response::HTTP_OK);
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
   }

}
