<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\User;

class APIUser extends Controller
{

        public function login(Request $request){

          $validator = Validator::make($request->all(), [
              'email' => 'required|email|min:2',
              'password' => 'required|min:2'
          ]);

          if($validator->fails()){
            return response()->json(['message'=>'There are some missing credentials'], 400);
          } else {
            if (\Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])){
              return response()->json(['message'=>'success', 'api_token'=>\Auth::user()->api_token]);
            } else {
              return response()->json(['message'=>'Invalid credentials'], 400);
            }
          }

        }

        public function register(Request $request){

          $validator = Validator::make($request->all(), [
              'name' => 'required|min:2',
              'email' => 'required|unique:users,email|email',
              'password' => 'required|min:2',
              'confirm_password' => 'required|same:password',
          ]);

          if($validator->fails()){
            return response()->json(['message'=>'error'], 400);
          } else {
            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('password'));
            $user->api_token = str_random(60);
            $user->save();
            return response()->json(['message'=>'success', 'api_token'=>$user->api_token]);
          }

        }

}
