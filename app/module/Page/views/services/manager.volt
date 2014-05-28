
{% if action == 'load' and mode != 'edit' and identity %}
<style>
#component-editor-menubar {
    background: #fff;
    color: #404040;
    height: 32px;
    text-decoration: none;
    text-shadow: none;
    text-align: left;
    overflow: hidden;
    width: 100%;
}
    #component-editor-menubar img {
        display: block;
        float: left;
        padding: 3px 0 0 5px;
    }
    #component-editor-menubar label {
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        display: block;
        float: left;
        height: 100%;
        margin: 0 15px 0 5px;
        padding: 0 10px;
        width: 40%;
    }
    #component-editor-menubar span {
        display: none;
        float: left;
        font-weight: normal;
        padding: 5px 15px 0 15px;
    }
    #component-editor-menubar select {
        display: block;
        font-weight: normal;
        padding: 6px 12px;
        margin: 5px 0 0;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
    }
    #component-editor-menubar a {
        background: #efefef;
        border-left: 1px solid #ccc;
        cursor: pointer;
        color: #404040;
        float: right;
        font-size: 12px;
        height: 32px;
        padding: 8px 10px;
        position: relative;
        text-shadow: none;
        text-decoration: none;
        z-index: 2050;
    }
    #component-editor-menubar a:hover {
        background: #ccc;
    }
</style>
<script>
function componentManagerRedirect() {
    var select = document.getElementById("component-manager-select"),
        url    = select.options[select.selectedIndex].getAttribute('value');
    window.location = url;
}    
</script>
<div id="component-editor-menubar">
    <img src="/assets/component/img/logo.png" height="26" />
    <label>
        <span>{{ i18n._('Page:') }}</span> 
        <select id="component-manager-select" onchange="componentManagerRedirect();">
            {% for link in pages %}
            <option {% if page._id is link._id %}selected{% endif %} value="/{{ link.slug }}">{{ link.name }}</option>
            {% endfor %}
        </select>
    </label>
    <a href="logout">
        {{ i18n._('Logout') }}
    </a>
    <a href="{{ url.get(['for':'admin/page','action':'editor','params':'activate']) }}?page={{ page.slug }}">
        {{ i18n._('Edit page') }}
    </a>
</div>
{% endif %}

{% if action == 'load' and mode == 'edit' %}
{# <link rel="stylesheet" type="text/css" href="component/vendor/jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css" /> #}
<link rel="stylesheet" type="text/css" href="assets/component/vendor/font-awesome-4.0.3/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="assets/component/vendor/jquery.growl/stylesheets/jquery.growl.css"  />

<link rel="stylesheet" type="text/css" href="assets/component/css/manager.css" />
<link rel="stylesheet" type="text/css" href="assets/component/css/skin/light.css" />

<div id="component-messages" style="display: none;">{{ flash.output() }}</div>

<div id="component-manager">
        
    <div class="cm-container clearfix">
        <a class="cm-logo" href="/?t=logo"></a>
        <div id="cm-controls" class="clearfix">           
            <ul class="action-crud">
                <li><a data-action="componentManager.insertAction"><i class="fa fa-pencil"></i><b>{{ i18n._('insert') }}</b></a></li>
            </ul>   
            <ul class="action-crud">
                <li><a data-action="componentManager.updateAction"><i class="fa fa-cogs"></i><b>{{ i18n._('update') }}</b></a></li>
                <li><a data-action="componentManager.deleteAction"><i class="fa fa-trash-o"></i><b>{{ i18n._('delete') }}</b></a></li>
            </ul>                  
            <ul class="action-crud">
                <li><a data-action="componentManager.cutAction" alt="{{ i18n._('CTRL + X') }}" title="{{ i18n._('CTRL + X') }}"><i class="fa fa-scissors"></i><b>{{ i18n._('cut') }}</b></a></li>
                <li><a data-action="componentManager.copyAction" alt="{{ i18n._('CTRL + C') }}" title="{{ i18n._('CTRL + C') }}"><i class="fa fa-copy"></i><b>{{ i18n._('copy') }}</b></a></li>
            </ul>
            <ul class="action-crud">
                <li><a data-action="componentManager.pasteAction" class="control-disabled"><i class="fa fa-paste"></i><b>{{ i18n._('paste') }}</b></a></li>
                <li><a data-action="componentManager.clearAction" class="control-disabled"><i class="fa fa-unlink"></i> <b>{{ i18n._('clear') }}</b></a></li>
            </ul>
            <ul class="action-default">
                <li><a data-action="pageManager.indexAction" alt="{{ i18n._('CTRL + L') }}" title="{{ i18n._('CTRL + L') }}"><i class="fa fa-indent"></i><b>{{ i18n._('page list') }}</b></a></li>
            </ul>
            <ul class="action-default">
                <li><a data-action="pageManager.createAction" alt="{{ i18n._('CTRL + N') }}" title="{{ i18n._('CTRL + N') }}"><i class="fa fa-pencil"></i><b>{{ i18n._('new page') }}</b></a></li>
            </ul>
            <ul class="action-default">
                <li><a data-action="pageManager.updateAction" alt="{{ i18n._('CTRL + E') }}" title="{{ i18n._('CTRL + E') }}"><i class="fa fa-cogs"></i><b>{{ i18n._('edit page') }}</b></a></li>
                <li><a data-action="pageManager.deleteAction" alt="{{ i18n._('CTRL + DELETE') }}" title="{{ i18n._('CTRL + DELETE') }}"><i class="fa fa-trash-o"></i><b>{{ i18n._('delete') }}</b></a></li>
            </ul>
            <ul class="action-default action-sortable">
                <li><a data-action="componentManager.makeSortableAction"><i class="fa fa-arrows"></i><b>{{ i18n._('sort') }}</b></a></li>
                <li><a data-action="componentManager.destroySortableAction" class="control-disabled"><i class="fa fa-floppy-o"></i><b>{{ i18n._('save') }}</b></a></li>
            </ul>
            <ul class="action-crud action-cancel action-create">
                <li><a data-action="controls.cancel" alt="{{ i18n._('ESC') }}" title="{{ i18n._('ESC') }}"><i class="fa fa-reply"></i><b>{{ i18n._('cancel') }}</b></a></li>
            </ul>
            <ul class="action-default">
                <li><a href="{{ url.get(['for':'admin/page','action':'editor','params':'deactivate']) }}?page={{ page.slug }}"><i class="fa fa-share"></i><b>{{ i18n._('close') }}</b></a></li>
            </ul>
        </div>
    </div>
</div>

<div id="component-page-list">
    <ul>
        <li><strong>{{ i18n._('PAGE LIST') }}</strong></li>      
        
        {% for link in pages %}
        <li><a {% if page._id is link._id %}class=active{% endif %} href="/{{ link.slug }}">{{ link.name }}</a></li>
        {% endfor %}
    </ul>
    <a id="component-page-list-logo" href="#"><img src="/assets/component/img/logo.png" /></a>
</div>

{# component-body #}
<div id="component-body">   
    
{% endif %}

{% if action == 'init' and mode == 'edit' %}

{# component-body #}
</div>

<div id="component-quick-list">
    <ul>
        {% for component in components %}
        <li><a class="quick-add">
            {{ component.name }}
            <img src="{{component.image}}" />
            <span></span>
        </a></li>
        {% endfor %}
    </ul>
</div>

{# hover overlay #}
<div id="component-overlay" data-icon="fa fa-cog">
    <div></div>
</div>

{# modal / dialog / loading #}
<div id="component-dropdown">
    <ul class="action-crud">
        <li><a data-action="componentManager.insertAction"><i class="fa fa-chevron-up"></i><b>{{ i18n._('insert above') }}</b></a></li>
        <li><a data-action="componentManager.insertAction"><i class="fa fa-chevron-down"></i><b>{{ i18n._('insert below') }}</b></a></li>
    </ul>
    <ul class="action-crud">
        <li><a data-action="componentManager.updateAction"><i class="fa fa-cogs"></i><b>{{ i18n._('update') }}</b></a></li>
        <li><a data-action="componentManager.deleteAction"><i class="fa fa-trash-o"></i><b>{{ i18n._('delete') }}</b></a></li>
    </ul>                  
    <ul class="action-crud">
        <li><a data-action="componentManager.cutAction"><i class="fa fa-scissors"></i><b>{{ i18n._('cut') }}</b></a></li>
        <li><a data-action="componentManager.copyAction"><i class="fa fa-copy"></i><b>{{ i18n._('copy') }}</b></a></li>
    </ul>
    <ul class="action-crud">
        <li><a data-action="componentManager.pasteAction" class="control-disabled"><i class="fa fa-paste"></i><b>{{ i18n._('paste') }}</b></a></li>
    </ul>
</div>
<div id="component-dialog"></div>
<div id="component-loader"></div>
<div id="component-modal"></div>

{# backdrop #}
<div id="component-modal-backdrop"></div>

{# @TODO move to CDN #}
{# vegas-cmf.com/assets/... #}
<script type="text/javascript" src="assets/component/vendor/jquery-ui-1.10.4.custom.draggable/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="assets/component/vendor/jquery-ui-1.10.4.custom.draggable/js/jquery-ui-1.10.4.custom.js"></script>
<script type="text/javascript" src="assets/component/vendor/jquery.growl/javascripts/jquery.growl.js"></script>

<script type="text/javascript" src="assets/component/scripts/utils/i18n.js"></script>
<script type="text/javascript" src="assets/component/scripts/utils/helpers.js"></script>
<script type="text/javascript" src="assets/component/scripts/utils/controls.js"></script>
<script type="text/javascript" src="assets/component/scripts/utils/layout.js"></script>
<script type="text/javascript" src="assets/component/scripts/utils/debug.js"></script>

<script type="text/javascript" src="assets/component/scripts/component.js"></script>
<script type="text/javascript" src="assets/component/scripts/page.js"></script>

<script type="text/javascript" src="assets/component/scripts/i18n/en.js"></script>

<script>
var config = {
    mode  : {{ mode|json_encode }},
    page  : {
        id : "{{ page._id }}",
        url: "/{{ page.slug }}"
    }
};
var urls = {
    component: {
        update  : {{ url.get(['for':'admin/component','action':'edit',  'params':'%id%'])|json_encode }},
        remove  : {{ url.get(['for':'admin/component','action':'delete','params':'%id%'])|json_encode }},
        create  : {{ url.get(['for':'admin/component/tools','action':'select'])|json_encode }},
        position: {{ url.get(['for':'admin/component/tools','action':'position'])|json_encode }},
        cut     : {{ url.get(['for':'admin/component/tools','action':'cut',   'params':'%id%'])|json_encode }},
        copy    : {{ url.get(['for':'admin/component/tools','action':'copy',  'params':'%id%'])|json_encode }}
    },
    page: {
        index : {{ url.get(['for':'admin/modal/page','action':'index'])|json_encode }},
        create: {{ url.get(['for':'admin/modal/page','action':'new'])|json_encode }},
        update: {{ url.get(['for':'admin/modal/page','action':'edit','params':page._id])|json_encode }}, 
        remove: {{ url.get(['for':'admin/modal/page','action':'delete','params':page._id])|json_encode }}         
    }
};
</script>
<script src="assets/component/main.js"></script>
{% endif %}
