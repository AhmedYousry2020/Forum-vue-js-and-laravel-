<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class profile extends Model
{

    protected $fillable = [
        'user_id','about', 'twitter', 'facebook','image'
    ];
    public function user(){
return $this->belongsTo(User::class);

    }
}
