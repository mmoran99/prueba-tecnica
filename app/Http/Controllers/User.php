<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Country;
use App\Models\State;
use App\Models\Area;

class User extends Controller
{
    public function index()
    {
        $users = Users::all();
        $countries = Country::all();
        $areas = Area::all();
        return view('users.index', compact('users', 'countries', 'areas'));
    }

    public function detail($id)
    {
        $user = Users::find($id);
        $states = State::where('id_country', $user->id_country)->get();
        return compact('user', 'states');
    }

    public function delete($id)
    {
        $user = Users::find($id);
        if ( $user === null ) {
            return 0;
        } else {
            $user->delete();
            return 1;
        }
    }

    public function add(Request $request)
    {
        $user = new Users;
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->sex = $request->sex;
        $user->id_country = $request->country;
        $user->id_state = $request->state;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->id_area = $request->area;
        $user->active = 1;
        $user->save();
        return $user->id_user;
    }

    public function edit (Request $request, User $user)
    {
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->sex = $request->sex;
        $user->id_country = $request->country;
        $user->id_state = $request->state;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->id_area = $request->area;
        return $user;
        //$user->save();
        //return $user->id_user;
    }

    public function findStates(Request $request)
    {
        $id = $request->country;
        $states = State::where('id_country', $id)->get();
        return compact('states');
    }

    public function filter($id_area)
    {
        $users = Users::where('id_area', $id_area)->get();
        $countries = Country::all();
        $areas = Area::all();
        return view('users.index', compact('users', 'countries', 'areas'));
    }
}
