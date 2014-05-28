
<div class="component-list" {% if mode == 'edit' %}
     data-allowed="{{allowed}}"
     data-blocked="{{blocked}}"
     data-limit="{{limit}}"
     data-position="{{position}}"
     data-level="{{level}}"
     data-count="{{ components|length }}"{% endif %}>

    {% for component in components %}
    <div class="component clearfix" 
         data-id="{{ component._id }}" 
         data-class="{{ component.class }}" 
         data-module="{{ component.module }}">       
        {{ component.instance.render(component.params) }}
        {% if mode == 'edit' %}
            <div class="component-overlay"></div>
            {#<span class="component-label">{{ component.class }}</span>#}
        {% endif %}
    </div> 
    {% endfor %}
         
    {% if mode == 'edit' and (limit == 0 or limit > components|length) %}
    <span class="component-hint{% if components %} hide{% endif %}{#% if components and not forced %} hide{% endif %#}">
        <div class="component" data-action="componentManager.createAction" data-icon="fa fa-plus-circle">
            <div class="component-overlay">
                <div><i class="fa fa-plus-circle"></i></div>
            </div>
        </div>
    </span>
    {% endif %}

</div>