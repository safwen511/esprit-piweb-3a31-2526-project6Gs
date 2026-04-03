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

/* @EasyAdmin/crud/includes/_action_confirmation_modal.html.twig */
class __TwigTemplate_d003c7da9d95a3a489705984f106da31 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig"));

        // line 3
        yield "<form class=\"d-none\" method=\"post\" id=\"action-confirmation-form\">
    ";
        // line 5
        yield "        <input type=\"hidden\" name=\"token\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("ea-delete"), "html", null, true);
        yield "\" />
    ";
        // line 7
        yield "</form>

<div id=\"modal-action-confirmation\" class=\"modal fade\" tabindex=\"-1\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-body\">
                <h4 id=\"action-confirmation-title\">";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("action_confirmation_modal.title", [], "EasyAdminBundle"), "html", null, true);
        yield "</h4>
            </div>
            <div class=\"modal-footer\">
                ";
        // line 16
        $_v0 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v0->preRender("ea:Button", Twig\Extension\CoreExtension::toArray(["type" => "button", "data-bs-dismiss" => "modal"]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v0->startEmbedComponent("ea:Button", Twig\Extension\CoreExtension::toArray(["type" => "button", "data-bs-dismiss" => "modal"]), $context, "@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig", 26654442581);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 26654442581);
            $this->load("@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig", 16, "26654442581")->display($embeddedContext, $embeddedBlocks);
            $_v0->finishEmbedComponent();
        }
        // line 19
        yield "
                ";
        // line 20
        $_v1 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v1->preRender("ea:Button", Twig\Extension\CoreExtension::toArray(["type" => "button", "variant" => "danger", "data-bs-dismiss" => "modal", "id" => "modal-action-confirmation-button"]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v1->startEmbedComponent("ea:Button", Twig\Extension\CoreExtension::toArray(["type" => "button", "variant" => "danger", "data-bs-dismiss" => "modal", "id" => "modal-action-confirmation-button"]), $context, "@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig", 15530407241);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 15530407241);
            $this->load("@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig", 20, "15530407241")->display($embeddedContext, $embeddedBlocks);
            $_v1->finishEmbedComponent();
        }
        // line 23
        yield "            </div>
        </div>
    </div>
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
        return "@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig";
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
        return array (  98 => 23,  84 => 20,  81 => 19,  67 => 16,  61 => 13,  53 => 7,  48 => 5,  45 => 3,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{# Hidden form for POST-based actions (like DELETE) with CSRF protection #}
<form class=\"d-none\" method=\"post\" id=\"action-confirmation-form\">
    {% guard function csrf_token %}
        <input type=\"hidden\" name=\"token\" value=\"{{ csrf_token('ea-delete') }}\" />
    {% endguard %}
</form>

<div id=\"modal-action-confirmation\" class=\"modal fade\" tabindex=\"-1\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-body\">
                <h4 id=\"action-confirmation-title\">{{ 'action_confirmation_modal.title'|trans([], 'EasyAdminBundle') }}</h4>
            </div>
            <div class=\"modal-footer\">
                {% component 'ea:Button' with { type: 'button', 'data-bs-dismiss': 'modal' } %}
                    {% block content %}{{ 'action.cancel'|trans([], 'EasyAdminBundle') }}
                {% endblock %}{% endcomponent %}

                {% component 'ea:Button' with { type: 'button', variant: 'danger', 'data-bs-dismiss': 'modal', id: 'modal-action-confirmation-button' } %}
                    {% block content %}{{ 'action_confirmation_modal.action'|trans([], 'EasyAdminBundle') }}
                {% endblock %}{% endcomponent %}
            </div>
        </div>
    </div>
</div>
", "@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\includes\\_action_confirmation_modal.html.twig");
    }
}


/* @EasyAdmin/crud/includes/_action_confirmation_modal.html.twig */
class __TwigTemplate_d003c7da9d95a3a489705984f106da31___26654442581 extends Template
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
        // line 16
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 16, $this->source); })()), 16);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig"));

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

    // line 17
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("action.cancel", [], "EasyAdminBundle"), "html", null, true);
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
        return "@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig";
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
        return array (  221 => 17,  190 => 16,  98 => 23,  84 => 20,  81 => 19,  67 => 16,  61 => 13,  53 => 7,  48 => 5,  45 => 3,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{# Hidden form for POST-based actions (like DELETE) with CSRF protection #}
<form class=\"d-none\" method=\"post\" id=\"action-confirmation-form\">
    {% guard function csrf_token %}
        <input type=\"hidden\" name=\"token\" value=\"{{ csrf_token('ea-delete') }}\" />
    {% endguard %}
</form>

<div id=\"modal-action-confirmation\" class=\"modal fade\" tabindex=\"-1\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-body\">
                <h4 id=\"action-confirmation-title\">{{ 'action_confirmation_modal.title'|trans([], 'EasyAdminBundle') }}</h4>
            </div>
            <div class=\"modal-footer\">
                {% component 'ea:Button' with { type: 'button', 'data-bs-dismiss': 'modal' } %}
                    {% block content %}{{ 'action.cancel'|trans([], 'EasyAdminBundle') }}
                {% endblock %}{% endcomponent %}

                {% component 'ea:Button' with { type: 'button', variant: 'danger', 'data-bs-dismiss': 'modal', id: 'modal-action-confirmation-button' } %}
                    {% block content %}{{ 'action_confirmation_modal.action'|trans([], 'EasyAdminBundle') }}
                {% endblock %}{% endcomponent %}
            </div>
        </div>
    </div>
</div>
", "@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\includes\\_action_confirmation_modal.html.twig");
    }
}


/* @EasyAdmin/crud/includes/_action_confirmation_modal.html.twig */
class __TwigTemplate_d003c7da9d95a3a489705984f106da31___15530407241 extends Template
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
        // line 20
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 20, $this->source); })()), 20);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig"));

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

    // line 21
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("action_confirmation_modal.action", [], "EasyAdminBundle"), "html", null, true);
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
        return "@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig";
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
        return array (  351 => 21,  320 => 20,  221 => 17,  190 => 16,  98 => 23,  84 => 20,  81 => 19,  67 => 16,  61 => 13,  53 => 7,  48 => 5,  45 => 3,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{# Hidden form for POST-based actions (like DELETE) with CSRF protection #}
<form class=\"d-none\" method=\"post\" id=\"action-confirmation-form\">
    {% guard function csrf_token %}
        <input type=\"hidden\" name=\"token\" value=\"{{ csrf_token('ea-delete') }}\" />
    {% endguard %}
</form>

<div id=\"modal-action-confirmation\" class=\"modal fade\" tabindex=\"-1\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-body\">
                <h4 id=\"action-confirmation-title\">{{ 'action_confirmation_modal.title'|trans([], 'EasyAdminBundle') }}</h4>
            </div>
            <div class=\"modal-footer\">
                {% component 'ea:Button' with { type: 'button', 'data-bs-dismiss': 'modal' } %}
                    {% block content %}{{ 'action.cancel'|trans([], 'EasyAdminBundle') }}
                {% endblock %}{% endcomponent %}

                {% component 'ea:Button' with { type: 'button', variant: 'danger', 'data-bs-dismiss': 'modal', id: 'modal-action-confirmation-button' } %}
                    {% block content %}{{ 'action_confirmation_modal.action'|trans([], 'EasyAdminBundle') }}
                {% endblock %}{% endcomponent %}
            </div>
        </div>
    </div>
</div>
", "@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\includes\\_action_confirmation_modal.html.twig");
    }
}
