<?php

namespace App\Http\Controllers;

use App\Models\BantuanHukum;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Gambar;
use App\Models\Pengacara;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class PrimeraJusticiaController extends Controller
{
    public function index()
    {
        $data = [
            'galleries' => Gallery::all(),
            'profile' => Profile::first(),
            'pengacara' => Pengacara::all(),
            'bantuans' => BantuanHukum::all(),
            'gambar' => Gambar::first()
        ];
        return view('primera_justicia.home', $data);
    }

    public function event(Category $category)
    {
        // $category = new Category;
        $data = [
            'events' => $category->posts()->latest()->paginate(6)
        ];
        // dd($data);
        return view('primera_justicia.event', $data);
    }
}