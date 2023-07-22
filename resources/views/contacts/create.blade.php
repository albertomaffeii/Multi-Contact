@extends('layouts.main')

@section('title', 'New Contact')

@section('content')

<div id="contact-create-container" class="col-md-6 offset-md-3">
    <h1>Create your contact</h1>
    <form action="/contacts" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Dropdown para selecionar o país -->
        <div class="form-group input-edit">
            <label for="CountryCode">Select a Country:</label><br>
            <select id="countrySelect" class="form-control" style="width: 500px">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group input-edit">
            <label for="CountryCode">Country Code:</label>
            <input type="text" class="form-control" id="countrycode" name="countrycode" placeholder="Type Country Code" >
                @error('countrycode')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        </div>
        <div class="form-group input-edit">
            <label for="contact"></label>Number:</label>
            <input type="text" id="number" name="number" class="form-control" placeholder="Number with 9 digits" maxlength="9" >
            @error('number')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="sendBtnBox input-edit">
            <input type="submit" class="btn btn-primary" value="Create Contact">
        </div>
    </form>
</div>


    <!-- Adicione os scripts da biblioteca Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        // Inicialize o dropdown com a lista de países usando a API
        $(document).ready(function() {
            $('#countrySelect').select2({
                ajax: {
                    url: '/countries',
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                }
            });
        });
    </script>

@endsection