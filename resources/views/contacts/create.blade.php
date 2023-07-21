@extends('layouts.main')

@section('title', 'New Contact')

@section('content')

<div id="contact-create-container" class="col-md-6 offset-md-3">
    <h1>Create your contact</h1>
    <form action="/contacts" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Contact's name"  required>
        </div>
        <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact with 9 digits" max="9" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" class="form-control" placeholder="Contact's email" required>
        </div>
        <div class="sendBtnBox">
            <input type="submit" class="btn btn-primary" value="Create Contact">
        </div>
    </form>
</div>

@endsection