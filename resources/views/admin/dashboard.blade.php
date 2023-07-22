@extends('layouts.header')

@section('title', 'Dashboard')

@section('content')

    <div class="col-md-12 row offset-md-1 dashboard-title-container">
        <div class="col-md-6"><h1>Admin Panel</h1></div>
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
            <p class="contact-back"><a href="{{ route('admin.dashboard') }}">Back to Home page</a></p>
        @endif

        <div id="cards-container" class="row">
        @if(count($users) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th> 
                    <th scope="col">Email</th> 
                    <th scope="col" class="action" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $us)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $us->name }}</td>
                        <td>{{ $us->email }}</td>
                        <td class="action">
                            <a href="/admin/show/{{ $us->id }}" class="btn btn-warning view-btn btn-sm">
                                <ion-icon name="create-outline"></ion-icon> View
                            </a>
                        </td>
                        <td class="action">
                            <a href="/admin/edit/{{ $us->id }}" class="btn btn-info edit-btn btn-sm">
                                <ion-icon name="create-outline"></ion-icon> Edit
                            </a>
                        </td>
                        <td>
                           <form action="{{ route('admin.destroy', ['id' => $us->id]) }}" method="POST">
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

        @endif
        
        @if(count($users) == 0 && $search)
            <h4>There are no contacts for the search key {{ $search }}!</h4>
        @endif
    </div>

@endsection