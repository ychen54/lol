<?php
	$dbms='mysql';     // database type
	$host='localhost'; //host name
	$dbName='lol';    // db name
	$user='root';      //db username
	$pass='';          //db password
	$dsn="$dbms:host=$host;dbname=$dbName";
	try {
	    $dbh = new PDO($dsn, $user, $pass); //create a PDO object
	    $sql = 'SELECT * from categories WHERE parent_id IS NULL';
	    $res = $dbh->query($sql);
	    $cate = array();
	} catch (PDOException $e) {
	    die ("Error!: " . $e->getMessage() . "<br/>");
	}

 ?>

<nav class='navbar navbar-default'>
        <div class='container-fluid'>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class='navbar-header'>
                <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' href='/lol/'>Information Platform</a>
            </div>
            <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
            	<ul class='nav navbar-nav'>
					<?php foreach($dbh->query($sql) as $row): ?>
						<li class="dropdown">
					    	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $row['cate_name'];?> <span class="caret"></span></a>
					        <ul class="dropdown-menu">
					         	<?php $sql1 = 'SELECT * from categories WHERE parent_id='.$row['cate_id'];foreach($dbh->query($sql1) as $row): ?>
					          		<li><a href="/lol/index/category/id/<?php echo $row['cate_id'];?>"><?php $cate[$row['cate_id']]=$row['cate_name'];echo $row['cate_name'];?></a></li>
					          	<?php endforeach; ?>
					        </ul>
					    </li>
					<?php endforeach; ?>
				</ul>
            	
            	<form class="navbar-form navbar-left" action="#" method="POST">
            		<select class="form-control" name="cate_id">
            			<option value="">All category</option>
            			<?php foreach($cate as $k=>$row): ?>
            				<option value="<?php echo$k; ?>"><?php echo $row; ?></option>
            			<?php endforeach; ?>
					</select>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search Keyword">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <ul class='nav navbar-nav navbar-right'>
                    <?php if(!isset($_SESSION['uid'])): ?>
                        <li ><a href='/lol/index/login'>Login</a></li>
                        <li><a type="button" style="color:#3c78d8;" href='/lol/index/register'>Register</a></li>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['uid'])): ?>
                    	<li><a type="button" style="color:#3c78d8;" href='/lol/admin/index'><?php echo $_SESSION['nickname']; ?></a></li>
                        <li ><a href='/lol/index/logout'>Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
                <ul class='nav navbar-nav'>
                    <li class='$active1'><a href='./event.php'>Events</a></li>
                    <li class='$active2'><a href='./registration.php'>Registrations</a></li>
                    <li class='$active3'><a href='./admin.php'>Admin</a></li>
                    <li><a href='./logout.php'>Logout</a></li>
                </ul>
            </div> --><!-- /.navbar-collapse -->

        </div><!-- /.container-fluid -->
    </nav>




