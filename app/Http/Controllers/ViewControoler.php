<?php

namespace App\Http\Controllers;

use App\Models\door;
use App\Models\doorMessege;
use App\Models\Grop;
use App\Models\Infowebsite;
use App\Models\Ticket;
use App\Models\TicketMesseg;
use App\Models\User;
use Password;

class ViewControoler extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grop = Grop::all();
        $info = Infowebsite::first();
        foreach ($grop as $item) {
            $item->subGrop = json_decode($item->subGrop);
        }
        $user = 0;
        if (session()->get('user')) {
            $user = User::find(session()->get('user'));
        }
        $pinDoor = door::where('pin', 1)->first();
        return view('ibaladam.index', ['user' => $user, 'grop' => $grop, 'info' => $info, 'pinDoor' => $pinDoor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function panel()
    {
        $grop = Grop::all();
        $info = Infowebsite::first();
        $user = null;
        $door = null;
        foreach ($grop as $item) {
            $item->subGrop = json_decode($item->subGrop);
        }
        if (session()->get('user')) {
            $user = User::find(session()->get('user'));
            if (door::where('user_id', $user->id)->first()) {
                $door = door::where('user_id', $user->id)->first();
            }
            $save = json_decode($user->saveDoor);
            $saveDoors = [];
            foreach ($save as $item) {
                $doorItem = door::find($item);
                if ($doorItem) {
                    array_push($saveDoors, $doorItem);
                }
            }
        } else {
            $user = 0;
        }
        return view('ibaladam.panel', ['user' => $user, 'grop' => $grop, 'info' => $info, 'door' => $door, 'saveDoors' => $saveDoors]);
    }


    public function recetPassViwe()
    {
        return view('ibaladam.resetPassword');
    }

    public function info()
    {
        $info = Infowebsite::first();
        $rols = json_decode(Infowebsite::first()->rols);
        $user = User::find(session()->get('user'));
        return view('ibaladam.info', ['info' => $info, 'rols' => $rols, 'user' => $user]);
    }

    public function doorViwe($id, $password = null)
    {
        $info = Infowebsite::first();
        $user = User::find(session()->get('user'));
        $messege = doorMessege::where('door_id', $id)->orderBy('id', 'desc')->get();
        $door = door::find($id);
        if ($door === null ) {
            return 'این اتاق پاک شده';
        }
        $doors_see = json_decode($user->doors_see);
        if (in_array($door->id, $doors_see) || $door->user_id == $user->id) {
            $ownUser = User::find($door->user_id);
            return view('ibaladam.doorViwe', ['messege' => $messege, 'door' => $door, 'user' => $ownUser, 'info' => $info]);
        } else {
            if ($user->score > 0) {
                if ($password != $door->password && $door->password != null) {
                    return 'pass';
                }
                array_push($doors_see, $door->id);
                $user->update([
                    'score' => $user->score - 1,
                    'doors_see' => json_encode($doors_see)
                ]);
                $count = $door->count;
                $count = $count + 1;
                $door->update([
                    'count' => $count
                ]);
                $ownUser = User::find($door->user_id);
                return view('ibaladam.doorViwe', ['messege' => $messege, 'door' => $door, 'user' => $ownUser, 'info' => $info]);
                return response()->json([
                    'view' => view('test', compact('data', 'data1'))->render(),
                ]);
            } else {
                return redirect()->back();
            }
        }
    }
    public function ticket()
    {
        $user = User::find(session()->get('user'));
        $ticket = Ticket::where('user_id', $user->id)->first();
        if (!Ticket::where('user_id', $user->id)->first()) {
            Ticket::create([
                'user_id' => $user->id,
                'sort'=>Ticket::max('id') + 1
            ]);
        }
        $ticket = Ticket::where('user_id', $user->id)->first();
        $messege = TicketMesseg::orderBy('id', 'DESC')->where('ticket_id', $ticket->id)->get();
        return view('ibaladam.ticket', ['user' => $user, 'messege' => $messege]);
    }
}
