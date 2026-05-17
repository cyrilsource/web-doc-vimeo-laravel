@extends("admin/layouts.admin")

@section('content')

<h1 class="mt-4 mb-5 text-center">Options</h1>

<form action="" method="post">
@csrf

    <h2 class="mb-3 number-words m-2">Nombre de caractères pour les extraits</h2>
    <div class="row">
        <div class="col-6">
            <div class="form-group m-2">
                <label for="field">Choisir un nombre</label>
                <input name="field" type="number" value="{{$words}}" class="form-control" id="field" aria-describedby="title">
            </div>
        </div>
    </div>

    <h2 class="mb-3 m-2 mt-5">Écran d'introduction (première visite)</h2>
    <p class="m-2 mb-3 text-muted small">Affiché uniquement lors de la première visite. Laisser vide pour désactiver.</p>
    <div class="row">
        <div class="col-8">
            <div class="form-group m-2">
                <label for="homepage_title">Titre (h1)</label>
                <input name="homepage_title" type="text" value="{{$homepageTitle}}" class="form-control" id="homepage_title" maxlength="255">
            </div>
            <div class="form-group m-2">
                <label for="homepage_description">Description</label>
                <textarea name="homepage_description" class="form-control" id="homepage_description" rows="4" maxlength="255">{{$homepageDescription}}</textarea>
                <small class="form-text text-muted">Maximum 255 caractères.</small>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary m-2 mt-3">Enregistrer</button>

</form>

@endsection
