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

/* post/_form.html.twig */
class __TwigTemplate_508d1cb1a94725dd3360fcee21b0d25e extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "post/_form.html.twig"));

        // line 1
        yield "<section class=\"social-card social-card--composer\">
    ";
        // line 2
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 2, $this->source); })()), 'form_start', ["attr" => ["class" => "social-compose-form social-compose-form--page"]]);
        yield "
        <div class=\"social-compose-form__main\">
            ";
        // line 4
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 4, $this->source); })()), "caption", [], "any", false, false, false, 4), 'label');
        yield "
            ";
        // line 5
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 5, $this->source); })()), "caption", [], "any", false, false, false, 5), 'widget', ["attr" => ["class" => "social-compose-form__caption"]]);
        yield "
            ";
        // line 6
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 6, $this->source); })()), "caption", [], "any", false, false, false, 6), 'errors');
        yield "
        </div>

        <div class=\"social-form-grid\">
            <div>
                ";
        // line 11
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 11, $this->source); })()), "mediaType", [], "any", false, false, false, 11), 'label');
        yield "
                ";
        // line 12
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 12, $this->source); })()), "mediaType", [], "any", false, false, false, 12), 'widget');
        yield "
                ";
        // line 13
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 13, $this->source); })()), "mediaType", [], "any", false, false, false, 13), 'errors');
        yield "
            </div>
            <div>
                ";
        // line 16
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 16, $this->source); })()), "visibility", [], "any", false, false, false, 16), 'label');
        yield "
                ";
        // line 17
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 17, $this->source); })()), "visibility", [], "any", false, false, false, 17), 'widget');
        yield "
                ";
        // line 18
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 18, $this->source); })()), "visibility", [], "any", false, false, false, 18), 'errors');
        yield "
            </div>
        </div>

        <div class=\"social-form-grid\">
            <div>
                ";
        // line 24
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 24, $this->source); })()), "mediaPath", [], "any", false, false, false, 24), 'label');
        yield "
                ";
        // line 25
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 25, $this->source); })()), "mediaPath", [], "any", false, false, false, 25), 'widget');
        yield "
                ";
        // line 26
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 26, $this->source); })()), "mediaPath", [], "any", false, false, false, 26), 'errors');
        yield "
            </div>
            <div>
                ";
        // line 29
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 29, $this->source); })()), "mediaFile", [], "any", false, false, false, 29), 'label');
        yield "
                ";
        // line 30
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 30, $this->source); })()), "mediaFile", [], "any", false, false, false, 30), 'widget');
        yield "
                ";
        // line 31
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 31, $this->source); })()), "mediaFile", [], "any", false, false, false, 31), 'errors');
        yield "
            </div>
        </div>

        ";
        // line 35
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "author", [], "any", true, true, false, 35)) {
            // line 36
            yield "            <div>
                ";
            // line 37
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 37, $this->source); })()), "author", [], "any", false, false, false, 37), 'label');
            yield "
                ";
            // line 38
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 38, $this->source); })()), "author", [], "any", false, false, false, 38), 'widget');
            yield "
                ";
            // line 39
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 39, $this->source); })()), "author", [], "any", false, false, false, 39), 'errors');
            yield "
            </div>
        ";
        }
        // line 42
        yield "
        ";
        // line 43
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 43, $this->source); })()), 'rest');
        yield "

        <div class=\"social-inline-actions\">
            <button type=\"submit\" class=\"button-primary\">";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("submit_label", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["submit_label"]) || array_key_exists("submit_label", $context) ? $context["submit_label"] : (function () { throw new RuntimeError('Variable "submit_label" does not exist.', 46, $this->source); })()), "Save post")) : ("Save post")), "html", null, true);
        yield "</button>
            <a class=\"button-secondary\" href=\"";
        // line 47
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("cancel_path", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["cancel_path"]) || array_key_exists("cancel_path", $context) ? $context["cancel_path"] : (function () { throw new RuntimeError('Variable "cancel_path" does not exist.', 47, $this->source); })()), $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("feed_index"))) : ($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("feed_index"))), "html", null, true);
        yield "\">Cancel</a>
        </div>
    ";
        // line 49
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 49, $this->source); })()), 'form_end', ["render_rest" => false]);
        yield "
</section>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "post/_form.html.twig";
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
        return array (  166 => 49,  161 => 47,  157 => 46,  151 => 43,  148 => 42,  142 => 39,  138 => 38,  134 => 37,  131 => 36,  129 => 35,  122 => 31,  118 => 30,  114 => 29,  108 => 26,  104 => 25,  100 => 24,  91 => 18,  87 => 17,  83 => 16,  77 => 13,  73 => 12,  69 => 11,  61 => 6,  57 => 5,  53 => 4,  48 => 2,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<section class=\"social-card social-card--composer\">
    {{ form_start(form, { attr: { class: 'social-compose-form social-compose-form--page' } }) }}
        <div class=\"social-compose-form__main\">
            {{ form_label(form.caption) }}
            {{ form_widget(form.caption, { attr: { class: 'social-compose-form__caption' } }) }}
            {{ form_errors(form.caption) }}
        </div>

        <div class=\"social-form-grid\">
            <div>
                {{ form_label(form.mediaType) }}
                {{ form_widget(form.mediaType) }}
                {{ form_errors(form.mediaType) }}
            </div>
            <div>
                {{ form_label(form.visibility) }}
                {{ form_widget(form.visibility) }}
                {{ form_errors(form.visibility) }}
            </div>
        </div>

        <div class=\"social-form-grid\">
            <div>
                {{ form_label(form.mediaPath) }}
                {{ form_widget(form.mediaPath) }}
                {{ form_errors(form.mediaPath) }}
            </div>
            <div>
                {{ form_label(form.mediaFile) }}
                {{ form_widget(form.mediaFile) }}
                {{ form_errors(form.mediaFile) }}
            </div>
        </div>

        {% if form.author is defined %}
            <div>
                {{ form_label(form.author) }}
                {{ form_widget(form.author) }}
                {{ form_errors(form.author) }}
            </div>
        {% endif %}

        {{ form_rest(form) }}

        <div class=\"social-inline-actions\">
            <button type=\"submit\" class=\"button-primary\">{{ submit_label|default('Save post') }}</button>
            <a class=\"button-secondary\" href=\"{{ cancel_path|default(path('feed_index')) }}\">Cancel</a>
        </div>
    {{ form_end(form, { render_rest: false }) }}
</section>
", "post/_form.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\post\\_form.html.twig");
    }
}
