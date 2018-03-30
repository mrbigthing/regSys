<!DOCTYPE html>  
<html lang="zh-CN">  
<head>  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ URL('../images/favicon.ico') }}" type="image/x-icon"> 
  <link rel="shortcut icon" href="{{ URL('../images/favicon.ico') }}" type="image/x-icon">
  <title>活动报名系统</title>

  <link href="{{ URL('../css/font.css') }}" rel="stylesheet">
  <link href="{{ URL('../css/app.css') }}" rel="stylesheet">
  <link href="{{ URL('../css/jquery-ui.min.css') }}" rel="stylesheet">
  <script src="{{ URL('../js/jquery-1.11.2.min.js') }}"></script>
  <script src="{{ URL('../js/bootstrap.min.js') }}"></script>
  <link href="{{ URL('../css/semantic.min.css') }}" rel="stylesheet">

  <!-- Fonts -->
  <link href='http://fonts.useso.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="{{ URL('../js/html5shiv.min.js') }} "></script>
    <script src="{{ URL('../js/respond.min.js') }}"></script>
  <![endif]-->
</head>  
<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <span class="navbar-brand" href="#">活动报名</span>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/') }}">主页</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          @if (Auth::guest())
            <li><a href="{{ url('/auth/login') }}">登录</a></li>
            <li><a href="{{ url('/auth/register') }}">注册</a></li>
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                @if (Auth::user()->is_admin < 2)
                <li><a href="{{ url('/profile') }}">个人</a></li>
                @else
                <li><a href="{{ url('/admin') }}">管理用户</a></li>
                @endif
                <li><a href="{{ url('/auth/logout') }}">注销</a></li>
              </ul>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <div class="container" style="margin-top: 20px;">
    @yield('content')
    <div id="footer" style="text-align: center; border-top: dashed 3px #eeeeee; margin: 50px 0; padding: 20px;">
      ©2015 newhope
    </div>
  </div>
</body>  
</html>  