
<header class="header">
    <div class="header--left">
        <a id="logo" class="logo rotation-left" href="{{ url('/') }}">TC</a>
        @if($template =='index')
        <a title="retour" id="logo-back" class="return " href="{{ url('/') }}">
            <span><</span>
        </a>
        @endif
        @if($template =='show')
        <a title="retour" id="logo-back" class="return">
            <span><</span>
        </a>
        @endif
    </div>
    <div class="header--right">
        <div role="navigation" class="navigation header--right-el">
            <div class="button">
                <span class="yep">Themes<i class="arrow down arrow--select"></i></span>
            </div>
            <div class="themes-list">
            @foreach ($themes as $theme)
                <a href="{{ url('/themes') }}/{{ $theme->slug }}/{{ $theme->id }}">{{ $theme->name }}</a>
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
<header class="header-mobile">
        <a title="retour" id="logo-back2" class="return back-button header-mobile-object"></a>
        <a id="logo" class="logo rotation-left header-mobile-object" href="{{ url('/') }}">TC</a>
        <div class="header-mobile--right">
            <span id="glass-mobile" class="glass-mobile"></span>
            <div id="search-container-mobile" class="search-container">
                <form action="{{ url('/search') }}" method="get">
                    <input type="text" placeholder="Rechercher une vidéo" name="search">
                    <button type="submit"></button>
                </form>
            </div>
            <div class="m-nav-toggle">
                <span class="m-toggle-icon"></span>
            </div><!--.m-nav-toggle-->
        </div>
        <div class="menu">
            <div class="themes-list">
                @foreach ($themes as $theme)
                    <a href="{{ url('/themes') }}/{{ $theme->slug }}/{{ $theme->id }}">{{ $theme->name }}</a>
                @endforeach
            </div>
            <button id="btn-dark-mode-mobile" class="btn-dark-mode"></button>
        </div>

</header>




