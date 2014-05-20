{% if not isAuthenticated %}
<a href="{{ linkedinUri }}">Login with linkedin!</a>
{% endif %}
{% if firstName is defined %}
{{ firstName }}
{% endif %}
{% if lastName is defined %}
{{ lastName }}
{% endif %}