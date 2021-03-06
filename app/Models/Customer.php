<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'customers';
    protected $guarded = [];
    protected $fillable = [
        'name',
        'email',
        'phone',
        'status_id',
    ];

    public function status(){
        return $this->hasOne(Status::class,'id', 'status_id');
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($customer) {
            $customer->status()->delete();
        });
    }
}
