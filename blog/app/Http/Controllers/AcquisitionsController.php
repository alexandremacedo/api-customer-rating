<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acquisitions;
use Illuminate\Support\Facades\Validator; 
use Symfony\Component\HttpFoundation\Response;

class AcquisitionsController extends Controller
{
    
    private $model;

    public function __construct(Acquisitions $acquisitions)
    {
        $this->model = $acquisitions;
    }

    public function getAll(){

        try{
            $acquisitions = $this->model->all();
            if(count($acquisitions) > 0){
                return response()->json($acquisitions, Response::HTTP_OK);
            }else{
                return response()->json([], Response::HTTP_OK);
            }
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

       

        
    }

    public function get($id){
        
        try{
            $acquisition = $this->model->find($id);
            if($acquisition!==null){
                return response()->json($acquisition, Response::HTTP_OK);
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
                'payment-type' => 'required | max:20 | min:5',
            ]
        );
        try{
            $acquisition = $this->model->create($req->all());
            return response()->json($acquisition, Response::HTTP_CREATED);
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        
    }

   public function update($id, Request $req){
            try{
                $acquisition = $this->model->find($id)
                    ->update($req->all());
        
                return response()->json($acquisition, Response::HTTP_OK);
            }catch (QueryException $exception){
                return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }    

        
   }

   public function destroy($id){

        try{
            $acquisition = $this->model->delete($id);
            return response()->json(null, Response::HTTP_OK);
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
   }

}
