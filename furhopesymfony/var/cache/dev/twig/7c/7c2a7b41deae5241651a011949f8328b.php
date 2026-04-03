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

/* @EasyAdmin/flash_messages.html.twig */
class __TwigTemplate_0d25e02dad30dad5d35d00cf4d4f7c48 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/flash_messages.html.twig"));

        // line 2
        $context["ea"] = $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->ea();
        // line 3
        $context["__internal_trans_default_domaind444a0e6281c9ff51a4b0b3518ca397b"] = (((null != (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 3, $this->source); })()))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 3, $this->source); })()), "i18n", [], "any", false, false, false, 3), "translationDomain", [], "any", false, false, false, 3)) : (((array_key_exists("translation_domain", $context)) ? ((((array_key_exists("translation_domain", $context) &&  !(null === $context["translation_domain"]))) ? ($context["translation_domain"]) : ("messages"))) : (""))));
        // line 4
        yield "
";
        // line 5
        $context["flash_messages"] = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 5, $this->source); })()), "flashes", [], "any", false, false, false, 5);
        // line 6
        yield "
";
        // line 7
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["flash_messages"]) || array_key_exists("flash_messages", $context) ? $context["flash_messages"] : (function () { throw new RuntimeError('Variable "flash_messages" does not exist.', 7, $this->source); })())) > 0)) {
            // line 8
            yield "    <div id=\"flash-messages\">
        ";
            // line 9
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["flash_messages"]) || array_key_exists("flash_messages", $context) ? $context["flash_messages"] : (function () { throw new RuntimeError('Variable "flash_messages" does not exist.', 9, $this->source); })()));
            foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
                // line 10
                yield "            ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
                foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                    // line 11
                    yield "                ";
                    // line 13
                    yield "                ";
                    $context["translated_message"] = $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans($context["message"], [],                     // line 3
(isset($context["__internal_trans_default_domaind444a0e6281c9ff51a4b0b3518ca397b"]) || array_key_exists("__internal_trans_default_domaind444a0e6281c9ff51a4b0b3518ca397b", $context) ? $context["__internal_trans_default_domaind444a0e6281c9ff51a4b0b3518ca397b"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domaind444a0e6281c9ff51a4b0b3518ca397b" does not exist.', 3, $this->source); })()));
                    // line 14
                    yield "                ";
                    $_v0 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
                    $preRendered = $_v0->preRender("ea:Alert", Twig\Extension\CoreExtension::toArray(["variant" => $context["label"], "withDismissButton" => true]));
                    if (null !== $preRendered) {
                        yield $preRendered; 
                    } else {
                        $preRenderEvent = $_v0->startEmbedComponent("ea:Alert", Twig\Extension\CoreExtension::toArray(["variant" => $context["label"], "withDismissButton" => true]), $context, "@EasyAdmin/flash_messages.html.twig", 15523601871);
                        $embeddedContext = $preRenderEvent->getVariables();
                        $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
                        $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
                        $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 15523601871);
                        $this->load("@EasyAdmin/flash_messages.html.twig", 14, "15523601871")->display($embeddedContext, $embeddedBlocks);
                        $_v0->finishEmbedComponent();
                    }
                    // line 17
                    yield "            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 18
                yield "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            yield "    </div>
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
        return "@EasyAdmin/flash_messages.html.twig";
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
        return array (  104 => 19,  98 => 18,  92 => 17,  77 => 14,  75 => 3,  73 => 13,  71 => 11,  66 => 10,  62 => 9,  59 => 8,  57 => 7,  54 => 6,  52 => 5,  49 => 4,  47 => 3,  45 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Provider\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain null != ea ? ea.i18n.translationDomain : (translation_domain is defined ? translation_domain ?? 'messages') %}

{% set flash_messages = app.flashes %}

{% if flash_messages|length > 0 %}
    <div id=\"flash-messages\">
        {% for label, messages in flash_messages %}
            {% for message in messages %}
                {# the message must be translated outside of the Twig component because
                   the trans_default_domain value is ignored inside the component #}
                {% set translated_message = message|trans %}
                {% component 'ea:Alert' with { variant: (label), withDismissButton: true } %}
                    {% block content %}{{ translated_message|raw }}
                {% endblock %}{% endcomponent %}
            {% endfor %}
        {% endfor %}
    </div>
{% endif %}
", "@EasyAdmin/flash_messages.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\flash_messages.html.twig");
    }
}


/* @EasyAdmin/flash_messages.html.twig */
class __TwigTemplate_0d25e02dad30dad5d35d00cf4d4f7c48___15523601871 extends Template
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
            'outer__block_fallback' => [$this, 'block_outer__block_fallback'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 14
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 14, $this->source); })()), 14);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/flash_messages.html.twig"));

        yield from $this->getParent($context)->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_outer__block_fallback(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "outer__block_fallback"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 15
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        yield (isset($context["translated_message"]) || array_key_exists("translated_message", $context) ? $context["translated_message"] : (function () { throw new RuntimeError('Variable "translated_message" does not exist.', 15, $this->source); })());
        yield "
                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/flash_messages.html.twig";
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
        return array (  219 => 15,  188 => 14,  104 => 19,  98 => 18,  92 => 17,  77 => 14,  75 => 3,  73 => 13,  71 => 11,  66 => 10,  62 => 9,  59 => 8,  57 => 7,  54 => 6,  52 => 5,  49 => 4,  47 => 3,  45 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Provider\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain null != ea ? ea.i18n.translationDomain : (translation_domain is defined ? translation_domain ?? 'messages') %}

{% set flash_messages = app.flashes %}

{% if flash_messages|length > 0 %}
    <div id=\"flash-messages\">
        {% for label, messages in flash_messages %}
            {% for message in messages %}
                {# the message must be translated outside of the Twig component because
                   the trans_default_domain value is ignored inside the component #}
                {% set translated_message = message|trans %}
                {% component 'ea:Alert' with { variant: (label), withDismissButton: true } %}
                    {% block content %}{{ translated_message|raw }}
                {% endblock %}{% endcomponent %}
            {% endfor %}
        {% endfor %}
    </div>
{% endif %}
", "@EasyAdmin/flash_messages.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\flash_messages.html.twig");
    }
}
