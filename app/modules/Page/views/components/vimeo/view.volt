
{#
    Vimeo Component
    - Displays a Vimeo video, which will scale to the width of the container
    - In edit mode, an image will be displayed for better rendering and speed
#}

<style>
.vimeo {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    padding-top: 25px;
    height: 0;
}
.vimeo img,
.vimeo iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}  
</style>

<div class="vimeo">
    {% if mode == 'edit' %}
        <?php $id = uniqid();?>
        <img id="img<?php echo $id;?>" />
        <script>
        function thumb<?php echo $id;?> (data) {
            document.getElementById('img<?php echo $id;?>').src = data[0].thumbnail_large;
        }
        </script>
        <script src="http://vimeo.com/api/v2/video/{{code}}.json?callback=thumb<?php echo $id;?>"></script>
    {% else %}
        <iframe src="//player.vimeo.com/video/{{code}}" 
                height="{{height}}" 
                width="{{width}}" 
                frameborder="0" 
                webkitallowfullscreen 
                mozallowfullscreen 
                allowfullscreen></iframe>    
    {% endif %}
</div>