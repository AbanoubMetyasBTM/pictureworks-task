<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserController extends Controller
{

    public function getUser(int $userId)
    {

        $userObj = User::getUserById($userId);
        if (!is_object($userObj)) {
            return response()->make("No such user (3)", 404);
        }

        return view("get_user", [
            "user" => $userObj
        ]);

    }


    private function _validatedUpdateUserComments(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                "password" => "required",
                "id"       => "required|numeric",
                "comments" => "required",
            ],
            [
                "password.required" => 'Missing key/value for "password"',
                "id.required"       => 'Missing key/value for "id"',
                "id.numeric"        => 'Invalid id',
                "comments.required" => 'Missing key/value for "comments"',
            ]
        );

        if ($validator->fails()) {
            return $validator->getMessageBag()->first();
        }

        return true;

    }

    public function updateUserComments(Request $request)
    {

        //i did it this way, because i don't want to change anything at the old response at all
        if (($message = $this->_validatedUpdateUserComments($request)) !== true) {
            return response()->make($message, 422);
        }

        $userObj = User::getUserById($request->get("id"));
        if (!is_object($userObj)) {
            return response()->make("No such user (1)", 404);
        }

        if (
            $request->get("password") != "not required" &&
            $request->get("password") != "720DF6C2482218518FA20FDC52D4DED7ECC043AB"
        ) {
            return response()->make('Invalid password', 401);
        }

        if (($error = User::updateUserComments($userObj, $request->get("comments"))) !== true) {
            return response()->make('Could not update database: ' . $error, 500);
        }

        return 'OK';

    }

}
