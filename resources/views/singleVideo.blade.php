@extends("layouts.front")

@section('title', 'Themes')

@section('content')

<main  id="swup" class="main">
@include('header')
@include('gif')
<div class="singleTheme">
    <div class="background-image transition-fade">
        <img class="background-image__image" src="{{ $video->thumbnail_large }}" alt="{{ $video->title }}">
        <div class="background-image__blur"></div>
    </div>
    <a id="play-video" data-lity class="video-play-button transition-fade" href="{{ $video->link }}">
        <span></span>
    </a>
        <div class="entry-content transition-fade">
            <div class="header-theme">
                <div class="button">
                    <a class="yep" href="{{ url('/') }}/storage/pdf/video/{{$video->pdf ?? ''}}">pdf</a>
                </div>
                <div class="center entry-title entry-title__page transition-fade">
                    <h1>{{ $video->title }}</h1>
                </div>
            </div>
            <div class=entry-content-text>
                {{ $video->description ?? '' }}
            </div>


        </div>
    </div>

</main>

@endsection
