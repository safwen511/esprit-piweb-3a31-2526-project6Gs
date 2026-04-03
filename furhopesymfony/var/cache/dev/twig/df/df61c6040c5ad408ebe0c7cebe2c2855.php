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

/* security/login.html.twig */
class __TwigTemplate_de51af406f6db11b18236ae4343abc79 extends Template
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
            'javascripts' => [$this, 'block_javascripts'],
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/login.html.twig"));

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

        yield "Sign in | FurHope";
        
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
            <div class=\"eyebrow\">Member access</div>
            <h1 style=\"font-size: 2.8rem;\">Sign in to FurHope</h1>
            <p class=\"muted\">Access your FurHope account to continue managing your profile and shelter activity.</p>

            <form method=\"post\" class=\"auth-form\" id=\"login-form\" novalidate>
                ";
        // line 13
        if ((($tmp = (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 13, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 14
            yield "                    <div class=\"flash flash-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 14, $this->source); })()), "messageKey", [], "any", false, false, false, 14), CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 14, $this->source); })()), "messageData", [], "any", false, false, false, 14), "security"), "html", null, true);
            yield "</div>
                ";
        }
        // line 16
        yield "
                <div class=\"form-group\">
                    <label for=\"username\">Email</label>
                    <input
                        type=\"email\"
                        id=\"username\"
                        name=\"_username\"
                        value=\"";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim((isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 23, $this->source); })())), "html", null, true);
        yield "\"
                        autocomplete=\"email\"
                        inputmode=\"email\"
                        required
                        autofocus
                        placeholder=\"name@example.com\"
                        aria-describedby=\"login-email-help login-email-error\"
                    >
                    <p class=\"form-help\" id=\"login-email-help\">Use the email address linked to your account.</p>
                    <p class=\"field-error\" id=\"login-email-error\"></p>
                </div>

                <div class=\"form-group\">
                    <label for=\"password\">Password</label>
                    <input
                        type=\"password\"
                        id=\"password\"
                        name=\"_password\"
                        autocomplete=\"current-password\"
                        required
                        placeholder=\"Enter your password\"
                        aria-describedby=\"login-password-error\"
                    >
                    <p class=\"field-error\" id=\"login-password-error\"></p>
                </div>

                <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 49
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        yield "\">

                <button class=\"button-primary\" type=\"submit\">Sign in</button>
            </form>
        </section>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 57
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 58
        yield "    <script>
        (() => {
            const form = document.getElementById('login-form');
            if (!form) {
                return;
            }

            const emailInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('login-email-error');
            const passwordError = document.getElementById('login-password-error');
            const emailPattern = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+\$/;

            const setFieldError = (input, errorNode, message) => {
                input.setAttribute('aria-invalid', message ? 'true' : 'false');
                errorNode.textContent = message;
                errorNode.classList.toggle('is-visible', Boolean(message));
            };

            const validateEmail = () => {
                const value = emailInput.value.trim();
                emailInput.value = value;

                if (!value) {
                    setFieldError(emailInput, emailError, 'Enter your email address.');
                    return false;
                }

                if (!emailPattern.test(value)) {
                    setFieldError(emailInput, emailError, 'Enter a valid email address.');
                    return false;
                }

                setFieldError(emailInput, emailError, '');
                return true;
            };

            const validatePassword = () => {
                const value = passwordInput.value;

                if (!value.trim()) {
                    setFieldError(passwordInput, passwordError, 'Enter your password.');
                    return false;
                }

                setFieldError(passwordInput, passwordError, '');
                return true;
            };

            emailInput.addEventListener('blur', validateEmail);
            emailInput.addEventListener('input', validateEmail);
            passwordInput.addEventListener('blur', validatePassword);
            passwordInput.addEventListener('input', validatePassword);

            form.addEventListener('submit', (event) => {
                const valid = validateEmail() && validatePassword();

                if (!valid) {
                    event.preventDefault();
                }
            });
        })();
    </script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "security/login.html.twig";
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
        return array (  166 => 58,  156 => 57,  141 => 49,  112 => 23,  103 => 16,  97 => 14,  95 => 13,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Sign in | FurHope{% endblock %}

{% block body %}
    <div class=\"auth-wrap\">
        <section class=\"panel form-card auth-card\">
            <div class=\"eyebrow\">Member access</div>
            <h1 style=\"font-size: 2.8rem;\">Sign in to FurHope</h1>
            <p class=\"muted\">Access your FurHope account to continue managing your profile and shelter activity.</p>

            <form method=\"post\" class=\"auth-form\" id=\"login-form\" novalidate>
                {% if error %}
                    <div class=\"flash flash-danger\">{{ error.messageKey|trans(error.messageData, 'security') }}</div>
                {% endif %}

                <div class=\"form-group\">
                    <label for=\"username\">Email</label>
                    <input
                        type=\"email\"
                        id=\"username\"
                        name=\"_username\"
                        value=\"{{ last_username|trim }}\"
                        autocomplete=\"email\"
                        inputmode=\"email\"
                        required
                        autofocus
                        placeholder=\"name@example.com\"
                        aria-describedby=\"login-email-help login-email-error\"
                    >
                    <p class=\"form-help\" id=\"login-email-help\">Use the email address linked to your account.</p>
                    <p class=\"field-error\" id=\"login-email-error\"></p>
                </div>

                <div class=\"form-group\">
                    <label for=\"password\">Password</label>
                    <input
                        type=\"password\"
                        id=\"password\"
                        name=\"_password\"
                        autocomplete=\"current-password\"
                        required
                        placeholder=\"Enter your password\"
                        aria-describedby=\"login-password-error\"
                    >
                    <p class=\"field-error\" id=\"login-password-error\"></p>
                </div>

                <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('authenticate') }}\">

                <button class=\"button-primary\" type=\"submit\">Sign in</button>
            </form>
        </section>
    </div>
{% endblock %}

{% block javascripts %}
    <script>
        (() => {
            const form = document.getElementById('login-form');
            if (!form) {
                return;
            }

            const emailInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('login-email-error');
            const passwordError = document.getElementById('login-password-error');
            const emailPattern = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+\$/;

            const setFieldError = (input, errorNode, message) => {
                input.setAttribute('aria-invalid', message ? 'true' : 'false');
                errorNode.textContent = message;
                errorNode.classList.toggle('is-visible', Boolean(message));
            };

            const validateEmail = () => {
                const value = emailInput.value.trim();
                emailInput.value = value;

                if (!value) {
                    setFieldError(emailInput, emailError, 'Enter your email address.');
                    return false;
                }

                if (!emailPattern.test(value)) {
                    setFieldError(emailInput, emailError, 'Enter a valid email address.');
                    return false;
                }

                setFieldError(emailInput, emailError, '');
                return true;
            };

            const validatePassword = () => {
                const value = passwordInput.value;

                if (!value.trim()) {
                    setFieldError(passwordInput, passwordError, 'Enter your password.');
                    return false;
                }

                setFieldError(passwordInput, passwordError, '');
                return true;
            };

            emailInput.addEventListener('blur', validateEmail);
            emailInput.addEventListener('input', validateEmail);
            passwordInput.addEventListener('blur', validatePassword);
            passwordInput.addEventListener('input', validatePassword);

            form.addEventListener('submit', (event) => {
                const valid = validateEmail() && validatePassword();

                if (!valid) {
                    event.preventDefault();
                }
            });
        })();
    </script>
{% endblock %}
", "security/login.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\security\\login.html.twig");
    }
}
