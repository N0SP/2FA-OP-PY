<?php

namespace App\Http\Controllers;

use
    App\Models\UserCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserCodeController extends Controller
{
    public function index()
    {
        return view('2fa');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);

        $find = UserCode::where('user_id', auth()->id())
            ->where('code', $request->code)
            ->where('updated_at', '>=', now()->subMinutes(2))
            ->first();

        if (!is_null($find)) {
            Session::put('user_2fa', auth()->id());
            return redirect()->route('home');
        }

        return back()->with('error', 'Has introducido un código incorrecto');
    }

    public function resend()
    {
        auth()->user()->generateCode();

        return back()->with('success', 'Le hemos enviado un código a su correo electrónico.');
    }
}
