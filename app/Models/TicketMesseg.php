<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMesseg extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'text',
        'admin',
        'ticket_id',
        'img',
    ];
}
