<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* layout.php */
class __TwigTemplate_c8f52ae83bed1aa363eb743824c5d0db4c8b506971325db6bd2f3b8a2b9de8d7 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<?php

<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/lol/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'>
    <script type='text/javascript' src='/lol/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/lol/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <title>";
        // line 12
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</title>
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
                    <li>";
        // line 30
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "session", [], "any", false, false, false, 30), "get", [0 => "uid"], "method", false, false, false, 30), "html", null, true);
        echo "</li>
                    <li ><a href='/lol/index/login'>Login</a></li>
                    <li><a href='/lol/index/Register'>Register</a></li>
                </ul>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
                <ul class='nav navbar-nav'>
                    <li class='\$active1'><a href='./event.php'>Events</a></li>
                    <li class='\$active2'><a href='./registration.php'>Registrations</a></li>
                    <li class='\$active3'><a href='./admin.php'>Admin</a></li>
                    <li><a href='./logout.php'>Logout</a></li>
                </ul>
            </div> --><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <content>
        ";
        // line 47
        $this->displayBlock('content', $context, $blocks);
        // line 49
        echo "    </content>
    <p align='center' style='margin-bottom: 20px;color:#878B91;'>Copyright &copy;2020 </p>
</body>

</html>
";
    }

    // line 47
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 48
        echo "        ";
    }

    public function getTemplateName()
    {
        return "layout.php";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 48,  103 => 47,  94 => 49,  92 => 47,  72 => 30,  51 => 12,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<?php

<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/lol/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'>
    <script type='text/javascript' src='/lol/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/lol/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <title>{{ title }}</title>
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
                    <li>{{ app.session.get('uid') }}</li>
                    <li ><a href='/lol/index/login'>Login</a></li>
                    <li><a href='/lol/index/Register'>Register</a></li>
                </ul>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
                <ul class='nav navbar-nav'>
                    <li class='\$active1'><a href='./event.php'>Events</a></li>
                    <li class='\$active2'><a href='./registration.php'>Registrations</a></li>
                    <li class='\$active3'><a href='./admin.php'>Admin</a></li>
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
", "layout.php", "D:\\wamp64\\www\\lol\\app\\views\\layout.php");
    }
}
