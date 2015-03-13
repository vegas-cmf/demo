{{ flash.output() }}
<?php
    $this->assets
        ->addCss('assets/lib/bootstrap-social/bootstrap-social.css')
        ;
?>
<div class="col-xs-12 col-md-6 col-md-offset-3">
    <form class="form-signin" role="form" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <div class="row">
            <input type="email" class="form-control" placeholder="Email address" name="email" required autofocus>
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </div>

        <div class="row">
            <a class="pull-right" href="{{ url.get(['for' : 'signup']) }}">Do not have an account ?</a>
        </div>

        <div class="row">
            <a href="{{ linkedinUri }}" class="btn btn-block btn-social btn-linkedin">
                <i class="fa fa-linkedin"></i>
                Sign in with Linkedin
            </a>
            <a href="{{ googleUri }}" class="btn btn-block btn-social btn-google-plus">
                <i class="fa fa-google-plus"></i>
                Sign in with Google
            </a>
            <a href="{{ facebookUri }}" class="btn btn-block btn-social btn-facebook">
                <i class="fa fa-facebook"></i>
                Sign in with Facebook
            </a>
        </div>
    </form>
    <div class="alert alert-info" style="text-align:center">
        Use the following CLI task to create an user account: <br />
        <i>php cli/cli.php app:user:user create -e=user@vegasdemo.com -p=p@55w0rD -n="Vegas User"</i>
    </div>
</div>