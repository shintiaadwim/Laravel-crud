<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReligionController extends Controller
{
    public function index()
    {
        $data = Religion::paginate('7');
        return view('datareligion', compact('data'));
    }

    public function show()
    {
        return view('add-religion');
    }

    public function create(Request $request)
    {
        $data = Religion::create($request->all());
        return Redirect()->route('religion');
    }

    public function store()
    {
        //
    }

    public function edit(Religion $religion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Religion $religion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Religion $religion)
    {
        //
    }
}
