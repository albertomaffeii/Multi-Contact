@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div class="col-md-12 row offset-md-1 dashboard-title-container">
        <div class="col-md-6"><h1>My Contacts</h1></div>
    </div>
    
        <div class="col-md-12 row offset-md-1 dashboard-title-container">
        <div class="col-md-6"><h4>Hello {{ $user->name }}</h4></div>
        <!-- Input group -->
        <div class="d-flex justify-content-center col-md-6">
            <form action="dashboard" method="GET" class="input-group w-auto">
                <input type="text" id="search" name="search" class="form-control" placeholder="Search Event ..." />
                <button type="submit" class="btn btn-primary" type="button" id="button-addon1" data-mdb-ripple-color="dark">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
            </form>
        </div>
    </div>

    <div id="contacts-container" class="contacts-search-for" class="col md 12">
        @if($search)
            <h2>Search for: {{ $search }}</h2>
            <p class="contact-back"><a href="{{ route('contacts.dashboard') }}">Back to Home page</a></p>
        @endif

        <div id="cards-container" class="row">
        @if(count($contacts) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Country Code</th> 
                    <th scope="col">Number</th> 
                    <th scope="col" class="action" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td> <ion-icon name="person-outline"></ion-icon> {{ $contact->countrycode }}</td>
                        <td>{{ $contact->number }}</td>
                        <td class="action">
                            <a href="/contacts/show/{{ $contact->id }}" class="btn btn-warning view-btn btn-sm">
                                <ion-icon name="create-outline"></ion-icon> View
                            </a>
                        </td>
                        <td class="action">
                            <a href="/contacts/edit/{{ $contact->id }}" class="btn btn-info edit-btn btn-sm">
                                <ion-icon name="create-outline"></ion-icon> Edit
                            </a>
                        </td>
                        <td>
                            <form action="/contacts/{{ $contact->id }}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn btn-sm">
                                    <ion-icon id="trash-outline" name="trash-outline"></ion-icon> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach                
            </tbody>
        </table>

        @else
            <p>You have no Contacts yet, <a href="/contacts/create">Create Contacts</a></p>
        @endif
        
        @if(count($contacts) == 0 && $search)
            <h4>There are no contacts for the search key {{ $search }}!</h4>
        @endif
    </div>

@endsection