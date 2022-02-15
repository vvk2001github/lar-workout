<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if($request->exists('ex_type')) {
            $exercises = \App\Models\Exercise::where('user_id', Auth::user()->id)
                ->where('ex_type', $request->ex_type)->get();
        } else {
            $exercises = [];
        }
        return $this->apisuccess($exercises);
    }
}
