<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use App\Models\cr;
use App\Models\Todolist;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataController extends Controller
{


    public function index(): array
    {
        $user_count = User::all()->count();

        $todolist_count = Todolist::all()->count();

        $registered_last_week = User::query()->where('created_at','>',Carbon::today()->subDay(7))->get();

        $registered_last_month = User::query()->where('created_at','>=',Carbon::today()->subMonth(1))->get();



        return [
            'user_count' => $user_count,
            'todolist_count' => $todolist_count,
            'registered_last_week' => $registered_last_week,
            'registered_last_month' => $registered_last_month,

        ] ;


    }

}
