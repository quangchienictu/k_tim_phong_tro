<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    protected $table = 'rating';
     public $timestamps = false;
   	 public  $primaryKey = 'id';

   	  public function user()
    {
        return $this->belongsTo('App\User','id_user','id');
    }
     public function motel()
    {
        return $this->belongsTo('App\Motelroom','id_motel','id');
    }
}
