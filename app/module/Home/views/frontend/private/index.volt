<div style="margin-top:150px" class="inner cover">
    <h1 class="cover-heading">Some private stuff</h1>

    {% if identity is defined %}
    <p>
        Logged in as {{ identity.getFirst_name() }} {{ identity.getLast_name() }} ({{ identity.getEmail() }}) | <a href="{{ url.get(['for' : 'logout']) }}">Logout</a>
    </p>
    {% endif %}
</div>