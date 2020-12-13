<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Channel;
use App\Reply;
class Discussion extends Model
{
    protected $fillable = ["title","content","slug","user_id","channel_id"];


    public function user(){

        return $this->belongsTo(user::class);

    }
    public function channel(){

        return $this->belongsTo(channel::class);

    }

    public function replies(){

        return $this->hasMany(Reply::class);
       }

}
