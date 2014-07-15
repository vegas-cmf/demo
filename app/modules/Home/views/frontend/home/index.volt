<div class="inner cover">
    <h1 class="cover-heading">Vegas Startup Project.</h1>
    <p class="lead">Vegas CMF is a complex Content Management Framework that allows you to easily build own CMS.</p>
    <p class="lead">
        <a href="https://bitbucket.org/amsdard/vegas-cmf-core" class="btn btn-lg btn-default">Learn more</a>
    </p>

    {% if identity is defined %}
    <p>
        Logged in as {{ identity.getEmail() }} | <a href="{{ url.get(['for' : 'logout']) }}">Logout</a>
    </p>
    {% endif %}
</div>

<div class="mastfoot">
    <div class="inner">
        <p>Thanks for using <a href="http://vegas.amsterdam-standard.pl">Vegas CMF</a>.</p>
    </div>
</div>