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

/* login.php */
class __TwigTemplate_51911b4249e6325f67ab7300e96a0ccad8987b165d5085b5c5cff6e2e6267da1 extends \Twig\Template
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
        // line 1
        return "layout.php";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout.php", "login.php", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        echo "<div class=\"main\" style=\"min-height: 600px;\">
    <div class=\"container-fluid\" style=\"height: 400px; width: 500px;\">
        <h2 class=\"text-center\">Login Page</h2>
        <form action=\"/lol/index/verify\" id=\"loginForm\" method=\"POST\" class=\"form-horizontal\" style=\"margin-top: 40px;\">
            <div class=\"form-group\">
                <label for=\"email\" class=\"col-sm-3 control-label\"><i class=\"glyphicon glyphicon-envelope\" aria-hidden=\"true\"></i>Email</label>
                <div class=\"col-sm-9\">
                    <input type=\"email\" class=\"form-control\" name=\"email\" id=\"email\" placeholder=\"Email\"><span id=\"warn-email\" style=\"color:red;display:none;\" \">Email can't be empty or invalid</span>
\t                </div>
\t            </div>
\t            <div class=\" form-group\">
                        <label for=\"psd\" class=\"col-sm-3 control-label\"><i class=\"glyphicon glyphicon-lock\"></i>Password</label>
                        <div class=\"col-sm-9\">
                            <input type=\"password\" class=\"form-control\" name=\"password\" id=\"psd\" placeholder=\"Password\"><span id=\"warn-password\" style=\"color:red;display:none;\">password can't be empty</span>
                        </div>
                </div>
                <div class=\" form-group\">
                        <label for=\"captcha\" class=\"col-sm-3 control-label\"><i class=\"glyphicon glyphicon-barcode\"></i>Captcha</label>
                        <div class=\"col-sm-4\">
                            <input type=\"text\" class=\"form-control\" name=\"captcha\" id=\"captcha\" placeholder=\"captcha\">
                            <span id=\"warn-captcha\" style=\"color:red;display:none;\">captcha can't be empty</span>
                        </div>
                        <div class=\"col-sm-4\">
                            <div class=\"media-left\">
                                <img id=\"cap\" src=\"/lol/index/captcha\"/>
                            </div>
                            <div class=\"media-body\">
                                <button type=\"button\" class=\"btn btn-info btn-sm\" id=\"change_captcha\">change</button>
                            </div>
                        </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-sm-offset-3 col-sm-2\">
                        <button type=\"button\" id=\"sub\" class=\"btn btn-success\" style=\"height: 30px;\">Login</button>
                    </div>

                    <div class=\"col-sm-offset-4 col-sm-2\">
                        <a type=\"button\" id=\"back\" href=\"/lol/index/register\" class=\"btn btn-primary\" style=\"height: 30px;\">Register</a>
                    </div>
                </div>
        </form>
    </div>
</div>
<script type=\"text/javascript\">
    \$(function(){
        \$(\"#change_captcha\").click(function(){
            var rand = parseInt(new Date().getTime()) +Math.random();
            console.log(\"rand:/lol/index/captcha/id/\"+rand);
            \$('#cap').attr('src', '/lol/index/captcha/id/'+rand);
        });
        \$(\"#sub\").click(function() {
            var email = \$(\"#email\").val();
            var psd = \$(\"#psd\").val();
            var captcha = \$(\"#captcha\").val();

            var reg = /^([a-zA-Z]|[0-9])(\\w|\\-)+@[a-zA-Z0-9]+\\.([a-zA-Z]{2,4})\$/;
            if (email == null || email == undefined || email == \"\" || !reg.test(email)) {
                \$(\"#warn-email\").css(\"display\", \"block\");
                return;
            } else {
                \$(\"#warn-email\").css(\"display\", \"none\");
            }
            if (psd == null || psd == undefined || psd == \"\") {
                \$(\"#warn-password\").css(\"display\", \"block\");
                return;
            } else {
                \$(\"#warn-password\").css(\"display\", \"none\");
            }
            if (captcha == null || captcha == undefined || captcha == \"\") {
                \$(\"#warn-captcha\").css(\"display\", \"block\");
                return;
            } else {
                \$(\"#warn-captcha\").css(\"display\", \"none\");
            }
            \$.ajax({
                type: \"post\",
                url: \"/lol/index/verify\",
                async:false, 
                data: {\"email\": email,\"password\":psd,\"captcha\":captcha},
                success: function(data) {
                    if(data == 1){
                        alert(\"login successfully\");
                    }else{
                        var rand = parseInt(new Date().getTime()) +Math.random();
                        \$('#cap').attr('src', '/lol/index/captcha/id/'+rand);
                        alert(\"login failed\");
                    }
                }
            });
            //\$(\"#loginForm\").submit();
        });
    })

</script>

";
    }

    public function getTemplateName()
    {
        return "login.php";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 3,  46 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout.php\" %}
{% block content %}
<div class=\"main\" style=\"min-height: 600px;\">
    <div class=\"container-fluid\" style=\"height: 400px; width: 500px;\">
        <h2 class=\"text-center\">Login Page</h2>
        <form action=\"/lol/index/verify\" id=\"loginForm\" method=\"POST\" class=\"form-horizontal\" style=\"margin-top: 40px;\">
            <div class=\"form-group\">
                <label for=\"email\" class=\"col-sm-3 control-label\"><i class=\"glyphicon glyphicon-envelope\" aria-hidden=\"true\"></i>Email</label>
                <div class=\"col-sm-9\">
                    <input type=\"email\" class=\"form-control\" name=\"email\" id=\"email\" placeholder=\"Email\"><span id=\"warn-email\" style=\"color:red;display:none;\" \">Email can't be empty or invalid</span>
\t                </div>
\t            </div>
\t            <div class=\" form-group\">
                        <label for=\"psd\" class=\"col-sm-3 control-label\"><i class=\"glyphicon glyphicon-lock\"></i>Password</label>
                        <div class=\"col-sm-9\">
                            <input type=\"password\" class=\"form-control\" name=\"password\" id=\"psd\" placeholder=\"Password\"><span id=\"warn-password\" style=\"color:red;display:none;\">password can't be empty</span>
                        </div>
                </div>
                <div class=\" form-group\">
                        <label for=\"captcha\" class=\"col-sm-3 control-label\"><i class=\"glyphicon glyphicon-barcode\"></i>Captcha</label>
                        <div class=\"col-sm-4\">
                            <input type=\"text\" class=\"form-control\" name=\"captcha\" id=\"captcha\" placeholder=\"captcha\">
                            <span id=\"warn-captcha\" style=\"color:red;display:none;\">captcha can't be empty</span>
                        </div>
                        <div class=\"col-sm-4\">
                            <div class=\"media-left\">
                                <img id=\"cap\" src=\"/lol/index/captcha\"/>
                            </div>
                            <div class=\"media-body\">
                                <button type=\"button\" class=\"btn btn-info btn-sm\" id=\"change_captcha\">change</button>
                            </div>
                        </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-sm-offset-3 col-sm-2\">
                        <button type=\"button\" id=\"sub\" class=\"btn btn-success\" style=\"height: 30px;\">Login</button>
                    </div>

                    <div class=\"col-sm-offset-4 col-sm-2\">
                        <a type=\"button\" id=\"back\" href=\"/lol/index/register\" class=\"btn btn-primary\" style=\"height: 30px;\">Register</a>
                    </div>
                </div>
        </form>
    </div>
</div>
<script type=\"text/javascript\">
    \$(function(){
        \$(\"#change_captcha\").click(function(){
            var rand = parseInt(new Date().getTime()) +Math.random();
            console.log(\"rand:/lol/index/captcha/id/\"+rand);
            \$('#cap').attr('src', '/lol/index/captcha/id/'+rand);
        });
        \$(\"#sub\").click(function() {
            var email = \$(\"#email\").val();
            var psd = \$(\"#psd\").val();
            var captcha = \$(\"#captcha\").val();

            var reg = /^([a-zA-Z]|[0-9])(\\w|\\-)+@[a-zA-Z0-9]+\\.([a-zA-Z]{2,4})\$/;
            if (email == null || email == undefined || email == \"\" || !reg.test(email)) {
                \$(\"#warn-email\").css(\"display\", \"block\");
                return;
            } else {
                \$(\"#warn-email\").css(\"display\", \"none\");
            }
            if (psd == null || psd == undefined || psd == \"\") {
                \$(\"#warn-password\").css(\"display\", \"block\");
                return;
            } else {
                \$(\"#warn-password\").css(\"display\", \"none\");
            }
            if (captcha == null || captcha == undefined || captcha == \"\") {
                \$(\"#warn-captcha\").css(\"display\", \"block\");
                return;
            } else {
                \$(\"#warn-captcha\").css(\"display\", \"none\");
            }
            \$.ajax({
                type: \"post\",
                url: \"/lol/index/verify\",
                async:false, 
                data: {\"email\": email,\"password\":psd,\"captcha\":captcha},
                success: function(data) {
                    if(data == 1){
                        alert(\"login successfully\");
                    }else{
                        var rand = parseInt(new Date().getTime()) +Math.random();
                        \$('#cap').attr('src', '/lol/index/captcha/id/'+rand);
                        alert(\"login failed\");
                    }
                }
            });
            //\$(\"#loginForm\").submit();
        });
    })

</script>

{% endblock %}", "login.php", "D:\\wamp64\\www\\lol\\app\\views\\login.php");
    }
}
