<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/lol/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'>
    <script type='text/javascript' src='/lol/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/lol/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <script type='text/javascript' src='/lol/public/js/common.js'></script>
    <title>
        <?php echo $title ?>
    </title>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="main" style="min-height: 600px;">
        <div class="container-fluid" style="height: 400px; width: 500px;">
            <h2 class="text-center">Register Page</h2>
            <form action="/lol/index/add" id="loginForm" method="POST" class="form-horizontal" style="margin-top: 40px;">
                <div class="form-group">
                    <label for="nickname" class="col-sm-3 control-label"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>Nick name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nickname" id="nickname" placeholder="Nick name"><span id="warn-nickname" style="color:red;display:none;">Nick name can't be empty or invalid</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"><span id="warn-email" style="color:red;display:none;">Email can't be empty or invalid</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="psd" class="col-sm-3 control-label"><i class="glyphicon glyphicon-lock"></i>Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" id="psd" placeholder="Password"><span id="warn-password" style="color:red;display:none;">password can't be empty</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm" class="col-sm-3 control-label"><i class="glyphicon glyphicon-lock"></i>Confirm</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm Password"><span id="warn-confirm" style="color:red;display:none;">confirm password can't be empty or different password</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="captcha" class="col-sm-3 control-label"><i class="glyphicon glyphicon-barcode"></i>Captcha</label>
                    <div class="col-sm-4">
                            <input type="text" class="form-control" name="captcha" id="captcha" placeholder="captcha">
                            <span id="warn-captcha" style="color:red;display:none;">captcha can't be empty</span>
                    </div>
                    <div class="col-sm-4">
                        <div class="media-left">
                            <img id="cap" src="/lol/index/captcha" />
                        </div>
                        <div class="media-body">
                            <button type="button" class="btn btn-info btn-sm" id="change_captcha">change</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-2">
                        <button type="button" id="sub" class="btn btn-success" style="height: 30px;">Register</button>
                    </div>
                    <div class="col-sm-offset-4 col-sm-2">
                        <a type="button" id="back" href="/lol/index/login" class="btn btn-primary" style="height: 30px;">Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php';include 'message.php'; ?>
</body>

</html>
<script type="text/javascript">
$(function() {
    $("#change_captcha").click(function() {
        var rand = parseInt(new Date().getTime()) + Math.random();
        console.log("rand:/lol/index/captcha/id/" + rand);
        $('#cap').attr('src', '/lol/index/captcha/id/' + rand);
    });
    $("#sub").click(function() {
        var nickname = $("#nickname").val();
        var confirm = $("#confirm").val();
        var email = $("#email").val();
        var psd = $("#psd").val();
        var captcha = $("#captcha").val();

        if (nickname == null || nickname == undefined || nickname == "" ) {
            $("#warn-nickname").css("display", "block");
            return;
        } else {
            $("#warn-nickname").css("display", "none");
        }
        var reg = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
        if (email == null || email == undefined || email == "" || !reg.test(email)) {
            $("#warn-email").css("display", "block");
            return;
        } else {
            $("#warn-email").css("display", "none");
        }
        if (psd == null || psd == undefined || psd == "") {
            $("#warn-password").css("display", "block");
            return;
        } else {
            $("#warn-password").css("display", "none");
        }
        if (confirm == null || confirm == undefined || confirm == "" || confirm != psd) {
            $("#warn-confirm").css("display", "block");
            return;
        } else {
            $("#warn-confirm").css("display", "none");
        }
        if (captcha == null || captcha == undefined || captcha == "") {
            $("#warn-captcha").css("display", "block");
            return;
        } else {
            $("#warn-captcha").css("display", "none");
        }
        $.ajax({
            type: "post",
            url: "/lol/index/add",
            async: false,
            data: { "nickname": nickname, "email": email, "password": psd, "captcha": captcha },
            success: function(data) {
                console.log(data);
                var a = $.parseJSON(data);
                console.log(a);
                if (a.code == 1) {
                    show_msg("success", "register successfully");
                    window.location.href = '/lol/index/login';
                }else{
                    var rand = parseInt(new Date().getTime()) + Math.random();
                    $('#cap').attr('src', '/lol/index/captcha/id/' + rand);
                    show_msg("error", a.msg);
                    disMsgDelay(3000);
                }
            }
        });
        //$("#loginForm").submit();
    });
})
</script>