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

/* @EasyAdmin/exception_standalone.html.twig */
class __TwigTemplate_657f4d348198f1bc77c266b361d7c468 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/exception_standalone.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("page_title.exception", ["%count%" => 1], "EasyAdminBundle"), "html", null, true);
        yield "</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; background: #fff; color: #1e293b; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .error-container { text-align: center; max-width: 600px; padding: 2rem; }
        h1 { font-size: 3rem; color: #64748b; margin: 0 0 1rem; }
        p { font-size: 1.1rem; color: #1e293b; }
        @media (prefers-color-scheme: dark) {
            body { background: #0a0a0a; color: #d4d4d4; }
            h1 { color: #737373; }
            p { color: #d4d4d4; }
        }
    </style>
</head>
<body>
    <div class=\"error-container\">
        <h1>";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exception"]) || array_key_exists("exception", $context) ? $context["exception"] : (function () { throw new RuntimeError('Variable "exception" does not exist.', 21, $this->source); })()), "statusCode", [], "any", false, false, false, 21), "html", null, true);
        yield "</h1>
        <p>";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exception"]) || array_key_exists("exception", $context) ? $context["exception"] : (function () { throw new RuntimeError('Variable "exception" does not exist.', 22, $this->source); })()), "publicMessage", [], "any", false, false, false, 22), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exception"]) || array_key_exists("exception", $context) ? $context["exception"] : (function () { throw new RuntimeError('Variable "exception" does not exist.', 22, $this->source); })()), "translationParameters", [], "any", false, false, false, 22), "EasyAdminBundle"), "html", null, true);
        yield "</p>
    </div>
</body>
</html>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/exception_standalone.html.twig";
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
        return array (  74 => 22,  70 => 21,  52 => 6,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>{{ 'page_title.exception'|trans({'%count%': 1}, 'EasyAdminBundle') }}</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; background: #fff; color: #1e293b; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .error-container { text-align: center; max-width: 600px; padding: 2rem; }
        h1 { font-size: 3rem; color: #64748b; margin: 0 0 1rem; }
        p { font-size: 1.1rem; color: #1e293b; }
        @media (prefers-color-scheme: dark) {
            body { background: #0a0a0a; color: #d4d4d4; }
            h1 { color: #737373; }
            p { color: #d4d4d4; }
        }
    </style>
</head>
<body>
    <div class=\"error-container\">
        <h1>{{ exception.statusCode }}</h1>
        <p>{{ exception.publicMessage|trans(exception.translationParameters, 'EasyAdminBundle') }}</p>
    </div>
</body>
</html>
", "@EasyAdmin/exception_standalone.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\exception_standalone.html.twig");
    }
}
