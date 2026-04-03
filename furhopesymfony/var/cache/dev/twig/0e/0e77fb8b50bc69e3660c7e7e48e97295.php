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

/* @EasyAdmin/crud/field/boolean.html.twig */
class __TwigTemplate_0608a0076ded4401bd9e1e6a61f8d0f0 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/field/boolean.html.twig"));

        // line 4
        $context["ea"] = $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->ea();
        // line 6
        yield "
";
        // line 7
        if (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 7, $this->source); })()), "crud", [], "any", false, false, false, 7), "currentAction", [], "any", false, false, false, 7) == "detail") ||  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 7, $this->source); })()), "customOptions", [], "any", false, false, false, 7), "get", ["renderAsSwitch"], "method", false, false, false, 7))) {
            // line 8
            yield "    ";
            $context["badge_is_hidden"] = ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 8, $this->source); })()), "crud", [], "any", false, false, false, 8), "currentAction", [], "any", false, false, false, 8) == "index") && (((CoreExtension::getAttribute($this->env, $this->source,             // line 10
(isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 10, $this->source); })()), "value", [], "any", false, false, false, 10) == true) && (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 10, $this->source); })()), "customOptions", [], "any", false, false, false, 10), "get", ["hideValueWhenTrue"], "method", false, false, false, 10) == true)) || ((CoreExtension::getAttribute($this->env, $this->source,             // line 12
(isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 12, $this->source); })()), "value", [], "any", false, false, false, 12) == false) && (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 12, $this->source); })()), "customOptions", [], "any", false, false, false, 12), "get", ["hideValueWhenFalse"], "method", false, false, false, 12) == true))));
            // line 14
            yield "
    ";
            // line 15
            if ((($tmp =  !(isset($context["badge_is_hidden"]) || array_key_exists("badge_is_hidden", $context) ? $context["badge_is_hidden"] : (function () { throw new RuntimeError('Variable "badge_is_hidden" does not exist.', 15, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 16
                yield "        <span class=\"badge ";
                yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 16, $this->source); })()), "value", [], "any", false, false, false, 16) == true)) ? ("badge-boolean-true") : ("badge-boolean-false"));
                yield "\">
            ";
                // line 17
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans((((CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 17, $this->source); })()), "value", [], "any", false, false, false, 17) == true)) ? ("label.true") : ("label.false")), [], "EasyAdminBundle"), "html", null, true);
                yield "
        </span>
    ";
            }
        } else {
            // line 21
            yield "    <div class=\"form-check form-switch\">
        <input type=\"checkbox\" class=\"form-check-input\" id=\"";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 22, $this->source); })()), "uniqueId", [], "any", false, false, false, 22), "html", null, true);
            yield "\" ";
            yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 22, $this->source); })()), "value", [], "any", false, false, false, 22) == true)) ? ("checked") : (""));
            yield "
            data-toggle-url=\"";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 23, $this->source); })()), "customOptions", [], "any", false, false, false, 23), "get", ["toggleUrl"], "method", false, false, false, 23), "html", null, true);
            yield "\"
            ";
            // line 24
            yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 24, $this->source); })()), "formTypeOption", ["disabled"], "method", false, false, false, 24) == true)) ? ("disabled") : (""));
            yield " autocomplete=\"off\">
        <label class=\"form-check-label\" for=\"";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 25, $this->source); })()), "uniqueId", [], "any", false, false, false, 25), "html", null, true);
            yield "\"></label>
    </div>
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
        return "@EasyAdmin/crud/field/boolean.html.twig";
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
        return array (  91 => 25,  87 => 24,  83 => 23,  77 => 22,  74 => 21,  67 => 17,  62 => 16,  60 => 15,  57 => 14,  55 => 12,  54 => 10,  52 => 8,  50 => 7,  47 => 6,  45 => 4,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{# @var field \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\FieldDto #}
{# @var entity \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\EntityDto #}
{% set ea = ea() %}
{% trans_default_domain 'EasyAdminBundle' %}

{% if ea.crud.currentAction == 'detail' or not field.customOptions.get('renderAsSwitch') %}
    {% set badge_is_hidden = ea.crud.currentAction == 'index'
        and (
            (field.value == true and field.customOptions.get('hideValueWhenTrue') == true)
            or
            (field.value == false and field.customOptions.get('hideValueWhenFalse') == true)
        ) %}

    {% if not badge_is_hidden %}
        <span class=\"badge {{ field.value == true ? 'badge-boolean-true' : 'badge-boolean-false' }}\">
            {{ (field.value == true ? 'label.true' : 'label.false')|trans }}
        </span>
    {% endif %}
{% else %}
    <div class=\"form-check form-switch\">
        <input type=\"checkbox\" class=\"form-check-input\" id=\"{{ field.uniqueId }}\" {{ field.value == true ? 'checked' }}
            data-toggle-url=\"{{ field.customOptions.get('toggleUrl') }}\"
            {{ field.formTypeOption('disabled') == true ? 'disabled' }} autocomplete=\"off\">
        <label class=\"form-check-label\" for=\"{{ field.uniqueId }}\"></label>
    </div>
{% endif %}
", "@EasyAdmin/crud/field/boolean.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\field\\boolean.html.twig");
    }
}
