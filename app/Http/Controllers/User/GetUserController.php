<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

class GetUserController extends Controller{
    
    public function index(Request $request)
    {
        
        $user = User::where('id', $request->id)->first();

        if ($user) {
            return $user;
        }
        
    }

}