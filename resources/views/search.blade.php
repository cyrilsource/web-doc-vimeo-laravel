@extends("layouts.front")

@section('title', 'Videos search')

@section('content')
<main  id="swup" class="main">
@include('header')
    <div class="entry-content-themes">
        <div class="entry-content-themes__grid">
            @if(count($videos) > 0)
                @foreach ($videos as $video)
                    <a  href="{{ url('/video') }}/{{ $video->slug }}/{{ $video->id }}" class="entry-content-themes__card transition-fade">
                        <img src="{{ $video->thumbnail_large }}" alt="{{ $video->title }}">
                        <h2 class="entry-content-themes__title">{{ $video->title }}</h2>
                    </a>
                @endforeach
            @else
            <section class="center">
                <div class="not-found">
                    <h2>Désolé nous n'avons pas trouvé de résultats correspondants à votre requête</h2>
                </div>
            </section>
            @endif

        </div>

    </div><!-- .entry-content-themes-->
</main>



@endsection
