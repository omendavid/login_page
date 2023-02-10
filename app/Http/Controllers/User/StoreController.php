<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Requests\User\StoreRequest;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;


class StoreController extends Controller{
    
    public function store(StoreRequest $request)
    {
        $data = $request->validated();


        $url = '';

        if($request->hasFile('img')){
            if($request->file('img')->isvalid()){
                
                $extension = $request->img->extension();
                if(!Storage::exists('/public/image')){
                    Storage::makeDirectory('/public/image',0775,true);
                }
                $date = \Carbon\Carbon::now()->format('Y M');
                if(!Storage::exists('/public/image/'.$date)){
                    Storage::makeDirectory('/public/image/'.$date,0775,true);
                    Storage::setVisibility('/public/image/','public');
                }
                $mt_rand = mt_rand(100000,999999);
                $imgName = \Carbon\Carbon::now()->format('YMd').$mt_rand;
                $name = $request->img->storeAs('/public/image/'.$date,$imgName.'.'.$extension);
                $url = Storage::url('image/'.$date.'/'.$imgName.'.'.$extension);
                Storage::setVisibility($name,'public');
                }
                /* Nkary avelacnely petqa dzel */
        }

        $data['img'] = $url;

        $data['img_croped'] = $url;

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