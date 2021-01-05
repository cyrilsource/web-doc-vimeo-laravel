
<header class="header">
    <div class="header--left">
        <a id="logo" class="logo rotation-left" href="{{ url('/') }}">TC</a>
        @if($template =='index')
        <a title="retour" id="logo" class="return " href="{{ url('/') }}">
            <span><</span>
        </a>
        @endif
        @if($template =='show')
        <a title="retour" id="logo" class="return " href="{{ url('/themes') }}">
            <span><</span>
        </a>
        @endif
    </div>
    <div class="header--right">
        <div role="navigation" class="navigation header--right-el">
            <div class="button">
                <span class="yep">Themes</span>
            </div>
            <div class="themes-list">
            @foreach ($themes as $theme)
                <a href="{{ url('/themes') }}/{{ $theme->id }}">{{ $theme->name }}</a>
            @endforeach
            </div>
        </div>
        <div class="search-container header--right-el">
            <form action="{{ url('/search') }}" method="get">
                <input type="text" placeholder="Rechercher une vidéo" name="search">
                <button type="submit"></button>
            </form>
        </div>
        <div class="header--right-el">
            <button id="btn-dark-mode" class='btn-dark-mode'></button>
        </div>
    </div>
</header>




