<?php

namespace App\Http\Controllers;

use App\Models\door;
use App\Models\doorMessege;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DoorMessegeController extends Controller
{
    public function setMessege(Request $request)
    {
        $user = User::find($request->user);
        $door = door::find($request->door);
        if ($door->messegeBlock=='true' && $door->user_id != $user->id) {
            return redirect()->back()->with('messegeBlock','1');
        }
        if ($user->block==1) {
            return redirect()->back()->with('blockErroe');
        }
        if (session()->exists('user')!=1){
            return  redirect()->back()->with('userError', '1');
        }
        $valid = Validator::make($request->all(), [
            'user' => 'required',
            'door' => 'required',
            'messege' => 'required',
            'file' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);
        if ($valid->fails()) {
            if ($request->messege==''){
                return redirect()->back()->with('errorDoorMessege', '1');
            }
            return redirect()->back()->with('errorDoorImg', '1');
        } else {
            $last = door::max('sort');
            if ($door === null ) {
                return 'این اتاق پاک شده';
            }
            $img = 'null';
            if ($request->file('img')){
                $name = Str::random(24).$request->file('img')->getClientOriginalExtension();
                $request->file('img')->move('ibaladam/img/doorMessege/'.$request->door,$name);
                $img = '/ibaladam/img/doorMessege/'.$request->door.'/'.$name;
            }
            doorMessege::create([
                'user_id' => $request->user,
                'door_id' => $request->door,
                'text' => $request->messege,
                'img' => $img,
                'time' => new verta(),
            ]);
            $door->update([
                'sort'=> $last + 1
            ]);
            return redirect()->back();
        }
    }
    public function checkMessege($door , $messege){
        $messegesDB =  doorMessege::where('door_id',$door)->orderBy('id','desc')->first();
        if ($messegesDB->id != $messege){
            $profile = User::find($messegesDB->user_id)->image;
            $messegesDB->profile = $profile;
            return $messegesDB;
        }else{
            return 0;
        }
    }
}
