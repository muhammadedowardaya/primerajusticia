<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pengacara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminPengacaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pengacara.index', [
            'pengacaras' => Pengacara::all()
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
            'email' => "required|email|unique:pengacara",
            'jabatan' => "required",
            'whatsapp' => "required",
            'instagram' => "nullable",
            'link' => "nullable",
            'image' => 'image|file|max:5048'
        ]);

        $slug = date('s') . '_' .  Str::slug($request->nama);

        if ($request->file('image')) {
            $fileName = $slug . '.' . $request->file('image')->getClientOriginalExtension();
            $validatedData['image'] = $fileName;
            $request->file('image')->storeAs('images/pengacara', $fileName, 'public');
        } else {
            $validatedData['image'] = null;
        }

        // dd($validatedData);
        Pengacara::create($validatedData);

        return redirect('/dashboard/pengacara')->with('success', 'pesan.berhasil("Data Pengacara baru berhasil ditambahkan!")');
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
    public function update(Request $request, Pengacara $pengacara)
    {
        $validatedData = $request->validate([
            'nama' => "required",
            'email' => "required|email|unique:pengacara,email,$pengacara->id",
            'jabatan' => "required",
            'whatsapp' => "required",
            'instagram' => "nullable",
            'link' => "nullable",
            'image' => 'image|file|max:5048'
        ]);

        $slug = date('s') . Str::slug($pengacara->name);

        if ($request->file('image')) {
            $fileName = $slug . '.' . $request->file('image')->getClientOriginalExtension();
            if ($request->oldImage) {
                Storage::delete('/images/pengacara/' . $request->oldImage);
            }
            $validatedData['image'] = $fileName;
            $request->file('image')->storeAs('images/pengacara', $fileName, 'public');
        }
        // dd($fileName);
        $pengacara->update($validatedData);

        return redirect('/dashboard/pengacara')->with('success', 'pesan.berhasil("Data Pengacara berhasil diupdate!")');
        // echo json_encode($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengacara $pengacara)
    {
        if ($pengacara->image) {
            Storage::delete('/images/pengacara/' . $pengacara->image);
        }
        Pengacara::destroy($pengacara->id);
    }

    public function getUbah(Request $request)
    {
        $id = $request->json('id');
        $pengacara = Pengacara::where('id', $id)->first();
        echo json_encode($pengacara);
    }
}