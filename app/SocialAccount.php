<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
protected $fillable=['provider_id','provider_name'];

    public function user(){
return $this->belongsTo(User::class);

    }
}
