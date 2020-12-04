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
    <div class="container" style="min-height: 600px;">
    	<!-- 加载进度条 -->
		<div class="loading">
			<div class="pic">
				<i></i>
				<i></i>
				<i></i>
				<i></i>
				<i></i>
			</div>
		</div>
		<div class="container">
			<ol class="breadcrumb">
				<span class="pull-right">Current Router</span>
                <li><a href='/lol/index/index'>Home</a></li>
        		<li class='active'>Search Result</li>
                <input type="hidden" id="search_cate" value="<?php echo $search_cate; ?>">
                <input type="hidden" id="search_keyword" value="<?php echo $keyword; ?>">
            </ol>
            <?php foreach($articles as $k=>$v): ?>
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title"><a href="/lol/index/detail/<?php echo $v['article_no'].'/'.$v['prelink']; ?>"><?php echo $v['title']; ?></a>
			    	<span class="badge pull-right">Last Edit:<?php echo $v['last_update_time']; ?></span></h3>
			  </div>
			  <div class="panel-body">
			    Category:<?php echo $v['cate_name']; ?><span class="badge pull-right"><?php echo $v['click']; ?></span>
			  </div>
			</div>
			<?php endforeach; ?>

            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li>
                  <a href="#" aria-label="Previous" id="first">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li><a href="#" id="pre">Pre</a></li>
                <?php
                    $i=$pageNum-3;
                    while($i<$pageNum)
                    {
                        if($i>0){
                            echo "<li><a href='#' class='pageClick' data-num='".$i."'>".$i."</a></li>";
                        }
                        $i++;
                    }
                ?>
                <li class="active"><span id="currentPage" data-num="<?php echo $pageNum;?>"><?php echo $pageNum;?><span class="sr-only">(current)</span></span></li>
                <?php
                    $j=$pageNum+1;
                    while($j<=$total && ($pageNum-$j)<4)
                    {
                        echo "<li><a href='#' class='pageClick' data-num='".$j."'>".$j."</a></li>";
                        $j++;
                    }
                ?>
                <li><a href="#" id="next">Next</a></li>
                <li>
                  <a href="#" aria-label="Next" id="last" data-num="<?php echo $total;?>">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
		</div>



    </div>

    <?php include 'footer.php';include 'message.php'; ?>
</body>
<script type="text/javascript">
    $(function(){
        $("#pageNum").val(1);
        $("#keyword").val($("#search_keyword").val());
        $("#cate_id").val($("#search_cate").val());

        $("#first").click(function(){
            $("#pageNum").val(1);
            $("#searhForm").submit();
        });
        $("#last").click(function(){
            $("#pageNum").val($("#last").data("num"));
            $("#searhForm").submit();
        });
        $("#pre").click(function(){
            $("#pageNum").val($("#currentPage").data("num") -1);
            $("#searhForm").submit();
        });
        $("#next").click(function(){
            $("#pageNum").val($("#currentPage").data("num") +1);
            $("#searhForm").submit();
        });
        $(".pageClick").click(function(){
            $("#pageNum").val($(this).data("num"));
            $("#searhForm").submit();
        });
    })

</script>

</html>



