<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>404 Page Not Found</title>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
</head>
<body>
    <div class="container pt-5">
		<div class="image text-center">
			<img src="{{ asset('images/404.png') }}" alt="404 page not found">
		</div>
		<div class="text-center">Trang bạn truy cập đã bị xóa hoặc không tồn tại.</div>
		<p class="text-center">Vui lòng nhấp vào <a href="/" title="Trang chủ"><i class="fas fa-home"></i></a> để trở về trang chủ</p>
	</div>
</body>
</html>
