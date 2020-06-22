<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "p_users";
    protected $primaryKey = "user_id";
    public $timestamps = false;
    protected $fillable=["user_id","user_name","password","email"];
}
