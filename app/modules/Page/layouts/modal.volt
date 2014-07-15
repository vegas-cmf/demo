<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
        
        <link rel="stylesheet" href="/assets/component/css/modal.css">

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        
        {% if h1 is defined %}<h1>{{h1}}</h1>{% endif %}
        
        <div id="main">
            {{ flash.output() }}            
            {{ content() }}
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="/component/scripts/helpers.js"></script>
        <script>
        $(function(){
            $('.btn-cancel').click(function(event){
                close();
                event.preventDefault();
            });
            keyboardHelper.init();
            keyboardHelper.addEvent('ESCAPE',close);
        });
        function close() {            
            window.parent.controlsManager.cancelAction();
        }
        </script>
    </body>
</html>