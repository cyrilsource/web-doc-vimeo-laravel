@extends("layouts.front")


@section('title', 'Themes')


@section('content')



<main  id="swup" class="main">
@include('header')
@include('gif')
<div class="background-image transition-fade">
    <img class="background-image__image" src="{{ url('/') }}/storage/img/theme/{{$theme->thumbnail}}" alt="{{ $theme->name }}">
    <div class="background-image__blur"></div>
</div>
    <div class="center entry-title entry-title__page transition-fade">
        <h1>{{ $theme->name }}</h1>
    </div>
    <div class="entry-content transition-fade">
        {{ $theme->description}}
    </div>
    @if($frame !='none')
        <section class="video-carousel transition-fade">
            @foreach ($videos as $video)
                <a href="{{ $video->link }}" data-lity class="video-carousel-card">
                    <h3 class="video-carousel-card__title">{{ $video->title }}</h3>
                    <img src="{{ $video->thumbnail_large }}">
                </a>
            @endforeach
        </section>
    @else
        <section class="video-vignette horizontal-align transition-fade">
            @foreach ($videos as $video)
                <a href="{{ $video->link }}" data-lity class="video-vignette-card">
                    <h3 class="video-vignette-card__title">{{ $video->title }}</h3>
                    <img src="{{ $video->thumbnail_large }}">
                </a>
            @endforeach
        </section>
    @endif

</main>

@endsection


