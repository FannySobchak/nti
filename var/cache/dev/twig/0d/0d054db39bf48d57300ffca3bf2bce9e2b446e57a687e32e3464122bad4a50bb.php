<?php

/* SilntiBundle:Default:index.html.twig */
class __TwigTemplate_ff3333b9b561d7b2f78ebf76b187c8b12cbc9c55d47cc9f42723e106e85f0842 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SilntiBundle::base.html.twig", "SilntiBundle:Default:index.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SilntiBundle::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_1bb1f763b037dc22ef8791bb56dcbbb7bf159c4549d38926056a4d5988fa31cb = $this->env->getExtension("native_profiler");
        $__internal_1bb1f763b037dc22ef8791bb56dcbbb7bf159c4549d38926056a4d5988fa31cb->enter($__internal_1bb1f763b037dc22ef8791bb56dcbbb7bf159c4549d38926056a4d5988fa31cb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SilntiBundle:Default:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_1bb1f763b037dc22ef8791bb56dcbbb7bf159c4549d38926056a4d5988fa31cb->leave($__internal_1bb1f763b037dc22ef8791bb56dcbbb7bf159c4549d38926056a4d5988fa31cb_prof);

    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        $__internal_a50e3f2b0955d8e98a2a48b7e214cd3fc5c2b2492480d34fdbe718e4cded356d = $this->env->getExtension("native_profiler");
        $__internal_a50e3f2b0955d8e98a2a48b7e214cd3fc5c2b2492480d34fdbe718e4cded356d->enter($__internal_a50e3f2b0955d8e98a2a48b7e214cd3fc5c2b2492480d34fdbe718e4cded356d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 4
        echo "    Accueil - ";
        $this->displayParentBlock("title", $context, $blocks);
        echo "
";
        
        $__internal_a50e3f2b0955d8e98a2a48b7e214cd3fc5c2b2492480d34fdbe718e4cded356d->leave($__internal_a50e3f2b0955d8e98a2a48b7e214cd3fc5c2b2492480d34fdbe718e4cded356d_prof);

    }

    // line 6
    public function block_content($context, array $blocks = array())
    {
        $__internal_6cd058287a4a068bdea07012d1f4f41074ca7b07d30777158c2df21f2e07fd25 = $this->env->getExtension("native_profiler");
        $__internal_6cd058287a4a068bdea07012d1f4f41074ca7b07d30777158c2df21f2e07fd25->enter($__internal_6cd058287a4a068bdea07012d1f4f41074ca7b07d30777158c2df21f2e07fd25_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 7
        echo "    toto
";
        
        $__internal_6cd058287a4a068bdea07012d1f4f41074ca7b07d30777158c2df21f2e07fd25->leave($__internal_6cd058287a4a068bdea07012d1f4f41074ca7b07d30777158c2df21f2e07fd25_prof);

    }

    public function getTemplateName()
    {
        return "SilntiBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 7,  51 => 6,  41 => 4,  35 => 3,  11 => 1,);
    }
}
/* {% extends "SilntiBundle::base.html.twig" %}*/
/* */
/* {% block title %}*/
/*     Accueil - {{ parent() }}*/
/* {% endblock %}*/
/* {% block content %}*/
/*     toto*/
/* {% endblock %}*/
/* */
