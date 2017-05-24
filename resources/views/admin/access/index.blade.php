<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/png">

    <title>Login</title>

    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->
    <style>
        .loginfo{
            text-align: center;
        }
        .succ{
            color:#5cb85c;
        }
        .failed{
            color:#d9534f;
        }
    </style>
</head>

<body class="login-body">

<div class="container">

    <form class="form-signin" >
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">Sign In</h1>
            <img src="/images/login-logo.png" alt=""/>
        </div>
        <div class="login-wrap">
            <input type="text" name="user" class="form-control" placeholder="User ID" autofocus>
            <input type="password" name="pwd" class="form-control" placeholder="Password">

            <span class="btn btn-lg btn-login btn-block" id="signin_submit">
                <i class="fa fa-check"></i>
            </span>
            <div class="loginfo">
                <span>神奇世界的背后</span>
            </div>
            {{--<div class="registration">--}}
                {{--Not a member yet?--}}
                {{--<a class="" href="registration.html">--}}
                    {{--Signup--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<label class="checkbox">--}}
                {{--<input type="checkbox" value="remember-me"> Remember me--}}
                {{--<span class="pull-right">--}}
                    {{--<a data-toggle="modal" href="#myModal"> Forgot Password?</a>--}}

                {{--</span>--}}
            {{--</label>--}}

        </div>

        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Forgot Password ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Enter your e-mail address below to reset your password.</p>
                        <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                        <button class="btn btn-primary" type="button">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

    </form>

</div>



<!-- Placed js at the end of the document so the pages load faster -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="/js/jquery-1.10.2.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/modernizr.min.js"></script>
<script>
    $(function(){
        var $msg = $(".loginfo>span");
        var request = 0;

        var logMsg = function(info,type){
            info = info?info:"";
            type = type?type:"failed";

            $msg.removeAttr("class");
            $msg.addClass(type);
            $msg.text(info);

        }

        var signin = function(){



            if(request){
                logMsg("不要请求那么快啦，服务器还没反应过来");
                return false;
            }

            var name = $.trim($("input[name=user]").val()),
                pwd  = $.trim($("input[name=pwd]").val()),
                handleUrl = "/Admin/Access/signin";

            if(name.length < 6 || pwd.length < 6){
                logMsg("额 ID和密码好像有点短");
                return false;
            }

            var data = {
                name:name,
                pwd:pwd,
                "_token":$('meta[name="_token"]').attr('content')
            };

            request = 1;
            $.post(handleUrl,data,function(res){
                if(res && res.sta > 0 ){
                    logMsg(res.msg,"succ");
                    window.location.href = "/Admin/Index/index";
                }else{
                    if(!res){
                        logMsg("系统君不想理你，并向你丢了个蕾姆。");
                    }else{
                        logMsg(res.msg);
                    }

                }
                request = 0;
            });
        }

        $("#signin_submit").click(function(){
            signin();
        });
    });
</script>
</body>
</html>
