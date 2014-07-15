<div class="row widget" >
    <form class="form-horizontal" role="form" method="post" action="{{ url.get(['for':'articles', 'action' : 'create', 'lang' : dispatcher.getParam('lang')]) }}">
        {{ partial('frontend/example/_form', ['form': form]) }}
        <button type="submit" class="btn btn-default pull-right">Submit</button>
    </form>
</div>
