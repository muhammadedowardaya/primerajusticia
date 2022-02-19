<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.galleries.index', [
            'galleries' => Gallery::all()
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
            'name' => "required",
            'image' => 'image|file|max:5048'
        ]);
        $slug = date('s') . '_' .  Str::slug($request->name);
        $fileName = $slug . '.' . $request->file('image')->getClientOriginalExtension();
        $validatedData['slug'] = $slug;

        if ($request->file('image')) {
            $validatedData['image'] = $fileName;
            $request->file('image')->storeAs('images/galleries', $fileName, 'public');
        } else {
            $validatedData['image'] = null;
        }
        // dd($validatedData);
        Gallery::create($validatedData);

        return redirect('/dashboard/galleries')->with('success', 'pesan.berhasil("Gallery baru berhasil ditambahkan!")');
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
    public function update(Request $request, Gallery $gallery)
    {
        $validatedData = $request->validate([
            'name' => "required",
            'image' => 'image|file|max:2048'
        ]);

        $slug = date('s') . Str::slug($gallery->name);
        $validatedData['slug'] = $slug;

        if ($request->file('image')) {
            $fileName = $slug . '.' . $request->file('image')->getClientOriginalExtension();
            if ($request->oldImage) {
                Storage::delete('/images/galleries/' . $request->oldImage);
            }
            $validatedData['image'] = $fileName;
            $request->file('image')->storeAs('images/galleries', $fileName, 'public');
        }
        // dd($fileName);
        $gallery->update($validatedData);

        return redirect('/dashboard/galleries')->with('success', 'pesan.berhasil("Gallery berhasil diupdate!")');
        // echo json_encode($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::delete('/images/galleries/' . $gallery->image);
        }
        Gallery::destroy($gallery->id);
    }

    public function getUbah(Request $request)
    {
        $slug = $request->json('slug');
        $gallery = Gallery::where('slug', $slug)->first();
        echo json_encode($gallery->image);
    }
}