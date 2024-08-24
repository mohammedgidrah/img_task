@extends('master')
@section('title')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 10px; /* Reduced margin */
        }
        
        .form-control {
            width: 100%;
            padding: 8px; /* Reduced padding */
            border-radius: 4px; /* Smaller border radius */
            border: 1px solid #ccc;
            font-size: 14px; /* Smaller font size */
        }

        .form-control-file {
            margin-top: 8px; /* Reduced margin */
        }

        .form-control:focus {
            border-color: #007BFF;
            outline: none;
        }

        label {
            font-size: 14px; /* Smaller font size */
            margin-bottom: 5px; /* Reduced margin */
            display: block;
        }

        select.form-control {
            padding: 6px; /* Smaller padding for select box */
        }

        .btn {
            padding: 8px 16px; /* Reduced padding */
            border-radius: 4px; /* Smaller border radius */
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 14px; /* Smaller font size */
        }

        .btn:hover {
            background-color: #0056b3;
        }

        form {
            max-width: 600px; /* Reduced form width */
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .main{
            padding-top: 100px
        }
    </style>
</head>
<body>
<div class="main">

    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" class="form-control" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Upload Image (optional)</label>
            <input type="file" id="image" name="image" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="tags">Tags:</label>
            <select id="tags" name="tags[]" class="form-control" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>

</body>
</html>
@endsection
