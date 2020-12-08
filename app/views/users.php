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
            <a href="#" id="create_user_btn" class="btn btn-primary btn-sm">Create User</a>
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
                            <button data-id="<?php echo $v['uid']; ?>" id="edit" class="btn btn-success btn-sm">edit</button>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
            $("#usernav").addClass("active");
        })

    </script>

</html>



