{{ serviceManager.getService('breadcrumb:breadcrumb').render([
    ['name':'OVV Intranet', 'slug' : '/'],
    ['name':'Static page list', 'slug': url.get(['for':'admin/page', 'action':'index']), 'is_active' : 1]
]) }}

<div class="row widget">
    <div class="col-md-12">
        <div class="widget widget-default-spacer">
            <div class="spacer spacer30"></div>
        </div>
        <div class="widget widget-page-header">
            <h1>{{ i18n._('Static page list') }}</h1>
        </div>
        <div class="widget widget-default-spacer">
            <div class="spacer spacer22"></div>
        </div>
        <div class="widget widget-table-page">
            <div class="well">
                <div class="row widget">
                    <div class="col-md-12">
                        <div class="widget widget-content">
                            <div class="panel panel-default">
                                <!-- Default panel contents -->
                                <div class="panel-heading clearfix">
                                    <a href="{{ url.get(['for':'admin/page', 'action':'new']) }}">
                                        <button class="btn pull-right">{{ i18n._('Add new') }}</button>
                                    </a>
                                </div>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr><th>{{ i18n._('Name') }}</th>
                                        <th>{{ i18n._('Url') }}</th>
                                        <th>{{ i18n._('Content') }}</th>
                                        <th class="options">&nbsp;</th>
                                    </tr></thead>
                                    <tbody>
                                    {% for page in pages %}
                                    <tr>
                                        <td>{{ page.name }}</td>
                                        <td>{{ page.slug }}</td>
                                        <td>{{ shortenText(page.content, 40) }}</td>
                                        <td class="options">
                                            <a href="{{ url('admin/page/edit/' ~ page._id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="{{ url('admin/page/delete/' ~ page._id) }}"><i class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                    </tr>
                                    {% endfor %}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>