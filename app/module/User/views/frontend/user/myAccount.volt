{{ serviceManager.getService('breadcrumb:breadcrumb').render([
['name':'OVV Intranet', 'slug' : '/'],
['name':'My account', 'slug': url.get(['for':'my-account', 'action':'myAccount']), 'is_active' : 1]
]) }}

<div class="row widget">
    <div class="col-xs-12">
        <div class="widget widget-default-spacer">
            <div class="spacer spacer30"></div>
        </div>
        <div class="widget widget-page-header">
            <h1>{{ i18n._('My account') }}</h1>
        </div>
        <div class="widget widget-default-spacer">
            <div class="spacer spacer22"></div>
        </div>
        <div class="widget widget-myaccount-page">
            <div class="well">
                <form action="{{ url.get(['for':'my-account/update']) }}" method="post" role="form">
                    {{ partial('frontend/user/_form', ['form': form]) }}
                </form>
            </div>
        </div>
    </div>
</div>
