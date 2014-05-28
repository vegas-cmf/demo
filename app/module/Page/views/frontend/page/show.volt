
{% set component = serviceManager.getService('page:component') %}

<div class="row">
    <div class="col-md-12">        
        {{ component.render(1) }}
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        {{ component.render(2) }}
    </div>
    <div class="col-md-4">
        {{ component.render(3) }}
    </div>
</div>

<div class="row">
    <div class="col-md-12">        
        {{ component.render(11) }}
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-6">
        {{ component.render(4) }}
    </div>
    <div class="col-md-3 col-sm-6">
        {{ component.render(5) }}
    </div>
    <div class="col-md-3 col-sm-6">
        {{ component.render(6) }}
    </div>
    <div class="col-md-3 col-sm-6">
        {{ component.render(7) }}
    </div>
</div>

<div class="row">
    <div class="col-md-12">        
        {{ component.render(12) }}
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-4">
        {{ component.render(8) }}
    </div>
    <div class="col-md-4 col-sm-4">
        {{ component.render(9) }}
    </div>
    <div class="col-md-4 col-sm-4">
        {{ component.render(10) }}
    </div>
</div>