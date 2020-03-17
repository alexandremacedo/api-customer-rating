<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ratings;
use App\Models\Transactions;
use App\Models\Clients;
use App\Models\Contributors;
use App\Models\Stores;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Async\Pool;

class RatingsController extends Controller
{

    public function getAll(){

        try{
            $ratings = Ratings::all();
            if(count($ratings) === 0){
                return response()->json(['error' => false, 'message' => 'There are no ratings'], 200);
            }
            return response()->json($ratings, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => true, 'message' => 'DATABASE ERROR'], 500);
        }

    }

    public function get($id){

        try{
            $rating = Ratings::find($id);
            if(empty($rating)){
                return response()->json(['error' => true, 'message' => 'RATING NOT FOUND'], 400);
            }

            $transaction = Transactions::find($rating["transaction_id"]);

            $ratingInfo = [
                "id" => $rating["id"],
                "grade" => $rating["grade"],
                "description" => $rating["description"],
                "transaction" => [
                    "id" => $transaction["id"],
                    "payment_amount" => $transaction["payment_amount"],
                    "created_at" => $transaction["created_at"],
                    "client_id" => $transaction["client_id"],
                    "contributor_id" => $transaction["contributor_id"]
                ]
            ];

            return response()->json($ratingInfo, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => true, 'message' => 'RATING NOT FOUND'], 500);
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

        $ratingExists = Ratings::where('transaction_id', $req["transaction_id"]);
        if($ratingExists){
            return response()->json(['error' => true, 'message' => 'TRANSACTION HAS ALREADY BEEN RATING'], 400);
        }

        $transactionExists = Transactions::find($req["transaction_id"]);
        if(empty($transactionExists)){
            return response()->json(['error' => true, 'message' => 'TRANSACTION NOT FOUND'], 400);
        }

        try{

            $rating = new Ratings();
            $rating->fill($req->all());
            $rating->save();

            $ratingInfo = [
                "id" => $rating["id"],
                "grade" => $rating["grade"],
                "description" => $rating["description"],
                "transaction" => [
                    "transaction_id" => $rating["transaction_id"],
                    "payment_amount" => $transactionExists["payment_amount"],
                    "created_at" => $transactionExists["created_at"],
                    "client_id" => $transactionExists["client_id"],
                    "contributor_id" => $transactionExists["contributor_id"]
                ]
            ];

            return response()->json($ratingInfo, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => true, 'message' => 'RATING ERROR'], 500);
        }

    }

}
