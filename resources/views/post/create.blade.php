<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Post</title>
</head>
<style>
    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .form-control-file {
        margin-top: 10px;
    }

    .form-control:focus {
        border-color: #007BFF;
        outline: none;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }

</style>
<body>
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Upload Image (optional)</label>
            <input type="file" id="image" name="image" class="form-control-file">
        </div>
        <label for="tags">Tags:</label>
        <select id="tags" name="tags[]" multiple>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
    
</body>
</html>
