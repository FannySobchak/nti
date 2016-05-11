<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_2b81b97e8b702c1fb06eab502af0c26883770c58e002486585b482341c157145 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_71ef06075e5d921f4b2e8fae15dce07b7c238d071c80b8173f2b519e441e81a9 = $this->env->getExtension("native_profiler");
        $__internal_71ef06075e5d921f4b2e8fae15dce07b7c238d071c80b8173f2b519e441e81a9->enter($__internal_71ef06075e5d921f4b2e8fae15dce07b7c238d071c80b8173f2b519e441e81a9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_71ef06075e5d921f4b2e8fae15dce07b7c238d071c80b8173f2b519e441e81a9->leave($__internal_71ef06075e5d921f4b2e8fae15dce07b7c238d071c80b8173f2b519e441e81a9_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_92ba75c81bc41a8b93db155c835db8eef3e317e85cf8474e31a2eefccdd0d7a2 = $this->env->getExtension("native_profiler");
        $__internal_92ba75c81bc41a8b93db155c835db8eef3e317e85cf8474e31a2eefccdd0d7a2->enter($__internal_92ba75c81bc41a8b93db155c835db8eef3e317e85cf8474e31a2eefccdd0d7a2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_92ba75c81bc41a8b93db155c835db8eef3e317e85cf8474e31a2eefccdd0d7a2->leave($__internal_92ba75c81bc41a8b93db155c835db8eef3e317e85cf8474e31a2eefccdd0d7a2_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_dc585ae0217a3c9abdef3faa32f8b53ea48c0fb8f7c783473d450b68d7ba5277 = $this->env->getExtension("native_profiler");
        $__internal_dc585ae0217a3c9abdef3faa32f8b53ea48c0fb8f7c783473d450b68d7ba5277->enter($__internal_dc585ae0217a3c9abdef3faa32f8b53ea48c0fb8f7c783473d450b68d7ba5277_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_dc585ae0217a3c9abdef3faa32f8b53ea48c0fb8f7c783473d450b68d7ba5277->leave($__internal_dc585ae0217a3c9abdef3faa32f8b53ea48c0fb8f7c783473d450b68d7ba5277_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_d7ff3784bb2854b2048487ad61d77288e32b2008d780dab401a7ed58bb499160 = $this->env->getExtension("native_profiler");
        $__internal_d7ff3784bb2854b2048487ad61d77288e32b2008d780dab401a7ed58bb499160->enter($__internal_d7ff3784bb2854b2048487ad61d77288e32b2008d780dab401a7ed58bb499160_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_d7ff3784bb2854b2048487ad61d77288e32b2008d780dab401a7ed58bb499160->leave($__internal_d7ff3784bb2854b2048487ad61d77288e32b2008d780dab401a7ed58bb499160_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@WebProfiler/Profiler/layout.html.twig' %}*/
/* */
/* {% block toolbar %}{% endblock %}*/
/* */
/* {% block menu %}*/
/* <span class="label">*/
/*     <span class="icon">{{ include('@WebProfiler/Icon/router.svg') }}</span>*/
/*     <strong>Routing</strong>*/
/* </span>*/
/* {% endblock %}*/
/* */
/* {% block panel %}*/
/*     {{ render(path('_profiler_router', { token: token })) }}*/
/* {% endblock %}*/
/* */
