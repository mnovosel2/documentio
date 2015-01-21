<?php

use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Role extends EntrustRole
{
    protected $dates = ['deleted_at'];
}