<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Real-Time Chat</title>
    <link rel="stylesheet" href="{{ mix('build/css/app.css') }}">
</head>
<body>
    <div id="app">
        <!-- This is where the ChatComponent will display -->
        <chat-component></chat-component>
    </div>

    <script src="{{ mix('build/js/app.js') }}"></script>
</body>
</html>
