<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Resources\TodolistResource;
use App\Models\Todolist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TodolistResource::collection(Todolist::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request) : JsonResponse
    {
//        $data = $request->validated();

        $data = auth()->user()->articles()->create($request->validated());

        return new TodolistResource($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function show(Todolist $todolist): Todolist
    {
        return $todolist;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function edit(Todolist $todolist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRequest $request, Todolist $todolist):JsonResponse
    {

        $share = Todolist::find($todolist)->update([
            'name' => $request->get('title'),
            'urls'=> $request->get('description'),

        ]);

        return response()->json(null, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todolist $todolist): JsonResponse
    {
//        $data = Todolist::findorFail($article);
        $todolist->delete();
        return response()->json(null, 204);
    }
}
