
<style>
.youtube {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    padding-top: 25px;
    height: 0;
}
.youtube iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}  
</style>

<div class="youtube">
    <iframe src="//www.youtube-nocookie.com/embed/{{code}}?rel=0"   
            height="{{height}}" 
            width="{{width}}" 
            frameborder="0" 
            webkitallowfullscreen 
            mozallowfullscreen 
            allowfullscreen></iframe>
</div>