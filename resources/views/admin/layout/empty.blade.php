<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"{{ (!empty($htmlAttribute)) ? $htmlAttribute : '' }}>
<head>
	@include('admin.layout.partial.head')
</head>
<body class="{{ (!empty($bodyClass)) ? $bodyClass : '' }}">
	@yield('content')

	@include('admin.layout.partial.scroll-top-btn')

	@include('admin.layout.partial.scripts')

</body>
</html>
