<!DOCTYPE html>
<html>
<head>
    <title>New Order</title>
</head>
<body>
    <h1>Thank you for your order!</h1>
    <p>Your order ID is: #{{ $transaction->id }}</p>
    <p>Total Amount: ${{ $transaction->total_amount }}</p>
    
    <h3>Order Details:</h3>
    <ul>
        @foreach($transaction->details as $detail)
            <li>{{ $detail->product->name }} (x{{ $detail->quantity }}) - ${{ $detail->price }}</li>
        @endforeach
    </ul>
    
    <p>We will process your order shortly.</p>
</body>
</html>
