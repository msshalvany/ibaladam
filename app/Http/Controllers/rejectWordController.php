<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\RejectWord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class rejectWordController extends Controller
{
    public function rejectWord()
    {
        $words = RejectWord::all();
        return view('admin.rejectWord.rejectWord', ['words' => $words]);
    }

    public function addRejectWord(Request $request)
    {
        $validat = Validator::make($request->all(), [
            'mesege' => 'required',
            'wordsReg' => 'required',
        ]);
        if ($validat->fails()) {
            return redirect()->back()->withErrors($validat)->withInput();
        }
        RejectWord::create([
            'mesege' => $request->mesege,
            'words' => $request->wordsReg,
            'price' => $request->price
        ]);
        return redirect()->back();
    }

    public function removRejectWord(Request $request)
    {
        RejectWord::find($request->id)->delete();
        return redirect()->back();
    }
}
