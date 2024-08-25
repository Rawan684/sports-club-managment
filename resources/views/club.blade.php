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
        <h1>{{ $club->name }}</h1>
        <img src="{{ asset($club->logo) }}" alt="Club Logo">
        <p>{{ $club->address }}</p>

        <h2>Sports Offered</h2>
        <ul>
            @foreach ($sports as $sport)
                <li>{{ $sport->name }} - {{ $sport->description }}</li>
            @endforeach
        </ul>

        <form method="POST" action="{{ route('club. submitInquiry', $club) }}">
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <div>
                <label for="captcha">CAPTCHA:</label>
                {!! captcha_img() !!}
                <input type="text" id="captcha" name="captcha" required>
            </div>
            <button type="submit">Submit Inquiry</button>
        </form>

    </body>

    </html>
@endsection
