<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_started',
        'status',
        'hold',
        'istimer',
        'autostart'
    ];

    protected $casts = [
        'date_started' => 'array',
        'hold' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
