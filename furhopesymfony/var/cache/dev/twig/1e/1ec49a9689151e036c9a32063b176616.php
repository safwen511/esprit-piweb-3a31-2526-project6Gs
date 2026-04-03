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

/* dashboard/index.html.twig */
class __TwigTemplate_9ae237f4adc5fbc9776e42525cee6cc5 extends Template
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
            'stylesheets' => [$this, 'block_stylesheets'],
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/index.html.twig"));

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

        yield "Dashboard | FurHope";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 6
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <link rel=\"stylesheet\" href=\"";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("styles/dashboard-theme.css"), "html", null, true);
        yield "\">
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 10
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 11
        yield "    ";
        $context["joinedLabel"] = (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 11, $this->source); })()), "createdAt", [], "any", false, false, false, 11)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 11, $this->source); })()), "createdAt", [], "any", false, false, false, 11), "M Y")) : ("Recently"));
        // line 12
        yield "    <div class=\"ops-shell\">
        <aside class=\"ops-sidebar\">
            <div class=\"ops-brand\">
                <div class=\"ops-brand__mark\">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div>
                    <strong>FurHope</strong>
                    <small>";
        // line 23
        yield (((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 23, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Unified dashboard") : ("Member hub"));
        yield "</small>
                </div>
            </div>

            <div class=\"ops-profile\">
                <div class=\"ops-avatar\">";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 28, $this->source); })()), "firstName", [], "any", false, false, false, 28)), "html", null, true);
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 28, $this->source); })()), "lastName", [], "any", false, false, false, 28)), "html", null, true);
        yield "</div>
                <strong>";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 29, $this->source); })()), "fullName", [], "any", false, false, false, 29), "html", null, true);
        yield "</strong>
                <span>";
        // line 30
        yield (((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 30, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Shelter administrator") : ("Shelter member"));
        yield "</span>
            </div>

            <nav class=\"ops-nav\">
                <a class=\"ops-nav__item is-active\" href=\"";
        // line 34
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dashboard");
        yield "\">
                    <span>Dashboard</span>
                    <em>";
        // line 36
        yield (((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 36, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Live") : ("Now"));
        yield "</em>
                </a>
                <a class=\"ops-nav__item\" href=\"";
        // line 38
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("feed_index");
        yield "\">
                    <span>Social feed</span>
                    <em>Community</em>
                </a>
                <div class=\"ops-nav__item\">
                    <span>Email status</span>
                    <em>";
        // line 44
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 44, $this->source); })()), "isVerified", [], "any", false, false, false, 44)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Verified") : ("Pending"));
        yield "</em>
                </div>
                <div class=\"ops-nav__item\">
                    <span>Account access</span>
                    <em>";
        // line 48
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 48, $this->source); })()), "isActive", [], "any", false, false, false, 48)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Active") : ("Inactive"));
        yield "</em>
                </div>
                <div class=\"ops-nav__item\">
                    <span>Joined</span>
                    <em>";
        // line 52
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["joinedLabel"]) || array_key_exists("joinedLabel", $context) ? $context["joinedLabel"] : (function () { throw new RuntimeError('Variable "joinedLabel" does not exist.', 52, $this->source); })()), "html", null, true);
        yield "</em>
                </div>
                ";
        // line 54
        if (((isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 54, $this->source); })()) && (isset($context["adminUsersUrl"]) || array_key_exists("adminUsersUrl", $context) ? $context["adminUsersUrl"] : (function () { throw new RuntimeError('Variable "adminUsersUrl" does not exist.', 54, $this->source); })()))) {
            // line 55
            yield "                    <a class=\"ops-nav__item\" href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["adminUsersUrl"]) || array_key_exists("adminUsersUrl", $context) ? $context["adminUsersUrl"] : (function () { throw new RuntimeError('Variable "adminUsersUrl" does not exist.', 55, $this->source); })()), "html", null, true);
            yield "\">
                        <span>Check users</span>
                        <em>Manage</em>
                    </a>
                ";
        }
        // line 60
        yield "                ";
        if (((isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 60, $this->source); })()) && (isset($context["userDirectoryUrl"]) || array_key_exists("userDirectoryUrl", $context) ? $context["userDirectoryUrl"] : (function () { throw new RuntimeError('Variable "userDirectoryUrl" does not exist.', 60, $this->source); })()))) {
            // line 61
            yield "                    <a class=\"ops-nav__item\" href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["userDirectoryUrl"]) || array_key_exists("userDirectoryUrl", $context) ? $context["userDirectoryUrl"] : (function () { throw new RuntimeError('Variable "userDirectoryUrl" does not exist.', 61, $this->source); })()), "html", null, true);
            yield "\">
                        <span>Search users</span>
                        <em>Filter</em>
                    </a>
                ";
        }
        // line 66
        yield "            </nav>

            <div class=\"ops-sidebar__footer\">
                <a href=\"";
        // line 69
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\">Log out</a>
            </div>
        </aside>

        <main class=\"ops-main\">
            <section class=\"ops-topbar\">
                <div>
                    <h1>Dashboard</h1>
                    <p>
                        ";
        // line 78
        if ((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 78, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 79
            yield "                            One place for member visibility, approvals, and user management.
                        ";
        } else {
            // line 81
            yield "                            One place for your FurHope account and next steps.
                        ";
        }
        // line 83
        yield "                    </p>
                </div>

                <div class=\"ops-topbar__actions\">
                    <a class=\"ops-button ops-button--accent\" href=\"";
        // line 87
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("feed_index");
        yield "\">Social feed</a>
                    ";
        // line 88
        if (((isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 88, $this->source); })()) && (isset($context["userDirectoryUrl"]) || array_key_exists("userDirectoryUrl", $context) ? $context["userDirectoryUrl"] : (function () { throw new RuntimeError('Variable "userDirectoryUrl" does not exist.', 88, $this->source); })()))) {
            // line 89
            yield "                        <a class=\"ops-button ops-button--ghost\" href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["userDirectoryUrl"]) || array_key_exists("userDirectoryUrl", $context) ? $context["userDirectoryUrl"] : (function () { throw new RuntimeError('Variable "userDirectoryUrl" does not exist.', 89, $this->source); })()), "html", null, true);
            yield "\">Search users</a>
                    ";
        }
        // line 91
        yield "                    ";
        if (((isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 91, $this->source); })()) && (isset($context["adminUsersUrl"]) || array_key_exists("adminUsersUrl", $context) ? $context["adminUsersUrl"] : (function () { throw new RuntimeError('Variable "adminUsersUrl" does not exist.', 91, $this->source); })()))) {
            // line 92
            yield "                        <a class=\"ops-button ops-button--accent\" href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["adminUsersUrl"]) || array_key_exists("adminUsersUrl", $context) ? $context["adminUsersUrl"] : (function () { throw new RuntimeError('Variable "adminUsersUrl" does not exist.', 92, $this->source); })()), "html", null, true);
            yield "\">Check users</a>
                    ";
        }
        // line 94
        yield "                    <a class=\"ops-button ops-button--ghost\" href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">Public site</a>
                </div>
            </section>

            <section class=\"ops-summary\">
                <article class=\"ops-stat\">
                    <span>Verification</span>
                    <strong>";
        // line 101
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 101, $this->source); })()), "isVerified", [], "any", false, false, false, 101)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
        yield "</strong>
                </article>
                <article class=\"ops-stat\">
                    <span>Account</span>
                    <strong>";
        // line 105
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 105, $this->source); })()), "isActive", [], "any", false, false, false, 105)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Active") : ("Paused"));
        yield "</strong>
                </article>
                <article class=\"ops-stat\">
                    <span>Roles</span>
                    <strong>";
        // line 109
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 109, $this->source); })()), "roles", [], "any", false, false, false, 109)), "html", null, true);
        yield "</strong>
                </article>
            </section>

            <section class=\"ops-grid\">
                <article class=\"ops-card ops-card--chart\">
                    <div class=\"ops-card__header\">
                        <h2>Activity</h2>
                        <small>Updated from live account state</small>
                    </div>

                    <div class=\"ops-graph\">
                        <div class=\"ops-graph__labels\">
                            <span>40k</span>
                            <span>30k</span>
                            <span>20k</span>
                            <span>10k</span>
                            <span>0k</span>
                        </div>
                        <div class=\"ops-graph__canvas\">
                            <svg viewBox=\"0 0 520 240\" aria-hidden=\"true\">
                                <path d=\"M20 170 C80 70, 140 60, 200 155 S320 205, 370 95 S450 120, 500 45\" />
                            </svg>
                            <div class=\"ops-graph__tooltip\">
                                <strong>";
        // line 133
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 133, $this->source); })()), "isVerified", [], "any", false, false, false, 133)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("32 210") : ("18 420"));
        yield "</strong>
                                <span>";
        // line 134
        yield (((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 134, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Dashboard health") : ("Account progress"));
        yield "</span>
                            </div>
                        </div>
                        <div class=\"ops-graph__days\">
                            <span>01</span>
                            <span>02</span>
                            <span>03</span>
                            <span>04</span>
                            <span>05</span>
                            <span>06</span>
                            <span>07</span>
                        </div>
                    </div>
                </article>

                <article class=\"ops-card ops-card--feature\">
                    <div class=\"ops-feature\">
                        <div>
                            <span>FurHope flow</span>
                            <h2>";
        // line 153
        yield (((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 153, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Keep reviews moving") : ("Keep your account moving"));
        yield "</h2>
                            <p>
                                ";
        // line 155
        if ((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 155, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 156
            yield "                                    Use the shared dashboard and user manager to process reviews faster.
                                ";
        } else {
            // line 158
            yield "                                    Track your verification and access status without leaving the dashboard.
                                ";
        }
        // line 160
        yield "                            </p>
                        </div>
                        <div class=\"ops-feature__badge\">";
        // line 162
        yield (((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 162, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("ADMIN") : ("MEMBER"));
        yield "</div>
                    </div>
                </article>
            </section>

            <section class=\"ops-grid ops-grid--bottom\">
                <article class=\"ops-card\">
                    <div class=\"ops-card__header\">
                        <h2>";
        // line 170
        yield (((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 170, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Priority list") : ("Your account"));
        yield "</h2>
                        <small>";
        // line 171
        yield (((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 171, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Needs action now") : ("Current state"));
        yield "</small>
                    </div>

                    <div class=\"ops-list\">
                        ";
        // line 175
        if ((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 175, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 176
            yield "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["pendingVeteranApplicants"]) || array_key_exists("pendingVeteranApplicants", $context) ? $context["pendingVeteranApplicants"] : (function () { throw new RuntimeError('Variable "pendingVeteranApplicants" does not exist.', 176, $this->source); })()));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
                // line 177
                yield "                                <div class=\"ops-list__item\">
                                    <div>
                                        <strong>";
                // line 179
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "fullName", [], "any", false, false, false, 179), "html", null, true);
                yield "</strong>
                                        <span>";
                // line 180
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "email", [], "any", false, false, false, 180), "html", null, true);
                yield "</span>
                                    </div>
                                    <b>";
                // line 182
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "createdAt", [], "any", false, false, false, 182)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "createdAt", [], "any", false, false, false, 182), "d M"), "html", null, true)) : ("New"));
                yield "</b>
                                </div>
                            ";
                $context['_iterated'] = true;
            }
            // line 184
            if (!$context['_iterated']) {
                // line 185
                yield "                                <div class=\"ops-list__item ops-list__item--empty\">
                                    <div>
                                        <strong>No pending veterinary reviews</strong>
                                        <span>The queue is currently clear.</span>
                                    </div>
                                </div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['user'], $context['_parent'], $context['_iterated']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 192
            yield "                        ";
        } else {
            // line 193
            yield "                            <div class=\"ops-list__item\">
                                <div>
                                    <strong>Email verification</strong>
                                    <span>";
            // line 196
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 196, $this->source); })()), "isVerified", [], "any", false, false, false, 196)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Your email is verified.") : ("Still waiting for verification."));
            yield "</span>
                                </div>
                                <b>";
            // line 198
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 198, $this->source); })()), "isVerified", [], "any", false, false, false, 198)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Done") : ("Pending"));
            yield "</b>
                            </div>
                            <div class=\"ops-list__item\">
                                <div>
                                    <strong>Account access</strong>
                                    <span>";
            // line 203
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 203, $this->source); })()), "isActive", [], "any", false, false, false, 203)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Your account is active.") : ("Your account needs review."));
            yield "</span>
                                </div>
                                <b>";
            // line 205
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 205, $this->source); })()), "isActive", [], "any", false, false, false, 205)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Open") : ("Paused"));
            yield "</b>
                            </div>
                            <div class=\"ops-list__item\">
                                <div>
                                    <strong>Veterinary request</strong>
                                    <span>
                                        ";
            // line 211
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 211, $this->source); })()), "isVeteranApplicant", [], "any", false, false, false, 211)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 212
                yield "                                            ";
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 212, $this->source); })()), "isVeteranApproved", [], "any", false, false, false, 212)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Approved for veterinary access.") : ("Request pending review."));
                yield "
                                        ";
            } else {
                // line 214
                yield "                                            No veterinary access request sent.
                                        ";
            }
            // line 216
            yield "                                    </span>
                                </div>
                                <b>
                                    ";
            // line 219
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 219, $this->source); })()), "isVeteranApproved", [], "any", false, false, false, 219)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 220
                yield "                                        Approved
                                    ";
            } elseif ((($tmp = CoreExtension::getAttribute($this->env, $this->source,             // line 221
(isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 221, $this->source); })()), "isVeteranApplicant", [], "any", false, false, false, 221)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 222
                yield "                                        Pending
                                    ";
            } else {
                // line 224
                yield "                                        None
                                    ";
            }
            // line 226
            yield "                                </b>
                            </div>
                        ";
        }
        // line 229
        yield "                    </div>
                </article>

                <article class=\"ops-card\">
                    <div class=\"ops-card__header\">
                        <h2>";
        // line 234
        yield (((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 234, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Top performers") : ("Profile details"));
        yield "</h2>
                        <small>";
        // line 235
        yield (((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 235, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Newest members") : ("Personal information"));
        yield "</small>
                    </div>

                    <div class=\"ops-list\">
                        ";
        // line 239
        if ((($tmp = (isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 239, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 240
            yield "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["recentUsers"]) || array_key_exists("recentUsers", $context) ? $context["recentUsers"] : (function () { throw new RuntimeError('Variable "recentUsers" does not exist.', 240, $this->source); })()));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
                // line 241
                yield "                                <div class=\"ops-list__item\">
                                    <div>
                                        <strong>";
                // line 243
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "fullName", [], "any", false, false, false, 243), "html", null, true);
                yield "</strong>
                                        <span>";
                // line 244
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "email", [], "any", false, false, false, 244), "html", null, true);
                yield "</span>
                                    </div>
                                    <b>";
                // line 246
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isVerified", [], "any", false, false, false, 246)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Verified") : ("Unverified"));
                yield "</b>
                                </div>
                            ";
                $context['_iterated'] = true;
            }
            // line 248
            if (!$context['_iterated']) {
                // line 249
                yield "                                <div class=\"ops-list__item ops-list__item--empty\">
                                    <div>
                                        <strong>No recent members</strong>
                                        <span>New signups will appear here.</span>
                                    </div>
                                </div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['user'], $context['_parent'], $context['_iterated']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 256
            yield "                        ";
        } else {
            // line 257
            yield "                            <div class=\"ops-list__item\">
                                <div>
                                    <strong>Full name</strong>
                                    <span>";
            // line 260
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 260, $this->source); })()), "fullName", [], "any", false, false, false, 260), "html", null, true);
            yield "</span>
                                </div>
                            </div>
                            <div class=\"ops-list__item\">
                                <div>
                                    <strong>Email</strong>
                                    <span>";
            // line 266
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 266, $this->source); })()), "email", [], "any", false, false, false, 266), "html", null, true);
            yield "</span>
                                </div>
                            </div>
                            <div class=\"ops-list__item\">
                                <div>
                                    <strong>Phone</strong>
                                    <span>";
            // line 272
            yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 272, $this->source); })()), "phoneNumber", [], "any", false, false, false, 272)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 272, $this->source); })()), "phoneNumber", [], "any", false, false, false, 272), "html", null, true)) : ("Not provided"));
            yield "</span>
                                </div>
                            </div>
                        ";
        }
        // line 276
        yield "                    </div>
                </article>
            </section>

            ";
        // line 280
        if (((isset($context["isAdmin"]) || array_key_exists("isAdmin", $context) ? $context["isAdmin"] : (function () { throw new RuntimeError('Variable "isAdmin" does not exist.', 280, $this->source); })()) && (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 280, $this->source); })()))) {
            // line 281
            yield "                <section class=\"ops-channels\">
                    <div class=\"ops-channels__intro\">
                        <h2>Channels</h2>
                        <p>Your shelter management snapshot for this week.</p>
                    </div>
                    <div class=\"ops-channel-grid\">
                        <article class=\"ops-channel-card\">
                            <span>Total users</span>
                            <strong>";
            // line 289
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 289, $this->source); })()), "allUsers", [], "any", false, false, false, 289), "html", null, true);
            yield "</strong>
                        </article>
                        <article class=\"ops-channel-card\">
                            <span>Active users</span>
                            <strong>";
            // line 293
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 293, $this->source); })()), "activeUsers", [], "any", false, false, false, 293), "html", null, true);
            yield "</strong>
                        </article>
                        <article class=\"ops-channel-card\">
                            <span>Verified</span>
                            <strong>";
            // line 297
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 297, $this->source); })()), "verifiedUsers", [], "any", false, false, false, 297), "html", null, true);
            yield "</strong>
                        </article>
                        <article class=\"ops-channel-card\">
                            <span>Admins</span>
                            <strong>";
            // line 301
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 301, $this->source); })()), "admins", [], "any", false, false, false, 301), "html", null, true);
            yield "</strong>
                        </article>
                    </div>
                    ";
            // line 304
            if ((($tmp = (isset($context["adminUsersUrl"]) || array_key_exists("adminUsersUrl", $context) ? $context["adminUsersUrl"] : (function () { throw new RuntimeError('Variable "adminUsersUrl" does not exist.', 304, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 305
                yield "                        <a class=\"ops-channels__cta\" href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["adminUsersUrl"]) || array_key_exists("adminUsersUrl", $context) ? $context["adminUsersUrl"] : (function () { throw new RuntimeError('Variable "adminUsersUrl" does not exist.', 305, $this->source); })()), "html", null, true);
                yield "\">Full stats</a>
                    ";
            }
            // line 307
            yield "                </section>
            ";
        }
        // line 309
        yield "        </main>
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
        return "dashboard/index.html.twig";
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
        return array (  649 => 309,  645 => 307,  639 => 305,  637 => 304,  631 => 301,  624 => 297,  617 => 293,  610 => 289,  600 => 281,  598 => 280,  592 => 276,  585 => 272,  576 => 266,  567 => 260,  562 => 257,  559 => 256,  547 => 249,  545 => 248,  538 => 246,  533 => 244,  529 => 243,  525 => 241,  519 => 240,  517 => 239,  510 => 235,  506 => 234,  499 => 229,  494 => 226,  490 => 224,  486 => 222,  484 => 221,  481 => 220,  479 => 219,  474 => 216,  470 => 214,  464 => 212,  462 => 211,  453 => 205,  448 => 203,  440 => 198,  435 => 196,  430 => 193,  427 => 192,  415 => 185,  413 => 184,  406 => 182,  401 => 180,  397 => 179,  393 => 177,  387 => 176,  385 => 175,  378 => 171,  374 => 170,  363 => 162,  359 => 160,  355 => 158,  351 => 156,  349 => 155,  344 => 153,  322 => 134,  318 => 133,  291 => 109,  284 => 105,  277 => 101,  266 => 94,  260 => 92,  257 => 91,  251 => 89,  249 => 88,  245 => 87,  239 => 83,  235 => 81,  231 => 79,  229 => 78,  217 => 69,  212 => 66,  203 => 61,  200 => 60,  191 => 55,  189 => 54,  184 => 52,  177 => 48,  170 => 44,  161 => 38,  156 => 36,  151 => 34,  144 => 30,  140 => 29,  135 => 28,  127 => 23,  114 => 12,  111 => 11,  101 => 10,  91 => 7,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Dashboard | FurHope{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <link rel=\"stylesheet\" href=\"{{ asset('styles/dashboard-theme.css') }}\">
{% endblock %}

{% block body %}
    {% set joinedLabel = member.createdAt ? member.createdAt|date('M Y') : 'Recently' %}
    <div class=\"ops-shell\">
        <aside class=\"ops-sidebar\">
            <div class=\"ops-brand\">
                <div class=\"ops-brand__mark\">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div>
                    <strong>FurHope</strong>
                    <small>{{ isAdmin ? 'Unified dashboard' : 'Member hub' }}</small>
                </div>
            </div>

            <div class=\"ops-profile\">
                <div class=\"ops-avatar\">{{ member.firstName|first }}{{ member.lastName|first }}</div>
                <strong>{{ member.fullName }}</strong>
                <span>{{ isAdmin ? 'Shelter administrator' : 'Shelter member' }}</span>
            </div>

            <nav class=\"ops-nav\">
                <a class=\"ops-nav__item is-active\" href=\"{{ path('app_dashboard') }}\">
                    <span>Dashboard</span>
                    <em>{{ isAdmin ? 'Live' : 'Now' }}</em>
                </a>
                <a class=\"ops-nav__item\" href=\"{{ path('feed_index') }}\">
                    <span>Social feed</span>
                    <em>Community</em>
                </a>
                <div class=\"ops-nav__item\">
                    <span>Email status</span>
                    <em>{{ member.isVerified ? 'Verified' : 'Pending' }}</em>
                </div>
                <div class=\"ops-nav__item\">
                    <span>Account access</span>
                    <em>{{ member.isActive ? 'Active' : 'Inactive' }}</em>
                </div>
                <div class=\"ops-nav__item\">
                    <span>Joined</span>
                    <em>{{ joinedLabel }}</em>
                </div>
                {% if isAdmin and adminUsersUrl %}
                    <a class=\"ops-nav__item\" href=\"{{ adminUsersUrl }}\">
                        <span>Check users</span>
                        <em>Manage</em>
                    </a>
                {% endif %}
                {% if isAdmin and userDirectoryUrl %}
                    <a class=\"ops-nav__item\" href=\"{{ userDirectoryUrl }}\">
                        <span>Search users</span>
                        <em>Filter</em>
                    </a>
                {% endif %}
            </nav>

            <div class=\"ops-sidebar__footer\">
                <a href=\"{{ path('app_logout') }}\">Log out</a>
            </div>
        </aside>

        <main class=\"ops-main\">
            <section class=\"ops-topbar\">
                <div>
                    <h1>Dashboard</h1>
                    <p>
                        {% if isAdmin %}
                            One place for member visibility, approvals, and user management.
                        {% else %}
                            One place for your FurHope account and next steps.
                        {% endif %}
                    </p>
                </div>

                <div class=\"ops-topbar__actions\">
                    <a class=\"ops-button ops-button--accent\" href=\"{{ path('feed_index') }}\">Social feed</a>
                    {% if isAdmin and userDirectoryUrl %}
                        <a class=\"ops-button ops-button--ghost\" href=\"{{ userDirectoryUrl }}\">Search users</a>
                    {% endif %}
                    {% if isAdmin and adminUsersUrl %}
                        <a class=\"ops-button ops-button--accent\" href=\"{{ adminUsersUrl }}\">Check users</a>
                    {% endif %}
                    <a class=\"ops-button ops-button--ghost\" href=\"{{ path('app_home') }}\">Public site</a>
                </div>
            </section>

            <section class=\"ops-summary\">
                <article class=\"ops-stat\">
                    <span>Verification</span>
                    <strong>{{ member.isVerified ? 'Yes' : 'No' }}</strong>
                </article>
                <article class=\"ops-stat\">
                    <span>Account</span>
                    <strong>{{ member.isActive ? 'Active' : 'Paused' }}</strong>
                </article>
                <article class=\"ops-stat\">
                    <span>Roles</span>
                    <strong>{{ member.roles|length }}</strong>
                </article>
            </section>

            <section class=\"ops-grid\">
                <article class=\"ops-card ops-card--chart\">
                    <div class=\"ops-card__header\">
                        <h2>Activity</h2>
                        <small>Updated from live account state</small>
                    </div>

                    <div class=\"ops-graph\">
                        <div class=\"ops-graph__labels\">
                            <span>40k</span>
                            <span>30k</span>
                            <span>20k</span>
                            <span>10k</span>
                            <span>0k</span>
                        </div>
                        <div class=\"ops-graph__canvas\">
                            <svg viewBox=\"0 0 520 240\" aria-hidden=\"true\">
                                <path d=\"M20 170 C80 70, 140 60, 200 155 S320 205, 370 95 S450 120, 500 45\" />
                            </svg>
                            <div class=\"ops-graph__tooltip\">
                                <strong>{{ member.isVerified ? '32 210' : '18 420' }}</strong>
                                <span>{{ isAdmin ? 'Dashboard health' : 'Account progress' }}</span>
                            </div>
                        </div>
                        <div class=\"ops-graph__days\">
                            <span>01</span>
                            <span>02</span>
                            <span>03</span>
                            <span>04</span>
                            <span>05</span>
                            <span>06</span>
                            <span>07</span>
                        </div>
                    </div>
                </article>

                <article class=\"ops-card ops-card--feature\">
                    <div class=\"ops-feature\">
                        <div>
                            <span>FurHope flow</span>
                            <h2>{{ isAdmin ? 'Keep reviews moving' : 'Keep your account moving' }}</h2>
                            <p>
                                {% if isAdmin %}
                                    Use the shared dashboard and user manager to process reviews faster.
                                {% else %}
                                    Track your verification and access status without leaving the dashboard.
                                {% endif %}
                            </p>
                        </div>
                        <div class=\"ops-feature__badge\">{{ isAdmin ? 'ADMIN' : 'MEMBER' }}</div>
                    </div>
                </article>
            </section>

            <section class=\"ops-grid ops-grid--bottom\">
                <article class=\"ops-card\">
                    <div class=\"ops-card__header\">
                        <h2>{{ isAdmin ? 'Priority list' : 'Your account' }}</h2>
                        <small>{{ isAdmin ? 'Needs action now' : 'Current state' }}</small>
                    </div>

                    <div class=\"ops-list\">
                        {% if isAdmin %}
                            {% for user in pendingVeteranApplicants %}
                                <div class=\"ops-list__item\">
                                    <div>
                                        <strong>{{ user.fullName }}</strong>
                                        <span>{{ user.email }}</span>
                                    </div>
                                    <b>{{ user.createdAt ? user.createdAt|date('d M') : 'New' }}</b>
                                </div>
                            {% else %}
                                <div class=\"ops-list__item ops-list__item--empty\">
                                    <div>
                                        <strong>No pending veterinary reviews</strong>
                                        <span>The queue is currently clear.</span>
                                    </div>
                                </div>
                            {% endfor %}
                        {% else %}
                            <div class=\"ops-list__item\">
                                <div>
                                    <strong>Email verification</strong>
                                    <span>{{ member.isVerified ? 'Your email is verified.' : 'Still waiting for verification.' }}</span>
                                </div>
                                <b>{{ member.isVerified ? 'Done' : 'Pending' }}</b>
                            </div>
                            <div class=\"ops-list__item\">
                                <div>
                                    <strong>Account access</strong>
                                    <span>{{ member.isActive ? 'Your account is active.' : 'Your account needs review.' }}</span>
                                </div>
                                <b>{{ member.isActive ? 'Open' : 'Paused' }}</b>
                            </div>
                            <div class=\"ops-list__item\">
                                <div>
                                    <strong>Veterinary request</strong>
                                    <span>
                                        {% if member.isVeteranApplicant %}
                                            {{ member.isVeteranApproved ? 'Approved for veterinary access.' : 'Request pending review.' }}
                                        {% else %}
                                            No veterinary access request sent.
                                        {% endif %}
                                    </span>
                                </div>
                                <b>
                                    {% if member.isVeteranApproved %}
                                        Approved
                                    {% elseif member.isVeteranApplicant %}
                                        Pending
                                    {% else %}
                                        None
                                    {% endif %}
                                </b>
                            </div>
                        {% endif %}
                    </div>
                </article>

                <article class=\"ops-card\">
                    <div class=\"ops-card__header\">
                        <h2>{{ isAdmin ? 'Top performers' : 'Profile details' }}</h2>
                        <small>{{ isAdmin ? 'Newest members' : 'Personal information' }}</small>
                    </div>

                    <div class=\"ops-list\">
                        {% if isAdmin %}
                            {% for user in recentUsers %}
                                <div class=\"ops-list__item\">
                                    <div>
                                        <strong>{{ user.fullName }}</strong>
                                        <span>{{ user.email }}</span>
                                    </div>
                                    <b>{{ user.isVerified ? 'Verified' : 'Unverified' }}</b>
                                </div>
                            {% else %}
                                <div class=\"ops-list__item ops-list__item--empty\">
                                    <div>
                                        <strong>No recent members</strong>
                                        <span>New signups will appear here.</span>
                                    </div>
                                </div>
                            {% endfor %}
                        {% else %}
                            <div class=\"ops-list__item\">
                                <div>
                                    <strong>Full name</strong>
                                    <span>{{ member.fullName }}</span>
                                </div>
                            </div>
                            <div class=\"ops-list__item\">
                                <div>
                                    <strong>Email</strong>
                                    <span>{{ member.email }}</span>
                                </div>
                            </div>
                            <div class=\"ops-list__item\">
                                <div>
                                    <strong>Phone</strong>
                                    <span>{{ member.phoneNumber ?: 'Not provided' }}</span>
                                </div>
                            </div>
                        {% endif %}
                    </div>
                </article>
            </section>

            {% if isAdmin and stats %}
                <section class=\"ops-channels\">
                    <div class=\"ops-channels__intro\">
                        <h2>Channels</h2>
                        <p>Your shelter management snapshot for this week.</p>
                    </div>
                    <div class=\"ops-channel-grid\">
                        <article class=\"ops-channel-card\">
                            <span>Total users</span>
                            <strong>{{ stats.allUsers }}</strong>
                        </article>
                        <article class=\"ops-channel-card\">
                            <span>Active users</span>
                            <strong>{{ stats.activeUsers }}</strong>
                        </article>
                        <article class=\"ops-channel-card\">
                            <span>Verified</span>
                            <strong>{{ stats.verifiedUsers }}</strong>
                        </article>
                        <article class=\"ops-channel-card\">
                            <span>Admins</span>
                            <strong>{{ stats.admins }}</strong>
                        </article>
                    </div>
                    {% if adminUsersUrl %}
                        <a class=\"ops-channels__cta\" href=\"{{ adminUsersUrl }}\">Full stats</a>
                    {% endif %}
                </section>
            {% endif %}
        </main>
    </div>
{% endblock %}
", "dashboard/index.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\dashboard\\index.html.twig");
    }
}
