<?php
namespace Documentio\Repositories\Account;

class AccountRepository implements AccountInterface{
    public function register($data){
     try{
      $newUser=new \User();
      $newUser->fill($data);
      $newUser->password=\Hash::make($data['password']);
      $newUser->save();
     /*$userRole=new \Role;
     $userRole->name="user";
      $userRole->save();*/
      $newUser->attachRole(\Role::find(1));
      return true;
     }catch(\Exception $e){
         return $e->getMessage();
     }
    }
    public function login($data){
        if(\Auth::attempt([ 'email' => $data['email'], 'password' => $data['password'] ], true))
        {
            return true;
        }else{
            return false;
        }
    }
    public function getLoggedUser(){
        return \Auth::user();
    }
    public function logout(){
        \Auth::logout();
    }
}