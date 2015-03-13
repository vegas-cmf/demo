<div class="col-lg-12">
    <div class="row">
        <h4>Crud - Articles</h4>
        <a class="pull-right" href="{{ url.get(['for' : 'crud', 'action': 'new']) }}">
            <i class="glyphicon glyphicon-plus"></i> Add
        </a>
        <table class="table table-bordered">
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Lang</th>
                <th></th>
            </tr>
            {% for article in articles %}
            <tr>
                <td>{{ article.title }}</td>
                <td>{{ article.content }}</td>
                <td>{{ article.lang }}</td>
                <td>
                    <a href="{{ url.get(['for' : 'crud', 'action' : 'edit', 'params' : article._id]) }}">Edit</a>
                    |
                    <a onclick="return confirm('Are you sure?')" href="{{ url.get(['for' : 'crud', 'action' : 'delete', 'params' : article._id]) }}">Delete</a>
                </td>
            </tr>
            {% endfor %}
        </table>
    </div>
</div>