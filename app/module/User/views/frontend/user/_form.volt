<div class="widget widget-myaccount-page">
    <div class="well">
        <div class="row widget">
            <div class="widget widget-default-spacer">
                <div class="spacer spacer22"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-9"><h2>{{ form.get('first_name').getValue() }} {{ form.get('last_name').getValue() }}</h2></div>
            <div class="col-xs-3">
                <input type="submit" class="btn" value="Opslaan" class="btn btn-primary" />
            </div>
        </div>
        <h3>Algemeen</h3>
        <div class="row widget">
            <div class="col-xs-3">
                <div class="myaccount-photo">
                    <label>{{ form.get('avatar').getLabel() }}</label>

                    <img src="{{  record.getAvatar(200,200) }}" alt="{{ i18n._('your avatar') }}" />
                    {% if files is defined %}
                        {% for key, file in files %}
                            <input type="hidden" name="files[{{ key }}][file_id]" value="{{ file.getId() }}">
                            {% break %}
                        {% endfor %}
                    {% endif %}
                            
                    {{ form.get('avatar') }}
                </div>
            </div>
            <div class="col-xs-4">
                <div class="controls-row">
                    <label>{{ form.get('first_name').getLabel() }}</label>

                    {% if form.hasMessagesFor(form.get('first_name').getName()) %}
                    <span class="help-block">
                        {% for error in form.getMessagesFor(form.get('first_name').getName()) %}
                            {{ error }}
                        {% endfor %}
                    </span>
                    {% endif %}

                    {{ form.get('first_name') }}
                </div>

                <div class="controls-row">
                    <label>{{ form.get('last_name').getLabel() }}</label>

                    {% if form.hasMessagesFor(form.get('last_name').getName()) %}
                    <span class="help-block">
                        {% for error in form.getMessagesFor(form.get('last_name').getName()) %}
                            {{ error }}
                        {% endfor %}
                    </span>
                    {% endif %}

                    {{ form.get('last_name') }}
                </div>

                <div class="controls-row">
                    <label>{{ form.get('email').getLabel() }}</label>

                    {% if form.hasMessagesFor(form.get('email').getName()) %}
                    <span class="help-block">
                        {% for error in form.getMessagesFor(form.get('email').getName()) %}
                            {{ error }}
                        {% endfor %}
                    </span>
                    {% endif %}

                    {{ form.get('email') }}
                </div>
                <div class="controls-row">
                    <label>{{ form.get('mobile').getLabel() }}</label>

                    {% if form.hasMessagesFor(form.get('mobile').getName()) %}
                    <span class="help-block">
                        {% for error in form.getMessagesFor(form.get('mobile').getName()) %}
                            {{ error }}
                        {% endfor %}
                    </span>
                    {% endif %}

                    {{ form.get('mobile') }}
                </div>
                <div class="controls-row">
                    <label>{{ form.get('phone_internal').getLabel() }}</label>

                    {% if form.hasMessagesFor(form.get('phone_internal').getName()) %}
                    <span class="help-block">
                        {% for error in form.getMessagesFor(form.get('phone_internal').getName()) %}
                            {{ error }}
                        {% endfor %}
                    </span>
                    {% endif %}

                    {{ form.get('phone_internal') }}
                </div>
                <div class="controls-row">
                    <label>{{ form.get('date_of_birth').getLabel() }}</label>

                    {% if form.hasMessagesFor(form.get('date_of_birth').getName()) %}
                    <span class="help-block">
                        {% for error in form.getMessagesFor(form.get('date_of_birth').getName()) %}
                            {{ error }}
                        {% endfor %}
                    </span>
                    {% endif %}
                    
                     {{ form.get('date_of_birth') }}
                </div>
                <div class="controls-row">
                    <label>{{ form.get('sector').getLabel() }}</label>

                    {% if form.hasMessagesFor(form.get('sector').getName()) %}
                    <span class="help-block">
                        {% for error in form.getMessagesFor(form.get('sector').getName()) %}
                            {{ error }}
                        {% endfor %}
                    </span>
                    {% endif %}

                    {{ form.get('sector') }}
                </div>
                <div class="controls-row">
                    <label>{{ form.get('more_sectors').getLabel() }}</label>

                    {% if form.hasMessagesFor(form.get('more_sectors').getName()) %}
                    <span class="help-block">
                        {% for error in form.getMessagesFor(form.get('more_sectors').getName()) %}
                            {{ error }}
                        {% endfor %}
                    </span>
                    {% endif %}

                    <div class="col-xs-12" vegas-cloneable>
                        {% for row in form.get('more_sectors').getRows() %}
                        <fieldset>
                            {{ row.get('sector_id') }}
                        </fieldset>
                        {% endfor %}
                    </div>
                </div>
                <div class="controls-row">
                    <label>{{ form.get('department').getLabel() }}</label>

                    {% if form.hasMessagesFor(form.get('department').getName()) %}
                    <span class="help-block">
                        {% for error in form.getMessagesFor(form.get('department').getName()) %}
                            {{ error }}
                        {% endfor %}
                    </span>
                    {% endif %}

                    {{ form.get('department') }}
                </div>
                <div class="controls-row">
                    <label>{{ form.get('position').getLabel() }}</label>

                    {% if form.hasMessagesFor(form.get('position').getName()) %}
                    <span class="help-block">
                        {% for error in form.getMessagesFor(form.get('position').getName()) %}
                            {{ error }}
                        {% endfor %}
                    </span>
                    {% endif %}

                    {{ form.get('position') }}
                </div>
                <div class="controls-row">
                    <label>{{ form.get('residency').getLabel() }}</label>

                    {% if form.hasMessagesFor(form.get('residency').getName()) %}
                    <span class="help-block">
                        {% for error in form.getMessagesFor(form.get('residency').getName()) %}
                            {{ error }}
                        {% endfor %}
                    </span>
                    {% endif %}

                    {{ form.get('residency') }}
                </div>
            </div>
            <div class="col-xs-5">
                <div class="controls-row">
                    <label>{{ form.get('twitter').getLabel() }}</label>

                    {% if form.hasMessagesFor(form.get('twitter').getName()) %}
                    <span class="help-block">
                        {% for error in form.getMessagesFor(form.get('twitter').getName()) %}
                            {{ error }}
                        {% endfor %}
                    </span>
                    {% endif %}

                    {{ form.get('twitter') }}
                </div>
                <div class="controls-row">
                    <label>{{ form.get('linkedin').getLabel() }}</label>

                    {% if form.hasMessagesFor(form.get('linkedin').getName()) %}
                    <span class="help-block">
                        {% for error in form.getMessagesFor(form.get('linkedin').getName()) %}
                            {{ error }}
                        {% endfor %}
                    </span>
                    {% endif %}

                    {{ form.get('linkedin') }}
                </div>
                <hr>
                <div class="controls-row favourites">
                    <label>Favorieten</label>
                    <div class="alert alert-success" style="display:none;"></div>
                    <div class="alert alert-warning" style="display:none;"></div>
                    {% for favourite in favourites %}
                    <div class="clearfix">
                        <input class="col-xs-11" type="text" value="{{ favourite.title }}" placeholder="{{ favourite.url }}" vegas-fav-change="{{ url.get(['for': 'fav/change', 'params': favourite._id]) }}">
                        <a href="{{ url.get(['for': 'fav/remove', 'params': favourite._id]) }}" vegas-fav-remove>{{ i18n._('Remove') }}</a>
                    </div>
                    {% endfor %}
                </div>
            </div>
        </div>
        <div class="widget widget-default-spacer">
            <div class="spacer spacer5"></div>
        </div>
        <div class="widget widget-default-hr">
            <hr>
        </div>
        <h3>{{ form.get('experience').getLabel() }}</h3>

        {% if form.hasMessagesFor(form.get('experience').getName()) %}
            <span class="help-block">
                {% for error in form.getMessagesFor(form.get('experience').getName()) %}
                    {{ error }}
                {% endfor %}
            </span>
        {% endif %}

        <div class="row widget my-account-cloner">
            <div class="col-xs-12" vegas-cloneable>
                {% for row in form.get('experience').getRows() %}
                <fieldset>
                    <div class="row widget">
                        <div class="col-xs-7">
                            <div class="controls-row">
                                <label>{{ row.get('name').getLabel() }}</label>
                                {{ row.get('name') }}
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="controls-row">
                                        <label>{{ row.get('start_date').getLabel() }}</label>
                                        {{ row.get('start_date') }}
                                    </div>
                                </div>
                                <div class="col-xs-6 nomargin">
                                    <div class="controls-row">
                                        <label>{{ row.get('finish_date').getLabel() }}</label>
                                        {{ row.get('finish_date') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                {% endfor %}

            </div>
        </div>
        <div class="widget widget-default-hr">
            <hr>
        </div>
        <h3>{{ form.get('education').getLabel() }}</h3>

        {% if form.hasMessagesFor(form.get('education').getName()) %}
            <span class="help-block">
                {% for error in form.getMessagesFor(form.get('education').getName()) %}
                    {{ error }}
                {% endfor %}
            </span>
        {% endif %}

        <div class="row widget my-account-cloner">
            <div class="col-xs-12" vegas-cloneable>
                {% for row in form.get('education').getRows() %}
                <fieldset>
                    <div class="row widget">
                        <div class="col-xs-7">
                            <div class="controls-row">
                                <label>{{ row.get('name').getLabel() }}</label>
                                {{ row.get('name') }}
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="controls-row">
                                        <label>{{ row.get('start_date').getLabel() }}</label>
                                        {{ row.get('start_date') }}
                                    </div>
                                </div>
                                <div class="col-xs-6 nomargin">
                                    <div class="controls-row">
                                        <label>{{ row.get('finish_date').getLabel() }}</label>
                                        {{ row.get('finish_date') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                {% endfor %}
            </div>
        </div>
        <div class="widget widget-default-hr">
            <hr>
        </div>
        <h3>{{ form.get('courses').getLabel() }}</h3>

        {% if form.hasMessagesFor(form.get('courses').getName()) %}
            <span class="help-block">
                {% for error in form.getMessagesFor(form.get('courses').getName()) %}
                    {{ error }}
                {% endfor %}
            </span>
        {% endif %}

        <div class="row widget my-account-cloner">
            <div class="col-xs-12" vegas-cloneable>
                {% for row in form.get('courses').getRows() %}
                <fieldset>
                    <div class="row widget">
                        <div class="col-xs-7">
                            <div class="controls-row">
                                <label>{{ row.get('name').getLabel() }}</label>
                                {{ row.get('name') }}
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="controls-row">
                                        <label>{{ row.get('start_date').getLabel() }}</label>
                                        {{ row.get('start_date') }}
                                    </div>
                                </div>
                                <div class="col-xs-6 nomargin">
                                    <div class="controls-row">
                                        <label>{{ row.get('finish_date').getLabel() }}</label>
                                        {{ row.get('finish_date') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                {% endfor %}
            </div>
        </div>
        <div class="widget widget-default-hr">
            <hr>
        </div>
        <h3>{{ form.get('skills').getLabel() }}</h3>

        {% if form.hasMessagesFor(form.get('skills').getName()) %}
            <span class="help-block">
                {% for error in form.getMessagesFor(form.get('skills').getName()) %}
                    {{ error }}
                {% endfor %}
            </span>
        {% endif %}

        <div class="controls-row full">
            <label>Vul hier jouw vaardigheden in (gescheiden door een ';')</label>
            {{ form.get('skills') }}
        </div>
        <div class="widget widget-default-hr">
            <hr>
        </div>
        <h3>{{ form.get('interests').getLabel() }}</h3>
        <div class="controls-row full">
            <label>Vul hier jouw interesses in (gescheiden door een ';')</label>

            {% if form.hasMessagesFor(form.get('interests').getName()) %}
            <span class="help-block">
                {% for error in form.getMessagesFor(form.get('interests').getName()) %}
                    {{ error }}
                {% endfor %}
            </span>
            {% endif %}

            {{ form.get('interests') }}
        </div>
        <div class="widget widget-default-hr">
            <hr>
        </div>
        <h3>{{ form.get('personal_info').getLabel() }}</h3>

        {% if form.hasMessagesFor(form.get('personal_info').getName()) %}
            <span class="help-block">
                {% for error in form.getMessagesFor(form.get('personal_info').getName()) %}
                    {{ error }}
                {% endfor %}
            </span>
        {% endif %}

        <div class="controls-row full">
            <label>Een klein stukje tekst over jezelf</label>
            {{ form.get('personal_info') }}
        </div>
        <div class="controls-row full">
            <input type="submit" class="btn" value="Opslaan" class="btn btn-primary" />
        </div>
    </div>
</div>
