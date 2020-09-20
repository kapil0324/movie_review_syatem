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

/* themes/contrib/bootstrap/templates/bootstrap/item-list--dropdown.html.twig */
class __TwigTemplate_6e9db9ebcab4360ddd2e76d0c56c990098b0fc44aea7983da0526ede69174a8e extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 26, "if" => 32, "for" => 35];
        $filters = ["escape" => 34];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'for'],
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
        // line 26
        $context["classes"] = [0 => "dropdown-menu", 1 => (((        // line 28
($context["alignment"] ?? null) == "left")) ? ("dropdown-menu-left") : ("")), 2 => (((        // line 29
($context["alignment"] ?? null) == "right")) ? ("dropdown-menu-right") : (""))];
        // line 32
        if ((($context["items"] ?? null) || ($context["empty"] ?? null))) {
            // line 33
            if (($context["items"] ?? null)) {
                // line 34
                echo "<";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["list_type"] ?? null)), "html", null, true);
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
                echo " role=\"menu\">";
                // line 35
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 36
                    echo "<li";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "attributes", [])), "html", null, true);
                    echo ">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "value", [])), "html", null, true);
                    echo "</li>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 38
                echo "</";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["list_type"] ?? null)), "html", null, true);
                echo ">";
            } else {
                // line 40
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["empty"] ?? null)), "html", null, true);
            }
        }
    }

    public function getTemplateName()
    {
        return "themes/contrib/bootstrap/templates/bootstrap/item-list--dropdown.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 40,  82 => 38,  72 => 36,  68 => 35,  63 => 34,  61 => 33,  59 => 32,  57 => 29,  56 => 28,  55 => 26,);
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
 * Theme override for an item list.
 *
 * Available variables:
 * - alignment: (optional) The alignment of the dropdown menu.
 * - items: A list of items. Each item contains:
 *   - attributes: HTML attributes to be applied to each list item.
 *   - value: The content of the list element.
 * - title: The title of the list.
 * - list_type: The tag for list element (\"ul\" or \"ol\").
 * - wrapper_attributes: HTML attributes to be applied to the list wrapper.
 * - attributes: HTML attributes to be applied to the list.
 * - empty: A message to display when there are no items. Allowed value is a
 *   string or render array.
 * - context: A list of contextual data associated with the list. May contain:
 *   - list_style: The custom list style.
 *
 * @ingroup templates
 *
 * @see template_preprocess_item_list()
 */
#}
{%
  set classes = [
    'dropdown-menu',
    alignment == 'left' ? 'dropdown-menu-left',
    alignment == 'right' ? 'dropdown-menu-right',
  ]
%}
{% if items or empty -%}
  {%- if items -%}
    <{{ list_type }}{{ attributes.addClass(classes) }} role=\"menu\">
      {%- for item in items -%}
        <li{{ item.attributes }}>{{ item.value }}</li>
      {%- endfor -%}
    </{{ list_type }}>
  {%- else -%}
    {{- empty -}}
  {%- endif -%}
{%- endif %}
", "themes/contrib/bootstrap/templates/bootstrap/item-list--dropdown.html.twig", "/Applications/MAMP/htdocs/drupal/movie/web/themes/contrib/bootstrap/templates/bootstrap/item-list--dropdown.html.twig");
    }
}
