@extends('layouts.main')

@section('title', 'Editing: ' . $contact->name)

@section('content')

<div id="contact-create-container" class="col-md-6 offset-md-3">
    <h1 class="input-edit">Editing your contact</h1>
    <form action="/contacts/update/{{ $contact->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Country Code:</label>
            <input type="text" class="form-control" id="countrycode" name="countrycode" value="{{ $contact->countrycode }}" placeholder="contact's name" />
                @error('countrycode')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        </div>
        <div class="form-group input-edit">
            <label for="contact">Number:</label>
            <input type="text" id="number" name="number" class="form-control" value="{{ $contact->number }}" placeholder="Number with 9 digits" />
                @error('number')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        </div>        
        <div class="sendBtnBox input-edit">
            <input type="submit" class="btn btn-primary" value="Update contact">
        </div>
    </form>
</div>

@endsection