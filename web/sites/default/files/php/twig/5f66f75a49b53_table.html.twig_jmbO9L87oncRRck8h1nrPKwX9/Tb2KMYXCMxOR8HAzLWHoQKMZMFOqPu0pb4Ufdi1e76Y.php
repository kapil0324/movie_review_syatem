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

/* themes/contrib/bootstrap/templates/system/table.html.twig */
class __TwigTemplate_419b2c6e4b6539dd9a73e53a2f527080f3a884a52f42c4e9e24f1e29b2379026 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 49, "set" => 53, "for" => 67];
        $filters = ["escape" => 62];
        $functions = ["cycle" => 99];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'for'],
                ['escape'],
                ['cycle']
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
        // line 49
        if (($context["responsive"] ?? null)) {
            // line 50
            echo "  <div class=\"table-responsive\">
";
        }
        // line 53
        $context["classes"] = [0 => "table", 1 => ((        // line 55
($context["bordered"] ?? null)) ? ("table-bordered") : ("")), 2 => ((        // line 56
($context["condensed"] ?? null)) ? ("table-condensed") : ("")), 3 => ((        // line 57
($context["hover"] ?? null)) ? ("table-hover") : ("")), 4 => ((        // line 58
($context["striped"] ?? null)) ? ("table-striped") : ("")), 5 => ((        // line 59
($context["sticky"] ?? null)) ? ("sticky-enabled") : (""))];
        // line 62
        echo "<table";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">
  ";
        // line 63
        if (($context["caption"] ?? null)) {
            // line 64
            echo "    <caption>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption"] ?? null)), "html", null, true);
            echo "</caption>
  ";
        }
        // line 66
        echo "
  ";
        // line 67
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["colgroups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["colgroup"]) {
            // line 68
            echo "    ";
            if ($this->getAttribute($context["colgroup"], "cols", [])) {
                // line 69
                echo "      <colgroup";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["colgroup"], "attributes", [])), "html", null, true);
                echo ">
        ";
                // line 70
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["colgroup"], "cols", []));
                foreach ($context['_seq'] as $context["_key"] => $context["col"]) {
                    // line 71
                    echo "          <col";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["col"], "attributes", [])), "html", null, true);
                    echo " />
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['col'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 73
                echo "      </colgroup>
    ";
            } else {
                // line 75
                echo "      <colgroup";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["colgroup"], "attributes", [])), "html", null, true);
                echo " />
    ";
            }
            // line 77
            echo "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['colgroup'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 78
        echo "
  ";
        // line 79
        if (($context["header"] ?? null)) {
            // line 80
            echo "    <thead>
      <tr>
        ";
            // line 82
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["header"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                // line 83
                echo "        ";
                // line 84
                $context["cell_classes"] = [0 => (($this->getAttribute(                // line 85
$context["cell"], "active_table_sort", [])) ? ("active") : (""))];
                // line 88
                echo "        <";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["cell"], "tag", [])), "html", null, true);
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["cell"], "attributes", []), "addClass", [0 => ($context["cell_classes"] ?? null)], "method")), "html", null, true);
                echo ">";
                // line 89
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["cell"], "content", [])), "html", null, true);
                // line 90
                echo "</";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["cell"], "tag", [])), "html", null, true);
                echo ">
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cell'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 92
            echo "      </tr>
    </thead>
  ";
        }
        // line 95
        echo "
  ";
        // line 96
        if (($context["rows"] ?? null)) {
            // line 97
            echo "    <tbody>
      ";
            // line 98
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 99
                echo "        ";
                $context["row_classes"] = [0 => twig_cycle([0 => "odd", 1 => "even"], $this->sandbox->ensureToStringAllowed($this->getAttribute($context["loop"], "index0", [])))];
                // line 100
                echo "        <tr";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["row"], "attributes", []), "addClass", [0 => ($context["row_classes"] ?? null)], "method")), "html", null, true);
                echo ">
          ";
                // line 101
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["row"], "cells", []));
                foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                    // line 102
                    echo "            <";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["cell"], "tag", [])), "html", null, true);
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["cell"], "attributes", [])), "html", null, true);
                    echo ">";
                    // line 103
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["cell"], "content", [])), "html", null, true);
                    // line 104
                    echo "</";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["cell"], "tag", [])), "html", null, true);
                    echo ">
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cell'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 106
                echo "        </tr>
      ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 108
            echo "    </tbody>
  ";
        } elseif (        // line 109
($context["empty"] ?? null)) {
            // line 110
            echo "    <tbody>
      <tr class=\"odd\">
        <td colspan=\"";
            // line 112
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["header_columns"] ?? null)), "html", null, true);
            echo "\" class=\"empty message\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["empty"] ?? null)), "html", null, true);
            echo "</td>
      </tr>
    </tbody>
  ";
        }
        // line 116
        echo "  ";
        if (($context["footer"] ?? null)) {
            // line 117
            echo "    <tfoot>
      ";
            // line 118
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["footer"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 119
                echo "        <tr";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["row"], "attributes", [])), "html", null, true);
                echo ">
          ";
                // line 120
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["row"], "cells", []));
                foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                    // line 121
                    echo "            <";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["cell"], "tag", [])), "html", null, true);
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["cell"], "attributes", [])), "html", null, true);
                    echo ">";
                    // line 122
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["cell"], "content", [])), "html", null, true);
                    // line 123
                    echo "</";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["cell"], "tag", [])), "html", null, true);
                    echo ">
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cell'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 125
                echo "        </tr>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 127
            echo "    </tfoot>
  ";
        }
        // line 129
        echo "</table>
";
        // line 130
        if (($context["responsive"] ?? null)) {
            // line 131
            echo "  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "themes/contrib/bootstrap/templates/system/table.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  301 => 131,  299 => 130,  296 => 129,  292 => 127,  285 => 125,  276 => 123,  274 => 122,  269 => 121,  265 => 120,  260 => 119,  256 => 118,  253 => 117,  250 => 116,  241 => 112,  237 => 110,  235 => 109,  232 => 108,  217 => 106,  208 => 104,  206 => 103,  201 => 102,  197 => 101,  192 => 100,  189 => 99,  172 => 98,  169 => 97,  167 => 96,  164 => 95,  159 => 92,  150 => 90,  148 => 89,  143 => 88,  141 => 85,  140 => 84,  138 => 83,  134 => 82,  130 => 80,  128 => 79,  125 => 78,  119 => 77,  113 => 75,  109 => 73,  100 => 71,  96 => 70,  91 => 69,  88 => 68,  84 => 67,  81 => 66,  75 => 64,  73 => 63,  68 => 62,  66 => 59,  65 => 58,  64 => 57,  63 => 56,  62 => 55,  61 => 53,  57 => 50,  55 => 49,);
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
 * Default theme implementation to display a table.
 *
 * Available variables:
 * - attributes: HTML attributes to apply to the <table> tag.
 * - caption: A localized string for the <caption> tag.
 * - colgroups: Column groups. Each group contains the following properties:
 *   - attributes: HTML attributes to apply to the <col> tag.
 *     Note: Drupal currently supports only one table header row, see
 *     https://www.drupal.org/node/893530 and
 *     http://api.drupal.org/api/drupal/includes!theme.inc/function/theme_table/7#comment-5109.
 * - header: Table header cells. Each cell contains the following properties:
 *   - tag: The HTML tag name to use; either TH or TD.
 *   - attributes: HTML attributes to apply to the tag.
 *   - content: A localized string for the title of the column.
 *   - field: Field name (required for column sorting).
 *   - sort: Default sort order for this column (\"asc\" or \"desc\").
 * - sticky: A flag indicating whether to use a \"sticky\" table header.
 * - rows: Table rows. Each row contains the following properties:
 *   - attributes: HTML attributes to apply to the <tr> tag.
 *   - data: Table cells.
 *   - no_striping: A flag indicating that the row should receive no
 *     'even / odd' styling. Defaults to FALSE.
 *   - cells: Table cells of the row. Each cell contains the following keys:
 *     - tag: The HTML tag name to use; either TH or TD.
 *     - attributes: Any HTML attributes, such as \"colspan\", to apply to the
 *       table cell.
 *     - content: The string to display in the table cell.
 *     - active_table_sort: A boolean indicating whether the cell is the active
 *       table sort.
 * - footer: Table footer rows, in the same format as the rows variable.
 * - empty: The message to display in an extra row if table does not have
 *   any rows.
 * - header_columns: The number of columns in the header.
 * - bordered: Flag indicating whether or not the table should be bordered.
 * - condensed: Flag indicating whether or not the table should be condensed.
 * - hover: Flag indicating whether or not table rows should be hoverable.
 * - striped: Flag indicating whether or not table rows should be striped.
 * - responsive: Flag indicating whether or not the table should be wrapped to
 *   be responsive (using the Bootstrap Framework .table-responsive wrapper).
 *
 * @ingroup templates
 *
 * @see template_preprocess_table()
 */
#}
{% if responsive %}
  <div class=\"table-responsive\">
{% endif %}
{%
  set classes = [
    'table',
    bordered ? 'table-bordered',
    condensed ? 'table-condensed',
    hover ? 'table-hover',
    striped ? 'table-striped',
    sticky ? 'sticky-enabled',
  ]
%}
<table{{ attributes.addClass(classes) }}>
  {% if caption %}
    <caption>{{ caption }}</caption>
  {% endif %}

  {% for colgroup in colgroups %}
    {% if colgroup.cols %}
      <colgroup{{ colgroup.attributes }}>
        {% for col in colgroup.cols %}
          <col{{ col.attributes }} />
        {% endfor %}
      </colgroup>
    {% else %}
      <colgroup{{ colgroup.attributes }} />
    {% endif %}
  {% endfor %}

  {% if header %}
    <thead>
      <tr>
        {% for cell in header %}
        {%
        set cell_classes = [
          cell.active_table_sort ? 'active',
        ]
        %}
        <{{ cell.tag }}{{ cell.attributes.addClass(cell_classes) }}>
        {{- cell.content -}}
      </{{ cell.tag }}>
      {% endfor %}
      </tr>
    </thead>
  {% endif %}

  {% if rows %}
    <tbody>
      {% for row in rows %}
        {% set row_classes = [cycle(['odd', 'even'], loop.index0)] %}
        <tr{{ row.attributes.addClass(row_classes) }}>
          {% for cell in row.cells %}
            <{{ cell.tag }}{{ cell.attributes }}>
              {{- cell.content -}}
            </{{ cell.tag }}>
          {% endfor %}
        </tr>
      {% endfor %}
    </tbody>
  {% elseif empty %}
    <tbody>
      <tr class=\"odd\">
        <td colspan=\"{{ header_columns }}\" class=\"empty message\">{{ empty }}</td>
      </tr>
    </tbody>
  {% endif %}
  {% if footer %}
    <tfoot>
      {% for row in footer %}
        <tr{{ row.attributes }}>
          {% for cell in row.cells %}
            <{{ cell.tag }}{{ cell.attributes }}>
              {{- cell.content -}}
            </{{ cell.tag }}>
          {% endfor %}
        </tr>
      {% endfor %}
    </tfoot>
  {% endif %}
</table>
{% if responsive %}
  </div>
{% endif %}
", "themes/contrib/bootstrap/templates/system/table.html.twig", "/Applications/MAMP/htdocs/drupal/movie/web/themes/contrib/bootstrap/templates/system/table.html.twig");
    }
}
