
{#
    Youtube Component
    - Displays a youtube video, which will scale to the width of the container
    - In edit mode, an image will be displayed for better rendering and speed
#}

<style>
.youtube {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    padding-top: 25px;
    height: 0;
}
.youtube img,
.youtube iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}  
</style>

<div class="youtube">
    {% if mode == 'edit' %}
    <img src="http://img.youtube.com/vi/{{code}}/0.jpg" />  
    {% else %}
    <iframe src="//www.youtube-nocookie.com/embed/{{code}}?rel=0"   
            height="{{height}}" 
            width="{{width}}" 
            frameborder="0" 
            webkitallowfullscreen 
            mozallowfullscreen 
            allowfullscreen></iframe>
    {% endif %}
</div>