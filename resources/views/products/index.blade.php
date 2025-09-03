<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
            justify-content: center;
            align-items: flex-start;
        }
        .container {
            width: 100%;
            max-width: 960px;
        }
        h1 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
            color: #111827;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .product-table th,
        .product-table td {
            padding: 1rem;
            text-align: left;
        }
        .product-table th {
            background-color: #f9fafb;
            color: #4b5563;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
        }
        .product-table td {
            border-top: 1px solid #e5e7eb;
        }
        .product-table tbody tr:last-child td {
            border-bottom: none;
        }
        .product-table tbody tr:hover {
            background-color: #f3f4f6;
            transition: background-color 0.2s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Products</h1>
        <table class="product-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>