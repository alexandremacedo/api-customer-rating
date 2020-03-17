<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\Clients;
use App\Models\Contributors;
use App\Models\Stores;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TransactionsController extends Controller
{

    public function getAll(){

        try{
            $transactions = Transactions::all();
            if(count($transactions) === 0){
                return response()->json(['error' => true, 'message' => 'There are no transactions'], 400);
            }
            return response()->json($transactions, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'DATABASE ERROR'], 500);
        }

    }

    public function get($id){
        try{
            $transaction = Transactions::find($id);
            if(empty($transaction)){
                return response()->json(['error' => true, 'message' => 'TRANSACTION NOT FOUND'], 400);
            }

            $transactionInfo = [
                "id" => $transaction["id"],
                "payment_amount" => $transaction["payment_amount"],
                "created_at" => $transaction["created_at"],
                "client_id" => $transaction["client_id"],
                "contributor_id" => $transaction["contributor_id"]
            ];

            return response()->json($transactionInfo, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => true, 'message' => 'TRANSACTION NOT FOUND'], 500);
        }

    }

    public function store(Request $req){
        $validator = Validator::make(
            $req->all(),
            [
                'payment_amount' => 'required|numeric',
                'created_at' => 'required|date_format:Y-m-d H:i:s',
                'client_id' => 'required|numeric',
                'contributor_id' => 'required|numeric'
            ]
        );

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $clientExists = Clients::find($req["client_id"]);
        if(empty($clientExists)){
            return response()->json(['error' => true, 'message' => 'CLIENT NOT FOUND'], 400);
        }

        $contributorExists = Contributors::find($req["contributor_id"]);
        if(empty($contributorExists)){
            return response()->json(['error' => true, 'message' => 'CONTRIBUTOR NOT FOUND'], 400);
        }

        try{
            $transaction = new Transactions();
            $transaction->fill($req->all());
            $transaction->save();

            $transactionInfo = [
                "id" => $transaction["id"],
                "payment_amount" => $transaction["payment_amount"],
                "created_at" => $transaction["created_at"],
                "client_id" => $transaction["client_id"],
                "contributor_id" => $transaction["contributor_id"]
            ];

            return response()->json($transactionInfo, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => true, 'message' => 'TRANSACTION ERROR'], 500);
        }

    }

    public function update($id, Request $req){
                $validator = Validator::make(
                    $req->all(),
                    [
                        'payment_amount' => 'numeric',
                        'client_id' => 'numeric',
                        'contributor_id' => 'numeric'
                    ]
                );

                if($validator->fails()){
                    return response()->json($validator->errors(), 400);
                }

                $clientExists = Clients::find($req["client_id"]);
                if(empty($clientExists) && $req["client_id"] !== null){
                    return response()->json(['error' => true, 'message' => 'CLIENT NOT FOUND'], 400);
                }

                $contributorExists = Contributors::find($req["contributor_id"]);
                if(empty($contributorExists) && $req["contributor_id"] !== null){
                    return response()->json(['error' => true, 'message' => 'CONTRIBUTOR NOT FOUND'], 400);
                }

                try{
                    Transactions::find($id)->update($req->all());

                    $transaction = Transactions::find($id);

                    $transactionInfo = [
                        "id" => $transaction["id"],
                        "payment_amount" => $transaction["payment_amount"],
                        "created_at" => $transaction["created_at"],
                        "client_id" => $transaction["client_id"],
                        "contributor_id" => $transaction["contributor_id"],
                    ];

                    return response()->json($transactionInfo, 200);
                }catch (QueryException $exception){
                    return response()->json(['error' => true, 'message' => 'TRANSACTION ERROR'], 500);
                }

    }
}
