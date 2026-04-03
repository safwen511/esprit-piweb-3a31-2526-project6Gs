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

/* registration/register.html.twig */
class __TwigTemplate_8461754b57578586783f8f5557d306cb extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/register.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Create account | FurHope";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "    <div class=\"auth-wrap\">
        <section class=\"panel form-card auth-card\">
            <div class=\"eyebrow\">Volunteer and staff registration</div>
            <h1 style=\"font-size: 2.8rem;\">Join the FurHope shelter team</h1>
            <p class=\"muted\">Create your account, verify your email, and request veterinaire review if it applies to your profile.</p>

            ";
        // line 12
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 12, $this->source); })()), 'form_start', ["attr" => ["class" => "auth-form", "novalidate" => "novalidate"]]);
        yield "
                <div class=\"form-group\">
                    ";
        // line 14
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 14, $this->source); })()), "firstName", [], "any", false, false, false, 14), 'label');
        yield "
                    ";
        // line 15
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 15, $this->source); })()), "firstName", [], "any", false, false, false, 15), 'widget', ["attr" => ["placeholder" => "First name", "autocomplete" => "given-name"]]);
        // line 20
        yield "
                    ";
        // line 21
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 21, $this->source); })()), "firstName", [], "any", false, false, false, 21), 'errors');
        yield "
                </div>

                <div class=\"form-group\">
                    ";
        // line 25
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 25, $this->source); })()), "lastName", [], "any", false, false, false, 25), 'label');
        yield "
                    ";
        // line 26
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 26, $this->source); })()), "lastName", [], "any", false, false, false, 26), 'widget', ["attr" => ["placeholder" => "Last name", "autocomplete" => "family-name"]]);
        // line 31
        yield "
                    ";
        // line 32
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 32, $this->source); })()), "lastName", [], "any", false, false, false, 32), 'errors');
        yield "
                </div>

                <div class=\"form-group\">
                    ";
        // line 36
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 36, $this->source); })()), "email", [], "any", false, false, false, 36), 'label');
        yield "
                    ";
        // line 37
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 37, $this->source); })()), "email", [], "any", false, false, false, 37), 'widget', ["attr" => ["placeholder" => "name@example.com", "autocomplete" => "email", "inputmode" => "email"]]);
        // line 43
        yield "
                    <p class=\"form-help\">Use a real email address so you can receive account verification.</p>
                    ";
        // line 45
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 45, $this->source); })()), "email", [], "any", false, false, false, 45), 'errors');
        yield "
                </div>

                <div class=\"form-group\">
                    ";
        // line 49
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 49, $this->source); })()), "phoneNumber", [], "any", false, false, false, 49), 'label');
        yield "
                    ";
        // line 50
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 50, $this->source); })()), "phoneNumber", [], "any", false, false, false, 50), 'widget', ["attr" => ["placeholder" => "+216 00 000 000", "autocomplete" => "tel", "inputmode" => "tel"]]);
        // line 56
        yield "
                    <p class=\"form-help\">Optional. Add a contact number only if you want shelter staff to reach you.</p>
                    ";
        // line 58
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 58, $this->source); })()), "phoneNumber", [], "any", false, false, false, 58), 'errors');
        yield "
                </div>

                <div class=\"form-group\">
                    <div class=\"checkbox-row\">
                        ";
        // line 63
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 63, $this->source); })()), "isVeteranApplicant", [], "any", false, false, false, 63), 'widget');
        yield "
                        ";
        // line 64
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 64, $this->source); })()), "isVeteranApplicant", [], "any", false, false, false, 64), 'label');
        yield "
                    </div>
                    ";
        // line 66
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 66, $this->source); })()), "isVeteranApplicant", [], "any", false, false, false, 66), 'errors');
        yield "
                </div>

                <div class=\"form-group\">
                    ";
        // line 70
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 70, $this->source); })()), "plainPassword", [], "any", false, false, false, 70), "first", [], "any", false, false, false, 70), 'label');
        yield "
                    ";
        // line 71
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 71, $this->source); })()), "plainPassword", [], "any", false, false, false, 71), "first", [], "any", false, false, false, 71), 'widget', ["attr" => ["placeholder" => "At least 8 characters", "autocomplete" => "new-password"]]);
        // line 76
        yield "
                    <p class=\"form-help\">Choose a password with at least 8 characters.</p>
                    ";
        // line 78
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 78, $this->source); })()), "plainPassword", [], "any", false, false, false, 78), "first", [], "any", false, false, false, 78), 'errors');
        yield "
                </div>

                <div class=\"form-group\">
                    ";
        // line 82
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 82, $this->source); })()), "plainPassword", [], "any", false, false, false, 82), "second", [], "any", false, false, false, 82), 'label');
        yield "
                    ";
        // line 83
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 83, $this->source); })()), "plainPassword", [], "any", false, false, false, 83), "second", [], "any", false, false, false, 83), 'widget', ["attr" => ["placeholder" => "Repeat your password", "autocomplete" => "new-password"]]);
        // line 88
        yield "
                    ";
        // line 89
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 89, $this->source); })()), "plainPassword", [], "any", false, false, false, 89), "second", [], "any", false, false, false, 89), 'errors');
        yield "
                </div>

                <div class=\"form-group\">
                    <div class=\"checkbox-row\">
                        ";
        // line 94
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 94, $this->source); })()), "agreeTerms", [], "any", false, false, false, 94), 'widget');
        yield "
                        ";
        // line 95
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 95, $this->source); })()), "agreeTerms", [], "any", false, false, false, 95), 'label', ["label" => "I agree to use FurHope responsibly for shelter work"]);
        yield "
                    </div>
                    ";
        // line 97
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 97, $this->source); })()), "agreeTerms", [], "any", false, false, false, 97), 'errors');
        yield "
                </div>

                ";
        // line 100
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 100, $this->source); })()), 'rest');
        yield "
                <button class=\"button-primary\" type=\"submit\">Create my account</button>
            ";
        // line 102
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 102, $this->source); })()), 'form_end');
        yield "
        </section>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "registration/register.html.twig";
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
        return array (  235 => 102,  230 => 100,  224 => 97,  219 => 95,  215 => 94,  207 => 89,  204 => 88,  202 => 83,  198 => 82,  191 => 78,  187 => 76,  185 => 71,  181 => 70,  174 => 66,  169 => 64,  165 => 63,  157 => 58,  153 => 56,  151 => 50,  147 => 49,  140 => 45,  136 => 43,  134 => 37,  130 => 36,  123 => 32,  120 => 31,  118 => 26,  114 => 25,  107 => 21,  104 => 20,  102 => 15,  98 => 14,  93 => 12,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Create account | FurHope{% endblock %}

{% block body %}
    <div class=\"auth-wrap\">
        <section class=\"panel form-card auth-card\">
            <div class=\"eyebrow\">Volunteer and staff registration</div>
            <h1 style=\"font-size: 2.8rem;\">Join the FurHope shelter team</h1>
            <p class=\"muted\">Create your account, verify your email, and request veterinaire review if it applies to your profile.</p>

            {{ form_start(registrationForm, { attr: { class: 'auth-form', novalidate: 'novalidate' } }) }}
                <div class=\"form-group\">
                    {{ form_label(registrationForm.firstName) }}
                    {{ form_widget(registrationForm.firstName, {
                        attr: {
                            placeholder: 'First name',
                            autocomplete: 'given-name'
                        }
                    }) }}
                    {{ form_errors(registrationForm.firstName) }}
                </div>

                <div class=\"form-group\">
                    {{ form_label(registrationForm.lastName) }}
                    {{ form_widget(registrationForm.lastName, {
                        attr: {
                            placeholder: 'Last name',
                            autocomplete: 'family-name'
                        }
                    }) }}
                    {{ form_errors(registrationForm.lastName) }}
                </div>

                <div class=\"form-group\">
                    {{ form_label(registrationForm.email) }}
                    {{ form_widget(registrationForm.email, {
                        attr: {
                            placeholder: 'name@example.com',
                            autocomplete: 'email',
                            inputmode: 'email'
                        }
                    }) }}
                    <p class=\"form-help\">Use a real email address so you can receive account verification.</p>
                    {{ form_errors(registrationForm.email) }}
                </div>

                <div class=\"form-group\">
                    {{ form_label(registrationForm.phoneNumber) }}
                    {{ form_widget(registrationForm.phoneNumber, {
                        attr: {
                            placeholder: '+216 00 000 000',
                            autocomplete: 'tel',
                            inputmode: 'tel'
                        }
                    }) }}
                    <p class=\"form-help\">Optional. Add a contact number only if you want shelter staff to reach you.</p>
                    {{ form_errors(registrationForm.phoneNumber) }}
                </div>

                <div class=\"form-group\">
                    <div class=\"checkbox-row\">
                        {{ form_widget(registrationForm.isVeteranApplicant) }}
                        {{ form_label(registrationForm.isVeteranApplicant) }}
                    </div>
                    {{ form_errors(registrationForm.isVeteranApplicant) }}
                </div>

                <div class=\"form-group\">
                    {{ form_label(registrationForm.plainPassword.first) }}
                    {{ form_widget(registrationForm.plainPassword.first, {
                        attr: {
                            placeholder: 'At least 8 characters',
                            autocomplete: 'new-password'
                        }
                    }) }}
                    <p class=\"form-help\">Choose a password with at least 8 characters.</p>
                    {{ form_errors(registrationForm.plainPassword.first) }}
                </div>

                <div class=\"form-group\">
                    {{ form_label(registrationForm.plainPassword.second) }}
                    {{ form_widget(registrationForm.plainPassword.second, {
                        attr: {
                            placeholder: 'Repeat your password',
                            autocomplete: 'new-password'
                        }
                    }) }}
                    {{ form_errors(registrationForm.plainPassword.second) }}
                </div>

                <div class=\"form-group\">
                    <div class=\"checkbox-row\">
                        {{ form_widget(registrationForm.agreeTerms) }}
                        {{ form_label(registrationForm.agreeTerms, 'I agree to use FurHope responsibly for shelter work') }}
                    </div>
                    {{ form_errors(registrationForm.agreeTerms) }}
                </div>

                {{ form_rest(registrationForm) }}
                <button class=\"button-primary\" type=\"submit\">Create my account</button>
            {{ form_end(registrationForm) }}
        </section>
    </div>
{% endblock %}
", "registration/register.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\registration\\register.html.twig");
    }
}
