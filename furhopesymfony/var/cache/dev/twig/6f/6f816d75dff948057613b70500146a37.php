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

/* @EasyAdmin/components/ActionMenu/ActionList/Header.html.twig */
class __TwigTemplate_4dbad8ed6ed87de644c826bd62452dd5 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/components/ActionMenu/ActionList/Header.html.twig"));

        // line 1
        $propsNames = ['label', 'renderLabelRaw', 'icon', 'htmlAttributes'];
        $context['attributes'] = $context['attributes']->without(...$propsNames);
        if (isset($context['__props']['label'])) {
            $componentClass = isset($context['this']) ? get_debug_type($context['this']) : "";
            throw new \Twig\Error\RuntimeError('Cannot define prop "label" in template "@EasyAdmin/components/ActionMenu/ActionList/Header.html.twig". Property already defined in component class "'.$componentClass.'".');
        }
        if (!isset($context['label'])) {            $context['label'] = null;
        }        
        if (isset($context['__context']['label'])) {
            $context['label'] = null;
        }
        if (isset($context['__props']['renderLabelRaw'])) {
            $componentClass = isset($context['this']) ? get_debug_type($context['this']) : "";
            throw new \Twig\Error\RuntimeError('Cannot define prop "renderLabelRaw" in template "@EasyAdmin/components/ActionMenu/ActionList/Header.html.twig". Property already defined in component class "'.$componentClass.'".');
        }
        if (!isset($context['renderLabelRaw'])) {            $context['renderLabelRaw'] = false;
        }        
        if (isset($context['__context']['renderLabelRaw'])) {
            $context['renderLabelRaw'] = false;
        }
        if (isset($context['__props']['icon'])) {
            $componentClass = isset($context['this']) ? get_debug_type($context['this']) : "";
            throw new \Twig\Error\RuntimeError('Cannot define prop "icon" in template "@EasyAdmin/components/ActionMenu/ActionList/Header.html.twig". Property already defined in component class "'.$componentClass.'".');
        }
        if (!isset($context['icon'])) {            $context['icon'] = null;
        }        
        if (isset($context['__context']['icon'])) {
            $context['icon'] = null;
        }
        if (isset($context['__props']['htmlAttributes'])) {
            $componentClass = isset($context['this']) ? get_debug_type($context['this']) : "";
            throw new \Twig\Error\RuntimeError('Cannot define prop "htmlAttributes" in template "@EasyAdmin/components/ActionMenu/ActionList/Header.html.twig". Property already defined in component class "'.$componentClass.'".');
        }
        if (!isset($context['htmlAttributes'])) {            $context['htmlAttributes'] = [];
        }        
        if (isset($context['__context']['htmlAttributes'])) {
            $context['htmlAttributes'] = [];
        }
        foreach ($context['attributes']->all() as $key => $value) {
unset($context[$key]);
        }
        // line 7
        yield "
";
        // line 9
        $context["has_label"] = (( !((isset($context["label"]) || array_key_exists("label", $context) ? $context["label"] : (function () { throw new RuntimeError('Variable "label" does not exist.', 9, $this->source); })()) === false) &&  !(null === (isset($context["label"]) || array_key_exists("label", $context) ? $context["label"] : (function () { throw new RuntimeError('Variable "label" does not exist.', 9, $this->source); })()))) &&  !((isset($context["label"]) || array_key_exists("label", $context) ? $context["label"] : (function () { throw new RuntimeError('Variable "label" does not exist.', 9, $this->source); })()) === ""));
        // line 10
        if (((isset($context["has_label"]) || array_key_exists("has_label", $context) ? $context["has_label"] : (function () { throw new RuntimeError('Variable "has_label" does not exist.', 10, $this->source); })()) ||  !Twig\Extension\CoreExtension::testEmpty((isset($context["icon"]) || array_key_exists("icon", $context) ? $context["icon"] : (function () { throw new RuntimeError('Variable "icon" does not exist.', 10, $this->source); })())))) {
            // line 11
            yield "    <li ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["attributes"]) || array_key_exists("attributes", $context) ? $context["attributes"] : (function () { throw new RuntimeError('Variable "attributes" does not exist.', 11, $this->source); })()), "defaults", [Twig\Extension\CoreExtension::merge(["class" => "dropdown-header"], (isset($context["htmlAttributes"]) || array_key_exists("htmlAttributes", $context) ? $context["htmlAttributes"] : (function () { throw new RuntimeError('Variable "htmlAttributes" does not exist.', 11, $this->source); })()))], "method", false, false, false, 11), "html", null, true);
            yield ">";
            // line 12
            if ((($tmp = (isset($context["icon"]) || array_key_exists("icon", $context) ? $context["icon"] : (function () { throw new RuntimeError('Variable "icon" does not exist.', 12, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", [ ...CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["attributes"]) || array_key_exists("attributes", $context) ? $context["attributes"] : (function () { throw new RuntimeError('Variable "attributes" does not exist.', 12, $this->source); })()), "nested", ["icon"], "method", false, false, false, 12), "defaults", [["name" => (isset($context["icon"]) || array_key_exists("icon", $context) ? $context["icon"] : (function () { throw new RuntimeError('Variable "icon" does not exist.', 12, $this->source); })())]], "method", false, false, false, 12)]);
                yield " ";
            }
            // line 13
            if ((($tmp = (isset($context["has_label"]) || array_key_exists("has_label", $context) ? $context["has_label"] : (function () { throw new RuntimeError('Variable "has_label" does not exist.', 13, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["attributes"]) || array_key_exists("attributes", $context) ? $context["attributes"] : (function () { throw new RuntimeError('Variable "attributes" does not exist.', 13, $this->source); })()), "nested", ["label"], "method", false, false, false, 13), "html", null, true);
                yield ">";
                yield (((($tmp = (isset($context["renderLabelRaw"]) || array_key_exists("renderLabelRaw", $context) ? $context["renderLabelRaw"] : (function () { throw new RuntimeError('Variable "renderLabelRaw" does not exist.', 13, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ((isset($context["label"]) || array_key_exists("label", $context) ? $context["label"] : (function () { throw new RuntimeError('Variable "label" does not exist.', 13, $this->source); })())) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["label"]) || array_key_exists("label", $context) ? $context["label"] : (function () { throw new RuntimeError('Variable "label" does not exist.', 13, $this->source); })()), "html", null, true)));
                yield "</span>";
            }
            // line 14
            yield "</li>
";
        }
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/components/ActionMenu/ActionList/Header.html.twig";
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
        return array (  111 => 14,  103 => 13,  98 => 12,  94 => 11,  92 => 10,  90 => 9,  87 => 7,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% props
    label = null,
    renderLabelRaw = false,
    icon = null,
    htmlAttributes = {},
%}

{# don't use 'label is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
{% set has_label = label is not same as(false) and label is not null and label is not same as('') %}
{% if has_label or icon is not empty %}
    <li {{ attributes.defaults({class: 'dropdown-header'}|merge(htmlAttributes)) }}>
        {%- if icon %}{{ component('ea:Icon', { ...attributes.nested('icon').defaults({name: icon}) }) }} {% endif -%}
        {%- if has_label -%}<span {{ attributes.nested('label') }}>{{ renderLabelRaw ? label|raw : label }}</span>{%- endif -%}
    </li>
{% endif %}
", "@EasyAdmin/components/ActionMenu/ActionList/Header.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\components\\ActionMenu\\ActionList\\Header.html.twig");
    }
}
