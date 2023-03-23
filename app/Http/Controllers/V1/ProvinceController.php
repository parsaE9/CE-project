<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Province;
use EloquentBuilder;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = EloquentBuilder::to(Province::class , \Illuminate\Support\Facades\Request::all());
        return $provinces->get();
    }

    public function show($province)
    {
        return Province::query()->findOrFail($province);
    }
}
