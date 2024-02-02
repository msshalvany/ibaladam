<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMesseg;
use App\Models\User;
use Ghasedak\GhasedakApi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function ticketStor(Request $request)
    {
        $user = User::find(session()->get('user'));

        $ticket = Ticket::where('user_id', $user->id)->first();
        $request->validate([
            'text' => 'required|max:500',
            'img' => 'image|max:10000'
        ]);
        $img = null;
        if ($request->file('img')) {
            $file = $request->file('img');
            $name = Str::random(24) . '.' . $file->getClientOriginalExtension();
            $path = 'ibaladam/img/ticket/';
            $file->move($path, $name);
            $img = $path . $name;
        }
        TicketMesseg::create([
            'text' => $request->text,
            'user_id' => $user->id,
            'admin' => 0,
            'ticket_id' => $ticket->id,
            'img' => $img,
        ]);
        $sort = $ticket->sort;
        $sort++;
        $ticket->update([
            'sort'=>$sort
        ]);

        return redirect()->back();
    }

    public function ticketStorAdmin(Request $request)
    {
        $request->validate([
            'text' => 'required|max:500',
            'img' => 'image|max:10000'
        ]);
        $img = null;
        if ($request->file('img')) {
            $file = $request->file('img');
            $name = Str::random(24) . '.' . $file->getClientOriginalExtension();
            $path = 'ibaladam/img/ticket/';
            $file->move($path, $name);
            $img = $path . $name;
        }
        TicketMesseg::create([
            'text' => $request->text,
            'user_id' => 0,
            'admin' => 1,
            'ticket_id' => $request->ticket_id,
            '$img' => $img,
        ]);
        return redirect()->back();
    }

    public function ticketList()
    {
        return view('admin.ticket.list', ['ticket' => Ticket::orderBy('id', 'DESC')->get()]);
    }

    public function ticketShow($id)
    {
        $ticket = Ticket::find($id);
        $messege = TicketMesseg::orderBy('id', 'DESC')->where('ticket_id', $ticket->id)->get();
        $Usermessege = TicketMesseg::orderBy('id', 'DESC')->where('ticket_id', $ticket->id)->where('user_id', '!=', 0)->get();
        $user = User::find($ticket->user_id);
        $ticket->update([
            'lastSee' => $Usermessege[0]->id
        ]);
        return view('admin.ticket.show', ['messege' => $messege, 'ticket' => $ticket, 'user' => $user]);
    }

    public function sendUserSmsTicket(Request $request)
    {
        $user = User::find($request->id);
        $messege = new GhasedakApi('ff35f8690aa652194bbcd5cbad763622b0638f4af8059d9e1fb749969dc3fbda');
        $messege->Verify(
            $user->phon,
            'ibaladamReadyUser',
            $user->phon,
        );
    }
}
