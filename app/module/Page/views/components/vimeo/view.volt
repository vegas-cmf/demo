
<style>
.vimeo {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    padding-top: 25px;
    height: 0;
}
.vimeo iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}  
</style>

<div class="vimeo">
    <iframe src="//player.vimeo.com/video/{{code}}" 
            height="{{height}}" 
            width="{{width}}" 
            frameborder="0" 
            webkitallowfullscreen 
            mozallowfullscreen 
            allowfullscreen></iframe>    
</div>