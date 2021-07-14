<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="https://www.insightsintoimpact.com/wp-content/uploads/2019/03/to-do-list.png"/>
        <title>Todo List</title>
        <!-- <link rel=icon href="https://aboitizpower.com/wp-content/uploads/cropped-spiral-32x32.png" sizes="32x32"/> -->
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet"/>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">

        <link href="http://fonts.cdnfonts.com/css/carlista-buttery" rel="stylesheet">
      
    </head>
    <body>
            <div id="app" class="wrapper">
                <App/>
            </div>
    </body>
    <!-- <script type="text/javascript" src="{{ asset('/js/adminlte.js') }}"></script> -->
    <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
</html>
