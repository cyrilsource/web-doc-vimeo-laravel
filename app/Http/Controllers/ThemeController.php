<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Http\Requests\CreateThemeRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Theme;

class ThemeController extends Controller
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
        $themes = $users = DB::table('themes')
                ->orderBy('name', 'asc')
                ->get();

        return view('admin.home', ['themes' => $themes]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $datas = $request->all();

        $name = $datas['name'];

        //creation du slug à la volée
        $slug = Str::slug($datas['name']);
        //insertion slug dans array $values
        $datas['slug'] = $slug;

        //on récupère les données de l'image
        $image = $request->file('image');

        // Generate a file name
        $thumbnail = "$slug"."-".time().".".$image->getClientOriginalExtension();

        // Save the file
        $image->storeAs('public/img/theme', $thumbnail);

        $datas['thumbnail'] = $thumbnail;

        /*PDF */
        //on récupère les données pour le pdf
        $document = $request->file('pdf');

        //remove pdf extension from original name
        $originalName = substr($document->getClientOriginalName(), 0, -4);

        // Generate a file name
        $pdf = $originalName."-".rand(1,100).".".$document->getClientOriginalExtension();

        // Save the file
        $document->storeAs('public/pdf/theme', $pdf);

        $datas['pdf'] = $pdf;

        //On enleve le champ image et le champ token des valeurs envoyées à la bdd
        $datas2 = Arr::except($datas, ['image']);
        $values = Arr::except($datas2, ['_token']);

        Theme::create($values);

        $themes = $users = DB::table('themes')
                ->orderBy('name', 'asc')
                ->get();

        return view('admin.home', ['themes' => $themes]);

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
        $theme = Theme::findOrFail($id);

        return view('admin.editTheme', ['theme' => $theme]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theme = Theme::findOrFail($id);

        //suppression des fichiers
        Storage::delete("public/img/theme/".$theme['thumbnail']);
        Storage::delete("public/pdf/theme/".$theme['pdf']);

        $theme->delete();

        $themes = $users = DB::table('themes')
                ->orderBy('name', 'asc')
                ->get();

        return view('admin.home', ['themes' => $themes]);

    }
}
