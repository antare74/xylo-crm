<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Status extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table    = 'statuses';
    protected $fillable = [
        'status',
        'agent_id',
    ];

    public function user(){
        return $this->hasOne(User::class,'id', 'agent_id');
    }
}
