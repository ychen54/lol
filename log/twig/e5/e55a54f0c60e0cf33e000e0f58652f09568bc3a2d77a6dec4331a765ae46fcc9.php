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

/* layout.html */
class __TwigTemplate_e25a39d2c79e1e96a349b2f109595db75036f44815f169033aee2700738d6c8d extends \Twig\Template
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
        echo "<!DOCTYPE html>
<html>
<head>
\t<title></title>
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/test/vendor/components/jquery/jquery.min.js\">

</head>
<body>
\t<header>header</header>
\t<content>
\t\t";
        // line 11
        $this->displayBlock('content', $context, $blocks);
        // line 14
        echo "
\t</content>
\t<footer>footer</footer>
</body>
</html>";
    }

    // line 11
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 12
        echo "
\t\t";
    }

    public function getTemplateName()
    {
        return "layout.html";
    }

    public function getDebugInfo()
    {
        return array (  64 => 12,  60 => 11,  52 => 14,  50 => 11,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
\t<title></title>
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/test/vendor/components/jquery/jquery.min.js\">

</head>
<body>
\t<header>header</header>
\t<content>
\t\t{% block content %}

\t\t{% endblock %}

\t</content>
\t<footer>footer</footer>
</body>
</html>", "layout.html", "D:\\wamp64\\www\\test\\app\\views\\layout.html");
    }
}
