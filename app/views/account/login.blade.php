
@extends('layouts.scaffold')

@section('main')
        <h3>Prijava u sustav</h3>
        <form action="/api/account/login" method="POST">

            <input type="text" name="email" placeholder="Email..." id="email"/>

            <input type="password" name="password" placeholder="Password..." id="password"/>

            <input type="submit" id="sbn-btn" value="Prijavi se"/>

        </form>

@stop
