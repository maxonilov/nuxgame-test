<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page A</title>
</head>
<body>
    <h1>Welcome, {{ $user->username }}!</h1>
    <p>Phone: {{ $user->phone_number }}</p>

    <form method="POST" action="{{ route('page.regenerate', request()->route('token')) }}">
        @csrf
        <button type="submit">Regenerate Link</button>
    </form>

    <form method="POST" action="{{ route('page.deactivate', request()->route('token')) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Deactivate Link</button>
    </form>

    <form method="POST" action="{{ route('page.lucky', request()->route('token')) }}">
        @csrf
        <button type="submit">I'm Feeling Lucky</button>
    </form>

    <a href="{{ route('page.history', request()->route('token')) }}">History</a>
</body>
</html>
