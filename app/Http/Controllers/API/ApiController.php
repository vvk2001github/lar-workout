<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ApiResponser;

    public function userList(Request $request) {
        if($request->user()->tokenCan('server-admin')) {
            $users = \App\Models\User::all();
            return $this->apisuccess($users);
        } else {
            return $this->apierror('Credentials not match', 401);
        }
    }

    public function exercisesList(Request $request) {
        if($request->user()->tokenCan('server-admin')) {
            $exercises = \App\Models\Exercise::all();
        } else {
            $exercises = Exercise::where('user_id', $request->user()->id)->get()->makeHidden('user_id');
        }
        return $this->apisuccess($exercises);
    }
}
