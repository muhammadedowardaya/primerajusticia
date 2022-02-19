<?php

namespace App\Http\Controllers;

use App\Models\BantuanHukum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBantuanHukumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.bantuan_hukum.index', [
            'bantuanHukum' => BantuanHukum::all()
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
            'nama' => "required",
            'judul' => "required",
            'sub_judul' => "required",
            'deskripsi' => "required",
            'image' => 'image|file|max:5048'
        ]);

        $slug = date('s') . '_' .  Str::slug($request->nama);
        $fileName = $slug . '.' . $request->file('image')->getClientOriginalExtension();
        $validatedData['slug'] = $slug;

        if ($request->file('image')) {
            $validatedData['image'] = $fileName;
            $request->file('image')->storeAs('images/bantuan_hukum', $fileName, 'public');
        } else {
            $validatedData['image'] = null;
        }
        // dd($validatedData);
        BantuanHukum::create($validatedData);

        return redirect('/dashboard/bantuan')->with('success', 'pesan.berhasil("Bantuan Hukum baru berhasil ditambahkan!")');
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
    public function update(Request $request, BantuanHukum $bantuan)
    {
        $validatedData = $request->validate([
            'nama' => "required",
            'judul' => "required",
            'sub_judul' => "required",
            'deskripsi' => "required",
            'image' => 'image|file|max:5048'
        ]);

        $slug = date('s') . Str::slug($bantuan->nama);
        $validatedData['slug'] = $slug;

        if ($request->file('image')) {
            $fileName = $slug . '.' . $request->file('image')->getClientOriginalExtension();
            if ($request->oldImage) {
                Storage::delete('/images/bantuan_hukum/' . $request->oldImage);
            }
            $validatedData['image'] = $fileName;
            $request->file('image')->storeAs('images/bantuan_hukum', $fileName, 'public');
        }
        // dd($fileName);
        $bantuan->update($validatedData);

        return redirect('/dashboard/bantuan')->with('success', 'pesan.berhasil("Bantuan Hukum berhasil diupdate!")');
        // echo json_encode($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BantuanHukum $bantuan)
    {
        if ($bantuan->image) {
            Storage::delete('/images/bantuan_hukum/' . $bantuan->image);
        }
        BantuanHukum::destroy($bantuan->id);
    }

    public function getUbah(Request $request)
    {
        $id = $request->json('id');
        $bantuan = BantuanHukum::find($id);
        echo json_encode($bantuan);
    }
}