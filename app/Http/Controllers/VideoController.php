<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\Video as VideoResource;
use App\Theme;
use App\Video;

class VideoController extends Controller
{
    /**
     * Fetch a single field from the Vimeo v2 API for a given video ID.
     */
    private static function getVimeoData(string $vimeo_id, string $field): ?string
    {
        $url = 'https://vimeo.com/api/v2/video/' . $vimeo_id . '.php';
        $response = @file_get_contents($url);
        if ($response === false) {
            return null;
        }
        $data = @unserialize($response);
        return $data[0][$field] ?? null;
    }

    /**
     * Extract the Vimeo video ID from a URL.
     */
    private static function extractVimeoId(string $url): ?string
    {
        if (preg_match('~vimeo\.com/(?:video/|channels/[^/]+/|groups/[^/]+/videos/|manage/videos/)?(\d+)~', $url, $m)) {
            return $m[1];
        }
        return null;
    }

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
     * Return all videos as a JSON resource collection.
     */
    public function index()
    {
        $videos = Video::with('themes')->orderBy('title')->get();

        return VideoResource::collection($videos);
    }

    /**
     * Search videos by title (admin).
     */
    public function searchAdmin(Request $request)
    {
        if ($search = $request->q) {
            $videos = Video::with('themes')
                ->where('title', 'LIKE', '%' . $search . '%')
                ->orderBy('title')
                ->get();
        } else {
            $videos = Video::with('themes')->get();
        }

        return VideoResource::collection($videos);
    }

    /**
     * Refresh thumbnail URLs from Vimeo for all videos.
     */
    public function thumbnails()
    {
        $videos = Video::orderBy('title', 'asc')->get();

        foreach ($videos as $video) {
            $vimeo_id = $video->vimeo_id;

            $thumbnail_large  = self::getVimeoData($vimeo_id, 'thumbnail_large');
            $thumbnail_medium = self::getVimeoData($vimeo_id, 'thumbnail_medium');
            $thumbnail_small  = self::getVimeoData($vimeo_id, 'thumbnail_small');

            $updates = [];
            if ($thumbnail_large  && $video->thumbnail_large  !== $thumbnail_large)  $updates['thumbnail_large']  = $thumbnail_large;
            if ($thumbnail_medium && $video->thumbnail_medium !== $thumbnail_medium) $updates['thumbnail_medium'] = $thumbnail_medium;
            if ($thumbnail_small  && $video->thumbnail_small  !== $thumbnail_small)  $updates['thumbnail_small']  = $thumbnail_small;

            if (!empty($updates)) {
                DB::table('videos')->where('id', $video->id)->update($updates);
            }
        }

        return redirect('/admin');
    }

    /**
     * Show the form for creating a new video.
     */
    public function create()
    {
        $videos = Video::orderBy('title', 'asc')->get();
        $themes = Theme::orderBy('name', 'asc')->get();

        return view('admin.createVideo', ['videos' => $videos, 'themes' => $themes]);
    }

    /**
     * Store a newly created video.
     */
    public function store(Request $request)
    {
        $request->validate([
            'link'   => ['required', 'url', 'max:255'],
            'themes' => 'required',
            'pdf'    => ['mimes:pdf', 'max:800'],
        ]);

        $vimeo_id = self::extractVimeoId($request->input('link'));

        $values = [
            'link'             => $request->input('link'),
            'vimeo_id'         => $vimeo_id,
            'title'            => self::getVimeoData($vimeo_id, 'title'),
            'thumbnail_small'  => self::getVimeoData($vimeo_id, 'thumbnail_small'),
            'thumbnail_medium' => self::getVimeoData($vimeo_id, 'thumbnail_medium'),
            'thumbnail_large'  => self::getVimeoData($vimeo_id, 'thumbnail_large'),
            'duration'         => self::getVimeoData($vimeo_id, 'duration'),
            'description'      => $request->input('description'),
        ];

        $values['slug'] = Str::slug($values['title'] ?? $vimeo_id);

        $document = $request->file('pdf');
        if ($document !== null) {
            $originalName = substr($document->getClientOriginalName(), 0, -4);
            $pdf = $originalName . '-' . rand(1, 100) . '.' . $document->getClientOriginalExtension();
            $document->storeAs('public/pdf/video', $pdf);
            $values['pdf'] = $pdf;
        }

        DB::table('videos')->insert($values);

        $lastId = DB::table('videos')->orderBy('id', 'desc')->value('id');
        $video  = Video::findOrFail($lastId);
        $video->themes()->sync($request->input('themes'));

        Session::flash('success', 'la vidéo a bien été publiée');

        return redirect('/admin');
    }

    /**
     * Display a single video.
     */
    public function show($slug, $id)
    {
        $video = Video::findOrFail($id);

        // Build the Vimeo player URL
        if (!empty($video->vimeo_id)) {
            $playerUrl = "https://player.vimeo.com/video/{$video->vimeo_id}?autoplay=1&title=0&byline=0&portrait=0";
        } elseif (!empty($video->link)) {
            $extracted = self::extractVimeoId($video->link);
            $playerUrl = $extracted
                ? "https://player.vimeo.com/video/{$extracted}?autoplay=1&title=0&byline=0&portrait=0"
                : $video->link;
        } else {
            $playerUrl = null;
        }
        $video['player_url'] = $playerUrl;

        // Format duration
        $duration = $video->duration;
        if ($duration < 60) {
            $video['duration'] = $duration . ' sec';
        } elseif ($duration % 60 > 0) {
            $video['duration'] = floor($duration / 60) . ' min ' . ($duration % 60) . ' sec';
        } else {
            $video['duration'] = floor($duration / 60) . ' min';
        }

        // Meta description
        $description2    = strip_tags($video->description ?? '');
        $metadescription = $description2 !== ''
            ? self::truncate($description2, 155)
            : 'une video de Terre Commune';

        $themes = Theme::orderBy('name', 'asc')->get();

        return view('singleVideo', [
            'themes'          => $themes,
            'video'           => $video,
            'metadescription' => $metadescription,
            'template'        => 'show',
        ]);
    }

    /**
     * Show the edit form for a video.
     */
    public function edit($id)
    {
        $video       = Video::findOrFail($id);
        $themes_video = $video->themes->sortBy('name')->all();
        $themes      = Theme::orderBy('name', 'asc')->get();

        return view('admin.editVideo', [
            'video'        => $video,
            'themes'       => $themes,
            'themes_video' => $themes_video,
        ]);
    }

    /**
     * Update a video.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'themes' => 'required',
            'pdf'    => ['mimes:pdf', 'max:800'],
        ]);

        $video  = Video::findOrFail($id);
        $values = $request->except(['_token', 'themes']);

        $document = $request->file('pdf');
        if ($document !== null) {
            Storage::delete('public/pdf/video/' . $video->pdf);

            $originalName = substr($document->getClientOriginalName(), 0, -4);
            $pdf          = $originalName . '-' . rand(1, 100) . '.' . $document->getClientOriginalExtension();
            $document->storeAs('public/pdf/video', $pdf);
            $values['pdf'] = $pdf;
        }

        DB::table('videos')->where('id', $id)->update($values);
        $video->themes()->sync($request->input('themes'));

        Session::flash('success', 'la vidéo a bien été éditée');

        return view('admin.editVideo', [
            'videos'       => Video::orderBy('title', 'asc')->get(),
            'video'        => Video::findOrFail($id),
            'themes'       => Theme::orderBy('name', 'asc')->get(),
            'themes_video' => Video::findOrFail($id)->themes->sortBy('name')->all(),
        ]);
    }

    /**
     * Delete a video and its PDF.
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        Storage::delete('public/pdf/video/' . $video->pdf);
        $video->delete();

        return redirect('/admin');
    }

    /**
     * Remove only the PDF of a video.
     */
    public function destroyPdf($id)
    {
        $video = Video::findOrFail($id);
        Storage::delete('public/pdf/video/' . $video->pdf);
        $video->update(['pdf' => null]);

        return redirect('/admin');
    }

    /**
     * Full-text search on title and description (front).
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $videos = Video::where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('description', 'LIKE', '%' . $search . '%')
            ->orderBy('title')
            ->get();

        $themes = Theme::orderBy('name', 'asc')->get();

        return view('search', ['themes' => $themes, 'videos' => $videos, 'template' => 'show']);
    }

    /**
     * Autocomplete suggestions by title.
     */
    public function autocomplete(Request $request)
    {
        return Video::where('title', 'LIKE', '%' . $request->q . '%')->get();
    }
}
