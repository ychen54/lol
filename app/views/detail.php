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
    <title>Detail</title>
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
				<li><a href="/lol/index/index">Home</a></li>
                <li class="active">Article Detail</li>
            </ol>
           	<hr>
           	<?php ?>
           	<div class="text-center">
           		<h1> <?php echo $article[0]['title'] ?></h1>
           	</div>
           	<h5>Category:<code><?php echo $article[0]['cate_name']; ?></code> 
           		<span class="pull-right">Click:<?php echo $article[0]['click']; ?></span></h5>
           	<hr>
           	<?php echo $article[0]['content']; ?>
           	<?php if($article[0]['image_path'] != ''): ?>
           		<img src="/lol/public/img/<?php echo $article[0]['image_path']; ?>">
           	<?php endif; ?>
           	<hr>
           	<h5>Author:<mark><?php echo $article[0]['nick_name']; ?></mark>
           		<span class="pull-right">Last Edit Time:<mark><?php echo $article[0]['last_update_time']; ?></mark></span>
           	</h5>
		</div>



    </div>

    <?php include 'footer.php';include 'message.php'; ?>
</body>

</html>


