<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectWord extends Model
{
    use HasFactory;
    protected $fillable = [
        'words',
        'mesege',
    ];
}
