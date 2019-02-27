<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
</head>
<body>
	<div style="width:100%;height:200px;background-color:green">header</div>
	@section("main")
	@show
	<div style="width:100%;height:200px;background-color:red">footer</div>

</body>
</html>