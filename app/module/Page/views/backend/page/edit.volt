
<h1>{{ i18n._('Edit static page') }}</h1>

<div class="form-edit">
    <form action="{{ url.get(['for':route,'action':'update','params':record._id]) }}" method="post" role="form">
        {{ partial('backend/page/_form', ['form': form]) }}
    </form>
</div>