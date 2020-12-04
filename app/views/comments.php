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
                <li class="active">Comment List</li>
            </ol>
            <hr>
            <div class="bs-example" data-example-id="striped-table">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Article Title</th>
                          <th>Comment Content</th>
                          <th>verify</th>
                          <th>Create Time</th>
                          <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($comments as $k=>$v): ?>
                        <tr>
                          <th scope="row"><?php echo ++$k; ?></th>
                          <td><?php echo $v['title'];; ?></td>
                          <td><?php echo $v['content']; ?></td>
                          <td id="verify<?php echo $v['comment_no']; ?>"><?php if($v['verify'] == 0){echo "reviewing";}else{echo "confirmed";} ?></td>
                          <td><?php echo $v['create_time']; ?></td>
                          <td>
                            <a href="/lol/admin/deleteComment/id/<?php echo $v['comment_no']; ?>" class="btn btn-warning btn-sm">Delete</a>
                            <?php if($_SESSION['type'] == 'admin' && $v['verify'] == 0 ): ?>
                                <button data-id="<?php echo $v['comment_no']; ?>" id="confirm<?php echo $v['comment_no']; ?>" 
                                    class="btn btn-success btn-sm confirm">confirm</button>
                            <?php endif; ?>
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
            $(".confirm").click(function(){
                var id = $(this).data("id");

                $.ajax({
                    type: "post",
                    url: "/lol/admin/confirmComment",
                    data: { "id": id},
                    success: function(data) {
                        var a = $.parseJSON(data);
                        if (a.code == 1) {
                            show_msg("success", a.msg);
                            disMsgDelay(3000);
                            $("#verify"+id).text("confirmed");
                            $("#confirm"+id).hide();
                        }else{
                            show_msg("error", a.msg);
                            disMsgDelay(3000);
                        }
                    }
                });
            });
            $("#commentnav").addClass("active");
        })

    </script>

</html>



