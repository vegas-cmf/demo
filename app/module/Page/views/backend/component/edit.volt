
{% if record.updated_at is defined %}
    <h1>{{ i18n._('Update a component') }}</h1>
{% else %}
    <h1>{{ i18n._('Create a component') }}</h1>
{% endif %}
        
<div class="form-edit">
    <form class="form" action="{{ url.get(['for':'admin/component','action':'update','params':record._id ]) }}" method="post" role="form">
        {{ partial('backend/component/_form', ['form': form]) }}
    </form>
</div>