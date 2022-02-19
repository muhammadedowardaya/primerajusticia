<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

    public function index()
    {
        $data = [
            'galleries' => Gallery::all(),
            'title' => "galleries"
        ];
        // return view('himatika.home', $data);
        dd($data['galleries']);
    }
}