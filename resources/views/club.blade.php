@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>Material Design for Bootstrap</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css" />
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
        <!-- MDB -->
        <link rel="stylesheet" href="css/mdb.min.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />


    </head>

    <body>
        <div>
            <h1>{{ $clubInfo['name'] }}</h1>
            <p>{{ $clubInfo['description'] }}</p>
            <p>Location: {{ $clubInfo['location'] }}</p>

            <h2>Subscription Application Form</h2>
            <form action="" method="post">
                @csrf
                <label for="name">Name:</label>
                <input type="text" id="name" name="name"><br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"><br><br>
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone"><br><br>
                <label for="message">Message:</label>
                <textarea id="message" name="message"></textarea><br><br>
                <input type="submit" value="Apply for Subscription">
            </form>


        </div>

    </body>

    </html>
@endsection
