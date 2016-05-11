<?php

/* SilntiBundle::base.html.twig */
class __TwigTemplate_975189e921d797b295cbc52c54e279f882f1ba5cd92df8a4206c08bf35dcac5d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'content' => array($this, 'block_content'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_4a8de4c323dcaea11c28e1eaafcc5ae4d0190d14c6dcbb44e353ecb658f39f99 = $this->env->getExtension("native_profiler");
        $__internal_4a8de4c323dcaea11c28e1eaafcc5ae4d0190d14c6dcbb44e353ecb658f39f99->enter($__internal_4a8de4c323dcaea11c28e1eaafcc5ae4d0190d14c6dcbb44e353ecb658f39f99_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SilntiBundle::base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\" />
    <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 12
        echo "</head>
<body>
";
        // line 14
        $this->displayBlock('body', $context, $blocks);
        // line 58
        $this->displayBlock('javascripts', $context, $blocks);
        // line 65
        echo "</body>
</html>
";
        
        $__internal_4a8de4c323dcaea11c28e1eaafcc5ae4d0190d14c6dcbb44e353ecb658f39f99->leave($__internal_4a8de4c323dcaea11c28e1eaafcc5ae4d0190d14c6dcbb44e353ecb658f39f99_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_02b90004769e2d35ca4d06c7d1625c4b4dd458ed5e4adc530f95f765df569e91 = $this->env->getExtension("native_profiler");
        $__internal_02b90004769e2d35ca4d06c7d1625c4b4dd458ed5e4adc530f95f765df569e91->enter($__internal_02b90004769e2d35ca4d06c7d1625c4b4dd458ed5e4adc530f95f765df569e91_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_02b90004769e2d35ca4d06c7d1625c4b4dd458ed5e4adc530f95f765df569e91->leave($__internal_02b90004769e2d35ca4d06c7d1625c4b4dd458ed5e4adc530f95f765df569e91_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_3bbaec7135648dac8157de109fb5878ab1c968a01a6f46d3fa33a9fb9abe1129 = $this->env->getExtension("native_profiler");
        $__internal_3bbaec7135648dac8157de109fb5878ab1c968a01a6f46d3fa33a9fb9abe1129->enter($__internal_3bbaec7135648dac8157de109fb5878ab1c968a01a6f46d3fa33a9fb9abe1129_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 7
        echo "
        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.1/foundation.min.css\">

    ";
        
        $__internal_3bbaec7135648dac8157de109fb5878ab1c968a01a6f46d3fa33a9fb9abe1129->leave($__internal_3bbaec7135648dac8157de109fb5878ab1c968a01a6f46d3fa33a9fb9abe1129_prof);

    }

    // line 14
    public function block_body($context, array $blocks = array())
    {
        $__internal_aad4c2c6cf5905a753b234afd2dc58c3d99821808980832b129eab468a765302 = $this->env->getExtension("native_profiler");
        $__internal_aad4c2c6cf5905a753b234afd2dc58c3d99821808980832b129eab468a765302->enter($__internal_aad4c2c6cf5905a753b234afd2dc58c3d99821808980832b129eab468a765302_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 15
        echo "    <div class=\"container\">
        <div id=\"header\" class=\"jumbotron\">
            <img src=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/framework/images/image.png"), "html", null, true);
        echo "\">;
            <h1>Bienvenue sur le site de la Licence Professionnelle SIL-NTI</h1>

        </div>

        <div class=\"row\">
            <div id=\"menu\" class=\"col-md-3\">
                <ul class=\"dropdown menu\" data-dropdown-menu>
                    <li>
                        <a href=\"#\">Item 1</a>
                        <ul class=\"menu\">
                            <li><a href=\"#\">Item 1A</a></li>
                            <!-- ... -->
                        </ul>
                    </li>
                    <li><a href=\"#\">Item 2</a></li>
                    <li><a href=\"#\">Item 3</a></li>
                    <li><a href=\"#\">Item 4</a></li>
                </ul>
            <div id=\"content\" class=\"col-md-9\">

            </div>
        </div>

        <hr>

        <footer>
            <p>  SIL - NTI copyright 2016</p>
        </footer>
    </div>


    <!--<ul>
        <li>Accueil</li>
        <li>Contact</li>
    </ul>
    <div id=\"content\">";
        // line 53
        $this->displayBlock('content', $context, $blocks);
        // line 54
        echo "
    </div>
    -->
";
        
        $__internal_aad4c2c6cf5905a753b234afd2dc58c3d99821808980832b129eab468a765302->leave($__internal_aad4c2c6cf5905a753b234afd2dc58c3d99821808980832b129eab468a765302_prof);

    }

    // line 53
    public function block_content($context, array $blocks = array())
    {
        $__internal_95948aaf3308ebb275397ac24da9fd25e78d5184d7450c95b96536f497346a6a = $this->env->getExtension("native_profiler");
        $__internal_95948aaf3308ebb275397ac24da9fd25e78d5184d7450c95b96536f497346a6a->enter($__internal_95948aaf3308ebb275397ac24da9fd25e78d5184d7450c95b96536f497346a6a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        
        $__internal_95948aaf3308ebb275397ac24da9fd25e78d5184d7450c95b96536f497346a6a->leave($__internal_95948aaf3308ebb275397ac24da9fd25e78d5184d7450c95b96536f497346a6a_prof);

    }

    // line 58
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_d9087a52696441e30e1669349058fedcded879ed4c90a62cb62289ab24bc3b71 = $this->env->getExtension("native_profiler");
        $__internal_d9087a52696441e30e1669349058fedcded879ed4c90a62cb62289ab24bc3b71->enter($__internal_d9087a52696441e30e1669349058fedcded879ed4c90a62cb62289ab24bc3b71_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 59
        echo "    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.1/foundation.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.1/plugins/foundation.dropdown.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.1/plugins/foundation.dropdownMenu.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.1/plugins/foundation.responsiveMenu.js\"></script>
    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
";
        
        $__internal_d9087a52696441e30e1669349058fedcded879ed4c90a62cb62289ab24bc3b71->leave($__internal_d9087a52696441e30e1669349058fedcded879ed4c90a62cb62289ab24bc3b71_prof);

    }

    public function getTemplateName()
    {
        return "SilntiBundle::base.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  166 => 59,  160 => 58,  149 => 53,  139 => 54,  137 => 53,  98 => 17,  94 => 15,  88 => 14,  77 => 8,  74 => 7,  68 => 6,  56 => 5,  47 => 65,  45 => 58,  43 => 14,  39 => 12,  37 => 6,  33 => 5,  27 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/* <head>*/
/*     <meta charset="UTF-8" />*/
/*     <title>{% block title %}Welcome!{% endblock %}</title>*/
/*     {% block stylesheets %}*/
/* */
/*         <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />*/
/*         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.1/foundation.min.css">*/
/* */
/*     {% endblock %}*/
/* </head>*/
/* <body>*/
/* {% block body %}*/
/*     <div class="container">*/
/*         <div id="header" class="jumbotron">*/
/*             <img src="{{ asset('bundles/framework/images/image.png') }}">;*/
/*             <h1>Bienvenue sur le site de la Licence Professionnelle SIL-NTI</h1>*/
/* */
/*         </div>*/
/* */
/*         <div class="row">*/
/*             <div id="menu" class="col-md-3">*/
/*                 <ul class="dropdown menu" data-dropdown-menu>*/
/*                     <li>*/
/*                         <a href="#">Item 1</a>*/
/*                         <ul class="menu">*/
/*                             <li><a href="#">Item 1A</a></li>*/
/*                             <!-- ... -->*/
/*                         </ul>*/
/*                     </li>*/
/*                     <li><a href="#">Item 2</a></li>*/
/*                     <li><a href="#">Item 3</a></li>*/
/*                     <li><a href="#">Item 4</a></li>*/
/*                 </ul>*/
/*             <div id="content" class="col-md-9">*/
/* */
/*             </div>*/
/*         </div>*/
/* */
/*         <hr>*/
/* */
/*         <footer>*/
/*             <p>  SIL - NTI copyright 2016</p>*/
/*         </footer>*/
/*     </div>*/
/* */
/* */
/*     <!--<ul>*/
/*         <li>Accueil</li>*/
/*         <li>Contact</li>*/
/*     </ul>*/
/*     <div id="content">{% block content %}{% endblock %}*/
/* */
/*     </div>*/
/*     -->*/
/* {% endblock %}*/
/* {% block javascripts %}*/
/*     <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.1/foundation.min.js"></script>*/
/*     <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.1/plugins/foundation.dropdown.js"></script>*/
/*     <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.1/plugins/foundation.dropdownMenu.js"></script>*/
/*     <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.1/plugins/foundation.responsiveMenu.js"></script>*/
/*     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>*/
/* {% endblock %}*/
/* </body>*/
/* </html>*/
/* */
