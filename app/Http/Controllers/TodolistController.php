<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\TodolistResource;
use App\Models\Todolist;
use App\Models\User;
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
        return TodolistResource::collection(Todolist::all());
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
