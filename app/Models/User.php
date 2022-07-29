<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table      = "users";
    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'comments',
    ];


    public static function getUserById(int $userId)
    {

        return self::find($userId);

    }

}
