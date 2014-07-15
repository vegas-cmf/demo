<div class="row widget">
    <div class="col-xs-12">
        <div class="widget widget-default-spacer">
            <div class="spacer spacer30"></div>
        </div>
        <div class="widget widget-page-header">
            <h1>{{ i18n._('Birthdays') }}</h1>
        </div>
        <div class="widget widget-default-spacer">
            <div class="spacer spacer22"></div>
        </div>
        <div class="widget widget-birthdaylist-page">
            <div class="well">
                <div class="row widget">
                    <div class="col-xs-12">
                        <div class="widget widget-default-spacer">
                            <div class="spacer spacer20"></div>
                        </div>
                        <div class="widget widget-content">
                            <ul>
                            {% for month, users in usersByMonth %}
                                <li>
                                    {% set firstUser = users[0] %}
                                    <h2>{{ firstUser.getMonthOfBirth(formatter) }} <span>{{ currentYear }}</span></h2>
                                    <ul>
                                    {% for user in users %}
                                        <li class="clearfix">
                                            <div class="pull-left">
                                                <span class="day">
                                                    {{ user.date_of_birth['day'] }}
                                                    {{ user.getMonthOfBirth(formatter) }}
                                                </span>
                                            </div>
                                            <div class="pull-right">
                                                <p>
                                                    <span class="label"></span>
                                                    <a href="{{ url.get(['for': 'user', 'id': user._id ]) }}">
                                                        {{ user.first_name }} {{ user.last_name }}
                                                    </a>
                                                </p>
                                            </div>
                                        </li>
                                    {% endfor %}
                                    </ul>
                                </li>
                            {% endfor %}
                            </ul>                              
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>