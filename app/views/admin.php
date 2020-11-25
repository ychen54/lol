<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/lol/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'>
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
                <li class="active">Article List</li>
            </ol>
            <a href="/lol/admin/add_article" class="btn btn-primary btn-sm">Add Article</a>
            <hr>
            <div class="bs-example" data-example-id="striped-table">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Click</th>
                          <th>verify</th>
                          <th>createTime</th>
                          <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($articles as $k=>$v): ?>
                        <tr>
                          <th scope="row"><?php echo ++$k; ?></th>
                          <td><?php echo $v['title'];; ?></td>
                          <td><?php echo $v['cate_name']; ?></td>
                          <td><?php echo $v['click']; ?></td>
                          <td id="verify<?php echo $v['article_no']; ?>"><?php if($v['verify'] == 0){echo "reviewing";}else{echo "confirmed";} ?></td>
                          <td><?php echo $v['create_time']; ?></td>
                          <td>
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-warning btn-sm">Delete</button>
                            <?php if($_SESSION['type'] == 'admin'): ?>
                                <button data-id="<?php echo $v['article_no']; ?>" class="btn btn-success btn-sm confirm">confirm</button>
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
                    url: "/lol/super/confirm",
                    async: false,
                    data: { "id": id},
                    success: function(data) {
                        var a = $.parseJSON(data);
                        if (a.code == 1) {
                            show_msg("success", a.msg);
                            disMsgDelay(3000);
                            $("#verify"+id).text("confirmed");
                        }else{
                            show_msg("error", a.msg);
                            disMsgDelay(3000);
                        }
                    }
                });
            });
        })

    </script>

</html>



