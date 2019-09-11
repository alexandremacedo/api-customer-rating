<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ratings;
use Illuminate\Support\Facades\Validator; 
use Symfony\Component\HttpFoundation\Response;

class RatingsController extends Controller
{
    
    private $model;

    public function __construct(Ratings $ratings)
    {
        $this->model = $ratings;
    }

    public function getAll(){

        try{
            $ratings = $this->model->all();
            if(count($ratings) > 0){
                return response()->json($ratings, Response::HTTP_OK);
            }else{
                return response()->json([], Response::HTTP_OK);
            }
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

       

        
    }

    public function get($id){
        
        try{
            $rating = $this->model->find($id);
            if($rating!==null){
                return response()->json($rating, Response::HTTP_OK);
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
                'note' => 'required | integer',
                'description' => 'required | text',
            ]
        );
        try{
            $rating = $this->model->create($req->all());
            return response()->json($rating, Response::HTTP_CREATED);
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        
    }

   public function update($id, Request $req){
            try{
                $rating = $this->model->find($id)
                    ->update($req->all());
        
                return response()->json($rating, Response::HTTP_OK);
            }catch (QueryException $exception){
                return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }    

        
   }

   public function destroy($id){

        try{
            $rating = $this->model->delete($id);
            return response()->json(null, Response::HTTP_OK);
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
   }

}
