<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> --}}
        <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}">
        <style type="text/css">
            .form-control{
                border-radius: 0;
                border: 1px solid rgba(0, 0, 0, .1);
                box-shadow: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <todolist></todolist>
                </div>
            </div>
        </div>
        <div class="flex-center position-ref full-height">
        </div>
        <script type="text/javascript" src="{{ url('/js/app.js') }}"></script>
    </body>
</html>
