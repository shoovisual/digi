<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Return Request</title>
    <style>
        body { font-family: Arial, sans-serif; color: #111; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <h2>New Order Return Request</h2>
    <p><span class="label">Email:</span> {{ $data['email'] ?? '—' }}</p>
    <p><span class="label">Phone:</span> {{ $data['phone'] ?? '—' }}</p>
    <p><span class="label">Category:</span> {{ $data['category_name'] ?? '—' }}</p>
    <p><span class="label">Product:</span> {{ $data['product_name'] ?? '—' }}</p>
    <p><span class="label">Order Number:</span> {{ $data['order_number'] ?? '—' }}</p>
    <p><span class="label">Return Reason:</span> {{ $data['reason_name'] ?? '—' }}</p>
    @if(!empty($data['details']))
    <p><span class="label">Details:</span><br>{{ nl2br(e($data['details'])) }}</p>
    @endif
    <hr>
    <p>Submitted from DIGI Appliances website.</p>
</body>
<script>/* no scripts in email */</script>
</html>