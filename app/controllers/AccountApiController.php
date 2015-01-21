<?php
use Documentio\Repositories\Account\AccountInterface;
class AccountApiController extends \BaseController {
    private $user;
    public function __construct(AccountInterface $user){
        $this->user=$user;
    }
	public function register(){
        $data=Input::except(['_token']);
        $userRegistered=$this->user->register($data);
        if($userRegistered){
            return Redirect::to('/login');
        }else{
            return Redirect::to('/register');
        }
    }

    public function login(){
        $data=Input::except(['_token']);
        $userLoggedIn=$this->user->login($data);
        if($userLoggedIn){
            return Redirect::route('repositories.index');
        }else{
            return Redirect::to('/login');
        }
    }
    public function logout(){
        $this->user->logout();
        return Redirect::to('/login');
    }
}