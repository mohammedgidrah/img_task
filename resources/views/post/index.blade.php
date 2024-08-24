@extends('master')
@section('title')
    
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px; /* Adjusted for a smaller container */
            margin: 100px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #343a40;
            margin-bottom: 20px;
            text-align: center;
        }

        .btn {
            padding: 8px 16px; /* Reduced padding */
            border-radius: 5px;
            font-size: 14px; /* Smaller font size */
            color: #ffffff;
            text-align: center;
            cursor: pointer;
            margin-top: 20px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .alert-success {
            padding: 10px; /* Reduced padding */
            margin-bottom: 20px;
            border-radius: 4px;
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px; /* Smaller font size */
        }

        thead {
            background-color: #007bff;
            color: #ffffff;
        }

        th,
        td {
            padding: 8px; /* Reduced padding */
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #e9ecef;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 8px; /* Reduced padding */
            border-radius: 4px;
            border: 1px solid #ced4da;
            box-sizing: border-box;
        }

        .text-center {
            text-align: center;
        }

        .post-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 10px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .post-card img {
            max-width: 100%;
            height: auto;
        }

        .post-content {
            padding: 15px;
        }

        .post-title {
            font-size: 1.5rem;
            margin: 0;
            color: #333;
        }

        .post-excerpt {
            font-size: 1rem;
            color: #666;
            margin: 10px 0;
        }

        .read-more {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .read-more:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>All Posts</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Tags</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td>
                        @foreach ($post->tags as $tag)
                            {{ $tag->name }}@if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td><img src="{{ asset($post->image) }}" style="height: 60px; width:auto;" alt="Post Image"></td>
                    <td>
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>

@endsection
