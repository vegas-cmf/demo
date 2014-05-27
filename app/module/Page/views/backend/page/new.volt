
<h1>{{ i18n._('Add new static page') }}</h1>

<div class="form-edit">
    <form action="{{ url.get(['for':route,'action':'create']) }}" method="post" role="form">
        {{ partial('backend/page/_form', ['form': form]) }}
    </form>
</div>