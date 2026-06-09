<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #28a745;">
            Order Confirmation
        </h2>
        <p>Dear {{ $order->name }},</p>
        <p>
            Thank you for shopping with us. We are pleased to confirm that your order has been received and is being processed.
        </p>
        <div style="background:#f8f9fa;padding:15px;border-radius:5px;margin:20px 0;">
            <h3>Order Details</h3>
            <p><strong>Order ID:</strong> #{{ $order->id }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
            <p><strong>Total Amount:</strong> ₹{{ number_format($order->total, 2) }}</p>
            <p><strong>Payment Method:</strong> {{ $order->payment_method }}:cash on delivery</p>
            <p><strong>Order Status:</strong> {{ ucfirst($order->status) }}</p>
        </div>
        <p>
            We will notify you once your order has been shipped.
        </p>
        <p>
            If you have any questions regarding your order, please contact our support team.
        </p>
        <br>
        <p>
            Regards,<br>
            <strong>{{ config('app.name') }}</strong>
        </p>
        <hr>
        <p style="font-size:12px;color:#777;">
            This is an automated email. Please do not reply directly to this message.
        </p>
    </div>
</body>
</html>