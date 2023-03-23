<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CompanyEmployerListController extends Controller
{
    public function index(Request $request)
    {
        return User::query()->whereIn('type' , ['company' , 'employer'])->advancedFilter($request->all());
    }
}
