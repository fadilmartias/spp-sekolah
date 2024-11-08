<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function setLocale(Request $request)
    {
        $locale = [
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'flag_code' => $request->input('flag_code'),
        ];
        session(['locale' => $locale]);
        App::setLocale(session('locale')['code']);
        // dd(session('locale'));
        return redirect()->back();
    }
}
