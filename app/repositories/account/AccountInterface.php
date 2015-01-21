<?php
namespace Documentio\Repositories\Account;
interface AccountInterface {
    public function register($data);
    public function login($data);
    public function getLoggedUser();
    public function logout();
} 