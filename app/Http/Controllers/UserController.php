<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function datatable(){
        $user = User::query();

        return DataTables::of($user)
            ->make(true);
    }

    public function index(){
        return view('user.index');
    }

}
