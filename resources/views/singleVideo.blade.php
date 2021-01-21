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

        <div class="entry-content transition-fade">
            <div class="header-theme">
                @if (!empty($video->pdf))
                    <div class="button">
                        <a class="yep" href="{{ url('/') }}/storage/pdf/theme/{{$video->pdf}}">pdf</a>
                    </div>
                    <div id="entry-title" class="center entry-title entry-title__page entry-title__page-pdf transition-fade">
                        <h1>{{ $video->title }}</h1>
                    </div>
                    @else
                    <div id="entry-title" class="center entry-title entry-title__page transition-fade">
                        <h1>{{ $video->title }}</h1>
                    </div>
                @endif
            </div>
            @if (!empty($description))
                <div id="entry-content-text" class=entry-content-text>
                    {{ $description ?? '' }}
                </div>
            @endif

        </div>
        <a id="play-video" data-lity class="video-play-button transition-fade" href="{{ $video->link }}">
            <span></span>
        </a>
    </div>

</main>

@endsection
