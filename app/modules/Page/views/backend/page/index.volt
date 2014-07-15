
<div class="clearfix">
    <h3 class="pull-left">{{ i18n._('Static page list') }}</h3>
    <a class="btn btn-default pull-right" href="{{ url.get(['for':'admin/page', 'action':'new']) }}">{{ i18n._('Add new') }}</a>
</div>

<table class="table table-bordered table-hover">
    <thead>
    <tr><th>{{ i18n._('Name') }}</th>
        <th>{{ i18n._('Url') }}</th>
        <th class="options">&nbsp;</th>
    </tr></thead>
    <tbody>
    {% for page in pages %}
    <tr>
        <td>{{ page.name }}</td>
        <td>{{ page.slug }}</td>
        <td class="options">
            <a href="{{ url('admin/page/edit/' ~ page._id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
            <a href="{{ url('admin/page/delete/' ~ page._id) }}"><i class="glyphicon glyphicon-trash"></i></a>
        </td>
    </tr>
    {% endfor %}
    </tbody>
</table>