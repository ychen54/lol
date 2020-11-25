<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/lol/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'>
    <link rel='stylesheet' href='/lol/public/css/common.css' type='text/css'>
    <script type='text/javascript' src='/lol/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/lol/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type='text/javascript' src='/lol/public/js/common.js'></script>
    <title>
        <?php echo $title; ?>
    </title>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="contaniner" style="min-height: 600px;">
        <?php include 'list.php'; ?>
        <div class="container pull-left" style="width: 800px; height: auto;">
            <ol class="breadcrumb">
                <li><a href="/lol/admin/index">Home</a></li>
                <li class=""><a href="/lol/admin/index">Article List</a></li>
                <li class="active">New Article</li>
            </ol>
            <form class="form-horizontal" style="margin-left: -120px;" action="/lol/admin/addArticle" method="POST" id="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">Category</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="parent">
                          <?php foreach($parentCate as $k=>$v): ?>
                            <option value="<?php echo $v['cate_id']; ?>"><?php echo $v['cate_name']; ?></option>
                          <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control" name="cate" id="child">
                          <?php foreach($childCate as $k=>$v): ?>
                            <option value="<?php echo $v['cate_id']; ?>"><?php echo $v['cate_name']; ?></option>
                          <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" id="title" placeholder="title">
                        <span id="warn-title" style="color:red;display:none;">title can't be empty</span>
                    </div>
                </div>
                <div class=" form-group">
                    <label for="content" class="col-sm-3 control-label">Content</label>
                    <div class="col-sm-9">
                      <textarea rows="20" cols="80" id="content" name="content">
                                
                      </textarea>
                      <span id="warn-content" style="color:red;display:none;">Content can't be empty</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="prelink" class="col-sm-3 control-label">Permalink</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="prelink" id="prelink" placeholder="prelink">
                        <span id="warn-prelink" style="color:red;display:none;">Permalink can't be empty</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="img" class="col-sm-3 control-label">Image(optional)</label>
                    <input type="file" checked="col-sm-8" accept="image/*" id="img" name="img">
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-8">
                    <button type="button" id="sub" class="btn btn-success" style="height: 30px;">Create</button>
                  </div>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php';include 'message.php'; ?>
</body>
<script type="text/javascript">
    
  $(function(){
      tinymce.init({
        selector: 'textarea'
      });
      $("#sub").click(function() {
        $("#form").submit();
        var title = $("#title").val();
        var prelink = $("#prelink").val();
        if (title == null || title == undefined || title == "" ) {
            $("#warn-title").css("display", "block");
            return;
        } else {
            $("#warn-title").css("display", "none");
        }
        if (prelink == null || prelink == undefined || prelink == "") {
            $("#warn-prelink").css("display", "block");
            return;
        } else {
            $("#warn-prelink").css("display", "none");
        }
        
    });

      $("#parent").change(function(){
        $.ajax({
            type: "post",
            url: "/lol/admin/getCategoryByParentId",
            async: false,
            data: { "id": $("#parent").val()},
            success: function(data) {
                var a = $.parseJSON(data);
                var cates = a.data;
                if (a.code == 1) {
                    var childhtml = "";
                    for(var cate in cates){
                        childhtml +="<option value="+cates[cate]['cate_id']+">"+cates[cate]['cate_name']+"</option>"
                    }
                    $("#child").html(childhtml);
                }
            }
        });
      });

  });

</script>
</html>