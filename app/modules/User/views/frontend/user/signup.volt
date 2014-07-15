{{ flash.output() }}
{% if formErrors is defined %}
<div class="alert alert-danger">
    <ul>
        {%  for label,error in formErrors %}
        <li><strong>{{ label }}</strong> - {{ error }}</li>
        {% endfor %}
    </ul>
</div>
{% endif %}
<?php
    $this->assets
        ->addJs('assets/vendor/jquery/dist/jquery.min.js')
        ->addCss('assets/vendor/bootstrap/dist/css/bootstrap.min.css')
        ->addJs('assets/vendor/bootstrap/dist/js/bootstrap.min.js')
        ->addCss('assets/vendor/font-awesome/css/font-awesome.min.css')
        ->addCss('assets/vendor/bootstrap-social/bootstrap-social.css')
        ;
?>
<form class="form-signin" role="form" method="POST" action="{{ url.get(['for' : 'signup']) }}">
    <h2 class="form-signup-heading">Please sign up</h2>
    <input type="email" class="form-control" placeholder="Email address" name="email" required autofocus>
    <input type="password" class="form-control" placeholder="Password" name="raw_password" required>
    <input type="password" class="form-control" placeholder="Re-type password" name="repassword" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

    <a href="{{ linkedinUri }}" class="btn btn-block btn-social btn-linkedin">
        <i class="fa fa-linkedin"></i>
        Sign up with Linkedin
    </a>
    <a href="{{ googleUri }}" class="btn btn-block btn-social btn-google-plus">
        <i class="fa fa-google-plus"></i>
        Sign up with Google
    </a>
    <a href="{{ facebookUri }}" class="btn btn-block btn-social btn-facebook">
        <i class="fa fa-facebook"></i>
        Sign up with Facebook
    </a>

    <a href="{{ url.get(['for': 'login']) }}">Have account?</a>
</form>