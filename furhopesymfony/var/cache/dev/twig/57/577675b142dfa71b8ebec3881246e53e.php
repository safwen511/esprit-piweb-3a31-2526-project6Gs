<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* @EasyAdmin/components/ActionMenu/ActionList/ItemGroup.html.twig */
class __TwigTemplate_0e1e7d6ce7e3a94d25292d4e3b719ab1 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/components/ActionMenu/ActionList/ItemGroup.html.twig"));

        // line 1
        $propsNames = ['group', 'showBlankIcons', 'entity'];
        $context['attributes'] = $context['attributes']->without(...$propsNames);
        if (isset($context['__props']['group'])) {
            $componentClass = isset($context['this']) ? get_debug_type($context['this']) : "";
            throw new \Twig\Error\RuntimeError('Cannot define prop "group" in template "@EasyAdmin/components/ActionMenu/ActionList/ItemGroup.html.twig". Property already defined in component class "'.$componentClass.'".');
        }
        if (!isset($context['group'])) {            $context['group'] = null;
        }        
        if (isset($context['__context']['group'])) {
            $context['group'] = null;
        }
        if (isset($context['__props']['showBlankIcons'])) {
            $componentClass = isset($context['this']) ? get_debug_type($context['this']) : "";
            throw new \Twig\Error\RuntimeError('Cannot define prop "showBlankIcons" in template "@EasyAdmin/components/ActionMenu/ActionList/ItemGroup.html.twig". Property already defined in component class "'.$componentClass.'".');
        }
        if (!isset($context['showBlankIcons'])) {            $context['showBlankIcons'] = true;
        }        
        if (isset($context['__context']['showBlankIcons'])) {
            $context['showBlankIcons'] = true;
        }
        if (isset($context['__props']['entity'])) {
            $componentClass = isset($context['this']) ? get_debug_type($context['this']) : "";
            throw new \Twig\Error\RuntimeError('Cannot define prop "entity" in template "@EasyAdmin/components/ActionMenu/ActionList/ItemGroup.html.twig". Property already defined in component class "'.$componentClass.'".');
        }
        if (!isset($context['entity'])) {            $context['entity'] = null;
        }        
        if (isset($context['__context']['entity'])) {
            $context['entity'] = null;
        }
        foreach ($context['attributes']->all() as $key => $value) {
unset($context[$key]);
        }
        // line 6
        yield "
<li class=\"dropstart dropdown-submenu\">
    ";
        // line 8
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 8, $this->source); })()), "hasMainAction", [], "any", false, false, false, 8) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 8, $this->source); })()), "mainAction", [], "any", false, false, false, 8))) {
            // line 9
            yield "        ";
            // line 10
            yield "        <div class=\"d-flex flex-row-reverse position-relative\">
            ";
            // line 11
            $context["formId"] = (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 11, $this->source); })()), "mainAction", [], "any", false, false, false, 11), "isRenderedAsForm", [], "any", false, false, false, 11)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ((("ea-form-" . Twig\Extension\CoreExtension::random($this->env->getCharset())) . Twig\Extension\CoreExtension::random($this->env->getCharset()))) : (null));
            // line 12
            yield "            ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 12, $this->source); })()), "mainAction", [], "any", false, false, false, 12), "isRenderedAsForm", [], "any", false, false, false, 12)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 13
                yield "                <form action=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 13, $this->source); })()), "mainAction", [], "any", false, false, false, 13), "linkUrl", [], "any", false, false, false, 13), "html", null, true);
                yield "\" method=\"POST\" ";
                if ((($tmp = (isset($context["formId"]) || array_key_exists("formId", $context) ? $context["formId"] : (function () { throw new RuntimeError('Variable "formId" does not exist.', 13, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "id=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["formId"]) || array_key_exists("formId", $context) ? $context["formId"] : (function () { throw new RuntimeError('Variable "formId" does not exist.', 13, $this->source); })()), "html", null, true);
                    yield "\"";
                }
                yield "></form>
            ";
            }
            // line 15
            yield "
            <a class=\"dropdown-item flex-grow-1 border-end-0 ";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 16, $this->source); })()), "mainAction", [], "any", false, false, false, 16), "cssClass", [], "any", false, false, false, 16), "html", null, true);
            yield "\"
                ";
            // line 17
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 17, $this->source); })()), "mainAction", [], "any", false, false, false, 17), "isRenderedAsForm", [], "any", false, false, false, 17)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 18
                yield "                    href=\"#\"
                    data-ea-action-form-id=\"";
                // line 19
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["formId"]) || array_key_exists("formId", $context) ? $context["formId"] : (function () { throw new RuntimeError('Variable "formId" does not exist.', 19, $this->source); })()), "html", null, true);
                yield "\"
                ";
            } else {
                // line 21
                yield "                    href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 21, $this->source); })()), "mainAction", [], "any", false, false, false, 21), "linkUrl", [], "any", false, false, false, 21), "html", null, true);
                yield "\"
                ";
            }
            // line 23
            yield "                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->processHtmlAttributes(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 23, $this->source); })()), "mainAction", [], "any", false, false, false, 23), "htmlAttributes", [], "any", false, false, false, 23)));
            foreach ($context['_seq'] as $context["attr"] => $context["value"]) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["attr"], "html", null, true);
                yield "=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html", null, true);
                yield "\" ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['attr'], $context['value'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            yield ">
                ";
            // line 24
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 24, $this->source); })()), "icon", [], "any", false, false, false, 24)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 25
                yield "                    ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 25, $this->source); })()), "icon", [], "any", false, false, false, 25)]);
                yield "
                ";
            } elseif ((            // line 26
(isset($context["showBlankIcons"]) || array_key_exists("showBlankIcons", $context) ? $context["showBlankIcons"] : (function () { throw new RuntimeError('Variable "showBlankIcons" does not exist.', 26, $this->source); })()) || CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 26, $this->source); })()), "hasAnyActionWithIcon", [], "any", false, false, false, 26))) {
                // line 27
                yield "                    ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:blank"]);
                yield "
                ";
            }
            // line 29
            yield "                    ";
            // line 30
            yield "                    ";
            if ((( !(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 30, $this->source); })()), "mainAction", [], "any", false, false, false, 30), "label", [], "any", false, false, false, 30) === false) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 30, $this->source); })()), "mainAction", [], "any", false, false, false, 30), "label", [], "any", false, false, false, 30))) &&  !(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 30, $this->source); })()), "mainAction", [], "any", false, false, false, 30), "label", [], "any", false, false, false, 30) === ""))) {
                // line 31
                yield "                    <span>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 31, $this->source); })()), "mainAction", [], "any", false, false, false, 31), "label", [], "any", false, false, false, 31)), "html", null, true);
                yield "</span>
                ";
            }
            // line 33
            yield "            </a>
            <a class=\"dropdown-toggle dropdown-toggle-split dropdown-item border-start-0\" href=\"#\" role=\"button\" data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\" aria-expanded=\"false\">
                <span class=\"dropdown-toggle-marker\"></span>
            </a>
        </div>
    ";
        } else {
            // line 39
            yield "        ";
            // line 40
            yield "        ";
            // line 41
            yield "        ";
            $context["has_group_label"] = (( !(CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 41, $this->source); })()), "label", [], "any", false, false, false, 41) === false) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 41, $this->source); })()), "label", [], "any", false, false, false, 41))) &&  !(CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 41, $this->source); })()), "label", [], "any", false, false, false, 41) === ""));
            // line 42
            yield "        <a class=\"dropdown-item dropdown-toggle\" href=\"#\" role=\"button\" data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\" aria-expanded=\"false\">
            ";
            // line 43
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 43, $this->source); })()), "icon", [], "any", false, false, false, 43)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 44
                yield "                ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 44, $this->source); })()), "icon", [], "any", false, false, false, 44)]);
                yield "
            ";
            } elseif ((            // line 45
(isset($context["showBlankIcons"]) || array_key_exists("showBlankIcons", $context) ? $context["showBlankIcons"] : (function () { throw new RuntimeError('Variable "showBlankIcons" does not exist.', 45, $this->source); })()) || CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 45, $this->source); })()), "hasAnyActionWithIcon", [], "any", false, false, false, 45))) {
                // line 46
                yield "                ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:blank"]);
                yield "
            ";
            }
            // line 48
            yield "            ";
            if ((($tmp = (isset($context["has_group_label"]) || array_key_exists("has_group_label", $context) ? $context["has_group_label"] : (function () { throw new RuntimeError('Variable "has_group_label" does not exist.', 48, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 48, $this->source); })()), "label", [], "any", false, false, false, 48)), "html", null, true);
                yield "</span>";
            }
            // line 49
            yield "        </a>
    ";
        }
        // line 51
        yield "
    ";
        // line 53
        yield "    <ul class=\"dropdown-menu\">
        ";
        // line 54
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 54, $this->source); })()), "items", [], "any", false, false, false, 54));
        foreach ($context['_seq'] as $context["_key"] => $context["subItem"]) {
            // line 55
            yield "            ";
            if ((is_iterable($context["subItem"]) && CoreExtension::getAttribute($this->env, $this->source, $context["subItem"], "type", [], "any", true, true, false, 55))) {
                // line 56
                yield "                ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["subItem"], "type", [], "any", false, false, false, 56) == "divider")) {
                    // line 57
                    yield "                    ";
                    yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Divider");
                    yield "
                ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 58
$context["subItem"], "type", [], "any", false, false, false, 58) == "header")) {
                    // line 59
                    yield "                    ";
                    yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Header", ["label" => CoreExtension::getAttribute($this->env, $this->source, $context["subItem"], "content", [], "any", false, false, false, 59), "renderLabelRaw" => "true"]);
                    yield "
                ";
                }
                // line 61
                yield "            ";
            } else {
                // line 62
                yield "                ";
                // line 63
                yield "                ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Item", ["class" => ((CoreExtension::getAttribute($this->env, $this->source, $context["subItem"], "cssClass", [], "any", false, false, false, 63) . " dropdown-item-variant-") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["subItem"], "variant", [], "any", false, false, false, 63), "value", [], "any", false, false, false, 63)), "label" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, $context["subItem"], "label", [], "any", false, false, false, 63)), "icon" => CoreExtension::getAttribute($this->env, $this->source, $context["subItem"], "icon", [], "any", false, false, false, 63), "htmlAttributes" => $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->processHtmlAttributes(CoreExtension::getAttribute($this->env, $this->source, $context["subItem"], "htmlAttributes", [], "any", false, false, false, 63)), "url" => CoreExtension::getAttribute($this->env, $this->source, $context["subItem"], "linkUrl", [], "any", false, false, false, 63), "renderLabelRaw" => "true", "renderAsForm" => CoreExtension::getAttribute($this->env, $this->source, $context["subItem"], "isRenderedAsForm", [], "any", false, false, false, 63), "showBlankIcons" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 63, $this->source); })()), "hasAnyActionWithIcon", [], "any", false, false, false, 63)]);
                yield "
            ";
            }
            // line 65
            yield "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['subItem'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        yield "    </ul>
</li>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/components/ActionMenu/ActionList/ItemGroup.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  260 => 66,  254 => 65,  248 => 63,  246 => 62,  243 => 61,  237 => 59,  235 => 58,  230 => 57,  227 => 56,  224 => 55,  220 => 54,  217 => 53,  214 => 51,  210 => 49,  203 => 48,  197 => 46,  195 => 45,  190 => 44,  188 => 43,  185 => 42,  182 => 41,  180 => 40,  178 => 39,  170 => 33,  164 => 31,  161 => 30,  159 => 29,  153 => 27,  151 => 26,  146 => 25,  144 => 24,  129 => 23,  123 => 21,  118 => 19,  115 => 18,  113 => 17,  109 => 16,  106 => 15,  94 => 13,  91 => 12,  89 => 11,  86 => 10,  84 => 9,  82 => 8,  78 => 6,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% props
    group = null,
    showBlankIcons = true,
    entity = null,
%}

<li class=\"dropstart dropdown-submenu\">
    {% if group.hasMainAction and group.mainAction %}
        {# split dropdown: main action + submenu toggle #}
        <div class=\"d-flex flex-row-reverse position-relative\">
            {% set formId = group.mainAction.isRenderedAsForm ? 'ea-form-' ~ random() ~ random() : null %}
            {% if group.mainAction.isRenderedAsForm %}
                <form action=\"{{ group.mainAction.linkUrl }}\" method=\"POST\" {% if formId %}id=\"{{ formId }}\"{% endif %}></form>
            {% endif %}

            <a class=\"dropdown-item flex-grow-1 border-end-0 {{ group.mainAction.cssClass }}\"
                {% if group.mainAction.isRenderedAsForm %}
                    href=\"#\"
                    data-ea-action-form-id=\"{{ formId }}\"
                {% else %}
                    href=\"{{ group.mainAction.linkUrl }}\"
                {% endif %}
                {% for attr, value in group.mainAction.htmlAttributes|ea_html_attrs %}{{ attr }}=\"{{ value }}\" {% endfor %}>
                {% if group.icon %}
                    {{ component('ea:Icon', { name: (group.icon) }) }}
                {% elseif showBlankIcons or group.hasAnyActionWithIcon %}
                    {{ component('ea:Icon', { name: 'internal:blank' }) }}
                {% endif %}
                    {# don't use 'label is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                    {% if group.mainAction.label is not same as(false) and group.mainAction.label is not null and group.mainAction.label is not same as('') %}
                    <span>{{ group.mainAction.label|trans }}</span>
                {% endif %}
            </a>
            <a class=\"dropdown-toggle dropdown-toggle-split dropdown-item border-start-0\" href=\"#\" role=\"button\" data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\" aria-expanded=\"false\">
                <span class=\"dropdown-toggle-marker\"></span>
            </a>
        </div>
    {% else %}
        {# regular submenu toggle #}
        {# don't use 'group.label is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
        {% set has_group_label = group.label is not same as(false) and group.label is not null and group.label is not same as('') %}
        <a class=\"dropdown-item dropdown-toggle\" href=\"#\" role=\"button\" data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\" aria-expanded=\"false\">
            {% if group.icon %}
                {{ component('ea:Icon', { name: (group.icon) }) }}
            {% elseif showBlankIcons or group.hasAnyActionWithIcon %}
                {{ component('ea:Icon', { name: 'internal:blank' }) }}
            {% endif %}
            {% if has_group_label %}<span>{{ group.label|trans }}</span>{% endif %}
        </a>
    {% endif %}

    {# nested ActionList for submenu items #}
    <ul class=\"dropdown-menu\">
        {% for subItem in group.items %}
            {% if subItem is iterable and subItem.type is defined %}
                {% if subItem.type == 'divider' %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                {% elseif subItem.type == 'header' %}
                    {{ component('ea:ActionMenu:ActionList:Header', { label: (subItem.content), renderLabelRaw: 'true' }) }}
                {% endif %}
            {% else %}
                {# subItem is an ActionDto #}
                {{ component('ea:ActionMenu:ActionList:Item', { class: (subItem.cssClass)~' dropdown-item-variant-'~(subItem.variant.value), label: (subItem.label|trans), icon: (subItem.icon), htmlAttributes: (subItem.htmlAttributes|ea_html_attrs), url: (subItem.linkUrl), renderLabelRaw: 'true', renderAsForm: (subItem.isRenderedAsForm), showBlankIcons: (group.hasAnyActionWithIcon) }) }}
            {% endif %}
        {% endfor %}
    </ul>
</li>
", "@EasyAdmin/components/ActionMenu/ActionList/ItemGroup.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\components\\ActionMenu\\ActionList\\ItemGroup.html.twig");
    }
}
