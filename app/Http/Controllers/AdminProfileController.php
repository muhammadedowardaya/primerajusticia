<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.profile.index', [
            'profile' => Profile::first()
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
            'alamat' => "required",
            'phone' => "required",
            'email' => "required",
            'link_video' => "required",
        ]);

        // dd($validatedData);
        Profile::create($validatedData);

        return redirect('/dashboard/profile')->with('success', 'pesan.berhasil("Data Profile baru berhasil ditambahkan!")');
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
    public function update(Request $request, Profile $profile)
    {
        $validatedData = $request->validate([
            'alamat' => "required",
            'phone' => "required",
            'email' => "required",
            'link_video' => "required",
        ]);

        $profile->update($validatedData);

        return redirect('/dashboard/profile')->with('success', 'pesan.berhasil("Data Profile berhasil diupdate!")');
        // echo json_encode($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        Profile::destroy($profile->id);
    }

    public function getUbah(Request $request)
    {
        // $id = $request->json('id');
        $profile = Profile::first();
        echo json_encode($profile);
    }
}