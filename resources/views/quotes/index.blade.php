<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container {
            max-width: 800px;
            width: 100%;
        }
        h1 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
            color: #111827;
        }
        ol {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        li {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            font-size: 1.125rem;
            line-height: 1.6;
            color: #374151;
        }
        li:last-child {
            border-bottom: none;
        }
        li:before {
            content: "• ";
            color: #4f46e5;
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
        .quote-author {
            font-weight: 600;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quotes</h1>
        <ol>
            @foreach($quotes as $quote)
                <li>
                    {{$quote['quote']}} - <span class="quote-author">{{$quote['author']}}</span>
                </li>
            @endforeach
        </ol>
    </div>
</body>
</html>