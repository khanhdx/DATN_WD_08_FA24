<html>
<head>
    <title>Liên hệ từ website</title>
</head>
<body>
    <p style="font-size: 30px"><strong>Chủ đề:</strong> {{ $contact['subject'] }}</p>
    <p><strong>Tên:</strong> {{ $contact['name'] }}</p>
    <p><strong>Số điện thoại:</strong> {{ $contact['phone'] }}</p>
    <p><strong>Email:</strong> {{ $contact['email'] }}</p>
    <p><strong>Tin nhắn:</strong></p>
    <p>{{ $contact['message'] }}</p>
    @if($images)
        <img src="{{ asset('storage/' . $images) }}" alt="Uploaded Image">
    @endif
</body>
</html>
