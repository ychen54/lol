<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/lol/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'>
    <script type='text/javascript' src='/lol/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/lol/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <title> <?php echo $title ?> </title>
</head>

<body>
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
                <a class='navbar-brand' href='/lol/'>Game Information Platform</a>
            </div>
            <div class='collapse navbar-collapse pull-right' id='bs-example-navbar-collapse-1'>
                <ul class='nav navbar-nav'>
                    <li>{{ var_dump(SESSION) }} </li>
                    <li ><a href='/lol/index/login'>Login</a></li>
                    <li><a href='/lol/index/Register'>Register</a></li>
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
    <content>
        {% block content %}
        {% endblock %}
    </content>
    <p align='center' style='margin-bottom: 20px;color:#878B91;'>Copyright &copy;2020 </p>
</body>

</html>
