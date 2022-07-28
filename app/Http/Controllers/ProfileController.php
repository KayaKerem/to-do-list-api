<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profile(User $user){


        return response()->json(new ProfileResource($user));
    }

    public function index(Request $request){


        $searchQuerey = $request->query('is_admin');
        if($searchQuerey != null){
            return ProfileResource::collection(User::query()->where('is_admin', 'LIKE', $searchQuerey)->get());
        }

        return ProfileResource::collection(User::all());
    }


}
