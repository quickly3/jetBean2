<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8">
  <title>CoG | Tell your world</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <script src="/js/jquery.js"></script>
  <link rel='icon' href='/favicon.ico' type='image/ico' />

  <!--[if lt IE 9]>
  <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <script src="/js/ie.js"></script>
  <![endif]-->

  <!-- Le styles -->

  <link href="/css/reset.css" rel="stylesheet">
  <link href="/css/grid.css" rel="stylesheet">
  <link href="/css/nivo.css" rel="stylesheet">
  <link href="/css/custom.css" rel="stylesheet">


  @section("_css")
  @show
</head>

<body>

<div id="page_wrap">

  @include("layouts.header")<!-- Left Side ENDS -->

  @include("layouts.subLevel")<!-- Sub Level ENDS -->
  <div class="rightSide">
    @section('rightSide')
      This is the master sidebar.
    @show

    @include("layouts.footer")
  </div>
  <!-- RightSide ENDS -->

</div><!-- Page Wrap ENDS -->

<div id="toTop"></div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/isotope.js"></script>

<script src="/js/caroufredsel.js"></script>
<script src="/js/nivo.js"></script>
<script src="/js/jquery.mousewheel.js"></script>
<script src="/js/tinyscrollbar.js"></script>
<script src="/js/custom.js"></script>
@section("_js")
@show
<!--[if lte IE 9]>
<script src="/js/respond.min.js"></script>
<![endif]-->
</body>
</html>