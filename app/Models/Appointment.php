<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'phone',
        'appointment_date',
        'appointment_time',
        'appointment_message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
