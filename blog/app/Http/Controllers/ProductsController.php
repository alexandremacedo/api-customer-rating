<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Validator; 
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    
    private $model;

    public function __construct(Products $products)
    {
        $this->model = $products;
    }

    public function getAll(){

        try{
            $products = $this->model->all();
            if(count($products) > 0){
                return response()->json($products, Response::HTTP_OK);
            }else{
                return response()->json([], Response::HTTP_OK);
            }
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

       

        
    }

    public function get($id){
        
        try{
            $product = $this->model->find($id);
            if($product!==null){
                return response()->json($product, Response::HTTP_OK);
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
                'price' => 'required | double'
            ]
        );
        try{
            $product = $this->model->create($req->all());
            return response()->json($product, Response::HTTP_CREATED);
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        
    }

   public function update($id, Request $req){
            try{
                $product = $this->model->find($id)
                    ->update($req->all());
        
                return response()->json($product, Response::HTTP_OK);
            }catch (QueryException $exception){
                return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }    

        
   }

   public function destroy($id){

        try{
            $product = $this->model->delete($id);
            return response()->json(null, Response::HTTP_OK);
        }catch (QueryException $exception){
            return response()->json(['error' => 'TROUBLE WITH DATABASE CONNECTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
   }

}
