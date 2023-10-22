<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ParseController extends Controller
{
    public function parseButton(Request $request)
    {

        $data = $request->input('data');

        $modifiedData = [];

        $modifiedData = collect($data)->map(function ($user) {
            $user['name'] = strtolower($user['name']);
            $user['email'] = '<a href="mailto:' . $user['email'] . '">' . $user['email'] . '</a>';
            return $user;
        });

        return response()->json(['data' => $modifiedData]);
    }
}
