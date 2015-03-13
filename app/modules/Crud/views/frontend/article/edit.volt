<div class="col-lg-12">
    <div class="row widget" >
        <form class="form-horizontal" role="form" method="post" action="{{ url.get(['for':'crud', 'action' : 'update', 'params' : record._id]) }}">
            {{ partial('frontend/article/_form', ['form': form, 'record' : record]) }}
            <button type="submit" class="btn btn-default pull-right">Submit</button>
        </form>
    </div>
</div>