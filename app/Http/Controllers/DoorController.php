<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\door;
use App\Models\doorMessege;
use App\Models\RejectWord;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;
use function GuzzleHttp\Promise\all;

class DoorController extends Controller
{
    private function checkText($text)
    {
        $RejectWord = RejectWord::all();
        foreach ($RejectWord as $item) {
            $words = json_decode($item->words);
            $counter= 0;
            $i = 0;
            while($i<count($words)){
                if (str_contains($text,$words[$i])) {
                    $counter++;
                }
                $i++;
            }
            if ($counter==$i) {
                return $item->mesege;
            }
        }
        return 1;
    }
    protected function index()
    {
        $door = door::where('status', 'check')->paginate(25);
        return view('admin.door.index', ['door' => $door]);
    }
    public function otherCity()
    {
        $user = User::find(session()->get('user'));
        $score = $user->score;
        if ($score < 100) {
            return "scor";
        } else {
            $user->update([
                'other_city' => 1,
            ]);
            return 1;
        }
    }

    public function doorNwe(Request $request)
    {
        $checkText = $this->checkText($request->topic.' '.$request->title);
        if ($checkText!=1) {
            return redirect()->back()->with('checkText',$checkText);
        }
        $user = User::find(session()->get('user'));
        if ($user->block == 1) {
            return redirect()->back()->with('blockErroe');
        }
        $valid = Validator::make($request->all(), [
            'user_id' => 'required',
            'title' => 'required|max:1000',
            'topic' => 'required|max:2000',
            'subgrops' => 'required',
            'password' => 'max:20',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->with('doorErroe');
        }
        $img = 'null';
        if ($user->other_city != 0 && $request->city == 0) {
            $city = $user->other_city;
        } else {
            $city = $user->city;
        }
        if ($user->all_city != 0) {
            $city = ($request->all_city) ? 'all_city' : $request->city;
        }
        if ($request->file('img')) {
            $valid = Validator::make($request->all(), [
                'img' => 'image|max:100000',
            ]);
            if ($valid->fails()) {
                return redirect()->back()->with('imgEr');
            }
            $file = $request->file('img');
            $name = Str::random(24) . '.' . $file->getClientOriginalExtension();
            $path = 'ibaladam/img/door/';
            $file->move($path, $name);
            $img = $path . $name;
        }
        door::create([
            'title' => $request->title,
            'topic' => $request->topic,
            'time' => new Verta(),
            'user_id' => $request->user_id,
            'status' => 'check',
            'city' => $city,
            'grops' => $request->grops,
            'img' => $img,
            'subgrops' => $request->subgrops,
            'password' => $request->password,
            'password_status'=> $request->password? 1 :0 ,
            'price' => $request->price?$request->price:0,
        ]);
        $user = User::find($request->user_id);
        $user->update([
            'status_door' => 'check'
        ]);
        return redirect()->back()->with('witeDoor');
    }

    protected function deleteDoor($id, Request $request)
    {
        $user = User::find($request->user);
        $mesege = doorMessege::where('door_id', $id)->get();
        foreach ($mesege as $item) {
            doorMessege::find($item->id)->delete();
        }
        File::deleteDirectory('ibaladam/img/doorMessege/' . $id);
        door::find($id)->delete();
        $user->update([
            "status_door" => 'new',
        ]);
        return redirect()->back();
    }

    protected function setDoor($id, $user_id)
    {
        $door = door::find($id);
        $user = User::find($user_id);
        if ($door->city == 'all_city') {
            $user->update([
                'all_city' => 0
            ]);
        }
        if ($user->other_city == 1 && $user->other_city != $user->city) {
            $score = $user->score;
            $score = $score - 1000;
            $user->update([
                'score' => $score,
                'other_city' => 0,
            ]);
        }
        File::makeDirectory('ibaladam/img/doorMessege/' . $door->id);
        $door->update([
            'status' => 'accept'
        ]);

        $user->update([
            'status_door' => 'accept',
        ]);
        return redirect()->back();
    }


    protected function rejecDoorViwe($id, $user_id)
    {
        return view('admin.door.reject', ['id' => $id, 'user_id' => $user_id]);
    }

    function rejecDoor($id, $user_id, Request $request)
    {
        $door = door::find($id);
        if (!$door) {
            return redirect('/dashbord');
        }
        $user = User::find($user_id);
        if ($door->img) {
            File::delete($door->img);
        }
        doorMessege::where('door_id',$door->id)->delete();
        File::delete('ibaladam/img/doorMessege/' . $door->id);
        $door->delete();
        $user->update([
            "status_door" => 'reject',
            "rejectDoorMesseg" => $request->mesege ? $request->mesege : '-'
        ]);
        return redirect('/dashbord');
    }

    public function resetDoor(Request $request, $id)
    {
        $user = User::find($request->user);
        $door = door::find($id);
        if ($user->status_door == 'reject') {
            $user->update([
                "status_door" => 'new',
            ]);
            return redirect()->back();
        }
        if ($id != 0) {
            File::delete($door->img);
            $door->delete();
        }
        $user->update([
            "status_door" => 'new',
        ]);
        return redirect()->back();
    }


    public function getDoor($count, $category, $city, $price, $search)
    {
        $save = [];
        $doors_see = [];
        if (session()->exists('user')) {
            $user = User::find(session()->get('user'));
            $save = json_decode($user->saveDoor);
            $doors_see = json_decode($user->doors_see);
        }
        $category = json_decode($category);
        $end = $count * 8;
        $start = $end - 8;
        if ($category == 0) {
            $doors = door::where('status', 'accept')->where(function ($q) use ($city) {
                if ($city != 'null') {
                    $q->where('city', $city)->orWhere('city', 'all_city');
                }
            })->where(function ($q) use ($price) {
                if ($price != 'null') {
                    $q->where('price', "!=", 0);
                }
            })->where(function ($q) use ($search) {
                if ($search != 'null') {
                    $q->where('topic', "LIKE", "%$search%")->orWhere('title', "LIKE", "%$search%");;
                }
            })->orderBy('id', 'ASC')->orderBy('sort', 'ASC')->skip($start)->take(8)->get();
            foreach ($doors as $key) {
                $id = $key->id;
                if (in_array($id, $save)) {
                    $key['save'] = 1;
                } else {
                    $key['save'] = 0;
                }
                if (in_array($id, $doors_see)) {
                    $key['see'] = 1;
                } else {
                    $key['see'] = 0;
                }
            }
            return $doors;
        } else {
            $res = [];
            for ($i = 0; $i < count($category); $i++) {
                $doors = door::where('status', 'accept')->where('subgrops', $category[$i])->where(function ($q) use ($city) {
                    if ($city != 'null') {
                        $q->where('city', $city)->orWhere('city', 'all_city');
                    }
                })->where(function ($q) use ($price) {
                    if ($price != 'null') {
                        $q->where('price', "!=", 0);
                    }
                })->where(function ($q) use ($search) {
                    if ($search != 'null') {
                        $q->where('topic', "LIKE", "%$search%")->orWhere('title', "LIKE", "%$search%");;
                    }
                })->orderBy('id', 'DESC')->orderBy('sort', 'DESC')->skip($start)->take(8)->get();
                if (count($doors) != 0) {
                    $res[] = $doors;
                }
            }
            $result = [];
            foreach ($res as $arr) {
                foreach ($arr as $arr2) {
                    $result[] = $arr2;
                }
            }
            foreach ($result as $key) {
                $id = $key->id;
                if (in_array($id, $save)) {
                    $key['save'] = 1;
                } else {
                    $key['save'] = 0;
                }
                if (in_array($id, $doors_see)) {
                    $key['see'] = 1;
                } else {
                    $key['see'] = 0;
                }
            }
            return $result;
        }
    }

    public function doorList()
    {
        $door = door::where('status', '!=', 'check')->paginate(100);
        return view('admin.door.doorList', ['door' => $door]);
    }

    public function doorShow($id)
    {
        $door = door::find($id);
        $user = User::find($door->user_id);
        $messege = doorMessege::where('door_id', $id)->orderBy('id', 'desc')->get();
        return view('admin.door.show', ['messege' => $messege, 'door' => $door, 'user' => $user]);
    }

    public function pinDoor($id, $val)
    {
        if ($val == 1) {
            door::query()->update(['pin' => 0]);
            return redirect()->back();
        }
        door::query()->update(['pin' => 0]);
        door::find($id)->update([
            'pin' => 1
        ]);
        return redirect()->back();
    }

    public function deleteMesesege($id)
    {
        $messege = doorMessege::find($id);
        if ($messege->img != 'null') {
            File::delete($messege->img);
        }
        $messege->delete();
        return redirect()->back();
    }

    public function cehckAcceptDoor($id)
    {
        $door = door::where('user_id', $id)->first();
        if ($door == null) {
            return User::find($id)->rejectDoorMesseg;
        } else {
            return $door;
        }
    }

    public function checkHavDoor($id)
    {
        $door = door::find($id);
        $user = User::find(session()->get('user'));
        $doors_see = json_decode($user->doors_see);
        if (in_array($door->id, $doors_see) || $door->user_id == $user->id) {
            return 1;
        } else {
            if ($door->password != null) {
                return 'p';
            }
            return 0;
        }
    }
    function blockMessege(Request $request) {
        $door = door::find($request->id);
        $door->update([
            'messegeBlock'=>$request->val
        ]);
        return 1;
    }
}
