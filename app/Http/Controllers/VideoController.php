<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Http\Requests\CreateThemeRequest;
use App\Http\Requests\CreateVideoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Theme;
use App\Video;

class VideoController extends Controller
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
        $videos = DB::table('videos')
                ->orderBy('name', 'asc')
                ->get();

        $themes = DB::table('themes')
                ->orderBy('name', 'asc')
                 ->get();

        return view('admin.videos', ['videos' => $videos, 'themes' => $themes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required', 'max:255'],
            'link' => ['required', 'url', 'max:255'],
            'themes' => 'required',
            'pdf'=> ['mimes:pdf', 'max:800'],
            'description' => 'required'
        ]);

        $datas = $request->all();

        $name = $datas['name'];

        //creation du slug à la volée
        $slug = Str::slug($datas['name']);
        //insertion slug dans array $values
        $datas['slug'] = $slug;

        //on récupère les données pour le pdf
        $document = $request->file('pdf');

        if ($document !==null) {

            /*PDF */
            //on récupère les données pour le pdf
            $document = $request->file('pdf');

            //remove pdf extension from original name
            $originalName = substr($document->getClientOriginalName(), 0, -4);

            // Generate a file name
            $pdf = $originalName."-".rand(1,100).".".$document->getClientOriginalExtension();

            // Save the file
            $document->storeAs('public/pdf/video', $pdf);

            $datas['pdf'] = $pdf;

        }

        //On enleve le champ themes et le champ token des valeurs envoyées à la bdd
        $datas2 = Arr::except($datas, ['_token']);
        $values = Arr::except($datas2, ['themes']);

        Video::create($values);

        // on récupère le dernier post
        $lastpost = DB::table('videos')
                ->orderBy('created_at', 'desc')
                ->limit(1)
                ->value('id');

        //on va insérer les themes_id dans la table video_theme en récuperant le dernier post inséré
       $video = Video::findOrFail($lastpost);

        //on insert les themes dans la table pivot
        $video->themes()->sync($datas['themes']);

        //affichage pour la page
        $videos = DB::table('videos')
                ->orderBy('name', 'asc')
                ->get();

        $themes = DB::table('themes')
                ->orderBy('name', 'asc')
                 ->get();

        return view('admin.videos', ['videos' => $videos, 'themes' => $themes]);

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
        $video = Video::findOrFail($id);

        //suppression des fichiers pdf
        Storage::delete("public/pdf/video/".$video['pdf']);

        $video->delete();

        //affichage pour la page
        $videos = DB::table('videos')
                ->orderBy('name', 'asc')
                ->get();

        $themes = DB::table('themes')
                ->orderBy('name', 'asc')
                 ->get();

        return view('admin.videos', ['videos' => $videos, 'themes' => $themes]);
    }
}
