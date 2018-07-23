<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='messages';
    protected $fillable=['send_to','send_from','content','created_at','updated_at'];

}
