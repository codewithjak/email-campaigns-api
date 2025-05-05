<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $subjectLine }}</title>
</head>
<body>
    <h2>{{ $subjectLine }}</h2>
    <p>{!! $body !!}</p>

    @if(isset($customerId))
        <p style="margin-top: 30px;">Customer ID: {{ $customerId }}</p>
    @endif
</body>
</html>
