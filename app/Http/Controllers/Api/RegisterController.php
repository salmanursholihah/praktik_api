<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
use app\Models\User;

class RegisterController extends Controller
{
    /**
     * @param
     * @return
     */
public function __invoke (request $request){

    $validator=validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required|email|unique:users',
        'password'=>'required|min:8|confirmated'
    ]);
if($validator->fails()){
    return response()->json($validator->errors(),422);
}

$user =user::create([
    'name'=>$request->name,
    'email'=>$request->email,
    'password'=>bcrypt($request->password)
]);

if($user){
    return response()->json([
        'succes'=>true,
        'user'=>$user,
    ],200);
}
return response()->json([
    'success'=>false,
],409);

}
}

