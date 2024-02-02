<?php

namespace App\Http\Controllers;

use App\Models\door;
use App\Models\doorMessege;
use App\Models\User;
use Illuminate\Support\Str;
use Ghasedak\GhasedakApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Evryn\LaravelToman\CallbackRequest;
use Evryn\LaravelToman\Facades\Toman;

class UserControllerr extends Controller
{
    // )tU[Xf[kJ^&S
    public function sendPhon(Request $request, User $user)
    {
        $validat = Validator::make($request->all(), [
            'phon' => 'required|min:11|numeric',
        ]);
        if ($validat->fails()) {
            return 0;
        } else {
            if ($user->where('phon', $request->phon)->first()) {
                return 'has';
            }
             $code = rand(1000, 9999);
            session(['code' => $code]);
             $messege = new GhasedakApi('ff35f8690aa652194bbcd5cbad763622b0638f4af8059d9e1fb749969dc3fbda');
             $messege->Verify(
                 $request->phon,
                 'ibaladam',
                 $code,
             );
            session(['phon' => $request->phon, 'code' => $code]);
            return 1;
        }
    }


    public function AuthStore(Request $request, User $user)
    {
        if ($request->code == session()->get('code')) {
            session(['AuthStore' => 1]);
            return 1;
        } else {
            return 0;
        }
    }

    public function createUser(Request $request, User $user)
    {
        $validat = Validator::make($request->all(), [
            'username' => 'required',
        ]);
        if ($validat->fails()) {
            return 'username';
        }
        $validat = Validator::make($request->all(), [
            'city' => 'required',
        ]);
        if ($validat->fails()) {
            return 'city';
        }
        if (session()->get('AuthStore') == 1) {
            if ($request->invider) {
                if (!$user->where('phon', $request->invider)->first()) {
                    return 'invider';
                } else {
                    $target = $user->where('phon', $request->invider)->first();
                    $newScore = $target->score;
                    $newScore = $newScore + 100;
                    $target->update([
                        'score' => $newScore
                    ]);
                }
            }
            $user->create([
                'username' => $request->username,
                'password' => $request->password,
                'phon' => session()->get('phon'),
                'status_door' => 'new',
                'image' => '/ibaladam/img/man.png',
                'rejectDoorMesseg' => 'null',
                'score' => 10,
                'doors_see' => json_encode([]),
                'saveDoor' => json_encode([]),
                'city' => $request->city
            ]);
            $userid = $user->where('phon', session()->get('phon'))->first()->id;
            session(['user' => $userid]);
            return 1;
        } else {
            return 0;
        }
    }

    public function loginUser(Request $request, User $user)
    {
        if ($user->where('phon', $request->phon)->where('password', $request->password)->first()) {
            session(['user' => $user->where('phon', $request->phon)->where('password', $request->password)->first()->id]);
            return 1;
        } else {
            return 0;
        }
    }

    public function imageUpdate(Request $request)
    {
        $img = $request->file('img');
        $name = Str::random(12) . '.' . $img->getClientOriginalExtension();
        $img->move('ibaladam/img/profile/', $name);
        if (User::find(session()->get('user'))->image != '/ibaladam/img/profile/man.jpg') {
            File::delete(User::find(session()->get('user'))->image);
        }
        User::find(session()->get('user'))->update([
            'image' => '/ibaladam/img/profile/' . $name
        ]);
        return redirect()->back();
    }

    public function logOutUser()
    {
        session()->forget('user');
    }

    public function editInfoUser($id)
    {
        $user = User::find($id);
        return view('ibaladam.ededInfo', ['user' => $user]);
    }

    public function userupdate(Request $request)
    {
        $validat = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validat->fails()) {
            return 0;
        } else {
            $user = User::find($request->id);
            $user->update([
                'username' => $request->username,
                'password' => $request->password,
            ]);
            return 1;
        }
    }

    public function recetUserPass(Request $request)
    {
        $validat = Validator::make($request->all(), [
            'phon' => 'required|numeric|min:10',
        ]);
        if ($validat->fails()) {
            return 0;
        } else {
            if (User::where('phon', $request->phon)->first()) {
                $cdoeRecrtPaass = 123;
                $cdoeRecrtPaass = rand(1000, 9999);
                $messege = new GhasedakApi('ff35f8690aa652194bbcd5cbad763622b0638f4af8059d9e1fb749969dc3fbda');
                $messege->Verify(
                    $request->phon,
                    'ibaladam',
                    $cdoeRecrtPaass,
                );
                session(['cdoeRecrtPaass' => $cdoeRecrtPaass, 'userُRecetPass' => User::where('phon', $request->phon)->first()->id]);
                return 1;
            } else {
                return 0;
            }
        }
    }


    public function recetUserPassAuth(Request $request)
    {
        if ($request->code == session()->get('cdoeRecrtPaass')) {
            session()->forget('cdoeRecrtPaass');
            $user = session()->get('userُRecetPass');
            session(['user' => $user]);
            session()->forget('userُRecetPass');
            return 1;
        } else {
            return 0;
        }
    }

    public function recetUserPsswordEnd(Request $request)
    {
        $user = User::find(session()->get('user'));
        $user->update([
            'password' => $request->password
        ]);
        return 1;
    }

    public function userShow()
    {
        $user = User::paginate(40);
        $count = User::count();
        return view('admin.user.user', ['user' => $user, 'count' => $count]);
    }

    public function searchUser(Request $request)
    {
        $user = User::where('city', 'like', '%' . $request->text . '%')->orWhere('phon', 'like', '%' . $request->text . '%')->paginate(40);
        $count = User::count();
        return view('admin.user.user', ['user' => $user, 'count' => $count]);
    }

    public function pay_city()
    {
        $request = Toman::amount(25 * 1000)->callback(route('checkPay'))->request();
        if ($request->successful()) {
            $transactionId = $request->transactionId();
            return $request->pay(); // Redirect to payment URL
        }
        if ($request->failed()) {
            return 'در حال حاضر امکان پرداخت وجود ندارد';
        }
    }

    public function BlockUser(User $user, doorMessege $doorMessege)
    {
        $doorMessege->delete();
        $user->update([
            'block' => 1
        ]);
        return redirect()->back();
    }

    public function unBlockUser(User $user)
    {
        $user->update([
            'block' => 0
        ]);
        return redirect()->back();
    }

    public function checkPay(CallbackRequest $request)
    {
        $payment = $request->amount(session()->get('count') * 1000)->verify();
        if ($payment->successful()) {
            $user = User::find(session()->get('user'));
            $user->update([
                'all_city' => 1
            ]);
            return redirect('/panel')->with('paySucc', 1);
        }
        if ($payment->alreadyVerified()) {
            return 'پرداخت قبلاً یه بار بررسی و تایید شده بود. شناسه ارجاع همچنان در دسترسه.';
        }

        if ($payment->failed()) {
            return redirect('/panel')->with('pay', 'erroe');
        }
    }

    public function mark(User $user, door $door)
    {
        $save = json_decode($user->saveDoor);
        array_push($save, $door->id);
        $user->update([
            'saveDoor' => json_encode($save)
        ]);
        return 1;
    }

    public function unmark(User $user, door $door)
    {
        $save = json_decode($user->saveDoor);
        $index = array_search($door->id, $save);
        if ($index !== false) {
            unset($save[$index]);
        }
        $user->update([
            'saveDoor' => json_encode($save)
        ]);
        return 1;
    }
}
