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

/* themes/contrib/bootstrap/templates/input/datetime-wrapper.html.twig */
class __TwigTemplate_44a68bbb4303e11da8860726aab8ff43dec368beaf73eeacbfad9d5919ac9842 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 19, "if" => 24];
        $filters = ["escape" => 25];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
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
        // line 19
        $context["title_classes"] = [0 => "control-label", 1 => ((        // line 21
($context["required"] ?? null)) ? ("form-required") : (""))];
        // line 24
        if (($context["title"] ?? null)) {
            // line 25
            echo "  <label";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["title_attributes"] ?? null), "addClass", [0 => ($context["title_classes"] ?? null)], "method")), "html", null, true);
            echo ">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
            echo "</label>
";
        }
        // line 27
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null)), "html", null, true);
        echo "
";
        // line 28
        if (($context["errors"] ?? null)) {
            // line 29
            echo "  <div class=\"form-item--error-message alert alert-danger alert-sm\">
    ";
            // line 30
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["errors"] ?? null)), "html", null, true);
            echo "
  </div>
";
        }
        // line 33
        if (($context["description"] ?? null)) {
            // line 34
            echo "  <p class=\"help-block\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["description"] ?? null)), "html", null, true);
            echo "</p>
";
        }
    }

    public function getTemplateName()
    {
        return "themes/contrib/bootstrap/templates/input/datetime-wrapper.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 34,  83 => 33,  77 => 30,  74 => 29,  72 => 28,  68 => 27,  60 => 25,  58 => 24,  56 => 21,  55 => 19,);
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
 * Default theme implementation of a datetime form wrapper.
 *
 * Available variables:
 * - content: The form element to be output, usually a datelist, or datetime.
 * - title: The title of the form element.
 * - title_attributes: HTML attributes for the title wrapper.
 * - description: Description text for the form element.
 * - required: An indicator for whether the associated form element is required.
 *
 * @ingroup templates
 *
 * @see template_preprocess_datetime_wrapper()
 */
#}
{%
  set title_classes = [
    'control-label',
    required ? 'form-required',
  ]
%}
{% if title %}
  <label{{ title_attributes.addClass(title_classes) }}>{{ title }}</label>
{% endif %}
{{ content }}
{% if errors %}
  <div class=\"form-item--error-message alert alert-danger alert-sm\">
    {{ errors }}
  </div>
{% endif %}
{% if description %}
  <p class=\"help-block\">{{ description }}</p>
{% endif %}
", "themes/contrib/bootstrap/templates/input/datetime-wrapper.html.twig", "/Applications/MAMP/htdocs/drupal/movie/web/themes/contrib/bootstrap/templates/input/datetime-wrapper.html.twig");
    }
}
