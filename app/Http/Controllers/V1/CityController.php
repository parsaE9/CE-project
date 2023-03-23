<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return City::all();
    }

    public function show($id)
    {
        return City::query()->findOrFail($id);
    }

    public function store(Request $request)
    {
        return City::query()->where('province_id', '=' , $request->get("province_id"))->get();
    }
}
