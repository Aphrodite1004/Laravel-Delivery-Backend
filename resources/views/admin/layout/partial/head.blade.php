<meta charset="utf-8" />
<title>TecManic | @yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="@yield('metaDescription')" />
<meta name="author" content="@yield('metaAuthor')" />
<meta name="keywords" content="@yield('metaKeywords')" />

@stack('metaTag')

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="/assets/css/app.min.css" rel="stylesheet" />
<!-- ================== END BASE CSS STYLE ================== -->

@stack('css')
