<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Grop;
use App\Models\SubGrop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GropController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grop = Grop::all();
        foreach ($grop as $item) {
            $item->subGrop = json_decode($item->subGrop);
        }
        return view('admin.grop.grop', ["grop" => $grop]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'sub' => 'required',
            'icon' => 'required',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $sub = json_decode($request->sub);
        foreach ($sub as $item) {
            SubGrop::create([
                'name' => $item,
                'sub' => $request->name,
            ]);
        }
        Grop::create([
            'name' => $request->name,
            'subGrop' => $request->sub,
            'icon' => $request->icon
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Grop $grop
     * @return \Illuminate\Http\Response
     */
    public function show(Grop $grop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Grop $grop
     * @return \Illuminate\Http\Response
     */
    public function edit(Grop $grop)
    {
        $grop->subGrop = json_decode($grop->subGrop);
        return view('admin.grop.edit', ["grop" => $grop]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Grop $grop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grop $grop)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'sub' => 'required',
            'icon' => 'required',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $grop = Grop::find($grop->id);
        SubGrop::where('sub', $grop->name)->delete();
        $sub = json_decode($request->sub);
        foreach ($sub as $item) {
            SubGrop::create([
                'name' => $item,
                'sub' => $request->name,
            ]);
        }
        $grop->update([
            'name' => $request->name,
            'subGrop' => $request->sub,
            'icon' => $request->icon
        ]);
        return redirect()->action([GropController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Grop $grop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grop $grop)
    {
        Grop::find($grop->id)->delete();
        SubGrop::where('sub', $grop->name)->delete();
        return redirect()->back();
    }

    public function getSubGrop($grop)
    {
        return SubGrop::where('sub', $grop)->get();
    }

}
