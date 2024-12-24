<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Comment App</title>
</head>
<body>
    <h1>Comments</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Your name" required>
        <textarea name="comment" placeholder="Your comment" required></textarea>
        <button type="submit">Add Comment</button>
    </form>

    <h2>All Comments:</h2>
    @foreach($comments as $comment)
        <p><strong>{{ $comment->name }}:</strong> {{ $comment->comment }}</p>
        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Supprimer</button>
        </form>
    @endforeach
</body>
</html>
