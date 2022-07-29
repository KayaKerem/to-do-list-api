<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProfileController extends Controller
{
    public function profile(User $user): JsonResponse
    {
        return response()->json(new ProfileResource($user));
    }

    public function index(Request $request): AnonymousResourceCollection
    {


        $userQuery = User::query();

        if ($request->exists('is_admin')) {
            $userQuery = $userQuery->where('is_admin', '=', $request->query('is_admin'));
        }

        return ProfileResource::collection($userQuery->get());
    }
}
