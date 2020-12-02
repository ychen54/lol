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
                <?php if(isset($cate_id) && $cate_id != null){echo "<li><a href='/lol/index/index'>Home</a></li>
        		<li class='active'>Category</li>";}else{echo "<li  class='active'>Home</li>";} ?>
            </ol>
            <?php if(!isset($cate_id) || $cate_id == null): ?>
            	Order By
            	
            	<a href="/lol/index/index/order/title/sc/asc" class="btn btn-sm btn-primary"
      			<?php if(isset($order) && $order=='title' && isset($sc) && $sc=='asc'){echo "disabled='disabled'";} ?> >Title Asc</a>
      			<a href="/lol/index/index/order/title/sc/desc" class="btn btn-sm btn-primary"
      			<?php if(isset($order) && $order=='title' && isset($sc) && $sc=='desc'){echo "disabled='disabled'";} ?> >Title Desc</a>

            	<a href="/lol/index/index/order/create_time/sc/asc" class="btn btn-sm btn-success" <?php if(isset($order) && $order=='create_time' && isset($sc) && $sc=='asc'){echo "disabled='disabled'";} ?> >Create Time Asc</a>
            	<a href="/lol/index/index/order/create_time/sc/desc" class="btn btn-sm btn-success" <?php if(isset($order) && $order=='create_time' && isset($sc) && $sc=='desc'){echo "disabled='disabled'";} ?> >Create Time Desc</a>

            	<a href="/lol/index/index/order/last_update_time/sc/asc" class="btn btn-sm btn-info" <?php if(isset($order) && $order=='last_update_time' && isset($sc) && $sc=='asc'){echo "disabled='disabled'";} ?>>Last Edit Time Asc</a>
            	<a href="/lol/index/index/order/last_update_time/sc/desc" class="btn btn-sm btn-info" <?php if(isset($order) && $order=='last_update_time' && isset($sc) && $sc=='desc'){echo "disabled='disabled'";} ?>>Last Edit Time Desc</a>
            	<hr />
            <?php endif; ?>
            <?php foreach($articles as $k=>$v): ?>
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title"><a href="/lol/index/detail/id/<?php echo $v['article_no']; ?>"><?php echo $v['title']; ?></a>
			    	<span class="badge pull-right">Last Edit:<?php echo $v['last_update_time']; ?></span></h3>
			  </div>
			  <div class="panel-body">
			    Category:<?php echo $v['cate_name']; ?><span class="badge pull-right"><?php echo $v['click']; ?></span>
			  </div>
			</div>
			<?php endforeach; ?>

		</div>



    </div>

    <?php include 'footer.php';include 'message.php'; ?>
</body>

</html>



