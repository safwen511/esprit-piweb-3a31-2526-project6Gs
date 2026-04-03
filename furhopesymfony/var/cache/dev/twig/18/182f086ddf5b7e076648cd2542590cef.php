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

/* @EasyAdmin/crud/field/code_editor.html.twig */
class __TwigTemplate_d5dad8681802401dad8c332bfa2548aa extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/field/code_editor.html.twig"));

        // line 4
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->ea(), "crud", [], "any", false, false, false, 4), "currentAction", [], "any", false, false, false, 4) == "detail")) {
            // line 5
            yield "    ";
            yield $this->getTemplateForMacro("macro_render_code_editor", $context, 5, $this->getSourceContext())->macro_render_code_editor(...[(isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 5, $this->source); })())]);
            yield "
";
        } else {
            // line 7
            yield "    ";
            $context["html_id"] = ("ea-code-editor-" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 7, $this->source); })()), "uniqueId", [], "any", false, false, false, 7));
            // line 8
            yield "    <a href=\"#\" data-bs-toggle=\"modal\" data-bs-target=\"#";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["html_id"]) || array_key_exists("html_id", $context) ? $context["html_id"] : (function () { throw new RuntimeError('Variable "html_id" does not exist.', 8, $this->source); })()), "html", null, true);
            yield "\">
        ";
            // line 9
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:code"]);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("field.code_editor.view_code", [], "EasyAdminBundle"), "html", null, true);
            yield "
    </a>

    <div class=\"modal fade\" id=\"";
            // line 12
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["html_id"]) || array_key_exists("html_id", $context) ? $context["html_id"] : (function () { throw new RuntimeError('Variable "html_id" does not exist.', 12, $this->source); })()), "html", null, true);
            yield "\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
        <div class=\"modal-dialog modal-lg\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header d-flex justify-content-between\">
                    <h5 class=\"modal-title\">";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 16, $this->source); })()), "label", [], "any", false, false, false, 16)), "html", null, true);
            yield "</h5>
                    ";
            // line 17
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Button", ["type" => "button", "isInvisible" => true, "icon" => "internal:xmark", "data-bs-dismiss" => "modal", "aria-label" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("action.close", [], "EasyAdminBundle")]);
            yield "
                </div>
                <div class=\"modal-body\">
                    ";
            // line 20
            yield $this->getTemplateForMacro("macro_render_code_editor", $context, 20, $this->getSourceContext())->macro_render_code_editor(...[(isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 20, $this->source); })())]);
            yield "
                </div>
            </div>
        </div>
    </div>
";
        }
        // line 26
        yield "
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 27
    public function macro_render_code_editor($field = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "field" => $field,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "render_code_editor"));

            // line 28
            yield "    ";
            $context["configuredHeight"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 28, $this->source); })()), "customOptions", [], "any", false, false, false, 28), "get", ["height"], "method", false, false, false, 28);
            // line 29
            yield "    <textarea
            readonly
            style=\"";
            // line 31
            yield (((null === (isset($context["configuredHeight"]) || array_key_exists("configuredHeight", $context) ? $context["configuredHeight"] : (function () { throw new RuntimeError('Variable "configuredHeight" does not exist.', 31, $this->source); })()))) ? ("max-height: 500px;") : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((("max-height: unset; height: " . (isset($context["configuredHeight"]) || array_key_exists("configuredHeight", $context) ? $context["configuredHeight"] : (function () { throw new RuntimeError('Variable "configuredHeight" does not exist.', 31, $this->source); })())) . "px"), "html", null, true)));
            yield "\"
            data-ea-code-editor-field=\"true\"
            data-language=\"";
            // line 33
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 33, $this->source); })()), "customOptions", [], "any", false, false, false, 33), "get", ["language"], "method", false, false, false, 33), "html");
            yield "\"
            data-tab-size=\"";
            // line 34
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 34, $this->source); })()), "customOptions", [], "any", false, false, false, 34), "get", ["tabSize"], "method", false, false, false, 34), "html");
            yield "\"
            data-indent-with-tabs=\"";
            // line 35
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 35, $this->source); })()), "customOptions", [], "any", false, false, false, 35), "get", ["indentWithTabs"], "method", false, false, false, 35)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("true") : ("false"));
            yield "\"
            data-show-line-numbers=\"";
            // line 36
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 36, $this->source); })()), "customOptions", [], "any", false, false, false, 36), "get", ["showLineNumbers"], "method", false, false, false, 36)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("true") : ("false"));
            yield "\"
            data-number-of-rows=\"";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 37, $this->source); })()), "customOptions", [], "any", false, false, false, 37), "get", ["numOfRows"], "method", false, false, false, 37), "html");
            yield "\"
    >";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["field"]) || array_key_exists("field", $context) ? $context["field"] : (function () { throw new RuntimeError('Variable "field" does not exist.', 39, $this->source); })()), "formattedValue", [], "any", false, false, false, 39));
            // line 40
            yield "</textarea>
";
            
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/crud/field/code_editor.html.twig";
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
        return array (  153 => 40,  151 => 39,  147 => 37,  143 => 36,  139 => 35,  135 => 34,  131 => 33,  126 => 31,  122 => 29,  119 => 28,  104 => 27,  95 => 26,  86 => 20,  80 => 17,  76 => 16,  69 => 12,  61 => 9,  56 => 8,  53 => 7,  47 => 5,  45 => 4,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{# @var field \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\FieldDto #}
{# @var entity \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\EntityDto #}
{% if ea().crud.currentAction == 'detail' %}
    {{ _self.render_code_editor(field) }}
{% else %}
    {% set html_id = 'ea-code-editor-' ~ field.uniqueId %}
    <a href=\"#\" data-bs-toggle=\"modal\" data-bs-target=\"#{{ html_id }}\">
        {{ component('ea:Icon', { name: 'internal:code' }) }} {{ 'field.code_editor.view_code'|trans([], domain: 'EasyAdminBundle') }}
    </a>

    <div class=\"modal fade\" id=\"{{ html_id }}\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
        <div class=\"modal-dialog modal-lg\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header d-flex justify-content-between\">
                    <h5 class=\"modal-title\">{{ field.label|trans }}</h5>
                    {{ component('ea:Button', { type: 'button', isInvisible: true, icon: 'internal:xmark', 'data-bs-dismiss': 'modal', 'aria-label': ('action.close'|trans([], domain: 'EasyAdminBundle')) }) }}
                </div>
                <div class=\"modal-body\">
                    {{ _self.render_code_editor(field) }}
                </div>
            </div>
        </div>
    </div>
{% endif %}

{% macro render_code_editor(field) %}
    {% set configuredHeight = field.customOptions.get('height') %}
    <textarea
            readonly
            style=\"{{ configuredHeight is null ? 'max-height: 500px;' : 'max-height: unset; height: ' ~ configuredHeight ~ 'px' }}\"
            data-ea-code-editor-field=\"true\"
            data-language=\"{{ field.customOptions.get('language')|e('html') }}\"
            data-tab-size=\"{{ field.customOptions.get('tabSize')|e('html') }}\"
            data-indent-with-tabs=\"{{ field.customOptions.get('indentWithTabs') ? 'true' : 'false' }}\"
            data-show-line-numbers=\"{{ field.customOptions.get('showLineNumbers') ? 'true' : 'false' }}\"
            data-number-of-rows=\"{{ field.customOptions.get('numOfRows')|e('html') }}\"
    >
        {{- field.formattedValue|escape -}}
    </textarea>
{% endmacro %}
", "@EasyAdmin/crud/field/code_editor.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\field\\code_editor.html.twig");
    }
}
