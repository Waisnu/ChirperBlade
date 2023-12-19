<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\ResponseFactory;

class AuthorizationController extends Controller
{
    public function index()
    {

        Gate::allows('isAdmin') ? Response::allow()
            :
           abort(403, 'Uy! bawal yan!');

        return ' Admin Page, YOU ARE AUTHORIZED ! ';


}

}
