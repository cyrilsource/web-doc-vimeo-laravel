
<header class="header">
    <div class="header--left">
        <a id="logo" class="logo rotation-left" href="{{ url('/') }}">TC</a>
        @if($template =='index')
        <a title="retour" id="logo-back" class="return " href="{{ url('/')  }}">
            <span><</span>
        </a>
        @endif
        @if($template =='show' )
        <a title="retour" id="logo-back" class="return" href="#">
            <span><</span>
        </a>
        @endif
    </div>
    <div class="header--right">
        @if($template != 'error-404' )
            <div role="navigation" class="navigation header--right-el" role="button" aria-pressed="false">
                <button class="button">
                    <span class="yep">Themes<i class="arrow down arrow--select"></i></span>
                </button>
                <div class="themes-list">
                @foreach ($themes as $theme)
                    <a href="{{ url('/themes') }}/{{ $theme->slug }}/{{ $theme->id }}">{{ $theme->name }}</a>
                @endforeach
                </div>
            </div>
        @endif
        <div class="search-container header--right-el">
            <form action="{{ url('/search') }}" method="get" role="search">
                <input class="search-autocomplete" title="recherche" aria-label="rechercher une vidéo" type="text" placeholder="Rechercher une vidéo" name="search">
                <button type="submit"></button>
            </form>
        </div>
        <div class="header--right-el">
            <button title="mode sombre ou clair" id="btn-dark-mode" class='btn-dark-mode'></button>
        </div>
    </div>
</header>
<header class="header-mobile">
        <a title="retour" id="logo-back2" class="return back-button header-mobile-object"></a>
        <a id="logo" class="logo rotation-left header-mobile-object" href="{{ url('/') }}">TC</a>
        <div class="header-mobile--right">
            <span id="glass-mobile" class="glass-mobile"></span>
            <div id="search-container-mobile" class="search-container">
                <form action="{{ url('/search') }}" method="get" role="search">
                    <input class="search-autocomplete" type="text" placeholder="Rechercher une vidéo" name="search">
                    <button type="submit"></button>
                </form>
            </div>
            <div class="m-nav-toggle header-mobile-object">
                <span class="m-toggle-icon header-mobile-object"></span>
            </div><!--.m-nav-toggle-->
        </div>
        <div class="menu">
            <div class="themes-list">
                @foreach ($themes as $theme)
                    <a class="menu-item" href="{{ url('/themes') }}/{{ $theme->slug }}/{{ $theme->id }}">{{ $theme->name }}</a>
                @endforeach
            </div>
            <button id="btn-dark-mode-mobile" class="menu-item btn-dark-mode"></button>
        </div>
        <span class="close"></span>

</header>




