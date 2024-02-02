<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function loginAdmin(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else if ($id = Admin::where('username', $request->username)->where('password', $request->password)->first()) {
            session(['admin' => $id]);
            return redirect('/dashbord');
        } else {
            return redirect()->back()->withErrors('')->withInput();
        }
    }

    public function logoutAdmin()
    {
        session()->forget('admin');
        return redirect('/');
    }

    public function dashbord()
    {
        $admin = Admin::find(session()->get('admin'));
        return view('admin.dashbord', ['admin' => $admin]);
    }

    public function index()
    {
        $admins = Admin::all();
        return view('admin.admin.index', ['admins' => $admins]);
    }

    public function create()
    {
        $admin = Admin::find(session()->get('admin')['id']);
        return view('admin.admin.add');
    }

    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'username' => 'required|regex:/^[\pL\s\-]+$/u',
            'phon' => 'required|Numeric',
            'password' => 'required',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        Admin::create([
            "username" => $request->username,
            "phon" => $request->phon,
            "password" => $request->password,
            "image" => 'aa'
        ]);
        return redirect()->action([AdminController::class, 'index']);
    }

    public function edit($id)
    {
        $admins = Admin::find($id);
        return view('admin.admin.edit', ['admins' => $admins]);
    }


    public function update(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'username' => 'required',
            'phon' => 'required|Numeric',
            'password' => 'required',
            'order' => 'required',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        Admin::find($id)->update([
            "username" => $request->username,
            "phon" => $request->phon,
            "password" => $request->password,
            "order" => $request->order,
        ]);
        return redirect()->action([AdminController::class, 'index']);
    }

    public function destroy($id)
    {
        Admin::find($id)->delete();
        return redirect()->action([AdminController::class, 'index']);
    }
}
