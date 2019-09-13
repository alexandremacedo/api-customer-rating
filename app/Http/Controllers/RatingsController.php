<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ratings;
use Illuminate\Support\Facades\Validator; 
use Symfony\Component\HttpFoundation\Response;

class RatingsController extends Controller
{
    
    public function getAll(){

        try{
            $ratings = Ratings::all();
            return response()->json($ratings, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'DATABASE ERROR'], 500);
        }

    }

    public function get($id){
        
        try{
            $rating = Ratings::find($id);            
            return response()->json($rating, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'RATING NOT FOUND'], 500);
        }
    
    }

    public function store(Request $req){
        $this->validate(
            $req,
            [
                'grade' => 'required|numeric|max:10|min:0',
                'description' => 'required',
                'transaction_id' => 'required|numeric'
            ]
        );
        try{

            $rating = new Ratings();
            $rating->fill($req->all());
            $rating->save();
            
            return response()->json($rating, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'RATING ERROR'], 500);
        } 
        
    }

}
