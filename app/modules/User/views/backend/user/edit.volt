{{ serviceManager.getService('breadcrumb:breadcrumb').render([
['name':'OVV Intranet', 'slug' : '/'],
['name':'User edit', 'slug': url.get(['for':'admin/user', 'action':'edit', 'params':record._id]), 'is_active' : 1]
]) }}

<div class="row widget">
    <div class="col-xs-12">
        <div class="widget widget-default-spacer">
            <div class="spacer spacer30"></div>
        </div>
        <div class="widget widget-page-header">
            <h1>{{ i18n._('Edit user') }}</h1>
        </div>
        <div class="widget widget-default-spacer">
            <div class="spacer spacer22"></div>
        </div>
        <div class="widget widget-default-page">
            <div class="well">
                <div class="row widget">
                    <div class="col-xs-12">
                        <div class="widget widget-content">
                            <form action="{{ url.get(['for':'admin/user', 'action':'update', 'params':record._id]) }}" method="post" role="form">
                                {{ partial('backend/user/_form', ['form': form]) }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>