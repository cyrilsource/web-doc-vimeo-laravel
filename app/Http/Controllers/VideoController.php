<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Http\Requests\CreateThemeRequest;
use App\Http\Requests\CreateVideoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Theme;
use App\Video;

class VideoController extends Controller
{

    /**
     * Show the videos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //pour aficher les videos
        $videos = Video::orderBy('title', 'asc')->get();

        return view('admin.home', ['videos' => $videos]);

    }

    public function searchAdmin(Request $request)   {


        $videos = Video::where('title', 'like', '%' .$request->get('query') . '%' )->get();

        return json_encode($videos);
     }

    /**
     * update the video thumbnail from vimeo when the link is broken.
     *
     * @return \Illuminate\Http\Response
     */
    public function thumbnails()
    {
        //pour aficher les videos
        $videos = Video::orderBy('title', 'asc')->get();

        //https://stackoverflow.com/questions/1361149/get-img-thumbnails-from-vimeo
        function get_vimeo_data_from_id( $video_id, $data ) {
            $request = unserialize(file_get_contents( 'http://vimeo.com/api/v2/video/' . $video_id .'.php' ));
            return $request[0][$data];
        }

        for ($i=0; $i < count($videos); $i++) {

                $vimeo_id = $videos[$i]['vimeo_id'];
                $id_video = $videos[$i]['id'];

                //get thumnail_large vimeo
                $thumbnail_large = get_vimeo_data_from_id( $vimeo_id, 'thumbnail_large' );
                $thumbnail_medium = get_vimeo_data_from_id( $vimeo_id, 'thumbnail_medium' );
                $thumbnail_small = get_vimeo_data_from_id( $vimeo_id, 'thumbnail_small' );

                // update the thumbnail large link in database
                if ($videos[$i]['thumbnail_large'] != $thumbnail_large ) {
                    //update datas in database
                    DB::table('videos')
                    ->where('id', $id_video)
                    ->update(['thumbnail_large' => $thumbnail_large]);
                }

                // update the thumbnail medium link in database
                if ($videos[$i]['thumbnail_medium'] != $thumbnail_medium ) {
                    //update datas in database
                    DB::table('videos')
                    ->where('id', $id_video)
                    ->update(['thumbnail_medium' => $thumbnail_medium]);
                }

                // update the thumbnail small link in database
                if ($videos[$i]['thumbnail_small'] != $thumbnail_small ) {
                    //update datas in database
                    DB::table('videos')
                    ->where('id', $id_video)
                    ->update(['thumbnail_small' => $thumbnail_small]);
                }
        }

        //display themes for select input
        $themes = Theme::orderBy('name', 'asc')->get();

        return view('admin.videos', ['videos' => $videos, 'themes' => $themes]);
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

        return view('admin.createVideo', ['videos' => $videos, 'themes' => $themes]);

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


        //https://stackoverflow.com/questions/1361149/get-img-thumbnails-from-vimeo
        function get_vimeo_data_from_id( $video_id, $data ) {
            $request = unserialize(file_get_contents( 'http://vimeo.com/api/v2/video/' . $video_id .'.php' ));

            return $request[0][$data];
        }

        $title = get_vimeo_data_from_id( $vimeo_id, 'title' );

        //creation du slug à la volée
        $slug = Str::slug($title);

        //get thumnail_small vimeo
        $thumbnail_small = get_vimeo_data_from_id( $vimeo_id, 'thumbnail_small' );

        //get thumnail_medium vimeo
        $thumbnail_medium = get_vimeo_data_from_id( $vimeo_id, 'thumbnail_medium' );

        //get thumnail_large vimeo
        $thumbnail_large = get_vimeo_data_from_id( $vimeo_id, 'thumbnail_large' );

         //get duration
         $duration = get_vimeo_data_from_id( $vimeo_id, 'duration' );


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
        //vimeo thumbnail_small in datas
        $datas['thumbnail_small'] = $thumbnail_small;
        //vimeo thumbnail_medium in datas
        $datas['thumbnail_medium'] = $thumbnail_medium;
        //vimeo thumbnail_large in datas
        $datas['thumbnail_large'] = $thumbnail_large;
        //vimeo thumbnail_large in datas
        $datas['duration'] = $duration;

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

        //pour afficher un message de succès
        Session::flash('success', 'la vidéo a bien été publiée');

        //pour aficher les videos
        $videos = Video::orderBy('title', 'asc')->get();

        //display themes for select input
        $themes = Theme::orderBy('name', 'asc')->get();

        return view('admin.home', ['videos' => $videos, 'themes' => $themes]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
    {
        $video = Video::findOrFail($id);

        $vimeo_id = $video['vimeo_id'];

        $duration = $video['duration'];
            if ($duration < 60) {
               $display_duration = $duration . ' sec';
            } else {
               if ($duration%60 > 0) {
                $display_duration = floor($duration/60) .' '. 'min ' . $duration%60 . ' ' .'sec';
               } else {
                $display_duration = floor($duration/60) .' '. 'min ';
               }
            }
        $video['duration'] = $display_duration;

        $description = $video['description'];

        //remove html tags
        $description2 = strip_tags($description);

         // https://99webtools.com/blog/truncate-a-string-in-php-without-breaking-words/
         function Truncate($text,$length) {
            if (preg_match('/^.{1,'.$length.'}\b/su', $text, $match)) {
                return $match[0];
            }
            else
                return $text;
        }
        if ($description2 !== null) {
            $metadescription = Truncate($description2, 155);
        }
        else {
            $metadescription = 'une video de Terre Commune';
        }

        $themes = Theme::orderBy('name', 'asc')->get();

        return view('singleVideo', ['themes' => $themes, 'video' => $video, 'metadescription' => $metadescription, 'template' => 'show']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $themes_video = Video::findOrFail($id)->themes->sortBy('name')->all();

        $video = Video::findOrFail($id);

        $vimeo_id = $video['vimeo_id'];

        $themes = Theme::orderBy('name', 'asc')->get();

        return view('admin.editVideo', ['video' => $video, 'themes' => $themes,  'themes_video' => $themes_video]);
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
        $datas = $request->all();

        //on récupère les données pour le pdf
        $document = $request->file('pdf');

        //get the current video
        $video = Video::findOrFail($id);


        if ($document !==null) {

            //remove previous image
            Storage::delete("public/pdf/video/".$video['pdf']);

            //on récupère les données de l'image
            $document = $request->file('pdf');

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

        //update datas in database
        DB::table('videos')
            ->where('id', $id)
            ->update($values);


        //on insert les themes dans la table pivot
        $video->themes()->sync($datas['themes']);

        //pour afficher un message de succès
        Session::flash('success', 'la vidéo a bien été éditée');

        //pour aficher les videos
        $videos = Video::orderBy('title', 'asc')->get();

        // pour afficher la vidéo éditée
        $video = Video::findOrFail($id);
        $themes_video = Video::findOrFail($id)->themes->sortBy('name')->all();

        //display themes for select input
        $themes = Theme::orderBy('name', 'asc')->get();

        return view('admin.editVideo', ['videos' => $videos, 'video' => $video, 'themes' => $themes, 'themes_video' => $themes_video]);

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

        return view('admin.home', ['videos' => $videos, 'themes' => $themes]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $videos = Video::where("title", "LIKE", "%".$search."%")
        ->orWhere("description", "LIKE", "%".$search."%")
        ->orderBy('title')
        ->get();

        $themes = Theme::orderBy('name', 'asc')->get();

        return view('search', ['themes' => $themes, 'videos' => $videos, 'template' => 'show']);
    }
}
