<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    function index()
    {
        return view('todos.index');
    }
}
