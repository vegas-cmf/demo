{{ serviceManager.getService('breadcrumb:breadcrumb').render([
    ['name':'OVV Intranet', 'slug' : '/'],
    ['name':'User list', 'slug': url.get(['for':'admin/user', 'action':'index']), 'is_active' : 1]
]) }}

<div class="row widget">
    <div class="col-xs-12">
        <div class="widget widget-default-spacer">
            <div class="spacer spacer30"></div>
        </div>
        <div class="widget widget-page-header">
            <h1>{{ i18n._('User list') }}</h1>
        </div>
        <div class="widget widget-default-spacer">
            <div class="spacer spacer22"></div>
        </div>
        <div class="widget widget-table-page">
            <div class="well">
                <div class="row widget">
                    <div class="col-xs-12">
                        <div class="widget widget-content">
                            <div class="panel panel-default">
                                <!-- Default panel contents -->
                                <div class="panel-heading clearfix">
                                    <a href="{{ url.get(['for':'admin/user', 'action':'new']) }}">
                                        <button class="btn pull-right">{{ i18n._('Add new') }}</button>
                                    </a>
                                </div>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>{{ i18n._('Email') }}</th>
                                        <th class="options">&nbsp;</th>
                                    </tr></thead>
                                    <tbody>
                                    {% if(users) %}
                                    {% for user in users %}
                                    <tr>
                                        <td>{{ user.email }}</td>
                                        <td class="options">
                                            <a href="{{ url.get(['for':'admin/user', 'action':'edit', 'params':user._id]) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="{{ url.get(['for':'admin/user', 'action':'delete', 'params':user._id]) }}"><i class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                    </tr>
                                    {% endfor %}
                                    {% endif %}
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