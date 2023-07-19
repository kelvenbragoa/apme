<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function event_type(){
        return $this->hasOne('App\Models\EventType', 'id', 'event_type_id');
    }
}
