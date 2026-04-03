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

/* user_directory/index.html.twig */
class __TwigTemplate_82d8d608f331378651bc06a4434240b4 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "user_directory/index.html.twig"));

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

        yield "User Directory | FurHope";
        
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
        yield "    <section class=\"directory-shell\">
        <div class=\"directory-hero\">
            <div>
                <p class=\"directory-kicker\">Admin tools</p>
                <h1>Search and filter users</h1>
                <p class=\"directory-copy\">Find members by first name, last name, email, or account status.</p>
            </div>
            <div class=\"directory-actions\">
                <a class=\"directory-link directory-link--ghost\" href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dashboard");
        yield "\">Back to dashboard</a>
                <a class=\"directory-link\" href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_user_index");
        yield "\">Open EasyAdmin list</a>
            </div>
        </div>

        <div class=\"directory-panel\">
            ";
        // line 20
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["searchForm"]) || array_key_exists("searchForm", $context) ? $context["searchForm"] : (function () { throw new RuntimeError('Variable "searchForm" does not exist.', 20, $this->source); })()), 'form_start', ["attr" => ["class" => "directory-form"]]);
        yield "
                <div class=\"directory-field\">
                    ";
        // line 22
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["searchForm"]) || array_key_exists("searchForm", $context) ? $context["searchForm"] : (function () { throw new RuntimeError('Variable "searchForm" does not exist.', 22, $this->source); })()), "term", [], "any", false, false, false, 22), 'label');
        yield "
                    ";
        // line 23
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["searchForm"]) || array_key_exists("searchForm", $context) ? $context["searchForm"] : (function () { throw new RuntimeError('Variable "searchForm" does not exist.', 23, $this->source); })()), "term", [], "any", false, false, false, 23), 'widget');
        yield "
                </div>
                <div class=\"directory-field\">
                    ";
        // line 26
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["searchForm"]) || array_key_exists("searchForm", $context) ? $context["searchForm"] : (function () { throw new RuntimeError('Variable "searchForm" does not exist.', 26, $this->source); })()), "status", [], "any", false, false, false, 26), 'label');
        yield "
                    ";
        // line 27
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["searchForm"]) || array_key_exists("searchForm", $context) ? $context["searchForm"] : (function () { throw new RuntimeError('Variable "searchForm" does not exist.', 27, $this->source); })()), "status", [], "any", false, false, false, 27), 'widget');
        yield "
                </div>
                <button class=\"directory-button\" type=\"submit\">Search users</button>
            ";
        // line 30
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["searchForm"]) || array_key_exists("searchForm", $context) ? $context["searchForm"] : (function () { throw new RuntimeError('Variable "searchForm" does not exist.', 30, $this->source); })()), 'form_end');
        yield "
        </div>

        <div class=\"directory-results\">
            <div class=\"directory-results__head\">
                <h2>";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 35, $this->source); })())), "html", null, true);
        yield " result";
        yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 35, $this->source); })())) == 1)) ? ("") : ("s"));
        yield "</h2>
                ";
        // line 36
        if ((($tmp = (isset($context["hasFilters"]) || array_key_exists("hasFilters", $context) ? $context["hasFilters"] : (function () { throw new RuntimeError('Variable "hasFilters" does not exist.', 36, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 37
            yield "                    <a class=\"directory-reset\" href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_user_directory");
            yield "\">Clear filters</a>
                ";
        }
        // line 39
        yield "            </div>

            <div class=\"directory-list\">
                ";
        // line 42
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 42, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 43
            yield "                    <article class=\"directory-card\">
                        <div>
                            <strong>";
            // line 45
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "fullName", [], "any", false, false, false, 45), "html", null, true);
            yield "</strong>
                            <span>";
            // line 46
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "email", [], "any", false, false, false, 46), "html", null, true);
            yield "</span>
                        </div>
                        <div class=\"directory-badges\">
                            <span class=\"directory-badge ";
            // line 49
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isActive", [], "any", false, false, false, 49)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("is-active") : ("is-inactive"));
            yield "\">
                                ";
            // line 50
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isActive", [], "any", false, false, false, 50)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Active") : ("Inactive"));
            yield "
                            </span>
                            <span class=\"directory-badge ";
            // line 52
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isVerified", [], "any", false, false, false, 52)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("is-verified") : ("is-pending"));
            yield "\">
                                ";
            // line 53
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isVerified", [], "any", false, false, false, 53)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Verified") : ("Unverified"));
            yield "
                            </span>
                            ";
            // line 55
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isVeteranApplicant", [], "any", false, false, false, 55) &&  !CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isVeteranApproved", [], "any", false, false, false, 55))) {
                // line 56
                yield "                                <span class=\"directory-badge is-review\">Veterinary review</span>
                            ";
            }
            // line 58
            yield "                        </div>
                    </article>
                ";
            $context['_iterated'] = true;
        }
        // line 60
        if (!$context['_iterated']) {
            // line 61
            yield "                    <div class=\"directory-empty\">
                        <strong>No users matched this search.</strong>
                        <p>Try a different name, email, or status filter.</p>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['user'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        yield "            </div>
        </div>
    </section>

    <style>
        .directory-shell {
            max-width: 1100px;
            margin: 0 auto;
            padding: 48px 20px 72px;
            display: grid;
            gap: 24px;
        }

        .directory-hero,
        .directory-panel,
        .directory-card,
        .directory-empty {
            border: 1px solid #d8e0ea;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 0 22px 50px rgba(15, 23, 42, 0.08);
        }

        .directory-hero,
        .directory-panel {
            padding: 28px;
        }

        .directory-hero {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: end;
        }

        .directory-kicker {
            margin: 0 0 8px;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            font-size: 0.78rem;
            color: #0f766e;
            font-weight: 700;
        }

        .directory-hero h1,
        .directory-results__head h2,
        .directory-card strong,
        .directory-empty strong {
            margin: 0;
            color: #102033;
        }

        .directory-copy,
        .directory-card span,
        .directory-empty p {
            color: #526274;
        }

        .directory-actions,
        .directory-badges {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .directory-link,
        .directory-button,
        .directory-reset {
            text-decoration: none;
            border-radius: 999px;
            font-weight: 700;
        }

        .directory-link,
        .directory-button {
            padding: 12px 18px;
        }

        .directory-link {
            background: #102033;
            color: #ffffff;
        }

        .directory-link--ghost,
        .directory-reset {
            background: #eef4f8;
            color: #102033;
        }

        .directory-form {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(220px, 1fr) auto;
            gap: 16px;
            align-items: end;
        }

        .directory-field {
            display: grid;
            gap: 8px;
        }

        .directory-field input,
        .directory-field select {
            width: 100%;
            border: 1px solid #c9d5e1;
            border-radius: 14px;
            padding: 14px 16px;
            font: inherit;
        }

        .directory-button {
            border: 0;
            background: linear-gradient(135deg, #0f766e, #155e75);
            color: #ffffff;
            cursor: pointer;
            min-height: 50px;
        }

        .directory-results {
            display: grid;
            gap: 16px;
        }

        .directory-results__head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
        }

        .directory-list {
            display: grid;
            gap: 14px;
        }

        .directory-card,
        .directory-empty {
            padding: 20px 22px;
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: center;
        }

        .directory-badge {
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .directory-badge.is-active {
            background: #dcfce7;
            color: #166534;
        }

        .directory-badge.is-inactive {
            background: #e5e7eb;
            color: #374151;
        }

        .directory-badge.is-verified {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .directory-badge.is-pending,
        .directory-badge.is-review {
            background: #fef3c7;
            color: #b45309;
        }

        @media (max-width: 800px) {
            .directory-hero,
            .directory-card,
            .directory-form {
                grid-template-columns: 1fr;
                display: grid;
            }

            .directory-card {
                align-items: start;
            }
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "user_directory/index.html.twig";
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
        return array (  220 => 66,  210 => 61,  208 => 60,  202 => 58,  198 => 56,  196 => 55,  191 => 53,  187 => 52,  182 => 50,  178 => 49,  172 => 46,  168 => 45,  164 => 43,  159 => 42,  154 => 39,  148 => 37,  146 => 36,  140 => 35,  132 => 30,  126 => 27,  122 => 26,  116 => 23,  112 => 22,  107 => 20,  99 => 15,  95 => 14,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}User Directory | FurHope{% endblock %}

{% block body %}
    <section class=\"directory-shell\">
        <div class=\"directory-hero\">
            <div>
                <p class=\"directory-kicker\">Admin tools</p>
                <h1>Search and filter users</h1>
                <p class=\"directory-copy\">Find members by first name, last name, email, or account status.</p>
            </div>
            <div class=\"directory-actions\">
                <a class=\"directory-link directory-link--ghost\" href=\"{{ path('app_dashboard') }}\">Back to dashboard</a>
                <a class=\"directory-link\" href=\"{{ path('admin_user_index') }}\">Open EasyAdmin list</a>
            </div>
        </div>

        <div class=\"directory-panel\">
            {{ form_start(searchForm, { attr: { class: 'directory-form' } }) }}
                <div class=\"directory-field\">
                    {{ form_label(searchForm.term) }}
                    {{ form_widget(searchForm.term) }}
                </div>
                <div class=\"directory-field\">
                    {{ form_label(searchForm.status) }}
                    {{ form_widget(searchForm.status) }}
                </div>
                <button class=\"directory-button\" type=\"submit\">Search users</button>
            {{ form_end(searchForm) }}
        </div>

        <div class=\"directory-results\">
            <div class=\"directory-results__head\">
                <h2>{{ users|length }} result{{ users|length == 1 ? '' : 's' }}</h2>
                {% if hasFilters %}
                    <a class=\"directory-reset\" href=\"{{ path('app_user_directory') }}\">Clear filters</a>
                {% endif %}
            </div>

            <div class=\"directory-list\">
                {% for user in users %}
                    <article class=\"directory-card\">
                        <div>
                            <strong>{{ user.fullName }}</strong>
                            <span>{{ user.email }}</span>
                        </div>
                        <div class=\"directory-badges\">
                            <span class=\"directory-badge {{ user.isActive ? 'is-active' : 'is-inactive' }}\">
                                {{ user.isActive ? 'Active' : 'Inactive' }}
                            </span>
                            <span class=\"directory-badge {{ user.isVerified ? 'is-verified' : 'is-pending' }}\">
                                {{ user.isVerified ? 'Verified' : 'Unverified' }}
                            </span>
                            {% if user.isVeteranApplicant and not user.isVeteranApproved %}
                                <span class=\"directory-badge is-review\">Veterinary review</span>
                            {% endif %}
                        </div>
                    </article>
                {% else %}
                    <div class=\"directory-empty\">
                        <strong>No users matched this search.</strong>
                        <p>Try a different name, email, or status filter.</p>
                    </div>
                {% endfor %}
            </div>
        </div>
    </section>

    <style>
        .directory-shell {
            max-width: 1100px;
            margin: 0 auto;
            padding: 48px 20px 72px;
            display: grid;
            gap: 24px;
        }

        .directory-hero,
        .directory-panel,
        .directory-card,
        .directory-empty {
            border: 1px solid #d8e0ea;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 0 22px 50px rgba(15, 23, 42, 0.08);
        }

        .directory-hero,
        .directory-panel {
            padding: 28px;
        }

        .directory-hero {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: end;
        }

        .directory-kicker {
            margin: 0 0 8px;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            font-size: 0.78rem;
            color: #0f766e;
            font-weight: 700;
        }

        .directory-hero h1,
        .directory-results__head h2,
        .directory-card strong,
        .directory-empty strong {
            margin: 0;
            color: #102033;
        }

        .directory-copy,
        .directory-card span,
        .directory-empty p {
            color: #526274;
        }

        .directory-actions,
        .directory-badges {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .directory-link,
        .directory-button,
        .directory-reset {
            text-decoration: none;
            border-radius: 999px;
            font-weight: 700;
        }

        .directory-link,
        .directory-button {
            padding: 12px 18px;
        }

        .directory-link {
            background: #102033;
            color: #ffffff;
        }

        .directory-link--ghost,
        .directory-reset {
            background: #eef4f8;
            color: #102033;
        }

        .directory-form {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(220px, 1fr) auto;
            gap: 16px;
            align-items: end;
        }

        .directory-field {
            display: grid;
            gap: 8px;
        }

        .directory-field input,
        .directory-field select {
            width: 100%;
            border: 1px solid #c9d5e1;
            border-radius: 14px;
            padding: 14px 16px;
            font: inherit;
        }

        .directory-button {
            border: 0;
            background: linear-gradient(135deg, #0f766e, #155e75);
            color: #ffffff;
            cursor: pointer;
            min-height: 50px;
        }

        .directory-results {
            display: grid;
            gap: 16px;
        }

        .directory-results__head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
        }

        .directory-list {
            display: grid;
            gap: 14px;
        }

        .directory-card,
        .directory-empty {
            padding: 20px 22px;
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: center;
        }

        .directory-badge {
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .directory-badge.is-active {
            background: #dcfce7;
            color: #166534;
        }

        .directory-badge.is-inactive {
            background: #e5e7eb;
            color: #374151;
        }

        .directory-badge.is-verified {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .directory-badge.is-pending,
        .directory-badge.is-review {
            background: #fef3c7;
            color: #b45309;
        }

        @media (max-width: 800px) {
            .directory-hero,
            .directory-card,
            .directory-form {
                grid-template-columns: 1fr;
                display: grid;
            }

            .directory-card {
                align-items: start;
            }
        }
    </style>
{% endblock %}
", "user_directory/index.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\user_directory\\index.html.twig");
    }
}
