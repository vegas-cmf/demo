<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Vegas CMF">

    <title>Vegas CMF</title>

    <link rel="icon" href="https://avatars0.githubusercontent.com/u/7290509?v=3&s=200" />
    <link href="/assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">

    {{ assets.outputCss() }}

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="http://getbootstrap.com/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{ assets.outputJs() }}
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url.get(['for': 'root']) }}">vegas-cmf demo</a>
            <button data-target="#navbar-main" data-toggle="collapse" type="button" class="navbar-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar-main" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
                <li><a href="{{ url.get([ 'for' : 'private' ])}}">Private</a></li>
                <li><a href="http://vegas-cmf.github.io/1.0/guide.html">Features</a></li>
                <li><a href="http://cmf.vegas#box-contact">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                {% if auth.isAuthenticated() %}
                <li>
                    <a href="#">
                    Logged in as {{ auth.getIdentity().getEmail() }}
                    </a>
                </li>
                <li><a href="{{ url.get(['for' : 'crud', 'action' : 'index']) }}">Crud</a></li>
                <li><a href="{{ url.get(['for': 'logout']) }}">{{ i18n._('Logout') }}</a></li>
                {% else %}
                <li><a href="{{ url.get(['for': 'login']) }}">{{ i18n._('Login') }}</a></li>
                {% endif %}
            </ul>

        </div>
    </div>
</div>

<div class="container">
    <div id="banner" class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1>Vegas CMF</h1>
                <p class="lead">
                    {{ i18n._('Vegas CMF is a complex Content Management Framework that allows you to easily build own CMS.') }}
                </p>
            </div>
        </div>
    </div>
    <div class="clearfix row">
        {{ flash.output() }}
        {{ content() }}
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="text-muted text-center">
            <a href="http://cmf.vegas" target="_blank">Thanks for using Vegas CMF</a>
        </p>
    </div>
</footer>
</body>
</html>
