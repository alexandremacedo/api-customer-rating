<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use Illuminate\Support\Facades\Validator; 
use Symfony\Component\HttpFoundation\Response;

class TransactionsController extends Controller
{
    
    public function getAll(){

        try{
            $transactions = Transactions::all();
            return response()->json($transactions, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'DATABASE ERROR'], 500);
        }

    }

    public function get($id){
        
        try{
            $transaction = Transactions::find($id);            
            return response()->json($transaction, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'TRANSACTION NOT FOUND'], 500);
        }
    
    }

    public function store(Request $req){
         $this->validate(
            $req,
            [
                'payment_amount' => 'required|numeric',
                'created_at' => 'required|date_format:Y-m-d H:i:s',
                'client_id' => 'required|numeric',
                'contributor_id' => 'required|numeric'
            ]
        );
        try{

            $transaction = new Transactions();
            $transaction->fill($req->all());
            $transaction->save();
            
            return response()->json($transaction, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'TRANSACTION ERROR'], 500);
        } 
        
    }

   public function update($id, Request $req){
            $this->validate(
                $req,
                [
                    'payment_amount' => 'numeric',
                    'created_at' => 'date_format:Y-m-d H:i:s',
                    'client_id' => 'numeric',
                    'contributor_id' => 'numeric'
                ]
            );

            try{
                
                $transaction = Transactions::find($id)
                    ->update($req->all());
        
                return response()->json(Transactions::find($id), 200);
            }catch (QueryException $exception){
                return response()->json(['error' => 'TRANSACTION NOT FOUND'], 500);
            }    

        
   }

   public function destroy($id){

        try{
            $transaction = Transactions::delete($id);

            return response()->json(['message' => 'TRANSACTION DELETED'], 200);
        }catch (QueryException $exception){
            return response()->json(['error' => 'TRANSACTION NOT FOUND'], 500);
        }
        
   }

}
