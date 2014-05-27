
<div class="nine columns centered">
    {% if position is 'left' %}
        <div class="four columns">
            <figure class="serviceblock">
                <img src="{{image}}" alt="{{title}}" />
            </figure>
        </div>    
    {% endif %} 
        
    <div class="eight columns info">
        <h4>{{title}}</h4>
        <p>{{description}}</p>
    </div>   
        
    {% if position is 'right' %}
        <div class="four columns">
            <figure class="serviceblock">
                <img src="{{image}}" alt="{{title}}" />
            </figure>
        </div>    
    {% endif %}                                                            
</div>