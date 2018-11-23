<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function store(Request $request)
    {
        \Log::info($request->all());
        Test::create($request->all());
    }

    public function show(Request $request, $id)
    {
        return 1;
        // return $test->type;
    }
}

