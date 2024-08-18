<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClubController extends Controller
{


    public function index()
    {
        $clubInfo = [
            'name' => 'Laravel Lovers Club',
            'description' => 'A club for Laravel enthusiasts to share knowledge and experiences.',
            'location' => 'Online',
        ];

        return view('club', compact('clubInfo'));
    }
}
