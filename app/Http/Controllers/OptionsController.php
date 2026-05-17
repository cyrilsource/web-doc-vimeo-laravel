<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Options;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
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
    public function edit()
    {
        $words               = DB::table('options')->where('name', 'words')->value('field');
        $homepageTitle       = DB::table('options')->where('name', 'homepage_title')->value('field');
        $homepageDescription = DB::table('options')->where('name', 'homepage_description')->value('field');

        return view('admin.options', compact('words', 'homepageTitle', 'homepageDescription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::table('options')
            ->where('name', 'Words')
            ->update(['field' => $request->input('field')]);

        DB::table('options')
            ->where('name', 'homepage_title')
            ->update(['field' => $request->input('homepage_title', '')]);

        DB::table('options')
            ->where('name', 'homepage_description')
            ->update(['field' => $request->input('homepage_description', '')]);

        $words               = DB::table('options')->where('name', 'words')->value('field');
        $homepageTitle       = DB::table('options')->where('name', 'homepage_title')->value('field');
        $homepageDescription = DB::table('options')->where('name', 'homepage_description')->value('field');

        return view('admin.options', compact('words', 'homepageTitle', 'homepageDescription'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
