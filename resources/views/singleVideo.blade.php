@extends("layouts.front")

@section('title')
{{trans($video->title)}}
@stop

@section('description')
{{trans($metadescription)}}
@stop

@section('url')
videos/{{trans($video->slug)}}/{{trans($video->id)}}
@stop

@section('content')

<main  id="swup" class="main" role="main">
@include('header')
@include('gif')
<div class="singleTheme">
    <div class="background-image transition-fade2">
        <img class="background-image__image" src="{{ $video->thumbnail_large }}" alt="{{ $video->title }}">
        <div class="background-image__blur"></div>
    </div>

        <div class="entry-content transition-fade2">
            <div class="header-theme">
                @if (!empty($video->pdf))
                    <a id="pdf" href=#" class="button" data-link="{{ url('/') }}/storage/pdf/video/{{$video->pdf}}">
                        <span class="yep">pdf</span>
                    </a>
                    <div id="entry-title" class="entry-title entry-title__page entry-title__video entry-title__page-pdf transition-fade2">
                        <h1>{{ $video->title }}</h1>
                    </div>
                    @else
                    <div id="entry-title" class="entry-title entry-title__page entry-title__video transition-fade2">
                        <h1>{{ $video->title }}</h1>
                    </div>

                @endif

            </div>
            <div class="video-duration">
                <p>{{ $video->duration }}</p>
            </div>
            @foreach ($video->themes as $theme)
                <em>{{$theme->name}},</em>
            @endforeach
            @if (!empty($video->description))
                <div id="entry-content-text" class=entry-content-text>
                    {!! $video->description ?? '' !!}
                </div>
            @endif

        </div>
        <a id="play-video" data-lity class="video-play-button transition-fade2" href="{{ $video->link }}">
            <span></span>
        </a>
    </div>

</main>

@endsection
