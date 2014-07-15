<a href="{{ url.get(['for' : 'articles', 'action': 'new', 'lang' : dispatcher.getParam('lang')]) }}">Add</a>
<hr />
<table class="table">
    {% for article in articles %}
    <tr>
        <td>{{ article.title }}</td>
        <td>{{ article.content }}</td>
        <td>{{ article.lang }}</td>
    </tr>
    {% endfor %}
</table>