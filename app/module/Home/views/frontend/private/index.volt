<div class="inner cover">
    <h1 class="cover-heading">Some private stuff</h1>

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