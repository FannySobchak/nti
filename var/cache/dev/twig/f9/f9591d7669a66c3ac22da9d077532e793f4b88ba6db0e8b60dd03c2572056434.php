<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_1d82eb2a8ffe6fa5301c0246f8a500225ee5255e09f8582b7a96d1bc56360cbf extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "@Twig/Exception/exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_9508ba885e14bec9c363815f1a960591ac88acca2a091f12464b4f30ee417cd9 = $this->env->getExtension("native_profiler");
        $__internal_9508ba885e14bec9c363815f1a960591ac88acca2a091f12464b4f30ee417cd9->enter($__internal_9508ba885e14bec9c363815f1a960591ac88acca2a091f12464b4f30ee417cd9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9508ba885e14bec9c363815f1a960591ac88acca2a091f12464b4f30ee417cd9->leave($__internal_9508ba885e14bec9c363815f1a960591ac88acca2a091f12464b4f30ee417cd9_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_3b3aba5c30b17878a620e59f3f65d327d32d183ad1f3f9ee219ca48982a0c57a = $this->env->getExtension("native_profiler");
        $__internal_3b3aba5c30b17878a620e59f3f65d327d32d183ad1f3f9ee219ca48982a0c57a->enter($__internal_3b3aba5c30b17878a620e59f3f65d327d32d183ad1f3f9ee219ca48982a0c57a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_3b3aba5c30b17878a620e59f3f65d327d32d183ad1f3f9ee219ca48982a0c57a->leave($__internal_3b3aba5c30b17878a620e59f3f65d327d32d183ad1f3f9ee219ca48982a0c57a_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_9d434876fd20854524cc5192a064e92408b43c4fa7e9d9296e67df5a17f63efd = $this->env->getExtension("native_profiler");
        $__internal_9d434876fd20854524cc5192a064e92408b43c4fa7e9d9296e67df5a17f63efd->enter($__internal_9d434876fd20854524cc5192a064e92408b43c4fa7e9d9296e67df5a17f63efd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_9d434876fd20854524cc5192a064e92408b43c4fa7e9d9296e67df5a17f63efd->leave($__internal_9d434876fd20854524cc5192a064e92408b43c4fa7e9d9296e67df5a17f63efd_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_ed599503aca2e9ab7cab761b234bb292f8b3e371e70333ee9e2472b4b7ccb061 = $this->env->getExtension("native_profiler");
        $__internal_ed599503aca2e9ab7cab761b234bb292f8b3e371e70333ee9e2472b4b7ccb061->enter($__internal_ed599503aca2e9ab7cab761b234bb292f8b3e371e70333ee9e2472b4b7ccb061_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_ed599503aca2e9ab7cab761b234bb292f8b3e371e70333ee9e2472b4b7ccb061->leave($__internal_ed599503aca2e9ab7cab761b234bb292f8b3e371e70333ee9e2472b4b7ccb061_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@Twig/layout.html.twig' %}*/
/* */
/* {% block head %}*/
/*     <link href="{{ absolute_url(asset('bundles/framework/css/exception.css')) }}" rel="stylesheet" type="text/css" media="all" />*/
/* {% endblock %}*/
/* */
/* {% block title %}*/
/*     {{ exception.message }} ({{ status_code }} {{ status_text }})*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/*     {% include '@Twig/Exception/exception.html.twig' %}*/
/* {% endblock %}*/
/* */
