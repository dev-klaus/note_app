<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script  src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <link href="{{ URL::to('css/note_app.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ URL::to('js/note_app.js') }}"></script>
        <script>
            $(document).ready(function(){
                App.init();
            });
        </script>

    </head>
    <body>
        <div id="app_loading">
            <img alt="Please wait..." src="{{ URL::to('img/loading_icn.gif') }}" />
        </div>
        <div class="content" id="note_app"></div>
    </body>
</html>
