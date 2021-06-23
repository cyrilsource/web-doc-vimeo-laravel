
@extends("layouts.front")

@section('title', 'Erreur 404')
@php
$template = 'index';
$themes = [];
@endphp
@section('content')
<main  id="swup" class="main" role="main">
@include('header')
    <div class="entry-content-themes">
       <h1>oups la page n'existe pas, veuillez...</h1>

    </div><!-- .entry-content-themes-->
</main>



@endsection
