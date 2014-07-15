<div class="row widget">
    <div class="col-xs-12">
        <div class="widget widget-default-spacer">
            <div class="spacer spacer30"></div>
        </div>
        <div class="widget widget-page-header">
            <h1>{{ user.first_name }} {{ user.last_name }}</h1>
        </div>
        <div class="widget widget-default-spacer">
            <div class="spacer spacer22"></div>
        </div>
    </div>
</div>

<div class="row widget">
    <div class="widget widget-profile-page">
        <div class="col-xs-9">
            <div class="well">
                <div class="profile-general clearfix">
                    <div class="photo">
                        <img src="{{ user.getAvatar(190, 190) }}" alt="">
                    </div>
                    <div class="txt">
                        <p>
                            <strong>Functie</strong>
                            {{ user.position }}
                        </p>
                        <p>
                            <strong>Telefoonnummer</strong>
                            {% if user.phone_internal %}{{ user.phone_internal }}{% endif %}
                        </p>
                        <p>
                            <strong>Mail</strong>
                            <a href="mailto:{{ user.email }}">{{ user.email }}</a>
                        </p>
                        <p>
                            <strong>Verjaardag</strong>
                            {{ user.getBirthDate() }}
                        </p>
                    </div>
                    <div class="social">
                        {% if user.twitter %}
                            <a href="{{ user.twitter }}" target="_blank" class="twitter">Twitter</a>
                        {% endif %}
                        {% if user.linkedin %}
                            <a href="{{ user.linkedin }}" target="_blank" class="linkedin">linkedin</a>
                        {% endif %}
                    </div>
                </div>
                <div class="profile-box">
                    <h2>Werkervaring</h2>
                    {% for item in user.experience %}
                    <p>
                        <strong>{{ item['name'] }}</strong>
                        <br>
                        {{ item['start_date'] }} - {% if item['finish_date'] is defined %} {{ item['finish_date'] }} {% endif %}
                    </p>
                    {% endfor %}
                </div>
                <div class="profile-box">
                    <h2>Opleidingen</h2>
                    {% for item in user.education %}
                        <p>
                            <strong>{{ item['name'] }}</strong>
                            <br>
                            {{ item['start_date'] }} - {% if item['finish_date'] is defined %} {{ item['finish_date'] }} {% endif %}
                        </p>
                    {% endfor %}
                </div>
                <div class="profile-box clearfix">
                    <h2>{{ i18n._('Skills') }}</h2>
                    {{ serviceManager.getService('user:myAccount').renderList(user.getSkillsArray()) }}
                </div>
                <div class="profile-box clearfix">
                    <h2>{{ i18n._('Interests') }}</h2>
                    {{ serviceManager.getService('user:myAccount').renderList(user.getInterestsArray()) }}
                </div>
                <div class="profile-box personal-Information clearfix">
                    <h2>{{ i18n._('Personal info') }}</h2>
                    {{ user.personal_info }}
                </div>

            </div>
        </div>
        <div class="col-xs-3">
            <div class="profile-aside-box">
                <h3>Prikboard</h3>
                {% if(messages) %}
                    {% for message in messages %}
                        <p><strong>{{ message['category'] }}: {{ shortenText(message['content'], 20) }}</strong></p>
                        <br>
                    {% endfor %}
                {% endif %}
            </div>
            <div class="profile-aside-box">
                <h3>Projectenportfolio</h3>
                {% set running = constant('Investigations\Models\Investigation::STATUS_RUNNING') %}
                {% if investigations[running] is empty %} {% else %}
                    <ul>
                        {% for investigation in investigations[running] %}
                            <li>
                                <a href="{{ url.get(['for':'investigation', 'action':'show', 'id':investigation._id]) }}">{{ investigation.investigation['title'] }}</a>
                            </li>
                        {% endfor %}
                    </ul>
                {% endif %}
                
                {% set completed = constant('Investigations\Models\Investigation::STATUS_COMPLET') %}
                {% if investigations[completed] is empty %} {% else %}
                    <hr>
                    <h4>{{ i18n._('Completed') }}</h4>
                    <ul>
                        {% for investigation in investigations[completed] %}
                            <li>
                                <a href="{{ url.get(['for':'investigation', 'action':'show', 'id':investigation._id]) }}">{{ investigation.investigation['title'] }}</a>
                            </li>
                        {% endfor %}
                    </ul>
                {% endif %}
                <p class="readmore">
                    <a href="{{ url.get(['for':'investigations/user', 'id':user._id]) }}">{{ i18n._('See all') }}</a>
                </p>
            </div>
            {{ serviceManager.getService('agenda:userAgendaWidget').render() }}
        </div>
    </div>

</div>
