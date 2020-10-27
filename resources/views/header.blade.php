
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
        <div role="navigation" class="navigation">
            <div class="button">
                <span class="yep">Themes</span>
            </div>
            <div class="themes-list">
            @foreach ($themes as $theme)
                <a href="{{ url('/themes') }}/{{ $theme->id }}">{{ $theme->name }}</a>
            @endforeach
            </div>
        </div>
    </div>
</header>




