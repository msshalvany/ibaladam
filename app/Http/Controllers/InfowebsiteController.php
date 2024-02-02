<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Infowebsite;
use Illuminate\Http\Request;
use Symfony\Polyfill\Intl\Idn\Info;

class InfowebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = Infowebsite::first();
        $rols = json_decode(Infowebsite::first()->rols);
        return view('admin.info.info', ['info' => $info, 'rols' => $rols]);

    }


    public function infoUpfate(Request $request)
    {
        Infowebsite::first()->update([
            'rols' => $request->rols,
            'keyWord' => $request->keyWord,
            'instagram' => $request->instagram,
            'telegram' => $request->telegram,
            'suporter' => $request->suporter,
            'info' => $request->info,
        ]);
        return redirect()->back();
    }
}
