<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/movie_utility/templates/homepage-slider.html.twig */
class __TwigTemplate_c076a71908a6f6972bcee87d1b0815c4871265e89f3030ab8e362f47eeb8bbdc extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 11, "for" => 16];
        $filters = ["escape" => 17, "striptags" => 26];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for'],
                ['escape', 'striptags'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 11
        if ( !twig_test_empty(($context["data"] ?? null))) {
            // line 12
            echo "<div class=\"container\">
  <div id=\"myCarousel1\" class=\"carousel slide\" data-ride=\"carousel\">
    <!-- Indicators -->
    <ol class=\"carousel-indicators\">
      ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["result"]) {
                // line 17
                echo "      <li data-target=\"#myCarousel1\" data-slide-to=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["key"]), "html", null, true);
                echo "\" class=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["result"], "active", [])), "html", null, true);
                echo "\"></li>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['result'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            echo "    </ol>
    <!-- Wrapper for slides -->
    <div class=\"carousel-inner\">
      ";
            // line 22
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["result"]) {
                // line 23
                echo "      <div class=\"item ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["result"], "active", [])), "html", null, true);
                echo "\">
        <img src=\"";
                // line 24
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["result"], "image", [])), "html", null, true);
                echo "\" alt=\"Los Angeles\" style=\"width:100%;\">
        <div class=\"carousel-caption\">
          <h3>";
                // line 26
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, strip_tags($this->sandbox->ensureToStringAllowed($this->getAttribute($context["result"], "title", []))), "html", null, true);
                echo "</h3>
          <p>";
                // line 27
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, strip_tags($this->sandbox->ensureToStringAllowed($this->getAttribute($context["result"], "body", []))), "html", null, true);
                echo "</p>
        </div>
      </div>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['result'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 30
            echo "   
    </div>
    <!-- Left and right controls -->
    <a class=\"left carousel-control\" href=\"#myCarousel1\" data-slide=\"prev\">
    <span class=\"glyphicon glyphicon-chevron-left\"></span>
    <span class=\"sr-only\">Previous</span>
    </a>
    <a class=\"right carousel-control\" href=\"#myCarousel1\" data-slide=\"next\">
    <span class=\"glyphicon glyphicon-chevron-right\"></span>
    <span class=\"sr-only\">Next</span>
    </a>
  </div>
</div>
";
        }
        // line 44
        echo "<div id=\"myModal\" class=\"modal fade\" role=\"dialog\">
  <div class=\"modal-dialog\">
    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        <h4 class=\"modal-title\">Hello ";
        // line 50
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["data"] ?? null), 0, []), "name", [])), "html", null, true);
        echo "</h4>
      </div>
      <div class=\"modal-body\">
        <div class=\"modal-carousel\">
          ";
        // line 54
        if ( !twig_test_empty(($context["data"] ?? null))) {
            // line 55
            echo "          <div id=\"myCarousel\" class=\"carousel slide\" data-ride=\"carousel\">
            <!-- Indicators -->
            <ol class=\"carousel-indicators\">
              ";
            // line 58
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["result"]) {
                // line 59
                echo "              <li data-target=\"#myCarousel\" data-slide-to=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["key"]), "html", null, true);
                echo "\" class=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["result"], "active", [])), "html", null, true);
                echo "\"></li>
              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['result'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 61
            echo "            </ol>
            <!-- Wrapper for slides -->
            <div class=\"carousel-inner\">
              ";
            // line 64
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["result"]) {
                // line 65
                echo "              <div class=\"item ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["result"], "active", [])), "html", null, true);
                echo "\">
                <img src=\"";
                // line 66
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["result"], "image", [])), "html", null, true);
                echo "\" alt=\"movie\" >
                <div class=\"carousel-caption\">
                  <h3>";
                // line 68
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, strip_tags($this->sandbox->ensureToStringAllowed($this->getAttribute($context["result"], "title", []))), "html", null, true);
                echo "</h3>
                  <p>";
                // line 69
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, strip_tags($this->sandbox->ensureToStringAllowed($this->getAttribute($context["result"], "body", []))), "html", null, true);
                echo "</p>
                </div>
              </div>
              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['result'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 72
            echo "   
            </div>
            <!-- Left and right controls -->
            <a class=\"left carousel-control\" href=\"#myCarousel\" data-slide=\"prev\">
            <span class=\"glyphicon glyphicon-chevron-left\"></span>
            <span class=\"sr-only\">Previous</span>
            </a>
            <a class=\"right carousel-control\" href=\"#myCarousel\" data-slide=\"next\">
            <span class=\"glyphicon glyphicon-chevron-right\"></span>
            <span class=\"sr-only\">Next</span>
            </a>
          </div>
        </div>
        ";
        }
        // line 86
        echo "      </div>
    </div>
  </div>
</div>
</div>";
    }

    public function getTemplateName()
    {
        return "modules/custom/movie_utility/templates/homepage-slider.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  213 => 86,  197 => 72,  187 => 69,  183 => 68,  178 => 66,  173 => 65,  169 => 64,  164 => 61,  153 => 59,  149 => 58,  144 => 55,  142 => 54,  135 => 50,  127 => 44,  111 => 30,  101 => 27,  97 => 26,  92 => 24,  87 => 23,  83 => 22,  78 => 19,  67 => 17,  63 => 16,  57 => 12,  55 => 11,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
* @file
* Default theme implementation to display a block.
*
* @see template_preprocess_block()
*
* @ingroup themeable
*/
#}
{% if data is not empty %}
<div class=\"container\">
  <div id=\"myCarousel1\" class=\"carousel slide\" data-ride=\"carousel\">
    <!-- Indicators -->
    <ol class=\"carousel-indicators\">
      {% for key,result in data %}
      <li data-target=\"#myCarousel1\" data-slide-to=\"{{ key }}\" class=\"{{ result.active }}\"></li>
      {% endfor %}
    </ol>
    <!-- Wrapper for slides -->
    <div class=\"carousel-inner\">
      {% for result in data %}
      <div class=\"item {{ result.active }}\">
        <img src=\"{{ result.image }}\" alt=\"Los Angeles\" style=\"width:100%;\">
        <div class=\"carousel-caption\">
          <h3>{{ result.title|striptags }}</h3>
          <p>{{ result.body|striptags }}</p>
        </div>
      </div>
      {% endfor %}   
    </div>
    <!-- Left and right controls -->
    <a class=\"left carousel-control\" href=\"#myCarousel1\" data-slide=\"prev\">
    <span class=\"glyphicon glyphicon-chevron-left\"></span>
    <span class=\"sr-only\">Previous</span>
    </a>
    <a class=\"right carousel-control\" href=\"#myCarousel1\" data-slide=\"next\">
    <span class=\"glyphicon glyphicon-chevron-right\"></span>
    <span class=\"sr-only\">Next</span>
    </a>
  </div>
</div>
{% endif %}
<div id=\"myModal\" class=\"modal fade\" role=\"dialog\">
  <div class=\"modal-dialog\">
    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        <h4 class=\"modal-title\">Hello {{ data.0.name }}</h4>
      </div>
      <div class=\"modal-body\">
        <div class=\"modal-carousel\">
          {% if data is not empty %}
          <div id=\"myCarousel\" class=\"carousel slide\" data-ride=\"carousel\">
            <!-- Indicators -->
            <ol class=\"carousel-indicators\">
              {% for key,result in data %}
              <li data-target=\"#myCarousel\" data-slide-to=\"{{ key }}\" class=\"{{ result.active }}\"></li>
              {% endfor %}
            </ol>
            <!-- Wrapper for slides -->
            <div class=\"carousel-inner\">
              {% for result in data %}
              <div class=\"item {{ result.active }}\">
                <img src=\"{{ result.image }}\" alt=\"movie\" >
                <div class=\"carousel-caption\">
                  <h3>{{ result.title|striptags }}</h3>
                  <p>{{ result.body|striptags }}</p>
                </div>
              </div>
              {% endfor %}   
            </div>
            <!-- Left and right controls -->
            <a class=\"left carousel-control\" href=\"#myCarousel\" data-slide=\"prev\">
            <span class=\"glyphicon glyphicon-chevron-left\"></span>
            <span class=\"sr-only\">Previous</span>
            </a>
            <a class=\"right carousel-control\" href=\"#myCarousel\" data-slide=\"next\">
            <span class=\"glyphicon glyphicon-chevron-right\"></span>
            <span class=\"sr-only\">Next</span>
            </a>
          </div>
        </div>
        {% endif %}
      </div>
    </div>
  </div>
</div>
</div>", "modules/custom/movie_utility/templates/homepage-slider.html.twig", "/Applications/MAMP/htdocs/drupal/movie/web/modules/custom/movie_utility/templates/homepage-slider.html.twig");
    }
}
