<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Discussion;
class Reply extends Model
{
   protected $guarded=[];

   public function user(){
  return $this->belongsTo(User::class);

   }


   public function discussion(){
    return $this->belongsTo(Discussion::class);

     }
}
