<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ratings;
use App\Models\Transactions;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RatingsController extends Controller
{

    public function getAll(){

        try{
            $ratings = Ratings::all();
            if(count($ratings) === 0){
                return response()->json(['error' => true, 'message' => 'There are no ratings'], 200);
            }
            return response()->json($ratings, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'DATABASE ERROR'], 500);
        }

    }

    public function get($id){

        try{
            $rating = Ratings::find($id);
            if(empty($rating)){
                return response()->json(['error' => true, 'message' => 'RATING NOT FOUND'], 400);
            }
            return response()->json($rating, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'RATING NOT FOUND'], 500);
        }

    }

    public function store(Request $req){
        $validator = Validator::make(
            $req->all(),
            [
                'grade' => 'required|numeric|max:10|min:0',
                'description' => 'required|string|max:255',
                'transaction_id' => 'required|numeric'
            ]
        );

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $transactionExists = Transactions::find($req["transaction_id"]);
        if(empty($transactionExists)){
            return response()->json(['error' => 'TRANSACTION NOT FOUND'], 400);
        }

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
