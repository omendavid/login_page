<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Requests\User\StoreRequest;

use Illuminate\Support\Facades\Hash;

class StoreController extends Controller{
    
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        info(json_encode($data,JSON_PRETTY_PRINT));
        $user=User::create($data);
        return response([]);
    }

}