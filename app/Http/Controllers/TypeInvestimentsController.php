<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeInvestimentsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return to_route('dashboard');
    }
}
