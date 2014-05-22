{{ serviceManager.getService('breadcrumb:breadcrumb').render([
    ['name':'OVV Intranet', 'slug' : '/'],
    ['name':'User add', 'slug': url.get(['for':'admin/user', 'action':'new']), 'is_active' : 1]
]) }}

<div class="row widget">
    <div class="col-xs-12">
        <div class="widget widget-default-spacer">
            <div class="spacer spacer30"></div>
        </div>
        <div class="widget widget-page-header">
            <h1>{{ i18n._('Add new user') }}</h1>
        </div>
        <div class="widget widget-default-spacer">
            <div class="spacer spacer22"></div>
        </div>
        <div class="widget widget-default-page">
            <div class="well">
                <div class="row widget">
                    <div class="col-xs-12">
                        <div class="widget widget-content">
                            <form action="{{ url.get(['for':'admin/user', 'action':'create']) }}" method="post" role="form">
                                {{ partial('backend/user/_form', ['form': form]) }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>