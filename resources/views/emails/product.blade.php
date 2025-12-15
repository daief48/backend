<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product {{ ucfirst($action) }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f8;
            padding: 20px;
        }
        .card {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid #e5e7eb;
        }
        .header {
            font-size: 20px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 10px;
        }
        .text {
            font-size: 14px;
            color: #374151;
            margin-bottom: 8px;
        }
        .label {
            font-weight: bold;
            color: #1f2937;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
        .price {
            font-weight: bold;
            color: #16a34a;
        }
        img {
            max-width: 100%;
            border-radius: 6px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="header">
        Product {{ ucfirst($action) }} Notification
    </div>

    <p class="text">
        A product has been <strong>{{ $action }}</strong> in the system.
    </p>

    <p class="text">
        <span class="label">Name:</span> {{ $product->name }}
    </p>

    <p class="text">
        <span class="label">Category:</span>
        {{ $product->category->name ?? 'N/A' }}
    </p>

    <p class="text">
        <span class="label">Price:</span>
        <span class="price">{{ number_format($product->price, 2) }}</span>
    </p>

    @if($product->description)
        <p class="text">
            <span class="label">Description:</span><br>
            {{ $product->description }}
        </p>
    @endif

    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
    @endif

    <div class="footer">
        This is an automated notification from the Product Inventory System.
    </div>
</div>

</body>
</html>
