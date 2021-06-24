
@extends("layouts.front")

@section('title', 'Erreur 404')
@php
$template = 'error-404';
$themes = [];
@endphp
@section('content')
<main  id="swup" class="main" role="main">
@include('header')
    <div class="entry-content-themes page-error-container">
        <div id="entry-title" class="center entry-title entry-title__page transition-fade2 page-error-text">
            <h3>oups la page n'existe pas, vous pouvez retournez sur <a href="{{ url('/') }}">la page d'accueil</a>
                ou faire une recherche</h3>
        </div>
        <div class="search-container header--right-el transition-fade2">
            <form action="{{ url('/search') }}" method="get" role="search">
                <input title="recherche" aria-label="rechercher une vidéo" type="text" placeholder="Rechercher une vidéo" name="search">
                <button type="submit"></button>
            </form>
        </div>
    </div><!-- .entry-content-themes-->
</main>



@endsection
