{% if triggerPaste is defined %}

    <script>window.location = '{{ url.get(['for':'admin/component/tools','action':'paste']) }}?{{query}}';</script>
    
{% else %}

    <h1>{{ i18n._('Select the component you want to insert') }}</h1>
    
    <div class="btn-group btn-group-top-right">
        {% if paste %}
            <a class="btn btn-default btn-sm " href="{{ url.get(['for':'admin/component/tools','action':'paste']) }}?{{query}}">{{ i18n._('Paste from your clipboard') }}</a>
        {% endif %}
        <a class="btn btn-default btn-sm" href="{{ url.get(['for':'admin/component/tools','action':'scan']) }}">Re-Index</a>
    </div>

    <div class="form-edit">
        
        {% if allowed|length %}
        <ul id="select" class="clearfix">
            {% for component in previews %}
                {% if allowed[component.class] is defined %}
                <li>
                    <a href="{{ url.get(['for':'admin/component/tools','action':'select','params':component.module ~ ':' ~ component.class,'class':component.class]) }}?{{ query }}">
                        <span>{{component.name}}</span>
                        <img src="{{component.image}}" />
                    </a>
                </li>
                {% endif %}
            {% endfor %}
        </ul>            
        <hr />
        {% endif %}
        
        <ul id="select" class="clearfix">
            {% for component in previews %}
            <li>
                <a href="{{ url.get(['for':'admin/component/tools','action':'select','params':component.module ~ ':' ~ component.class,'class':component.class]) }}?{{ query }}">
                    <span>{{component.name}}</span>
                    <img src="{{component.image}}" />
                </a>
            </li>
            {% endfor %}
        </ul>
            
    </div>
    
    {# we have only 1 preview, so select it #}
    {% if previews|length == 1 %}
    <script>
    window.location = '{{ url.get(['for':'admin/component/tools','action':'select','params':component.module ~ ':' ~ component.class,'class':component.class]) }}?{{ query }}';
    </script>
   {% endif %}
    
{% endif %}