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

/* home/index.html.twig */
class __TwigTemplate_e6019f3b54fd9d05a9532ce68d3c49b0 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/index.html.twig"));

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

        yield "FurHope | Shelter Welcome";
        
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
        yield "    ";
        $context["slides"] = [["image" => "https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=1200&q=80", "alt" => "A happy brown rescue dog looking toward the camera outdoors.", "title" => "Fast access for members", "text" => "Open the right page quickly without digging through the site."], ["image" => "https://images.unsplash.com/photo-1511044568932-338cba0ad803?auto=format&fit=crop&w=1200&q=80", "alt" => "A calm ginger rescue cat lying comfortably indoors.", "title" => "Clear paths for sign in and registration", "text" => "New visitors and existing members should reach their next step immediately."], ["image" => "https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?auto=format&fit=crop&w=1200&q=80", "alt" => "A white rabbit sitting in green grass in daylight.", "title" => "Admin tools where they belong", "text" => "Management shortcuts appear when needed without overwhelming public visitors."]];
        // line 26
        yield "    ";
        $context["quickLinks"] = [["href" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 28
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 28, $this->source); })()), "user", [], "any", false, false, false, 28)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dashboard")) : ($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register"))), "title" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 29
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 29, $this->source); })()), "user", [], "any", false, false, false, 29)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("My FurHope") : ("Join FurHope")), "text" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 30
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 30, $this->source); })()), "user", [], "any", false, false, false, 30)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("See your volunteer space, shelter updates, and next steps.") : ("Create your profile to support rescue work, fostering, and shelter care.")), "icon" => "grid"], ["href" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login"), "title" => "Sign in", "text" => "Return to your FurHope space to follow updates and stay connected with the shelter.", "icon" => "lock"], ["href" => (((CoreExtension::getAttribute($this->env, $this->source,         // line 40
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 40, $this->source); })()), "user", [], "any", false, false, false, 40) && $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN"))) ? ($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_user_index")) : ($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home"))), "title" => (((CoreExtension::getAttribute($this->env, $this->source,         // line 41
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 41, $this->source); })()), "user", [], "any", false, false, false, 41) && $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN"))) ? ("Shelter team") : ("Our shelter")), "text" => (((CoreExtension::getAttribute($this->env, $this->source,         // line 42
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 42, $this->source); })()), "user", [], "any", false, false, false, 42) && $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN"))) ? ("Review volunteer and member records for the people supporting FurHope.") : ("Meet the mission behind FurHope and the animals it cares for.")), "icon" => (((CoreExtension::getAttribute($this->env, $this->source,         // line 43
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 43, $this->source); })()), "user", [], "any", false, false, false, 43) && $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN"))) ? ("users") : ("heart"))]];
        // line 46
        yield "    <section class=\"panel hero hero--showcase\">
        <div class=\"hero-copy\">
            <div class=\"eyebrow\">Rescue support, member access, and shelter operations</div>
            <h1>Everything important should be one click away.</h1>
            <p>
                FurHope should feel warm, welcoming, and easy to move through.
                Use the shortcut cards below to find the right place quickly, whether you are joining, returning, or learning about the shelter.
            </p>
            <div class=\"nav\" style=\"margin-top: 18px;\">
                ";
        // line 55
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 55, $this->source); })()), "user", [], "any", false, false, false, 55)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 56
            yield "                    <a class=\"button-primary\" href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dashboard");
            yield "\">Open dashboard</a>
                ";
        } else {
            // line 58
            yield "                    <a class=\"button-primary\" href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
            yield "\">Join FurHope</a>
                    <a class=\"button-secondary\" href=\"";
            // line 59
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\">Sign in</a>
                ";
        }
        // line 61
        yield "            </div>
            <div class=\"story-ribbon\">
                <span>Volunteer support</span>
                <span>Rescue care</span>
                <span>Welcoming first steps</span>
            </div>
        </div>

        <aside class=\"panel hero-slideshow\" aria-label=\"FurHope highlights\">
            ";
        // line 70
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["slides"]) || array_key_exists("slides", $context) ? $context["slides"] : (function () { throw new RuntimeError('Variable "slides" does not exist.', 70, $this->source); })()));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["slide"]) {
            // line 71
            yield "                <figure class=\"hero-slideshow__frame\">
                    <img class=\"hero-slideshow__image\" src=\"";
            // line 72
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["slide"], "image", [], "any", false, false, false, 72), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["slide"], "alt", [], "any", false, false, false, 72), "html", null, true);
            yield "\" loading=\"";
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 72)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("eager") : ("lazy"));
            yield "\" referrerpolicy=\"no-referrer\">
                    <figcaption class=\"hero-slideshow__caption\">
                        <strong>";
            // line 74
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["slide"], "title", [], "any", false, false, false, 74), "html", null, true);
            yield "</strong>
                        <span>";
            // line 75
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["slide"], "text", [], "any", false, false, false, 75), "html", null, true);
            yield "</span>
                    </figcaption>
                </figure>
            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['slide'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 79
        yield "            <div class=\"hero-slideshow__dots\" aria-hidden=\"true\">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </aside>
    </section>

    <section class=\"quick-link-grid\">
        ";
        // line 88
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["quickLinks"]) || array_key_exists("quickLinks", $context) ? $context["quickLinks"] : (function () { throw new RuntimeError('Variable "quickLinks" does not exist.', 88, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
            // line 89
            yield "            <a class=\"quick-link-card\" href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["link"], "href", [], "any", false, false, false, 89), "html", null, true);
            yield "\">
                <span class=\"quick-link-card__icon\">
                    ";
            // line 91
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["link"], "icon", [], "any", false, false, false, 91) == "grid")) {
                // line 92
                yield "                        <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                            <rect x=\"3\" y=\"3\" width=\"7\" height=\"7\"></rect>
                            <rect x=\"14\" y=\"3\" width=\"7\" height=\"7\"></rect>
                            <rect x=\"3\" y=\"14\" width=\"7\" height=\"7\"></rect>
                            <rect x=\"14\" y=\"14\" width=\"7\" height=\"7\"></rect>
                        </svg>
                    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 98
$context["link"], "icon", [], "any", false, false, false, 98) == "lock")) {
                // line 99
                yield "                        <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                            <rect x=\"4\" y=\"11\" width=\"16\" height=\"10\" rx=\"2\"></rect>
                            <path d=\"M8 11V8a4 4 0 0 1 8 0v3\"></path>
                        </svg>
                    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 103
$context["link"], "icon", [], "any", false, false, false, 103) == "users")) {
                // line 104
                yield "                        <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                            <path d=\"M16 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2\"></path>
                            <circle cx=\"9.5\" cy=\"7\" r=\"4\"></circle>
                            <path d=\"M22 21v-2a4 4 0 0 0-3-3.87\"></path>
                            <path d=\"M16 3.13a4 4 0 0 1 0 7.75\"></path>
                        </svg>
                    ";
            } else {
                // line 111
                yield "                        <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                            <path d=\"M12 21s-7-4.35-7-10a4 4 0 0 1 7-2.65A4 4 0 0 1 19 11c0 5.65-7 10-7 10z\"></path>
                        </svg>
                    ";
            }
            // line 115
            yield "                </span>
                <div>
                    <strong>";
            // line 117
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["link"], "title", [], "any", false, false, false, 117), "html", null, true);
            yield "</strong>
                    <p>";
            // line 118
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["link"], "text", [], "any", false, false, false, 118), "html", null, true);
            yield "</p>
                </div>
            </a>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['link'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 122
        yield "    </section>

    <section class=\"panel home-feature-band home-feature-band--compact\">
        <div>
            <div class=\"eyebrow\">A calmer welcome</div>
            <h2>Supporters, volunteers, and visitors should feel guided from the moment they arrive.</h2>
        </div>
        <div class=\"feature-list\">
            <article class=\"feature-item\">
                <strong>Easy paths</strong>
                <p>Quick links help people reach joining, sign-in, and shelter information without confusion.</p>
            </article>
            <article class=\"feature-item\">
                <strong>Less clutter</strong>
                <p>A shorter page keeps the focus on helping animals, supporting care, and getting involved.</p>
            </article>
            <article class=\"feature-item\">
                <strong>Human tone</strong>
                <p>The language now feels more like an animal shelter and less like a technical portal.</p>
            </article>
        </div>
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
        return "home/index.html.twig";
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
        return array (  263 => 122,  253 => 118,  249 => 117,  245 => 115,  239 => 111,  230 => 104,  228 => 103,  222 => 99,  220 => 98,  212 => 92,  210 => 91,  204 => 89,  200 => 88,  189 => 79,  171 => 75,  167 => 74,  158 => 72,  155 => 71,  138 => 70,  127 => 61,  122 => 59,  117 => 58,  111 => 56,  109 => 55,  98 => 46,  96 => 43,  95 => 42,  94 => 41,  93 => 40,  92 => 30,  91 => 29,  90 => 28,  88 => 26,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}FurHope | Shelter Welcome{% endblock %}

{% block body %}
    {% set slides = [
        {
            image: 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=1200&q=80',
            alt: 'A happy brown rescue dog looking toward the camera outdoors.',
            title: 'Fast access for members',
            text: 'Open the right page quickly without digging through the site.'
        },
        {
            image: 'https://images.unsplash.com/photo-1511044568932-338cba0ad803?auto=format&fit=crop&w=1200&q=80',
            alt: 'A calm ginger rescue cat lying comfortably indoors.',
            title: 'Clear paths for sign in and registration',
            text: 'New visitors and existing members should reach their next step immediately.'
        },
        {
            image: 'https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?auto=format&fit=crop&w=1200&q=80',
            alt: 'A white rabbit sitting in green grass in daylight.',
            title: 'Admin tools where they belong',
            text: 'Management shortcuts appear when needed without overwhelming public visitors.'
        }
    ] %}
    {% set quickLinks = [
        {
            href: app.user ? path('app_dashboard') : path('app_register'),
            title: app.user ? 'My FurHope' : 'Join FurHope',
            text: app.user ? 'See your volunteer space, shelter updates, and next steps.' : 'Create your profile to support rescue work, fostering, and shelter care.',
            icon: 'grid'
        },
        {
            href: path('app_login'),
            title: 'Sign in',
            text: 'Return to your FurHope space to follow updates and stay connected with the shelter.',
            icon: 'lock'
        },
        {
            href: app.user and is_granted('ROLE_ADMIN') ? path('admin_user_index') : path('app_home'),
            title: app.user and is_granted('ROLE_ADMIN') ? 'Shelter team' : 'Our shelter',
            text: app.user and is_granted('ROLE_ADMIN') ? 'Review volunteer and member records for the people supporting FurHope.' : 'Meet the mission behind FurHope and the animals it cares for.',
            icon: app.user and is_granted('ROLE_ADMIN') ? 'users' : 'heart'
        }
    ] %}
    <section class=\"panel hero hero--showcase\">
        <div class=\"hero-copy\">
            <div class=\"eyebrow\">Rescue support, member access, and shelter operations</div>
            <h1>Everything important should be one click away.</h1>
            <p>
                FurHope should feel warm, welcoming, and easy to move through.
                Use the shortcut cards below to find the right place quickly, whether you are joining, returning, or learning about the shelter.
            </p>
            <div class=\"nav\" style=\"margin-top: 18px;\">
                {% if app.user %}
                    <a class=\"button-primary\" href=\"{{ path('app_dashboard') }}\">Open dashboard</a>
                {% else %}
                    <a class=\"button-primary\" href=\"{{ path('app_register') }}\">Join FurHope</a>
                    <a class=\"button-secondary\" href=\"{{ path('app_login') }}\">Sign in</a>
                {% endif %}
            </div>
            <div class=\"story-ribbon\">
                <span>Volunteer support</span>
                <span>Rescue care</span>
                <span>Welcoming first steps</span>
            </div>
        </div>

        <aside class=\"panel hero-slideshow\" aria-label=\"FurHope highlights\">
            {% for slide in slides %}
                <figure class=\"hero-slideshow__frame\">
                    <img class=\"hero-slideshow__image\" src=\"{{ slide.image }}\" alt=\"{{ slide.alt }}\" loading=\"{{ loop.first ? 'eager' : 'lazy' }}\" referrerpolicy=\"no-referrer\">
                    <figcaption class=\"hero-slideshow__caption\">
                        <strong>{{ slide.title }}</strong>
                        <span>{{ slide.text }}</span>
                    </figcaption>
                </figure>
            {% endfor %}
            <div class=\"hero-slideshow__dots\" aria-hidden=\"true\">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </aside>
    </section>

    <section class=\"quick-link-grid\">
        {% for link in quickLinks %}
            <a class=\"quick-link-card\" href=\"{{ link.href }}\">
                <span class=\"quick-link-card__icon\">
                    {% if link.icon == 'grid' %}
                        <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                            <rect x=\"3\" y=\"3\" width=\"7\" height=\"7\"></rect>
                            <rect x=\"14\" y=\"3\" width=\"7\" height=\"7\"></rect>
                            <rect x=\"3\" y=\"14\" width=\"7\" height=\"7\"></rect>
                            <rect x=\"14\" y=\"14\" width=\"7\" height=\"7\"></rect>
                        </svg>
                    {% elseif link.icon == 'lock' %}
                        <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                            <rect x=\"4\" y=\"11\" width=\"16\" height=\"10\" rx=\"2\"></rect>
                            <path d=\"M8 11V8a4 4 0 0 1 8 0v3\"></path>
                        </svg>
                    {% elseif link.icon == 'users' %}
                        <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                            <path d=\"M16 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2\"></path>
                            <circle cx=\"9.5\" cy=\"7\" r=\"4\"></circle>
                            <path d=\"M22 21v-2a4 4 0 0 0-3-3.87\"></path>
                            <path d=\"M16 3.13a4 4 0 0 1 0 7.75\"></path>
                        </svg>
                    {% else %}
                        <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                            <path d=\"M12 21s-7-4.35-7-10a4 4 0 0 1 7-2.65A4 4 0 0 1 19 11c0 5.65-7 10-7 10z\"></path>
                        </svg>
                    {% endif %}
                </span>
                <div>
                    <strong>{{ link.title }}</strong>
                    <p>{{ link.text }}</p>
                </div>
            </a>
        {% endfor %}
    </section>

    <section class=\"panel home-feature-band home-feature-band--compact\">
        <div>
            <div class=\"eyebrow\">A calmer welcome</div>
            <h2>Supporters, volunteers, and visitors should feel guided from the moment they arrive.</h2>
        </div>
        <div class=\"feature-list\">
            <article class=\"feature-item\">
                <strong>Easy paths</strong>
                <p>Quick links help people reach joining, sign-in, and shelter information without confusion.</p>
            </article>
            <article class=\"feature-item\">
                <strong>Less clutter</strong>
                <p>A shorter page keeps the focus on helping animals, supporting care, and getting involved.</p>
            </article>
            <article class=\"feature-item\">
                <strong>Human tone</strong>
                <p>The language now feels more like an animal shelter and less like a technical portal.</p>
            </article>
        </div>
    </section>
{% endblock %}
", "home/index.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\home\\index.html.twig");
    }
}
