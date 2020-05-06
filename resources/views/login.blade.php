<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin</title>
        <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <v-app id="admin" id="inspire">
            <login-component></login-component>
        </v-app>
        <script src="{{ asset('js/admin.js') }}" defer></script>
</html>