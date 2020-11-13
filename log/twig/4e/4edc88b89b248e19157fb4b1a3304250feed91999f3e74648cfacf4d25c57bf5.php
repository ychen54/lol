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

/* index.html */
class __TwigTemplate_4e50d0d5559b4007f9544aac78b7f9a2e492ddd10d167afdc97553e9e1d3c194 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 3
        return "layout.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout.html", "index.html", 3);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo twig_escape_filter($this->env, ($context["data"] ?? null), "html", null, true);
        echo "

<form action=\"/test/index/add\" method=\"POST\">
\tusername:<input type=\"text\" name=\"username\"><br />
\tpassword:<input type=\"password\" name=\"password\"><br />
\t<input type=\"submit\" value=\"submit\">
</form>

";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 6,  46 => 5,  35 => 3,);
    }

    public function getSourceContext()
    {
        return new Source("

{% extends \"layout.html\" %}

{% block content %}
{{data}}

<form action=\"/test/index/add\" method=\"POST\">
\tusername:<input type=\"text\" name=\"username\"><br />
\tpassword:<input type=\"password\" name=\"password\"><br />
\t<input type=\"submit\" value=\"submit\">
</form>

{% endblock %}

", "index.html", "D:\\wamp64\\www\\lol\\app\\views\\index.html");
    }
}
