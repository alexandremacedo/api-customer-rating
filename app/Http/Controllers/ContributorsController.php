<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contributors;
use App\Models\Stores;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ContributorsController extends Controller
{

    public function getAll(){

        try{
            $contributors = Contributors::all();
            if(count($contributors) === 0){
                return response()->json(['error' => true, 'message' => 'There are no contributors'], 200);
            }
            return response()->json($contributors, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => true, 'message' => 'DATABASE ERROR'], 500);
        }

    }

    public function get($id){

        try{
            $contributor = Contributors::find($id);
            if(empty($contributor)){
                return response()->json(['error' => true, 'message' => 'CONTRIBUTOR NOT FOUND'], 400);
            }
            $storeExists = Stores::find($contributor["store_id"]);
            $contributorInfo = [
                "id" => $contributor["id"],
                "name" => $contributor["name"],
                "email" => $contributor["email"],
                "store" => [
                    "id" => $contributor["store_id"],
                    "name" => $storeExists["name"]
                ]
            ];

            return response()->json($contributorInfo, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => true, 'message' => 'CONTRIBUTOR NOT FOUND'], 500);
        }

    }

    public function store(Request $req){
         $validator = Validator::make(
            $req->all(),
            [
                'name' => 'required|max:40|min:3',
                'email' => 'required|email',
                'store_id' => 'required|numeric'
            ]
        );

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $storeExists = Stores::find($req["store_id"]);
        if(empty($storeExists)){
            return response()->json(['error' => true, 'message' => 'STORE NOT FOUND'], 400);
        }

        try{
            $contributor = new Contributors();
            $contributor->fill($req->all());
            $contributor->save();

            $contributorInfo = [
                "id" => $contributor["id"],
                "name" => $contributor["name"],
                "email" => $contributor["email"],
                "store" => [
                    "id" => $contributor["store_id"],
                    "name" => $storeExists["name"]
                ]
            ];

            return response()->json($contributorInfo, 200);
        }catch (QueryException $exception){
            return response()->json(['error' => true, 'message' => 'CONTRIBUTOR ERROR'], 500);
        }

    }

    public function update($id, Request $req){
                $validator = Validator::make(
                    $req->all(),
                    [
                        'name' => 'max:40|min:3',
                        'email' => 'email'
                    ]
                );

                if($validator->fails()){
                    return response()->json($validator->errors(), 400);
                }

                try{
                    Contributors::find($id)->update($req->all());

                    $contributor = Contributors::find($id);
                    $storeExists = Stores::find($contributor["store_id"]);

                    $contributorInfo = [
                        "id" => $contributor["id"],
                        "name" => $contributor["name"],
                        "email" => $contributor["email"],
                        "store" => [
                            "id" => $contributor["store_id"],
                            "name" => $storeExists["name"]
                        ]
                    ];

                    return response()->json($contributorInfo, 200);
                }catch (QueryException $exception){
                    return response()->json(['error' => true, 'message' => 'CONTRIBUTOR NOT FOUND'], 500);
                }


    }

    public function destroy($id){
            try{
                $contributor = Contributors::where('id', $id)->first();
                if(empty($contributor)){
                    return response()->json(['error' => true, 'message' => 'CONTRIBUTOR NOT FOUND'], 400);
                }
                $contributor->delete();
                return response()->json(['error' => false, 'message' => 'CONTRIBUTOR DELETED'], 200);
            }catch (QueryException $exception){
                return response()->json(['error' => true, 'message' => 'CONTRIBUTOR NOT FOUND'], 500);
            }
    }

}
