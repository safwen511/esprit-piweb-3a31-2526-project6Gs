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

/* @EasyAdmin/includes/_css_assets.html.twig */
class __TwigTemplate_de06332ad89a3e56601e592810c0de6c extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/includes/_css_assets.html.twig"));

        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["assets"]) || array_key_exists("assets", $context) ? $context["assets"] : (function () { throw new RuntimeError('Variable "assets" does not exist.', 2, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["css_asset"]) {
            // line 3
            yield "    ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["css_asset"], "preload", [], "any", false, false, false, 3)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 4
                yield "        ";
                // line 9
                yield "    ";
            } else {
                // line 10
                yield "        <link ";
                yield " rel=\"stylesheet\" href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(CoreExtension::getAttribute($this->env, $this->source, $context["css_asset"], "value", [], "any", false, false, false, 10), CoreExtension::getAttribute($this->env, $this->source, $context["css_asset"], "packageName", [], "any", false, false, false, 10)), "html", null, true);
                yield "\"";
                // line 11
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["css_asset"], "htmlAttributes", [], "any", false, false, false, 11));
                foreach ($context['_seq'] as $context["attr"] => $context["value"]) {
                    yield " ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["attr"], "html", null, true);
                    yield "=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html");
                    yield "\"";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['attr'], $context['value'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                yield ">
    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['css_asset'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/includes/_css_assets.html.twig";
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
        return array (  62 => 11,  57 => 10,  54 => 9,  52 => 4,  49 => 3,  45 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var assets \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\AssetDto[] #}
{% for css_asset in assets %}
    {% if css_asset.preload %}
        {% guard function preload %}
            {% set href = asset(css_asset.value, css_asset.packageName) %}
            <link {% guard function csp_nonce %}nonce=\"{{ csp_nonce('style') }}\"{% endguard %} rel=\"stylesheet\" href=\"{{ preload(href, {as: 'style', nopush: css_asset.nopush}) }}\"
            {%- for attr, value in css_asset.htmlAttributes %} {{ attr }}=\"{{ value|e('html') }}\"{% endfor %}>
        {% endguard %}
    {% else %}
        <link {% guard function csp_nonce %}nonce=\"{{ csp_nonce('style') }}\"{% endguard %} rel=\"stylesheet\" href=\"{{ asset(css_asset.value, css_asset.packageName) }}\"
        {%- for attr, value in css_asset.htmlAttributes %} {{ attr }}=\"{{ value|e('html') }}\"{% endfor %}>
    {% endif %}
{% endfor %}
", "@EasyAdmin/includes/_css_assets.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\includes\\_css_assets.html.twig");
    }
}
