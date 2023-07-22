@extends('layouts.header')

@section('title', 'Editing: ' . $user->name)

@section('content')

<div id="contact-create-container" class="col-md-6 offset-md-3">
    <h1 class="input-edit">Editing User</h1>
    <form action="/admin/update/{{ $user->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="contact's name"  required>
        </div>
        <div class="form-group input-edit">
            <label for="Email">Email:</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="contact's email"  required>
        </div>        
        <div class="sendBtnBox input-edit">
            <input type="submit" class="btn btn-primary" value="Update contact">
        </div>
    </form>
</div>

@endsection