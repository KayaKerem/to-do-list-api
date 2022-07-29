<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Http\Resources\TodolistResource;
use App\Models\Todolist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TodolistController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(): AnonymousResourceCollection
    {
        $todolists = Todolist::query();

        if (request()->exists('search')) {
            $searchQuerey = request()->query('search');
            $todolists =  $todolists->where(function ($query) use ($searchQuerey) {
                $query->where('title', 'LIKE', "%{$searchQuerey}%")
                    ->orwhere('description', 'LIKE', "%{$searchQuerey}%")
                    ->orWhereHas('user',function ($query) use ($searchQuerey){
                        $query->where('username','LIKE',"%{$searchQuerey}%");
                    } );
            });
        }

        if(request()->exists('user_id')){
            $filterUserIdQuery = request()->query('user_id');
            $todolists = $todolists->where('user_id','=',$filterUserIdQuery);
        }

        return TodolistResource::collection($todolists->get());
    }

    public function store(TodoListRequest $request): JsonResponse
    {
        $data = auth()->user()->todolists()->create($request->validated());

        return response()->json(new TodolistResource($data));
    }

    public function show(Todolist $todolist): JsonResponse
    {
        return response()->json(new TodolistResource($todolist));
    }

    public function update(TodoListRequest $request, Todolist $todolist): JsonResponse
    {
        $this->authorize('update', $todolist); // policyi controllerda tanımlamak

        $todolist->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        ]);

        return response()->json(null, 201);
    }

    public function destroy(Todolist $todolist): JsonResponse
    {
        $todolist->delete();

        return response()->json(null, 204);
    }
}
