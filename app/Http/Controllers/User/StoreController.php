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
        // info(json_encode($data,JSON_PRETTY_PRINT));
        // $user = User::firstOrCreate([
        //     'email' => $data['email']
        // ], $data);
        $user = User::where('email', $data['email'])->first();
        if ($user) {
            return response(['message' => 'User with this E-Mail already exists'], 403);
        }
        $user=User::create($data);
        
        $token = auth()->tokenById($user->id);

        return response(['access_token' => $token]);
    }

}