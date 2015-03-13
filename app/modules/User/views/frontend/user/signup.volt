<?php
    $this->assets->addCss('assets/lib/bootstrap-social/bootstrap-social.css')
        ;
?>
<div class="col-xs-12 col-md-6 col-md-offset-3">
    {% if formErrors is defined %}
    <div class="alert alert-danger">
        <ul>
            {%  for label,error in formErrors %}
            <li><strong>{{ label }}</strong> - {{ error }}</li>
            {% endfor %}
        </ul>
    </div>
    {% endif %}
    {% if error is defined %}
    <div class="alert alert-danger">
        <strong>{{ error }}</strong>
    </div>
    {% endif %}
    <form class="form-signin" role="form" method="POST" action="{{ url.get(['for' : 'signup']) }}">
        <h2 class="form-signup-heading">Please sign up</h2>
        <div class="row">
            <input type="email" class="form-control" placeholder="Email address" name="email" required autofocus>
            <input type="password" class="form-control" placeholder="Password" name="raw_password" required>
            <input type="password" class="form-control" placeholder="Re-type password" name="repassword" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
        </div>

        <div class="row">
            <a class="pull-right" href="{{ url.get(['for': 'login']) }}">Have account?</a>
        </div>

        <div class="row">
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
        </div>
    </form>
</div>