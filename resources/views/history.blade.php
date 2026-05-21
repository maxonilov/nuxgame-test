<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>History</title>
</head>
<body>
    <h1>Last 3 Results</h1>

    @forelse ($histories as $history)
        <div>
            <p>Number: {{ $history->number }}</p>
            <p>Result: {{ $history->is_win ? 'Win' : 'Lose' }}</p>
            <p>Amount: {{ $history->amount }}</p>
            <p>Date: {{ $history->created_at->format('Y-m-d H:i:s') }}</p>
            <hr>
        </div>
    @empty
        <p>No history yet.</p>
    @endforelse

    <a href="{{ url()->previous() }}">Back</a>
</body>
</html>
