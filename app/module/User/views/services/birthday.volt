<div class="widget widget-default-birthdays">
    <div class="well">
        <h2>{{ i18n._('Birthdays') }}</h2>
        <ul>
        {% for user in users %}
            <li>
                <span class="date">
                    {{ user.date_of_birth['day'] }}
                    <small>{{ user.getMonthOfBirth(formatter) }}</small>
                </span>
                <a href="{{ url.get(['for': 'user', 'id': user._id ]) }}">
                    <span class="name">{{ user.first_name }}</span>
                </a>
            </li>
        {% endfor %}
        </ul>
        <p class="readmore">
            <a href="{{ url.get(['for': 'birthdays']) }}">{{ i18n._('All birthdays') }}</a>
        </p>
    </div>
</div>