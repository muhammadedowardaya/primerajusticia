<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminGambarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.gambar.index', [
            'gambar' => Gambar::first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hero' => 'required|image|file|max:2048',
            'bg_about' => 'required|image|file|max:2048',
            'about' => 'required|image|file|max:2048',
        ]);
        $hero = date('s') . '_' .  Str::slug($request->hero);
        $bg_about = date('s') . '_' .  Str::slug($request->bg_about);
        $about = date('s') . '_' .  Str::slug($request->about);
        $heroFileName = $hero . '.' . $request->file('hero')->getClientOriginalExtension();
        $bg_aboutFileName = $bg_about . '.' . $request->file('bg_about')->getClientOriginalExtension();
        $aboutFileName = $about . '.' . $request->file('about')->getClientOriginalExtension();

        if ($request->file('hero')) {
            $validatedData['hero'] = $heroFileName;
            $request->file('hero')->storeAs('images/gambar', $heroFileName, 'public');
        } else if ($request->file('bg_about')) {
            $validatedData['bg_about'] = $bg_aboutFileName;
            $request->file('bg_about')->storeAs('images/gambar', $bg_aboutFileName, 'public');
        } else if ($request->file('about')) {
            $validatedData['about'] = $aboutFileName;
            $request->file('about')->storeAs('images/gambar', $aboutFileName, 'public');
        } else {
            $validatedData['hero'] = null;
            $validatedData['bg_about'] = null;
            $validatedData['about'] = null;
        }
        // dd($validatedData);
        Gambar::create($validatedData);

        return redirect('/dashboard/gambar')->with('success', 'pesan.berhasil("Gambar Halaman Profile baru berhasil ditambahkan!")');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gambar $gambar)
    {
        $validatedData = $request->validate([
            'hero' => 'image|file|max:2048',
            'bg_about' => 'image|file|max:2048',
            'about' => 'image|file|max:2048',
        ]);

        $hero = date('s') . '_' .  Str::slug($request->hero);
        $bg_about = date('s') . '_' .  Str::slug($request->bg_about);
        $about = date('s') . '_' .  Str::slug($request->about);

        $heroFileName = $hero . '.' . $request->file('hero')->getClientOriginalExtension();
        $bg_aboutFileName = $bg_about . '.' . $request->file('bg_about')->getClientOriginalExtension();
        $aboutFileName = $about . '.' . $request->file('about')->getClientOriginalExtension();

        if ($request->file('hero')) {
            if ($request->oldHero) {
                Storage::delete('/images/gambar/' . $request->oldHero);
            }
            $validatedData['hero'] = $heroFileName;
            $request->file('hero')->storeAs('images/gambar', $heroFileName, 'public');
        }

        if ($request->file('bg_about')) {
            if ($request->oldBg_about) {
                Storage::delete('/images/gambar/' . $request->oldBg_about);
            }
            $validatedData['bg_about'] = $bg_aboutFileName;
            $request->file('bg_about')->storeAs('images/gambar', $bg_aboutFileName, 'public');
        }

        if ($request->file('about')) {
            if ($request->oldAbout) {
                Storage::delete('/images/gambar/' . $request->oldAbout);
            }
            $validatedData['about'] = $aboutFileName;
            $request->file('about')->storeAs('images/gambar', $aboutFileName, 'public');
        }

        // dd($fileName);
        $gambar->update($validatedData);

        return redirect('/dashboard/gambar')->with('success', 'pesan.berhasil("Gambar Halaman Profile berhasil diupdate!")');
        // echo json_encode($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gambar $gambar)
    {
        if ($gambar->hero) {
            Storage::delete('/images/gambar/' . $gambar->hero);
        } else  if ($gambar->bg_about) {
            Storage::delete('/images/gambar/' . $gambar->bg_about);
        } else  if ($gambar->about) {
            Storage::delete('/images/gambar/' . $gambar->about);
        }
        Gambar::destroy($gambar->id);
    }

    public function getUbah(Request $request)
    {
        $id = $request->json('id');
        $gambar = Gambar::find($id);
        echo json_encode($gambar);
    }
}