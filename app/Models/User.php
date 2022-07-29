<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table      = "users";
    protected $primaryKey = "id";
    public    $timestamps = false;

    protected $fillable = [
        'name',
        'comments',
    ];


    public static function getUserById(int $userId)
    {

        return self::find($userId);

    }

    public static function updateUserComments(object $userObj, string $newComment)
    {

        try {

            $userObj->update([
                "comments" => $userObj->comments . "\n" . $newComment
            ]);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return true;
    }


}
