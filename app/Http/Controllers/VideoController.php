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
        //pour aficher les videos
        $videos = Video::orderBy('title', 'asc')->get();

        //display themes for select input
        $themes = Theme::orderBy('name', 'asc')->get();

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
            'link' => ['required', 'url', 'max:255'],
            'themes' => 'required',
            'pdf'=> ['mimes:pdf', 'max:800']
        ]);

        $datas = $request->all();

        //get url and we take only vimeo id
        $vimeo_id = substr($datas['link'], 18);

        // https://jamesdavidson.io/blog/getting-thumbnails-using-vimeo-api-php
        $xml = simplexml_load_file("http://vimeo.com/api/v2/video/".$vimeo_id.".xml");

        $xml = $xml->video;

        //get title vimeo
        $title = $xml->title->__toString();

        //creation du slug à la volée
        $slug = Str::slug($title);

        //get description vimeo
        $description = $xml->description->__toString();

        //get thumnail_small vimeo
        $thumbnail_small = $xml->thumbnail_small->__toString();

        //get thumnail_medium vimeo
        $thumbnail_medium = $xml->thumbnail_medium->__toString();

        //get thumnail_large vimeo
        $thumbnail_large = $xml->thumbnail_large->__toString();


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

        //vimeo id in datas
        $datas['vimeo_id'] = $vimeo_id;
        //vimeo title in datas
        $datas['title'] = $title;
        //insertion slug dans array $values
        $datas['slug'] = $slug;
        //vimeo description in datas
        $datas['description'] = $description;
        //vimeo thumbnail_small in datas
        $datas['thumbnail_small'] = $thumbnail_small;
        //vimeo thumbnail_medium in datas
        $datas['thumbnail_medium'] = $thumbnail_medium;
        //vimeo thumbnail_large in datas
        $datas['thumbnail_large'] = $thumbnail_large;

        //On enleve le champ themes et le champ token des valeurs envoyées à la bdd
        $datas2 = Arr::except($datas, ['_token']);
        $values = Arr::except($datas2, ['themes']);

        DB::table('videos')->insert(
            $values
        );

        // on récupère le dernier post
        $lastpost = DB::table('videos')
                ->orderBy('id', 'desc')
                ->limit(1)
                ->value('id');


        //on va insérer les themes_id dans la table video_theme en récuperant le dernier post inséré
        $video = Video::findOrFail($lastpost);



        //on insert les themes dans la table pivot
        $video->themes()->sync($datas['themes']);


        //pour aficher les videos
        $videos = Video::orderBy('title', 'asc')->get();

        //display themes for select input
        $themes = Theme::orderBy('name', 'asc')->get();

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

        //pour aficher les videos
        $videos = Video::orderBy('title', 'asc')->get();

        //display themes for select input
        $themes = Theme::orderBy('name', 'asc')->get();

        return view('admin.videos', ['videos' => $videos, 'themes' => $themes]);
    }
}
