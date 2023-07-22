@extends('layouts.header')

@section('title', $user->title)

@section('content')

<div class="col-md-10 row offset-md-1">
    <div class="col-md-6">
    
        <div id="info-container" class="col-md-6">
            <h1>{{ $user->name }}</h1>

            <p class="contact-email">
            <ion-icon name="calendar-outline"></ion-icon>
                {{ $user->email }}
            </p>
        </div>
    </div>
    <div class="col-md-6">
        <h2>Contacts</h2>
        @if ($user->contacts->count() > 0)
            <ul>
                @foreach ($user->contacts as $contact)
                    <li>
                        {{ $contact->number }} ({{ $contact->countrycode }})
                        <a href="#">Edit</a>
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No contacts found for this user.</p>
        @endif

        <a href="#" class="btn btn-primary">Add New Contact</a>
    </div>
@endsection