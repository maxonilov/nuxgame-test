<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>I'm Feeling Lucky</title>
</head>
<body>
    <h1>Result</h1>

    <p>Number: {{ $result->number }}</p>
    <p>Result: {{ $result->is_win ? 'Win' : 'Lose' }}</p>
    <p>Amount: {{ $result->amount }}</p>

    <a href="{{ url()->previous() }}">Back</a>
</body>
</html>
