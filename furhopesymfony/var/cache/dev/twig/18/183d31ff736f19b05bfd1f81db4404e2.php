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

/* admin/dashboard.html.twig */
class __TwigTemplate_13dc999c3f5e2c4536d53017bcc67c89 extends Template
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
            'content_title' => [$this, 'block_content_title'],
            'page_actions' => [$this, 'block_page_actions'],
            'main' => [$this, 'block_main'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "@EasyAdmin/page/content.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/dashboard.html.twig"));

        $this->parent = $this->load("@EasyAdmin/page/content.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_title"));

        yield "Operations Dashboard";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_actions(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_actions"));

        // line 6
        yield "    <a class=\"admin-hero__button admin-hero__button--primary\" href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->getAdminUrlGenerator(), "setController", ["App\\Controller\\Admin\\UserCrudController"], "method", false, false, false, 6), "html", null, true);
        yield "\">
        Manage users
    </a>
    <a class=\"admin-hero__button admin-hero__button--ghost\" href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">
        View site
    </a>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 14
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_main(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "main"));

        // line 15
        yield "    <div class=\"ops-dashboard\">
        <section class=\"ops-hero\">
            <div class=\"ops-hero__content\">
                <span class=\"ops-kicker\">FurHope admin</span>
                <h1>Clear priorities, faster review, better control.</h1>
                <p>
                    Keep onboarding, verification, and veterinary approval work in one place.
                    The dashboard highlights what needs attention instead of making you hunt through the backend.
                </p>

                <div class=\"ops-pills\">
                    <span>Review flow</span>
                    <span>Member oversight</span>
                    <span>Rescue operations</span>
                </div>
            </div>

            <div class=\"ops-hero__side\">
                <div class=\"ops-highlight\">
                    <small>Pending veterinary reviews</small>
                    <strong>";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 35, $this->source); })()), "pendingVeteranApplicants", [], "any", false, false, false, 35), "html", null, true);
        yield "</strong>
                    <span>Accounts waiting for elevated access approval.</span>
                </div>
                <div class=\"ops-highlight ops-highlight--muted\">
                    <small>Admin accounts</small>
                    <strong>";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 40, $this->source); })()), "admins", [], "any", false, false, false, 40), "html", null, true);
        yield "</strong>
                    <span>Users with platform-wide control.</span>
                </div>
            </div>
        </section>

        <section class=\"ops-stats\">
            <article class=\"ops-stat\">
                <small>Total users</small>
                <strong>";
        // line 49
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 49, $this->source); })()), "allUsers", [], "any", false, false, false, 49), "html", null, true);
        yield "</strong>
                <span>All registered accounts.</span>
            </article>
            <article class=\"ops-stat\">
                <small>Active users</small>
                <strong>";
        // line 54
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 54, $this->source); })()), "activeUsers", [], "any", false, false, false, 54), "html", null, true);
        yield "</strong>
                <span>Accounts currently allowed to sign in.</span>
            </article>
            <article class=\"ops-stat\">
                <small>Verified emails</small>
                <strong>";
        // line 59
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 59, $this->source); })()), "verifiedUsers", [], "any", false, false, false, 59), "html", null, true);
        yield "</strong>
                <span>Members who completed verification.</span>
            </article>
        </section>

        <section class=\"ops-grid\">
            <article class=\"ops-panel\">
                <div class=\"ops-panel__header\">
                    <div>
                        <span class=\"ops-kicker\">Attention queue</span>
                        <h2>Pending veterinary requests</h2>
                    </div>
                    <span class=\"ops-badge\">";
        // line 71
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 71, $this->source); })()), "pendingVeteranApplicants", [], "any", false, false, false, 71), "html", null, true);
        yield " open</span>
                </div>

                <div class=\"ops-list\">
                    ";
        // line 75
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["pendingVeteranApplicants"]) || array_key_exists("pendingVeteranApplicants", $context) ? $context["pendingVeteranApplicants"] : (function () { throw new RuntimeError('Variable "pendingVeteranApplicants" does not exist.', 75, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 76
            yield "                        <div class=\"ops-list__item\">
                            <div class=\"ops-list__identity\">
                                <strong>";
            // line 78
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "fullName", [], "any", false, false, false, 78), "html", null, true);
            yield "</strong>
                                <span>";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "email", [], "any", false, false, false, 79), "html", null, true);
            yield "</span>
                            </div>
                            <div class=\"ops-list__meta\">
                                <small>";
            // line 82
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "createdAt", [], "any", false, false, false, 82)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "createdAt", [], "any", false, false, false, 82), "Y-m-d"), "html", null, true)) : ("recently"));
            yield "</small>
                                <span class=\"ops-tag ops-tag--warn\">Needs review</span>
                            </div>
                        </div>
                    ";
            $context['_iterated'] = true;
        }
        // line 86
        if (!$context['_iterated']) {
            // line 87
            yield "                        <div class=\"ops-empty\">
                            <strong>No pending requests.</strong>
                            <p>The approval queue is currently clear.</p>
                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['user'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 92
        yield "                </div>
            </article>

            <article class=\"ops-panel\">
                <div class=\"ops-panel__header\">
                    <div>
                        <span class=\"ops-kicker\">Recent signups</span>
                        <h2>Newest members</h2>
                    </div>
                    <a class=\"ops-link\" href=\"";
        // line 101
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->getAdminUrlGenerator(), "setController", ["App\\Controller\\Admin\\UserCrudController"], "method", false, false, false, 101), "html", null, true);
        yield "\">
                        Open full list
                    </a>
                </div>

                <div class=\"ops-list\">
                    ";
        // line 107
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["recentUsers"]) || array_key_exists("recentUsers", $context) ? $context["recentUsers"] : (function () { throw new RuntimeError('Variable "recentUsers" does not exist.', 107, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 108
            yield "                        <div class=\"ops-list__item\">
                            <div class=\"ops-list__identity\">
                                <strong>";
            // line 110
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "fullName", [], "any", false, false, false, 110), "html", null, true);
            yield "</strong>
                                <span>";
            // line 111
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "email", [], "any", false, false, false, 111), "html", null, true);
            yield "</span>
                            </div>
                            <div class=\"ops-list__meta\">
                                <small>";
            // line 114
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "createdAt", [], "any", false, false, false, 114)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "createdAt", [], "any", false, false, false, 114), "Y-m-d"), "html", null, true)) : ("recently"));
            yield "</small>
                                <div class=\"ops-tags\">
                                    <span class=\"ops-tag ";
            // line 116
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isActive", [], "any", false, false, false, 116)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("ops-tag--ok") : ("ops-tag--soft"));
            yield "\">
                                        ";
            // line 117
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isActive", [], "any", false, false, false, 117)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Active") : ("Inactive"));
            yield "
                                    </span>
                                    <span class=\"ops-tag ";
            // line 119
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isVerified", [], "any", false, false, false, 119)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("ops-tag--info") : ("ops-tag--warn"));
            yield "\">
                                        ";
            // line 120
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isVerified", [], "any", false, false, false, 120)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Verified") : ("Unverified"));
            yield "
                                    </span>
                                </div>
                            </div>
                        </div>
                    ";
            $context['_iterated'] = true;
        }
        // line 125
        if (!$context['_iterated']) {
            // line 126
            yield "                        <div class=\"ops-empty\">
                            <strong>No recent members yet.</strong>
                            <p>New registrations will appear here.</p>
                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['user'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 131
        yield "                </div>
            </article>
        </section>
    </div>

    <style>
        .ops-dashboard {
            display: grid;
            gap: 24px;
            color: #f3efe9;
        }

        .ops-hero,
        .ops-stat,
        .ops-panel {
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(17, 27, 38, 0.94), rgba(10, 16, 24, 0.98));
            box-shadow: 0 28px 60px rgba(3, 9, 16, 0.28);
        }

        .ops-hero {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(280px, 0.8fr);
            gap: 18px;
            padding: 30px;
        }

        .ops-hero__content,
        .ops-hero__side {
            display: grid;
            gap: 18px;
            align-content: start;
        }

        .ops-kicker {
            text-transform: uppercase;
            letter-spacing: 0.14em;
            font-size: 0.78rem;
            color: #8ecae6;
            font-weight: 700;
        }

        .ops-hero h1,
        .ops-panel h2 {
            margin: 0;
            color: #ffffff;
        }

        .ops-hero h1 {
            font-size: clamp(2.2rem, 4vw, 3.6rem);
            line-height: 0.96;
            max-width: 10ch;
        }

        .ops-hero p {
            margin: 0;
            max-width: 60ch;
            color: #b7c3d0;
            line-height: 1.75;
            font-size: 1rem;
        }

        .ops-pills,
        .ops-tags {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .ops-pills span,
        .ops-badge,
        .ops-tag {
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 0.85rem;
            line-height: 1;
        }

        .ops-pills span {
            background: rgba(142, 202, 230, 0.10);
            border: 1px solid rgba(142, 202, 230, 0.18);
            color: #d7f1ff;
        }

        .ops-highlight {
            display: grid;
            gap: 8px;
            padding: 22px;
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(33, 50, 71, 0.95), rgba(17, 26, 38, 0.95));
            border: 1px solid rgba(142, 202, 230, 0.14);
        }

        .ops-highlight--muted {
            background: linear-gradient(135deg, rgba(31, 39, 53, 0.95), rgba(15, 22, 30, 0.95));
            border-color: rgba(255, 255, 255, 0.08);
        }

        .ops-highlight small,
        .ops-stat small {
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.76rem;
            color: #8ecae6;
            font-weight: 700;
        }

        .ops-highlight strong,
        .ops-stat strong {
            font-size: 2.5rem;
            line-height: 1;
            color: #ffffff;
        }

        .ops-highlight span,
        .ops-stat span,
        .ops-list__identity span,
        .ops-list__meta small,
        .ops-empty p {
            color: #b7c3d0;
        }

        .ops-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .ops-stat {
            display: grid;
            gap: 10px;
            padding: 22px;
        }

        .ops-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .ops-panel {
            display: grid;
            gap: 18px;
            padding: 24px;
        }

        .ops-panel__header {
            display: flex;
            align-items: start;
            justify-content: space-between;
            gap: 14px;
        }

        .ops-panel__header h2 {
            margin-top: 6px;
            font-size: 1.45rem;
        }

        .ops-badge {
            background: rgba(251, 133, 0, 0.16);
            border: 1px solid rgba(251, 133, 0, 0.22);
            color: #ffd8a8;
            white-space: nowrap;
        }

        .ops-link {
            color: #8ecae6;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        .ops-list {
            display: grid;
            gap: 12px;
        }

        .ops-list__item,
        .ops-empty {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 16px 18px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .ops-list__identity,
        .ops-list__meta,
        .ops-empty {
            display: grid;
            gap: 6px;
        }

        .ops-list__identity strong,
        .ops-empty strong {
            color: #ffffff;
        }

        .ops-list__meta {
            justify-items: end;
        }

        .ops-tag {
            font-weight: 700;
            border: 1px solid transparent;
        }

        .ops-tag--warn {
            background: rgba(251, 133, 0, 0.14);
            border-color: rgba(251, 133, 0, 0.18);
            color: #ffd8a8;
        }

        .ops-tag--ok {
            background: rgba(76, 201, 240, 0.12);
            border-color: rgba(76, 201, 240, 0.18);
            color: #c9f3ff;
        }

        .ops-tag--info {
            background: rgba(142, 202, 230, 0.12);
            border-color: rgba(142, 202, 230, 0.18);
            color: #d7f1ff;
        }

        .ops-tag--soft {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.10);
            color: #d9e1e8;
        }

        .ops-empty {
            align-items: start;
            justify-content: start;
        }

        @media (max-width: 1100px) {
            .ops-hero,
            .ops-stats,
            .ops-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .ops-panel__header,
            .ops-list__item {
                display: grid;
                grid-template-columns: 1fr;
            }

            .ops-list__meta {
                justify-items: start;
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
        return "admin/dashboard.html.twig";
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
        return array (  314 => 131,  304 => 126,  302 => 125,  292 => 120,  288 => 119,  283 => 117,  279 => 116,  274 => 114,  268 => 111,  264 => 110,  260 => 108,  255 => 107,  246 => 101,  235 => 92,  225 => 87,  223 => 86,  214 => 82,  208 => 79,  204 => 78,  200 => 76,  195 => 75,  188 => 71,  173 => 59,  165 => 54,  157 => 49,  145 => 40,  137 => 35,  115 => 15,  105 => 14,  93 => 9,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends '@EasyAdmin/page/content.html.twig' %}

{% block content_title %}Operations Dashboard{% endblock %}

{% block page_actions %}
    <a class=\"admin-hero__button admin-hero__button--primary\" href=\"{{ ea_url().setController('App\\\\Controller\\\\Admin\\\\UserCrudController') }}\">
        Manage users
    </a>
    <a class=\"admin-hero__button admin-hero__button--ghost\" href=\"{{ path('app_home') }}\">
        View site
    </a>
{% endblock %}

{% block main %}
    <div class=\"ops-dashboard\">
        <section class=\"ops-hero\">
            <div class=\"ops-hero__content\">
                <span class=\"ops-kicker\">FurHope admin</span>
                <h1>Clear priorities, faster review, better control.</h1>
                <p>
                    Keep onboarding, verification, and veterinary approval work in one place.
                    The dashboard highlights what needs attention instead of making you hunt through the backend.
                </p>

                <div class=\"ops-pills\">
                    <span>Review flow</span>
                    <span>Member oversight</span>
                    <span>Rescue operations</span>
                </div>
            </div>

            <div class=\"ops-hero__side\">
                <div class=\"ops-highlight\">
                    <small>Pending veterinary reviews</small>
                    <strong>{{ stats.pendingVeteranApplicants }}</strong>
                    <span>Accounts waiting for elevated access approval.</span>
                </div>
                <div class=\"ops-highlight ops-highlight--muted\">
                    <small>Admin accounts</small>
                    <strong>{{ stats.admins }}</strong>
                    <span>Users with platform-wide control.</span>
                </div>
            </div>
        </section>

        <section class=\"ops-stats\">
            <article class=\"ops-stat\">
                <small>Total users</small>
                <strong>{{ stats.allUsers }}</strong>
                <span>All registered accounts.</span>
            </article>
            <article class=\"ops-stat\">
                <small>Active users</small>
                <strong>{{ stats.activeUsers }}</strong>
                <span>Accounts currently allowed to sign in.</span>
            </article>
            <article class=\"ops-stat\">
                <small>Verified emails</small>
                <strong>{{ stats.verifiedUsers }}</strong>
                <span>Members who completed verification.</span>
            </article>
        </section>

        <section class=\"ops-grid\">
            <article class=\"ops-panel\">
                <div class=\"ops-panel__header\">
                    <div>
                        <span class=\"ops-kicker\">Attention queue</span>
                        <h2>Pending veterinary requests</h2>
                    </div>
                    <span class=\"ops-badge\">{{ stats.pendingVeteranApplicants }} open</span>
                </div>

                <div class=\"ops-list\">
                    {% for user in pendingVeteranApplicants %}
                        <div class=\"ops-list__item\">
                            <div class=\"ops-list__identity\">
                                <strong>{{ user.fullName }}</strong>
                                <span>{{ user.email }}</span>
                            </div>
                            <div class=\"ops-list__meta\">
                                <small>{{ user.createdAt ? user.createdAt|date('Y-m-d') : 'recently' }}</small>
                                <span class=\"ops-tag ops-tag--warn\">Needs review</span>
                            </div>
                        </div>
                    {% else %}
                        <div class=\"ops-empty\">
                            <strong>No pending requests.</strong>
                            <p>The approval queue is currently clear.</p>
                        </div>
                    {% endfor %}
                </div>
            </article>

            <article class=\"ops-panel\">
                <div class=\"ops-panel__header\">
                    <div>
                        <span class=\"ops-kicker\">Recent signups</span>
                        <h2>Newest members</h2>
                    </div>
                    <a class=\"ops-link\" href=\"{{ ea_url().setController('App\\\\Controller\\\\Admin\\\\UserCrudController') }}\">
                        Open full list
                    </a>
                </div>

                <div class=\"ops-list\">
                    {% for user in recentUsers %}
                        <div class=\"ops-list__item\">
                            <div class=\"ops-list__identity\">
                                <strong>{{ user.fullName }}</strong>
                                <span>{{ user.email }}</span>
                            </div>
                            <div class=\"ops-list__meta\">
                                <small>{{ user.createdAt ? user.createdAt|date('Y-m-d') : 'recently' }}</small>
                                <div class=\"ops-tags\">
                                    <span class=\"ops-tag {{ user.isActive ? 'ops-tag--ok' : 'ops-tag--soft' }}\">
                                        {{ user.isActive ? 'Active' : 'Inactive' }}
                                    </span>
                                    <span class=\"ops-tag {{ user.isVerified ? 'ops-tag--info' : 'ops-tag--warn' }}\">
                                        {{ user.isVerified ? 'Verified' : 'Unverified' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    {% else %}
                        <div class=\"ops-empty\">
                            <strong>No recent members yet.</strong>
                            <p>New registrations will appear here.</p>
                        </div>
                    {% endfor %}
                </div>
            </article>
        </section>
    </div>

    <style>
        .ops-dashboard {
            display: grid;
            gap: 24px;
            color: #f3efe9;
        }

        .ops-hero,
        .ops-stat,
        .ops-panel {
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(17, 27, 38, 0.94), rgba(10, 16, 24, 0.98));
            box-shadow: 0 28px 60px rgba(3, 9, 16, 0.28);
        }

        .ops-hero {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(280px, 0.8fr);
            gap: 18px;
            padding: 30px;
        }

        .ops-hero__content,
        .ops-hero__side {
            display: grid;
            gap: 18px;
            align-content: start;
        }

        .ops-kicker {
            text-transform: uppercase;
            letter-spacing: 0.14em;
            font-size: 0.78rem;
            color: #8ecae6;
            font-weight: 700;
        }

        .ops-hero h1,
        .ops-panel h2 {
            margin: 0;
            color: #ffffff;
        }

        .ops-hero h1 {
            font-size: clamp(2.2rem, 4vw, 3.6rem);
            line-height: 0.96;
            max-width: 10ch;
        }

        .ops-hero p {
            margin: 0;
            max-width: 60ch;
            color: #b7c3d0;
            line-height: 1.75;
            font-size: 1rem;
        }

        .ops-pills,
        .ops-tags {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .ops-pills span,
        .ops-badge,
        .ops-tag {
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 0.85rem;
            line-height: 1;
        }

        .ops-pills span {
            background: rgba(142, 202, 230, 0.10);
            border: 1px solid rgba(142, 202, 230, 0.18);
            color: #d7f1ff;
        }

        .ops-highlight {
            display: grid;
            gap: 8px;
            padding: 22px;
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(33, 50, 71, 0.95), rgba(17, 26, 38, 0.95));
            border: 1px solid rgba(142, 202, 230, 0.14);
        }

        .ops-highlight--muted {
            background: linear-gradient(135deg, rgba(31, 39, 53, 0.95), rgba(15, 22, 30, 0.95));
            border-color: rgba(255, 255, 255, 0.08);
        }

        .ops-highlight small,
        .ops-stat small {
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.76rem;
            color: #8ecae6;
            font-weight: 700;
        }

        .ops-highlight strong,
        .ops-stat strong {
            font-size: 2.5rem;
            line-height: 1;
            color: #ffffff;
        }

        .ops-highlight span,
        .ops-stat span,
        .ops-list__identity span,
        .ops-list__meta small,
        .ops-empty p {
            color: #b7c3d0;
        }

        .ops-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .ops-stat {
            display: grid;
            gap: 10px;
            padding: 22px;
        }

        .ops-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .ops-panel {
            display: grid;
            gap: 18px;
            padding: 24px;
        }

        .ops-panel__header {
            display: flex;
            align-items: start;
            justify-content: space-between;
            gap: 14px;
        }

        .ops-panel__header h2 {
            margin-top: 6px;
            font-size: 1.45rem;
        }

        .ops-badge {
            background: rgba(251, 133, 0, 0.16);
            border: 1px solid rgba(251, 133, 0, 0.22);
            color: #ffd8a8;
            white-space: nowrap;
        }

        .ops-link {
            color: #8ecae6;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        .ops-list {
            display: grid;
            gap: 12px;
        }

        .ops-list__item,
        .ops-empty {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 16px 18px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .ops-list__identity,
        .ops-list__meta,
        .ops-empty {
            display: grid;
            gap: 6px;
        }

        .ops-list__identity strong,
        .ops-empty strong {
            color: #ffffff;
        }

        .ops-list__meta {
            justify-items: end;
        }

        .ops-tag {
            font-weight: 700;
            border: 1px solid transparent;
        }

        .ops-tag--warn {
            background: rgba(251, 133, 0, 0.14);
            border-color: rgba(251, 133, 0, 0.18);
            color: #ffd8a8;
        }

        .ops-tag--ok {
            background: rgba(76, 201, 240, 0.12);
            border-color: rgba(76, 201, 240, 0.18);
            color: #c9f3ff;
        }

        .ops-tag--info {
            background: rgba(142, 202, 230, 0.12);
            border-color: rgba(142, 202, 230, 0.18);
            color: #d7f1ff;
        }

        .ops-tag--soft {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.10);
            color: #d9e1e8;
        }

        .ops-empty {
            align-items: start;
            justify-content: start;
        }

        @media (max-width: 1100px) {
            .ops-hero,
            .ops-stats,
            .ops-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .ops-panel__header,
            .ops-list__item {
                display: grid;
                grid-template-columns: 1fr;
            }

            .ops-list__meta {
                justify-items: start;
            }
        }
    </style>
{% endblock %}
", "admin/dashboard.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\admin\\dashboard.html.twig");
    }
}
