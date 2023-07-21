@extends('layouts.main')

@section('title', 'Showing: ' . $contact->name)

@section('content')

<div class="col-md-10 offset-md-1">
        <div id="info-container" class="col-md-6">
            <h1>{{ $contact->name }}</h1>
            <p class="contact-contact">
                <ion-icon name="location-outline"></ion-icon>
                {{ $contact->contact }}
            </p>
            <p class="contact-email">
            <ion-icon name="calendar-outline"></ion-icon>
                {{ $contact->email }}
</p>
    </div>
    <p class="contact-back"><a href="/dashboard">Back to Home page</a></p>
</div>

@endsection