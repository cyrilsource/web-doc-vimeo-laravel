<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Theme;
use App\Video;
use App\Options;

class ThemeController extends Controller
{
    /**
     * Truncate text to the nearest word boundary within $length characters.
     */
    private static function truncate(string $text, int $length): string
    {
        if (preg_match('/^.{1,' . $length . '}\b/su', $text, $match)) {
            return $match[0];
        }
        return $text;
    }

    /**
     * Display the themes list (front).
     */
    public function index()
    {
        $themes     = Theme::orderBy('name', 'asc')->get();
        $all_videos = Video::orderBy('title', 'asc')->get();

        $random = array_rand($all_videos->toArray(), 1);
        $image  = $all_videos[$random]['thumbnail_large'];

        return view('themes', ['themes' => $themes, 'image' => $image, 'template' => 'index']);
    }

    /**
     * Display the themes list (admin).
     */
    public function indexAdmin()
    {
        $themes = Theme::orderBy('name', 'asc')->get();

        return view('admin.themes', ['themes' => $themes]);
    }

    /**
     * Show the form for creating a new theme.
     */
    public function create()
    {
        $characters = DB::table('options')->where('name', 'words')->value('field');
        $themes     = Theme::orderBy('name', 'asc')->get();

        return view('admin.createTheme', ['themes' => $themes, 'characters' => $characters]);
    }

    /**
     * Store a newly created theme.
     */
    public function store(Request $request)
    {
        $characters = DB::table('options')->where('name', 'words')->value('field');

        $request->validate([
            'name'        => ['required', 'max:255'],
            'image'       => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:800'],
            'pdf'         => ['mimes:pdf', 'max:800'],
            'description' => 'required',
            'excerpt'     => 'required',
        ]);

        $slug = Str::slug($request->input('name'));

        $image     = $request->file('image');
        $thumbnail = $slug . '-' . time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/img/theme', $thumbnail);

        $values = $request->except(['_token', 'image']);
        $values['slug']      = $slug;
        $values['thumbnail'] = $thumbnail;

        $document = $request->file('pdf');
        if ($document !== null) {
            $originalName = substr($document->getClientOriginalName(), 0, -4);
            $pdf          = $originalName . '-' . rand(1, 100) . '.' . $document->getClientOriginalExtension();
            $document->storeAs('public/pdf/theme', $pdf);
            $values['pdf'] = $pdf;
        }

        Theme::create($values);

        Session::flash('success', 'le thème a bien été publié');

        return view('admin.themes', [
            'themes'     => Theme::orderBy('name', 'asc')->get(),
            'characters' => $characters,
        ]);
    }

    /**
     * Display a single theme with its videos (front).
     */
    public function show($slug, $id)
    {
        $theme  = Theme::findOrFail($id);
        $themes = Theme::orderBy('name', 'asc')->get();
        $videos = $theme->videos->sortBy('title')->all();

        $frame  = count($videos) < 3 ? 'none' : 3;

        $words          = DB::table('options')->where('name', 'words')->value('field');
        $metadescription = self::truncate($theme->excerpt ?? '', 155);

        // Format duration for each video
        foreach ($videos as &$video) {
            $duration = $video['duration'];
            if ($duration < 60) {
                $video['duration'] = $duration . ' sec';
            } elseif ($duration % 60 > 0) {
                $video['duration'] = floor($duration / 60) . ' min ' . ($duration % 60) . ' sec';
            } else {
                $video['duration'] = floor($duration / 60) . ' min';
            }
        }

        return view('singleTheme', [
            'themes'          => $themes,
            'theme'           => $theme,
            'videos'          => $videos,
            'frame'           => $frame,
            'metadescription' => $metadescription,
            'template'        => 'show',
        ]);
    }

    /**
     * Show the edit form for a theme.
     */
    public function edit($id)
    {
        $characters = DB::table('options')->where('name', 'words')->value('field');
        $theme      = Theme::findOrFail($id);

        return view('admin.editTheme', ['theme' => $theme, 'characters' => $characters]);
    }

    /**
     * Update a theme.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => ['required', 'max:255'],
            'pdf'         => ['mimes:pdf', 'max:800'],
            'description' => 'required',
            'excerpt'     => 'required',
        ]);

        $characters = DB::table('options')->where('name', 'words')->value('field');
        $theme      = Theme::findOrFail($id);
        $slug       = Str::slug($request->input('name'));

        $values = $request->except(['_token', 'image']);
        $values['slug'] = $slug;

        $image = $request->file('image');
        if ($image !== null) {
            Storage::delete('public/img/theme/' . $theme->thumbnail);
            $thumbnail        = $slug . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img/theme', $thumbnail);
            $values['thumbnail'] = $thumbnail;
        }

        $document = $request->file('pdf');
        if ($document !== null) {
            Storage::delete('public/pdf/theme/' . $theme->pdf);
            $originalName = substr($document->getClientOriginalName(), 0, -4);
            $pdf          = $originalName . '-' . rand(1, 100) . '.' . $document->getClientOriginalExtension();
            $document->storeAs('public/pdf/theme', $pdf);
            $values['pdf'] = $pdf;
        }

        DB::table('themes')->where('id', $id)->update($values);

        Session::flash('success', 'le thème a bien été édité');

        return view('admin.editTheme', [
            'themes'     => Theme::orderBy('name', 'asc')->get(),
            'theme'      => Theme::findOrFail($id),
            'characters' => $characters,
        ]);
    }

    /**
     * Delete a theme and its files.
     */
    public function destroy($id)
    {
        $theme = Theme::findOrFail($id);
        Storage::delete('public/img/theme/' . $theme->thumbnail);
        Storage::delete('public/pdf/theme/' . $theme->pdf);
        $theme->delete();

        return view('admin.themes', ['themes' => Theme::orderBy('name', 'asc')->get()]);
    }

    /**
     * Remove only the PDF of a theme.
     */
    public function destroyPdf($id)
    {
        $theme = Theme::findOrFail($id);
        Storage::delete('public/pdf/theme/' . $theme->pdf);
        $theme->update(['pdf' => null]);

        return view('admin.themes', ['themes' => Theme::orderBy('name', 'asc')->get()]);
    }
}
