<?php

namespace App\Http\Controllers;

use App\Models\UploadFiles;
use Illuminate\Http\Request;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class LandingPage extends Controller
{
    public function home()
    {
        return view('home')->with('pages', 'home');
    }

    public function source_code()
    {
        return view('source_code')->with('pages', 'source code');
    }

    public function detail_source_code($slug)
    {
        return view('detail_source_code')->with('pages', 'detail source code');
    }
    
}
