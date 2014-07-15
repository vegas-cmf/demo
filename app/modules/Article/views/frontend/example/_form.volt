{% for element in form %}
    {%  if (element.getUserOption('_type') == 'hidden') %}
        {{  element }}
    {% else %}
    {% do element.setAttribute('class', element.getAttribute('class')~' form-control') %}
    {% set hasErrors = form.hasMessagesFor(element.getName()) %}

    <div class="form-group{% if hasErrors %} has-error{% endif %}">
        <label for="{{ element.getName() }}"
               class="col-xs-2 control-label">{{ element.getLabel() }}</label>

        <div class="col-xs-10">
            {{ element }}
            {% if hasErrors %}
                <span class="help-block">
                    {% for error in form.getMessagesFor(element.getName()) %}
                        {{ error }}
                    {% endfor %}
                </span>
            {% endif %}
        </div>
    </div>
    {% endif %}
{% endfor %}