<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Http\Requests\CreateThemeRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Theme;
use App\Video;
use App\Options;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = Theme::orderBy('name', 'asc')->get();

        return view('themes', ['themes' => $themes, 'template' =>'index']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $themes = Theme::orderBy('name', 'asc')->get();

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
        request()->validate([
            'name' => ['required', 'max:255'],
            'image'=> ['required', 'image', 'mimes:jpeg,jpg,png', 'max:800'],
            'pdf'=> ['mimes:pdf', 'max:800'],
            'description' => 'required'
        ]);

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
            $document->storeAs('public/pdf/theme', $pdf);

            $datas['pdf'] = $pdf;

        }

        //On enleve le champ image et le champ token des valeurs envoyées à la bdd
        $datas2 = Arr::except($datas, ['image']);
        $values = Arr::except($datas2, ['_token']);

        Theme::create($values);

        //pour afficher un message de succès
        Session::flash('success', 'le thème a bien été publié');

        $themes = Theme::orderBy('name', 'asc')->get();

        return view('admin.home', ['themes' => $themes]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
    {
        //get the videos with the theme
        $videos = Theme::findOrFail($id)->videos->sortBy('title')->all();

        $themes = Theme::orderBy('name', 'asc')->get();

        $frame = 3;

        $number = count($videos);

        if ($number < 3) {
            $frame = 'none';
        }

        $theme = Theme::findOrFail($id);

        //query the number of words for the option words
        $words = DB::table('options')->where('name', 'words')->value('field');

        /*function limit number of words
        https://stackoverflow.com/questions/965235/how-can-i-truncate-a-string-to-the-first-20-words-in-php/10091794
        */
        function limit_text($text, $limit) {
            if (str_word_count($text, 0) > $limit) {
                $words = str_word_count($text, 2);
                $pos   = array_keys($words);
                $text  = substr($text, 0, $pos[$limit]) . '...';
            }
            return $text;
        }

        $description = $theme['description'];

        $short = limit_text($description, $words);

        // display with min and sec for duration. more readable
       for ($i=0; $i < count($videos); $i++) {
            $duration = $videos[$i]['duration'];
            if ($duration < 60) {
               $display_duration = $duration . ' sec';
            } else {
               if ($duration%60 > 0) {
                $display_duration = floor($duration/60) .' '. 'min ' . $duration%60 . ' ' .'sec';
               } else {
                $display_duration = floor($duration/60) .' '. 'min ';
               }
            }
            $videos[$i]['duration'] = $display_duration;
       }
        return view('singleTheme', ['themes' => $themes, 'theme' => $theme, 'short' => $short, 'videos' => $videos, 'frame' => $frame, 'template' => 'show']);
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
        $datas = $request->all();

        $name = $datas['name'];

        //creation du slug à la volée
        $slug = Str::slug($datas['name']);
        //insertion slug dans array $values
        $datas['slug'] = $slug;

        //on récupère les données de l'image
        $image = $request->file('image');

        if ($image !==null) {
            //get the current theme
            $theme = Theme::findOrFail($id);

            //remove previous image
            Storage::delete("public/img/theme/".$theme['thumbnail']);

            //on récupère les données de l'image
            $image = $request->file('image');

            // Generate a file name
            $thumbnail = "$slug"."-".time().".".$image->getClientOriginalExtension();

            // Save the file
            $image->storeAs('public/img/theme', $thumbnail);

            $datas['thumbnail'] = $thumbnail;
        }

        //on récupère les données pour le pdf
        $document = $request->file('pdf');

        if ($document !==null) {
            //get the current theme
            $theme = Theme::findOrFail($id);

            //remove previous image
            Storage::delete("public/pdf/theme/".$theme['pdf']);

            //on récupère les données de l'image
            $document = $request->file('pdf');

            $document = $request->file('pdf');

            //remove pdf extension from original name
            $originalName = substr($document->getClientOriginalName(), 0, -4);

            // Generate a file name
            $pdf = $originalName."-".rand(1,100).".".$document->getClientOriginalExtension();

            // Save the file
            $document->storeAs('public/pdf/theme', $pdf);

            $datas['pdf'] = $pdf;
        }

        //On enleve le champ image et le champ token des valeurs envoyées à la bdd
        $datas2 = Arr::except($datas, ['image']);
        $values = Arr::except($datas2, ['_token']);

        //update datas in database
        DB::table('themes')
            ->where('id', $id)
            ->update($values);

        //pour afficher un message de succès
        Session::flash('success', 'le thème a bien été édité');

        $themes = Theme::orderBy('name', 'asc')->get();

        $theme = Theme::findOrFail($id);

        return view('admin.editTheme', ['themes' => $themes, 'theme' => $theme]);

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

        $themes = Theme::orderBy('name', 'asc')->get();

        return view('admin.home', ['themes' => $themes]);

    }
}
