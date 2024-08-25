<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sport;
use App\Models\Club;
use App\Models\User;

class ClubController extends Controller
{


    public function index(Sport $sport)
    {

        $sports = Sport::where('sport_id', $sport->id)->get();
        return view('club', compact('club', 'sports'));
    }

    public function submitInquiry(Request $request, User $user)
    {
        // Validate the form data, including the CAPTCHA
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'captcha' => 'required|captcha',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->message = $request->message;
        $user->save();
        return back()->with('success', 'entrey success');
    }
}
