<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/lol/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css' />
    <link rel='stylesheet' href='/lol/public/css/common.css' type='text/css'>
    <script type='text/javascript' src='/lol/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/lol/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <script type='text/javascript' src='/lol/public/js/common.js'></script>
    <title><?php echo $title; ?></title>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="contaniner" style="min-height: 600px;">
        <?php include 'list.php'; ?>
        <div class="container pull-left" style="width: 1000px; height: auto;">
            <ol class="breadcrumb">
                <li><a href="/lol/admin/index">Home</a></li>
                <li class="active">Users List</li>
            </ol>
            <button id="create_user_btn" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create_user_modal">Create User</button>
            <hr>
            <div class="bs-example" data-example-id="striped-table">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Nick Name</th>
                          <th>Email</th>
                          <th>Create Time</th>
                          <th>Type</th>
                          <th>Status</th>
                          <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $k=>$v): ?>
                        <tr>
                          <th scope="row"><?php echo ++$k; ?></th>
                          <td><?php echo $v['nick_name'];; ?></td>
                          <td><?php echo $v['email']; ?></td>
                          <td><?php echo $v['create_time']; ?></td>
                          <td><?php echo $v['type']; ?></td>
                          <td id="status<?php echo $v['uid']; ?>"><?php if($v['disabled'] == 0){echo "normal";}else{echo "deleted";} ?></td>
                          <td>
                            <?php if($v['disabled'] == 0): ?>
                                <button data-id="<?php echo $v['uid']; ?>" id="delete<?php echo $v['uid']; ?>" class="btn btn-warning btn-sm delete">disable</button>
                            <?php endif;?>
                            <?php if($v['disabled'] == 1): ?>
                                <button data-id="<?php echo $v['uid']; ?>" id="enable<?php echo $v['uid']; ?>" class="btn btn-info btn-sm enable">enable</button>
                            <?php endif;?>
                            <button data-id="<?php echo $v['uid']; ?>" class="btn btn-success btn-sm edit">edit</button>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>  
    <div class="modal fade bs-example-modal-lg" id="create_user_modal" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Create User</h4>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" class="form-horizontal" style="margin-top: 40px;">
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
                    <div class="col-sm-offset-3 col-sm-2">
                        <button type="button" id="sub" class="btn btn-success" style="height: 30px;">Add</button>
                    </div>
                    <div class="col-sm-offset-4 col-sm-2">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" style="height: 30px;">Close</button>
                    </div>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" id="edit_user_modal" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Edit User</h4>
                </div>
                <div class="modal-body">
            <form action="#" id="editForm" method="POST" class="form-horizontal" style="margin-top: 40px;">
                <input type="hidden" name="uid" id="uid">
                <div class="form-group">
                    <label for="edit_nickname" class="col-sm-3 control-label"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>Nick name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nickname" id="edit_nickname" placeholder="Nick name"><span id="edit-nickname" style="color:red;display:none;">Nick name can't be empty or invalid</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_email" class="col-sm-3 control-label"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" id="edit_email" placeholder="Your Email"><span id="edit-email" style="color:red;display:none;">Email can't be empty or invalid</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_psd" class="col-sm-3 control-label"><i class="glyphicon glyphicon-lock"></i>Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" id="edit_psd" placeholder="Password"><span id="edit-password" style="color:red;display:none;">password can't be empty or less than six char</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_confirm" class="col-sm-3 control-label">User Type</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="type" id="user_type">
                            <option value="login">Nomal</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-2">
                        <button type="button" id="edit_user_sub" class="btn btn-success" style="height: 30px;">Edit</button>
                    </div>
                    <div class="col-sm-offset-4 col-sm-2">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" style="height: 30px;">Close</button>
                    </div>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php';include 'message.php'; ?>
</body>

    <script type="text/javascript">
        $(function(){
            $(".delete").click(function(){
                var id = $(this).data("id");
                $.ajax({
                    type: "post",
                    url: "/lol/super/deleteUser",
                    data: { "id": id, "data":1},
                    success: function(data) {
                        var a = $.parseJSON(data);
                        if (a.code == 1) {
                            show_msg("success", a.msg);
                            disMsgDelay(3000);
                            $("#status"+id).text("deleted");
                            $("#delete"+id).hide(1000);
                        }else{
                            show_msg("error", a.msg);
                            disMsgDelay(3000);
                        }
                    }
                });
            });
            $(".enable").click(function(){
                var id = $(this).data("id");
                $.ajax({
                    type: "post",
                    url: "/lol/super/deleteUser",
                    data: { "id": id, "data":0},
                    success: function(data) {
                        var a = $.parseJSON(data);
                        if (a.code == 1) {
                            show_msg("success", a.msg);
                            disMsgDelay(3000);
                            $("#status"+id).text("normal");
                            $("#enable"+id).hide(1000);
                        }else{
                            show_msg("error", a.msg);
                            disMsgDelay(3000);
                        }
                    }
                });
            });
            $("#sub").click(function() {
                var nickname = $("#nickname").val();
                var confirm = $("#confirm").val();
                var email = $("#email").val();
                var psd = $("#psd").val();
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
                $.ajax({
                    type: "post",
                    url: "/lol/super/addUser",
                    async: false,
                    data: { "nickname": nickname, "email": email, "password": psd},
                    success: function(data) {
                        console.log(data);
                        var a = $.parseJSON(data);
                        console.log(a);
                        if (a.code == 1) {
                            show_msg("success", a.msg);
                            window.location.href = '/lol/super/users';
                        }else{
                            show_msg("error", a.msg);
                            disMsgDelay(3000);
                        }
                    }
                 });
            });

            $(".edit").click(function(){
                var id = $(this).data("id");
                
                $.ajax({
                    type: "post",
                    url: "/lol/super/edit",
                    data: { "id": id},
                    success: function(data) {
                        var a = $.parseJSON(data);
                        if (a.code == 1) {
                            $("#uid").val(a.user.uid);
                            $("#edit_nickname").val(a.user.nick_name);
                            $("#edit_email").val(a.user.email);
                            $("#edit_passowrd").val("");
                            $("#user_type").val(a.user.type);
                            $('#edit_user_modal').modal('show');
                            console.log(a.user);
                            console.log(a.user.uid);
                        }else{
                            show_msg("error", a.msg);
                            disMsgDelay(3000);
                        }
                    }
                });
            });

            $("#edit_user_sub").click(function() {
                var nickname = $("#edit_nickname").val();
                var email = $("#edit_email").val();
                var psd = $("#edit_psd").val();
                if (nickname == null || nickname == undefined || nickname == "" ) {
                    $("#edit-nickname").css("display", "block");
                    return;
                } else {
                    $("#edit-nickname").css("display", "none");
                }
                var reg = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
                if (email == null || email == undefined || email == "" || !reg.test(email)) {
                    $("#edit-email").css("display", "block");
                    return;
                } else {
                    $("#edit-email").css("display", "none");
                }
                if (psd == null || psd == undefined || psd == "" || psd.length < 6) {
                    $("#edit-password").css("display", "block");
                    return;
                } else {
                    $("#edit-password").css("display", "none");
                }
                $.ajax({
                    type: "post",
                    url: "/lol/super/editUser",
                    async: false,
                    data: { "uid": $("#uid").val(), "nickname": nickname, "email": email, "password": psd, "type": $("#user_type").val()},
                    success: function(data) {
                        console.log(data);
                        var a = $.parseJSON(data);
                        console.log(a);
                        if (a.code == 1) {
                            show_msg("success", a.msg);
                            window.location.href = '/lol/super/users';
                        }else{
                            show_msg("error", a.msg);
                            disMsgDelay(3000);
                        }
                    }
                 });
            });

            $("#usernav").addClass("active");
        })

    </script>

</html>



