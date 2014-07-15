{{ flash.output() }}
<?php
    $this->assets
        ->addJs('assets/vendor/jquery/dist/jquery.min.js')
        ->addCss('assets/vendor/bootstrap/dist/css/bootstrap.min.css')
        ->addJs('assets/vendor/bootstrap/dist/js/bootstrap.min.js')
        ->addCss('assets/vendor/font-awesome/css/font-awesome.min.css')
        ->addCss('assets/vendor/bootstrap-social/bootstrap-social.css')
        ;
?>
<form class="form-signin" role="form" method="POST">
    <h2 class="form-signin-heading">Please login into dashboard</h2>
    <input type="email" class="form-control" placeholder="Email address" name="email" required autofocus>
    <input type="password" class="form-control" placeholder="Password" name="password" required>
    <label class="checkbox">
        <input type="checkbox" value="remember-me"> Remember me
    </label>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>