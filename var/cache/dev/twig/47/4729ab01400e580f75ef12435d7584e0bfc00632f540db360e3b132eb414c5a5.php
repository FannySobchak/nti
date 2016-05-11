<?php

/* PropelBundle:Collector:propel.html.twig */
class __TwigTemplate_7157df77d83a165ae30a31b32a62c5a0746090025b01ad5b2faf6e1a24f4679c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig", "PropelBundle:Collector:propel.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "WebProfilerBundle:Profiler:layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_fa39f1828d397e667905dc4c0f51d06bf4bb39a4c3bc715f28a56d6b740002a2 = $this->env->getExtension("native_profiler");
        $__internal_fa39f1828d397e667905dc4c0f51d06bf4bb39a4c3bc715f28a56d6b740002a2->enter($__internal_fa39f1828d397e667905dc4c0f51d06bf4bb39a4c3bc715f28a56d6b740002a2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "PropelBundle:Collector:propel.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_fa39f1828d397e667905dc4c0f51d06bf4bb39a4c3bc715f28a56d6b740002a2->leave($__internal_fa39f1828d397e667905dc4c0f51d06bf4bb39a4c3bc715f28a56d6b740002a2_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_cbbb2b44b59e4242e21c698b69724558e9b93aafc89e7a3ce248fa852659a318 = $this->env->getExtension("native_profiler");
        $__internal_cbbb2b44b59e4242e21c698b69724558e9b93aafc89e7a3ce248fa852659a318->enter($__internal_cbbb2b44b59e4242e21c698b69724558e9b93aafc89e7a3ce248fa852659a318_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        // line 4
        echo "    ";
        // line 5
        echo "    ";
        ob_start();
        // line 6
        echo "        <img alt=\"Propel\" src=\"data:image/png;base64,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\" />
        <span class=\"sf-toolbar-status\">";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "querycount", array()), "html", null, true);
        echo "</span>
    ";
        $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 9
        echo "    ";
        ob_start();
        // line 10
        echo "        <div class=\"sf-toolbar-info-piece\">
            <b>DB Queries</b>
            <span>";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "querycount", array()), "html", null, true);
        echo "</span>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <b>Query time</b>
            <span>";
        // line 16
        echo twig_escape_filter($this->env, sprintf("%0.2f", ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "time", array()) * 1000)), "html", null, true);
        echo " ms</span>
        </div>
";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 19
        echo "    ";
        $this->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig", "PropelBundle:Collector:propel.html.twig", 19)->display(array_merge($context, array("link" => (isset($context["profiler_url"]) ? $context["profiler_url"] : $this->getContext($context, "profiler_url")))));
        
        $__internal_cbbb2b44b59e4242e21c698b69724558e9b93aafc89e7a3ce248fa852659a318->leave($__internal_cbbb2b44b59e4242e21c698b69724558e9b93aafc89e7a3ce248fa852659a318_prof);

    }

    // line 22
    public function block_menu($context, array $blocks = array())
    {
        $__internal_0b5a27b247b91a146b8c06aca598721be1ee24cccd9cf0c0840122427e4f18fb = $this->env->getExtension("native_profiler");
        $__internal_0b5a27b247b91a146b8c06aca598721be1ee24cccd9cf0c0840122427e4f18fb->enter($__internal_0b5a27b247b91a146b8c06aca598721be1ee24cccd9cf0c0840122427e4f18fb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 23
        echo "    ";
        // line 24
        echo "    <span class=\"label\">
        <span class=\"icon\"><img src=\"data:image/png;base64,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\" alt=\"\" /></span>
        <strong>Propel</strong>
        <span class=\"count\">
            <span>";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "querycount", array()), "html", null, true);
        echo "</span>
            <span>";
        // line 29
        echo twig_escape_filter($this->env, sprintf("%0.0f", ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "time", array()) * 1000)), "html", null, true);
        echo " ms</span>
        </span>
    </span>
";
        
        $__internal_0b5a27b247b91a146b8c06aca598721be1ee24cccd9cf0c0840122427e4f18fb->leave($__internal_0b5a27b247b91a146b8c06aca598721be1ee24cccd9cf0c0840122427e4f18fb_prof);

    }

    // line 34
    public function block_panel($context, array $blocks = array())
    {
        $__internal_0fea25518b373429e51115b020975b5d53cac9850255179b69c98ebadea2da5b = $this->env->getExtension("native_profiler");
        $__internal_0fea25518b373429e51115b020975b5d53cac9850255179b69c98ebadea2da5b->enter($__internal_0fea25518b373429e51115b020975b5d53cac9850255179b69c98ebadea2da5b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 35
        echo "    ";
        // line 36
        echo "    <style type=\"text/css\">
    .SQLKeyword {
        color: blue;
        white-space: nowrap;
    }
    .SQLName {
        color: #464646;
        white-space: nowrap;
    }
    .SQLInfo, .SQLComment {
        color: gray;
        display: block;
        font-size: 0.9em;
        margin: 3px 0;
    }

    .SQLExplain {
       margin: 5px;
    }

    .SQLExplain .error {
        background-color: #F2DEDE;
        border-color: #EED3D7;
        color: #B94A48;
        padding: 8px 35px 8px 14px;
        font-weight: bold;
    }

    #content .SQLExplain h2 {
        font-size: 17px;
        margin-bottom: 0;
    }

    .query-trace {
        display: none;
        overflow: auto;
        padding: 5px;
        border: 1px solid silver;
        margin: 5px;
        border-radius: 5px;
        font-family: monospace;
        white-space: nowrap;
        color: #333;
    }

    .query-trace .gray {
        color: silver;
    }

    .query-trace .gray + .regular {
        margin-top: 3px;
    }
    .query-trace .regular + .gray {
        margin-top: 3px;
    }
    </style>

    <script>
        function toggle(id) {
            var el = document.getElementById(id);
            el.style.display = el.style.display === 'block' ? 'none' : 'block';
        }
    </script>

    <h2>Queries</h2>
    <table summary=\"Show logged queries\">
        <thead>
            <tr>
                <th>SQL queries</th>
            </tr>
        </thead>
        <tbody>
        ";
        // line 108
        if ( !$this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "querycount", array())) {
            // line 109
            echo "            <tr><td>No queries.</td></tr>
        ";
        } else {
            // line 111
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "queries", array()));
            foreach ($context['_seq'] as $context["i"] => $context["query"]) {
                // line 112
                echo "            <tr>
                <td>
                    <a name=\"propel-query-";
                // line 114
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "\" ></a>
                    <code>";
                // line 115
                echo $this->env->getExtension('propel_syntax_extension')->formatSQL($this->getAttribute($context["query"], "sql", array()));
                echo "</code>
                    ";
                // line 116
                if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "query", array()), "has", array(0 => "query"), "method") && ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "query", array()), "get", array(0 => "query"), "method") == $context["i"]))) {
                    // line 117
                    echo "                        <div class=\"SQLExplain\">
                        ";
                    // line 118
                    echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("PropelBundle:Panel:explain", array("token" =>                     // line 119
(isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")), "panel" => "propel", "query" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 121
(isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "query", array()), "get", array(0 => "query"), "method"), "connection" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 122
(isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "query", array()), "get", array(0 => "connection"), "method"))));
                    // line 123
                    echo "
                        </div>
                    ";
                }
                // line 126
                echo "                    <div class=\"SQLInfo\">
                        Time: ";
                // line 127
                echo twig_escape_filter($this->env, $this->getAttribute($context["query"], "time", array()), "html", null, true);
                echo " - Memory: ";
                echo twig_escape_filter($this->env, $this->env->getExtension('propel_syntax_extension')->formatMemory($this->getAttribute($context["query"], "memory", array())), "html", null, true);
                echo " - Connection: ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["query"], "connection", array()), "html", null, true);
                echo " -
                        <a href=\"#\" onclick=\"toggle('propel-stack-trace-";
                // line 128
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "'); return false;\">Stacktrace</a>

                        ";
                // line 130
                if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "query", array()), "get", array(0 => "query", 1 =>  -1), "method") != $context["i"])) {
                    // line 131
                    echo "                            - <a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_profiler", array("panel" => "propel", "token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")), "connection" => $this->getAttribute($context["query"], "connection", array()), "query" => $context["i"])), "html", null, true);
                    echo "#propel-query-";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "\">Explain the query</a>
                        ";
                }
                // line 133
                echo "                    </div>
                    <div id=\"propel-stack-trace-";
                // line 134
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "\" class=\"query-trace\">
                        ";
                // line 135
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["query"], "stackTrace", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["trace"]) {
                    // line 136
                    echo "                            <div class=\"";
                    echo ((((((twig_in_filter(": Symfony\\Component",                     // line 137
$context["trace"]) || twig_in_filter(": Propel\\Runtime",                     // line 138
$context["trace"])) || twig_in_filter(": Propel\\Bundle\\PropelBundle",                     // line 139
$context["trace"])) || twig_in_filter(": call_user_func(Object(Symfony\\Component",                     // line 140
$context["trace"])) || twig_in_filter(": call_user_func(Array, Object(Symfony\\Component",                     // line 141
$context["trace"]))) ? ("gray") : ("regular"));
                    // line 142
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["trace"], "html", null, true);
                    echo "</div>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trace'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 144
                echo "                    </div>
                </td>
            </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['i'], $context['query'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 148
            echo "        ";
        }
        // line 149
        echo "        </tbody>
    </table>

    ";
        // line 152
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("PropelBundle:Panel:configuration"));
        echo "
";
        
        $__internal_0fea25518b373429e51115b020975b5d53cac9850255179b69c98ebadea2da5b->leave($__internal_0fea25518b373429e51115b020975b5d53cac9850255179b69c98ebadea2da5b_prof);

    }

    public function getTemplateName()
    {
        return "PropelBundle:Collector:propel.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  303 => 152,  298 => 149,  295 => 148,  286 => 144,  277 => 142,  275 => 141,  274 => 140,  273 => 139,  272 => 138,  271 => 137,  269 => 136,  265 => 135,  261 => 134,  258 => 133,  250 => 131,  248 => 130,  243 => 128,  235 => 127,  232 => 126,  227 => 123,  225 => 122,  224 => 121,  223 => 119,  222 => 118,  219 => 117,  217 => 116,  213 => 115,  209 => 114,  205 => 112,  200 => 111,  196 => 109,  194 => 108,  120 => 36,  118 => 35,  112 => 34,  101 => 29,  97 => 28,  91 => 24,  89 => 23,  83 => 22,  75 => 19,  69 => 16,  62 => 12,  58 => 10,  55 => 9,  50 => 7,  47 => 6,  44 => 5,  42 => 4,  36 => 3,  11 => 1,);
    }
}
/* {% extends 'WebProfilerBundle:Profiler:layout.html.twig' %}*/
/* */
/* {% block toolbar %}*/
/*     {# the web debug toolbar content #}*/
/*     {% set icon %}*/
/*         <img alt="Propel" src="data:image/png;base64,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" />*/
/*         <span class="sf-toolbar-status">{{ collector.querycount }}</span>*/
/*     {% endset %}*/
/*     {% set text %}*/
/*         <div class="sf-toolbar-info-piece">*/
/*             <b>DB Queries</b>*/
/*             <span>{{ collector.querycount }}</span>*/
/*         </div>*/
/*         <div class="sf-toolbar-info-piece">*/
/*             <b>Query time</b>*/
/*             <span>{{ '%0.2f'|format(collector.time * 1000) }} ms</span>*/
/*         </div>*/
/* {% endset %}*/
/*     {% include 'WebProfilerBundle:Profiler:toolbar_item.html.twig' with { 'link': profiler_url } %}*/
/* {% endblock %}*/
/* */
/* {% block menu %}*/
/*     {# the menu content #}*/
/*     <span class="label">*/
/*         <span class="icon"><img src="data:image/png;base64,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" alt="" /></span>*/
/*         <strong>Propel</strong>*/
/*         <span class="count">*/
/*             <span>{{ collector.querycount }}</span>*/
/*             <span>{{ '%0.0f'|format(collector.time * 1000) }} ms</span>*/
/*         </span>*/
/*     </span>*/
/* {% endblock %}*/
/* */
/* {% block panel %}*/
/*     {# the panel content #}*/
/*     <style type="text/css">*/
/*     .SQLKeyword {*/
/*         color: blue;*/
/*         white-space: nowrap;*/
/*     }*/
/*     .SQLName {*/
/*         color: #464646;*/
/*         white-space: nowrap;*/
/*     }*/
/*     .SQLInfo, .SQLComment {*/
/*         color: gray;*/
/*         display: block;*/
/*         font-size: 0.9em;*/
/*         margin: 3px 0;*/
/*     }*/
/* */
/*     .SQLExplain {*/
/*        margin: 5px;*/
/*     }*/
/* */
/*     .SQLExplain .error {*/
/*         background-color: #F2DEDE;*/
/*         border-color: #EED3D7;*/
/*         color: #B94A48;*/
/*         padding: 8px 35px 8px 14px;*/
/*         font-weight: bold;*/
/*     }*/
/* */
/*     #content .SQLExplain h2 {*/
/*         font-size: 17px;*/
/*         margin-bottom: 0;*/
/*     }*/
/* */
/*     .query-trace {*/
/*         display: none;*/
/*         overflow: auto;*/
/*         padding: 5px;*/
/*         border: 1px solid silver;*/
/*         margin: 5px;*/
/*         border-radius: 5px;*/
/*         font-family: monospace;*/
/*         white-space: nowrap;*/
/*         color: #333;*/
/*     }*/
/* */
/*     .query-trace .gray {*/
/*         color: silver;*/
/*     }*/
/* */
/*     .query-trace .gray + .regular {*/
/*         margin-top: 3px;*/
/*     }*/
/*     .query-trace .regular + .gray {*/
/*         margin-top: 3px;*/
/*     }*/
/*     </style>*/
/* */
/*     <script>*/
/*         function toggle(id) {*/
/*             var el = document.getElementById(id);*/
/*             el.style.display = el.style.display === 'block' ? 'none' : 'block';*/
/*         }*/
/*     </script>*/
/* */
/*     <h2>Queries</h2>*/
/*     <table summary="Show logged queries">*/
/*         <thead>*/
/*             <tr>*/
/*                 <th>SQL queries</th>*/
/*             </tr>*/
/*         </thead>*/
/*         <tbody>*/
/*         {% if not collector.querycount %}*/
/*             <tr><td>No queries.</td></tr>*/
/*         {% else %}*/
/*             {% for i, query in collector.queries %}*/
/*             <tr>*/
/*                 <td>*/
/*                     <a name="propel-query-{{ i }}" ></a>*/
/*                     <code>{{ query.sql|format_sql|raw }}</code>*/
/*                     {% if app.request.query.has('query') and app.request.query.get('query') == i %}*/
/*                         <div class="SQLExplain">*/
/*                         {{ render(controller('PropelBundle:Panel:explain', {*/
/*                             'token': token,*/
/*                             'panel': 'propel',*/
/*                             'query': app.request.query.get('query'),*/
/*                             'connection': app.request.query.get('connection')*/
/*                         })) }}*/
/*                         </div>*/
/*                     {% endif %}*/
/*                     <div class="SQLInfo">*/
/*                         Time: {{ query.time }} - Memory: {{ query.memory|format_memory }} - Connection: {{ query.connection }} -*/
/*                         <a href="#" onclick="toggle('propel-stack-trace-{{ i }}'); return false;">Stacktrace</a>*/
/* */
/*                         {% if app.request.query.get('query', -1) != i %}*/
/*                             - <a href="{{ path('_profiler', {'panel': 'propel', 'token': token, 'connection': query.connection, 'query': i}) }}#propel-query-{{ i }}">Explain the query</a>*/
/*                         {% endif %}*/
/*                     </div>*/
/*                     <div id="propel-stack-trace-{{ i }}" class="query-trace">*/
/*                         {% for trace in query.stackTrace %}*/
/*                             <div class="{{*/
/*                             (': Symfony\\Component' in trace*/
/*                                 or ': Propel\\Runtime' in trace*/
/*                                 or ': Propel\\Bundle\\PropelBundle' in trace*/
/*                                 or ': call_user_func(Object(Symfony\\Component' in trace*/
/*                                 or ': call_user_func(Array, Object(Symfony\\Component' in trace*/
/*                             ) ? 'gray' : 'regular' }}">{{ trace }}</div>*/
/*                         {% endfor %}*/
/*                     </div>*/
/*                 </td>*/
/*             </tr>*/
/*             {% endfor %}*/
/*         {% endif %}*/
/*         </tbody>*/
/*     </table>*/
/* */
/*     {{ render(controller('PropelBundle:Panel:configuration')) }}*/
/* {% endblock %}*/
/* */
