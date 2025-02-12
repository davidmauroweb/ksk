<?php

namespace App\Http\Controllers;

use App\Models\{mov,art};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MovController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $json = json_decode($request);
        echo $json;

    }

    /**
     * Display the specified resource.
     */
    public function show(mov $mov)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mov $mov)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mov $mov)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mov $mov)
    {
        //
    }
}
