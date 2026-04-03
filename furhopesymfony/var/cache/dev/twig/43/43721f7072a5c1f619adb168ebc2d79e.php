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

/* base.html.twig */
class __TwigTemplate_989ba25de7199c786a08045b0b471497 extends Template
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
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'javascripts' => [$this, 'block_javascripts'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>";
        // line 6
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
        <link rel=\"icon\" href=\"data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221em%22 font-size=%2296%22>&amp;#128062;</text></svg>\">
        ";
        // line 8
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 995
        yield "        ";
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 996
        yield "    </head>
    <body>
        <header class=\"site-header\">
            <div class=\"shell site-header__inner\">
                <a class=\"brand\" href=\"";
        // line 1000
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">
                    <span class=\"brand__mark\">&#128062;</span>
                    <span>FurHope Animal Shelter</span>
                </a>
                <nav class=\"nav\">
                    <a href=\"";
        // line 1005
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">Home</a>
                    ";
        // line 1006
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 1006, $this->source); })()), "user", [], "any", false, false, false, 1006)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 1007
            yield "                        <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dashboard");
            yield "\">Dashboard</a>
                        <a href=\"";
            // line 1008
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("feed_index");
            yield "\">Social feed</a>
                        <a class=\"nav-profile\" href=\"";
            // line 1009
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile");
            yield "\" aria-label=\"Open profile\">
                            <span class=\"profile-avatar profile-avatar--small\">
                                ";
            // line 1011
            $context["navAvatarUrl"] = $this->extensions['App\Twig\SocialExtension']->socialAvatarUrl(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 1011, $this->source); })()), "user", [], "any", false, false, false, 1011));
            // line 1012
            yield "                                ";
            if ((($tmp = (isset($context["navAvatarUrl"]) || array_key_exists("navAvatarUrl", $context) ? $context["navAvatarUrl"] : (function () { throw new RuntimeError('Variable "navAvatarUrl" does not exist.', 1012, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 1013
                yield "                                    <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["navAvatarUrl"]) || array_key_exists("navAvatarUrl", $context) ? $context["navAvatarUrl"] : (function () { throw new RuntimeError('Variable "navAvatarUrl" does not exist.', 1013, $this->source); })()), "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 1013, $this->source); })()), "user", [], "any", false, false, false, 1013), "fullName", [], "any", false, false, false, 1013), "html", null, true);
                yield "\" referrerpolicy=\"no-referrer\">
                                ";
            } else {
                // line 1015
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 1015, $this->source); })()), "user", [], "any", false, false, false, 1015), "initials", [], "any", false, false, false, 1015), "html", null, true);
                yield "
                                ";
            }
            // line 1017
            yield "                            </span>
                        </a>
                        <a class=\"button-secondary\" href=\"";
            // line 1019
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\">Logout</a>
                    ";
        } else {
            // line 1021
            yield "                        <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\">Sign in</a>
                        <a class=\"button-primary\" href=\"";
            // line 1022
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
            yield "\">Create account</a>
                    ";
        }
        // line 1024
        yield "                </nav>
            </div>
        </header>

        <main class=\"layout\">
            <div class=\"shell\">
                <div class=\"flash-list\">
                    ";
        // line 1031
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 1031, $this->source); })()), "flashes", [], "any", false, false, false, 1031));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 1032
            yield "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 1033
                yield "                            <div class=\"flash flash-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "</div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1035
            yield "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1036
        yield "                </div>

                ";
        // line 1038
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 1039
        yield "            </div>
        </main>

        <footer class=\"shell site-footer\"></footer>
    </body>
</html>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "FurHope Animal Shelter";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 9
        yield "            <style>
                :root {
                    --canvas: #f7f1e3;
                    --ink: #1b1b18;
                    --muted: #6e655d;
                    --accent: #cf6a32;
                    --forest: #4d6b4f;
                    --card: rgba(255, 251, 244, 0.88);
                    --line: rgba(27, 27, 24, 0.08);
                    --shadow: 0 24px 60px rgba(82, 57, 30, 0.16);
                    --radius: 24px;
                }

                * { box-sizing: border-box; }

                body {
                    margin: 0;
                    font-family: Georgia, \"Times New Roman\", serif;
                    color: var(--ink);
                    background:
                        radial-gradient(circle at top left, rgba(207, 106, 50, 0.20), transparent 36%),
                        radial-gradient(circle at top right, rgba(77, 107, 79, 0.18), transparent 28%),
                        linear-gradient(180deg, var(--canvas) 0%, #f4ede0 100%);
                    min-height: 100vh;
                }

                a { color: inherit; text-decoration: none; }

                .shell {
                    width: min(1120px, calc(100% - 32px));
                    margin: 0 auto;
                }

                .site-header {
                    position: sticky;
                    top: 0;
                    z-index: 20;
                    backdrop-filter: blur(16px);
                    background: rgba(247, 241, 227, 0.82);
                    border-bottom: 1px solid var(--line);
                }

                .site-header__inner,
                .site-footer {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 18px;
                    padding: 18px 0;
                }

                .brand {
                    display: inline-flex;
                    gap: 12px;
                    align-items: center;
                    font-weight: 700;
                    letter-spacing: 0.02em;
                }

                .brand__mark {
                    width: 44px;
                    height: 44px;
                    display: grid;
                    place-items: center;
                    border-radius: 16px;
                    background: linear-gradient(135deg, var(--accent), #f2b15f);
                    color: white;
                    box-shadow: var(--shadow);
                    font-size: 1.35rem;
                }

                .nav {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    flex-wrap: wrap;
                }

                .nav-profile {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 44px;
                    height: 44px;
                    padding: 0;
                    border-radius: 999px;
                    border: 1px solid rgba(27, 27, 24, 0.14);
                    background: rgba(255, 255, 255, 0.72);
                    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.4);
                    overflow: hidden;
                }

                .profile-avatar {
                    width: 56px;
                    height: 56px;
                    display: inline-grid;
                    place-items: center;
                    border-radius: 999px;
                    background: linear-gradient(135deg, var(--accent), #f2b15f);
                    color: #fff;
                    font-weight: 700;
                    letter-spacing: 0.04em;
                    overflow: hidden;
                }

                .profile-avatar img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                }

                .profile-avatar--small {
                    width: 44px;
                    height: 44px;
                    font-size: 0.9rem;
                }

                .profile-avatar--large {
                    width: 108px;
                    height: 108px;
                    font-size: 2rem;
                    box-shadow: 0 18px 32px rgba(82, 57, 30, 0.18);
                }

                .profile-avatar--cover {
                    width: 148px;
                    height: 148px;
                    font-size: 2.6rem;
                    border: 6px solid rgba(255, 251, 244, 0.96);
                    box-shadow: 0 22px 40px rgba(54, 39, 24, 0.22);
                }

                .nav a,
                .button {
                    padding: 11px 18px;
                    border-radius: 999px;
                    border: 1px solid transparent;
                    transition: transform 0.24s ease, background-color 0.24s ease, box-shadow 0.24s ease, border-color 0.24s ease;
                }

                .nav a:hover,
                .button:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 12px 28px rgba(82, 57, 30, 0.12);
                }

                .button-primary,
                .button-secondary {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                }

                .button-primary {
                    background: var(--accent);
                    color: #fff;
                    border: 1px solid var(--accent);
                }

                .button-primary:hover,
                .button-primary:focus-visible {
                    background: #b95a27;
                    border-color: #b95a27;
                }

                .button-secondary {
                    background: rgba(255, 255, 255, 0.78);
                    border: 1px solid rgba(27, 27, 24, 0.18);
                    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.35);
                }

                .button-secondary:hover,
                .button-secondary:focus-visible {
                    background: rgba(255, 255, 255, 0.82);
                    border-color: rgba(27, 27, 24, 0.18);
                }

                .layout { padding: 42px 0 56px; }

                .panel {
                    background: var(--card);
                    border: 1px solid rgba(255, 255, 255, 0.7);
                    border-radius: var(--radius);
                    box-shadow: var(--shadow);
                    position: relative;
                    overflow: clip;
                }

                .hero {
                    display: grid;
                    grid-template-columns: 1.2fr 0.8fr;
                    gap: 28px;
                    padding: 28px;
                }

                .hero--showcase {
                    align-items: stretch;
                }

                .hero--showcase::before {
                    content: \"\";
                    position: absolute;
                    inset: auto -80px -120px auto;
                    width: 280px;
                    height: 280px;
                    border-radius: 999px;
                    background: radial-gradient(circle, rgba(207, 106, 50, 0.18) 0%, rgba(207, 106, 50, 0) 72%);
                    pointer-events: none;
                }

                h1, h2, h3 {
                    margin-top: 0;
                    line-height: 1.05;
                }

                h1 {
                    font-size: clamp(2.6rem, 7vw, 4.8rem);
                    margin-bottom: 18px;
                }

                .eyebrow,
                .muted { color: var(--muted); }

                .hero-copy p,
                .card p { line-height: 1.6; font-size: 1.02rem; }

                .hero-copy {
                    display: grid;
                    align-content: center;
                    position: relative;
                    z-index: 1;
                    gap: 14px;
                }

                .metrics,
                .grid { display: grid; gap: 18px; }

                .metrics {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    margin-top: 24px;
                }

                .grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    margin-top: 28px;
                }

                .card,
                .metric,
                .form-card {
                    padding: 24px;
                    border-radius: 22px;
                    background: rgba(255, 255, 255, 0.62);
                    border: 1px solid rgba(27, 27, 24, 0.08);
                    transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
                }

                .card:hover,
                .metric:hover,
                .form-card:hover,
                .feature-item:hover {
                    transform: translateY(-4px);
                    box-shadow: 0 24px 44px rgba(82, 57, 30, 0.15);
                    border-color: rgba(207, 106, 50, 0.18);
                }

                .metric strong {
                    display: block;
                    font-size: 2rem;
                    margin-bottom: 8px;
                }

                .stack { display: grid; gap: 16px; }

                .story-ribbon {
                    display: flex;
                    gap: 10px;
                    flex-wrap: wrap;
                    margin-top: 24px;
                }

                .story-ribbon span {
                    padding: 10px 14px;
                    border-radius: 999px;
                    background: rgba(255, 255, 255, 0.82);
                    border: 1px solid rgba(27, 27, 24, 0.16);
                    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.4);
                    color: var(--muted);
                }

                .hero-slideshow {
                    position: relative;
                    min-height: 520px;
                    overflow: hidden;
                    isolation: isolate;
                    background: #1c2b21;
                    transform: translateZ(0);
                }

                .hero-slideshow::after {
                    content: \"\";
                    position: absolute;
                    inset: 0;
                    background:
                        linear-gradient(180deg, rgba(14, 18, 16, 0.10) 0%, rgba(14, 18, 16, 0.58) 100%),
                        linear-gradient(135deg, rgba(207, 106, 50, 0.22) 0%, transparent 42%);
                    z-index: 1;
                }

                .hero-slideshow__frame {
                    position: absolute;
                    inset: 0;
                    margin: 0;
                    opacity: 0;
                    animation: slideshowFade 18s infinite;
                    will-change: opacity;
                }

                .hero-slideshow__frame:nth-child(2) { animation-delay: 6s; }
                .hero-slideshow__frame:nth-child(3) { animation-delay: 12s; }

                .hero-slideshow__image {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                    transform: scale(1.04);
                    animation: slideshowZoom 18s infinite;
                    filter: saturate(1.02) contrast(1.02);
                }

                .hero-slideshow__caption {
                    position: absolute;
                    left: 24px;
                    right: 24px;
                    bottom: 24px;
                    z-index: 2;
                    padding: 18px 20px;
                    border-radius: 20px;
                    background: rgba(250, 245, 238, 0.88);
                    border: 1px solid rgba(27, 27, 24, 0.10);
                    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.14);
                }

                .hero-slideshow__caption strong {
                    display: block;
                    margin-bottom: 6px;
                    font-size: 1.1rem;
                }

                .hero-slideshow__caption span {
                    color: var(--muted);
                    line-height: 1.5;
                }

                .hero-slideshow__dots {
                    position: absolute;
                    top: 24px;
                    right: 24px;
                    z-index: 2;
                    display: inline-flex;
                    gap: 8px;
                    padding: 10px 14px;
                    border-radius: 999px;
                    background: rgba(255, 251, 244, 0.72);
                    border: 1px solid rgba(27, 27, 24, 0.08);
                }

                .hero-slideshow__dots span {
                    width: 10px;
                    height: 10px;
                    border-radius: 999px;
                    background: rgba(27, 27, 24, 0.18);
                    animation: slideshowDot 18s infinite;
                }

                .hero-slideshow__dots span:nth-child(2) { animation-delay: 6s; }
                .hero-slideshow__dots span:nth-child(3) { animation-delay: 12s; }

                @keyframes slideshowFade {
                    0%,
                    29% { opacity: 1; }
                    33%,
                    100% { opacity: 0; }
                }

                @keyframes slideshowZoom {
                    0%,
                    33% { transform: scale(1.04); }
                    100% { transform: scale(1.1); }
                }

                @keyframes slideshowDot {
                    0%,
                    29% { background: var(--accent); transform: scale(1.1); }
                    33%,
                    100% { background: rgba(27, 27, 24, 0.18); transform: scale(1); }
                }

                .auth-wrap {
                    width: min(620px, 100%);
                    margin: 0 auto;
                }

                .auth-card {
                    padding: 34px 28px 28px;
                }

                .auth-form {
                    display: grid;
                    gap: 18px;
                }

                .form-group {
                    display: grid;
                    gap: 8px;
                }

                .form-help {
                    font-size: 0.95rem;
                    color: var(--muted);
                    margin: 0;
                }

                .field-error {
                    display: none;
                    margin: 0;
                    font-size: 0.92rem;
                    color: #8f2e2e;
                }

                .field-error.is-visible {
                    display: block;
                }

                .form-group ul {
                    margin: 0;
                    padding-left: 18px;
                    color: #8f2e2e;
                    font-size: 0.92rem;
                }

                .auth-form .button-primary {
                    width: 100%;
                    min-height: 54px;
                    padding: 14px 20px;
                    font-size: 1rem;
                    font-weight: 700;
                    letter-spacing: 0.01em;
                    box-shadow: 0 16px 34px rgba(207, 106, 50, 0.22);
                }

                .auth-form .button-primary:hover,
                .auth-form .button-primary:focus-visible {
                    transform: translateY(-2px);
                    box-shadow: 0 18px 38px rgba(185, 90, 39, 0.28);
                }

                form { display: grid; gap: 16px; }

                label {
                    display: block;
                    margin-bottom: 8px;
                    font-weight: 700;
                }

                input,
                select,
                textarea {
                    width: 100%;
                    padding: 14px 16px;
                    border: 1px solid rgba(27, 27, 24, 0.16);
                    border-radius: 14px;
                    background: rgba(255, 255, 255, 0.9);
                    font: inherit;
                }

                input:focus,
                select:focus,
                textarea:focus {
                    outline: none;
                    border-color: rgba(207, 106, 50, 0.6);
                    box-shadow: 0 0 0 4px rgba(207, 106, 50, 0.12);
                }

                input[aria-invalid=\"true\"],
                select[aria-invalid=\"true\"],
                textarea[aria-invalid=\"true\"] {
                    border-color: rgba(143, 46, 46, 0.5);
                    box-shadow: 0 0 0 4px rgba(143, 46, 46, 0.10);
                }

                .checkbox-row {
                    display: flex;
                    align-items: flex-start;
                    gap: 12px;
                    padding: 14px 16px;
                    border-radius: 16px;
                    background: rgba(255, 255, 255, 0.72);
                    border: 1px solid rgba(27, 27, 24, 0.08);
                }

                .checkbox-row input[type=\"checkbox\"] {
                    width: 18px;
                    height: 18px;
                    margin-top: 2px;
                    padding: 0;
                    flex: 0 0 auto;
                }

                .checkbox-row label {
                    margin: 0;
                    font-weight: 600;
                }

                .member-dashboard,
                .home-feature-band {
                    padding: 30px;
                }

                .member-dashboard {
                    background:
                        radial-gradient(circle at top right, rgba(207, 106, 50, 0.12), transparent 32%),
                        rgba(255, 251, 244, 0.92);
                }

                .grid--two {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .feature-list {
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 22px;
                    margin-top: 28px;
                }

                .quick-link-grid {
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 22px;
                    margin-top: 24px;
                    margin-bottom: 28px;
                }

                .quick-link-card {
                    display: grid;
                    grid-template-columns: 64px 1fr;
                    gap: 16px;
                    align-items: start;
                    padding: 20px;
                    border-radius: 22px;
                    background: rgba(255, 255, 255, 0.68);
                    border: 1px solid rgba(27, 27, 24, 0.08);
                    box-shadow: var(--shadow);
                    transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
                }

                .quick-link-card:hover {
                    transform: translateY(-4px);
                    box-shadow: 0 24px 44px rgba(82, 57, 30, 0.15);
                    border-color: rgba(207, 106, 50, 0.18);
                }

                .quick-link-card__icon {
                    width: 64px;
                    height: 64px;
                    display: grid;
                    place-items: center;
                    border-radius: 18px;
                    background: linear-gradient(135deg, rgba(207, 106, 50, 0.18), rgba(242, 177, 95, 0.24));
                    color: var(--accent);
                }

                .quick-link-card__icon svg {
                    width: 26px;
                    height: 26px;
                    stroke: currentColor;
                    fill: none;
                    stroke-width: 1.8;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                }

                .quick-link-card strong {
                    display: block;
                    margin-bottom: 8px;
                    font-size: 1.05rem;
                }

                .quick-link-card p {
                    margin: 0;
                    color: var(--muted);
                    line-height: 1.55;
                }

                .feature-item {
                    padding: 22px;
                    border-radius: 22px;
                    background: rgba(255, 255, 255, 0.64);
                    border: 1px solid rgba(27, 27, 24, 0.08);
                }

                .feature-item strong {
                    display: block;
                    margin-bottom: 8px;
                }

                .feature-item,
                .admin-spotlight-card {
                    backdrop-filter: blur(8px);
                }

                .home-feature-band--compact {
                    padding: 28px 30px;
                }

                .profile-page {
                    display: grid;
                    gap: 22px;
                }

                .profile-cover {
                    overflow: hidden;
                }

                .profile-cover__backdrop {
                    min-height: 220px;
                    background:
                        linear-gradient(135deg, rgba(207, 106, 50, 0.18), rgba(77, 107, 79, 0.20)),
                        url('https://images.unsplash.com/photo-1516934024742-b461fba47600?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
                }

                .profile-cover__content {
                    display: grid;
                    grid-template-columns: auto minmax(0, 1fr);
                    gap: 24px;
                    align-items: center;
                    padding: 0 30px 28px;
                    margin-top: -72px;
                    position: relative;
                    z-index: 1;
                }

                .profile-cover__avatar-wrap {
                    display: flex;
                    align-items: end;
                }

                .profile-photo-action,
                .profile-upload-trigger {
                    position: relative;
                    display: inline-flex;
                    width: fit-content;
                }

                .profile-photo-action__badge,
                .profile-upload-trigger__badge {
                    position: absolute;
                    right: 8px;
                    bottom: 10px;
                    width: 42px;
                    height: 42px;
                    display: grid;
                    place-items: center;
                    border-radius: 999px;
                    background: var(--accent);
                    color: #fff;
                    border: 3px solid rgba(255, 251, 244, 0.96);
                    box-shadow: 0 10px 18px rgba(82, 57, 30, 0.16);
                }

                .profile-photo-action__badge svg,
                .profile-upload-trigger__badge svg {
                    width: 18px;
                    height: 18px;
                    stroke: currentColor;
                    fill: none;
                    stroke-width: 2;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                }

                .profile-cover__main {
                    display: grid;
                    gap: 12px;
                    align-self: center;
                    min-width: 0;
                }

                .profile-title-stack {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    flex-wrap: wrap;
                }

                .profile-title-stack h1 {
                    margin-bottom: 0;
                    font-size: clamp(2.6rem, 6vw, 5rem);
                    line-height: 0.95;
                    word-break: break-word;
                }

                .profile-edit-inline {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 42px;
                    height: 42px;
                    color: var(--accent);
                    border-radius: 999px;
                    border: 1px solid rgba(27, 27, 24, 0.12);
                    background: rgba(255, 255, 255, 0.82);
                    text-decoration: none;
                    flex: 0 0 auto;
                }

                .profile-edit-inline svg {
                    width: 16px;
                    height: 16px;
                    stroke: currentColor;
                    fill: none;
                    stroke-width: 2;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                }

                .profile-cover__bio {
                    max-width: 62ch;
                    margin: 0;
                    color: var(--muted);
                    line-height: 1.65;
                }

                .profile-layout {
                    display: grid;
                    grid-template-columns: 320px minmax(0, 1fr);
                    gap: 22px;
                }

                .profile-sidebar,
                .profile-feed {
                    display: grid;
                    gap: 22px;
                }

                .profile-title-row {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                }

                .profile-title-row h1 {
                    margin-bottom: 0;
                }

                .profile-edit-link {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 42px;
                    height: 42px;
                    border-radius: 999px;
                    border: 1px solid rgba(27, 27, 24, 0.12);
                    background: rgba(255, 255, 255, 0.82);
                }

                .profile-edit-link svg {
                    width: 18px;
                    height: 18px;
                    stroke: currentColor;
                    fill: none;
                    stroke-width: 2;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                }

                .profile-side-card,
                .profile-feed-card {
                    background: rgba(255, 255, 255, 0.82);
                }

                .profile-feed-card__header {
                    display: flex;
                    align-items: start;
                    justify-content: space-between;
                    gap: 12px;
                    margin-bottom: 18px;
                }

                .profile-inline-action {
                    color: var(--accent);
                    font-weight: 700;
                    text-decoration: none;
                    white-space: nowrap;
                }

                .profile-info-list {
                    display: grid;
                    gap: 16px;
                }

                .profile-info-list > div {
                    padding-bottom: 14px;
                    border-bottom: 1px solid rgba(27, 27, 24, 0.08);
                }

                .profile-info-list > div:last-child {
                    padding-bottom: 0;
                    border-bottom: 0;
                }

                .profile-info-list strong {
                    display: block;
                    margin-bottom: 6px;
                }

                .profile-info-list span {
                    color: var(--muted);
                    line-height: 1.55;
                }

                .profile-detail-grid,
                .profile-status-grid,
                .profile-form-grid {
                    display: grid;
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    gap: 22px;
                }

                .profile-detail-item,
                .profile-status-box {
                    padding: 20px;
                    border-radius: 20px;
                    background: rgba(255, 255, 255, 0.66);
                    border: 1px solid rgba(27, 27, 24, 0.08);
                }

                .profile-detail-item small,
                .profile-status-box small {
                    display: block;
                    margin-bottom: 8px;
                    color: var(--muted);
                    text-transform: uppercase;
                    letter-spacing: 0.06em;
                    font-size: 0.74rem;
                    font-weight: 700;
                }

                .profile-detail-item strong,
                .profile-status-box strong {
                    display: grid;
                    margin-bottom: 8px;
                }

                .profile-status-box span {
                    color: var(--muted);
                    line-height: 1.55;
                }

                .profile-edit-page {
                    display: grid;
                }

                .profile-edit-panel {
                    padding: 30px;
                }

                .profile-edit-panel__intro {
                    display: flex;
                    align-items: center;
                    gap: 20px;
                    margin-bottom: 26px;
                }

                .profile-upload-trigger {
                    cursor: pointer;
                }

                .profile-upload-field {
                    display: grid;
                    gap: 8px;
                }

                .profile-upload-input {
                    padding: 10px 0;
                    border: 0;
                    background: transparent;
                }

                .profile-form {
                    display: grid;
                    gap: 18px;
                }

                .profile-form-actions {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    flex-wrap: wrap;
                }

                .profile-edit-wrap {
                    width: min(680px, 100%);
                }

                .flash-list {
                    display: grid;
                    gap: 12px;
                    margin-bottom: 22px;
                }

                .flash {
                    padding: 14px 18px;
                    border-radius: 16px;
                    border: 1px solid transparent;
                }

                .flash-success {
                    background: rgba(77, 107, 79, 0.12);
                    border-color: rgba(77, 107, 79, 0.28);
                }

                .flash-warning {
                    background: rgba(207, 106, 50, 0.12);
                    border-color: rgba(207, 106, 50, 0.28);
                }

                .flash-danger {
                    background: rgba(136, 36, 36, 0.12);
                    border-color: rgba(136, 36, 36, 0.28);
                }

                .site-footer {
                    min-height: 36px;
                    padding-bottom: 24px;
                }

                @media (max-width: 900px) {
                    .hero,
                    .metrics,
                    .grid,
                    .grid--two,
                    .feature-list,
                    .quick-link-grid,
                    .profile-grid,
                    .profile-layout,
                    .profile-detail-grid,
                    .profile-status-grid,
                    .profile-form-grid {
                        grid-template-columns: 1fr;
                    }

                    .hero-slideshow {
                        min-height: 420px;
                    }

                    .site-header__inner,
                    .site-footer,
                    .profile-edit-panel__intro {
                        flex-direction: column;
                        align-items: flex-start;
                    }

                    .profile-cover__content {
                        grid-template-columns: 1fr;
                        margin-top: -54px;
                        align-items: start;
                    }
                }

                @media (prefers-reduced-motion: reduce) {
                    *,
                    *::before,
                    *::after {
                        animation-duration: 0.01ms !important;
                        animation-iteration-count: 1 !important;
                        transition-duration: 0.01ms !important;
                        scroll-behavior: auto !important;
                    }
                }
            </style>
        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 995
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 1038
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
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
        return array (  1229 => 1038,  1213 => 995,  220 => 9,  210 => 8,  193 => 6,  179 => 1039,  177 => 1038,  173 => 1036,  167 => 1035,  156 => 1033,  151 => 1032,  147 => 1031,  138 => 1024,  133 => 1022,  128 => 1021,  123 => 1019,  119 => 1017,  113 => 1015,  105 => 1013,  102 => 1012,  100 => 1011,  95 => 1009,  91 => 1008,  86 => 1007,  84 => 1006,  80 => 1005,  72 => 1000,  66 => 996,  63 => 995,  61 => 8,  56 => 6,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>{% block title %}FurHope Animal Shelter{% endblock %}</title>
        <link rel=\"icon\" href=\"data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221em%22 font-size=%2296%22>&amp;#128062;</text></svg>\">
        {% block stylesheets %}
            <style>
                :root {
                    --canvas: #f7f1e3;
                    --ink: #1b1b18;
                    --muted: #6e655d;
                    --accent: #cf6a32;
                    --forest: #4d6b4f;
                    --card: rgba(255, 251, 244, 0.88);
                    --line: rgba(27, 27, 24, 0.08);
                    --shadow: 0 24px 60px rgba(82, 57, 30, 0.16);
                    --radius: 24px;
                }

                * { box-sizing: border-box; }

                body {
                    margin: 0;
                    font-family: Georgia, \"Times New Roman\", serif;
                    color: var(--ink);
                    background:
                        radial-gradient(circle at top left, rgba(207, 106, 50, 0.20), transparent 36%),
                        radial-gradient(circle at top right, rgba(77, 107, 79, 0.18), transparent 28%),
                        linear-gradient(180deg, var(--canvas) 0%, #f4ede0 100%);
                    min-height: 100vh;
                }

                a { color: inherit; text-decoration: none; }

                .shell {
                    width: min(1120px, calc(100% - 32px));
                    margin: 0 auto;
                }

                .site-header {
                    position: sticky;
                    top: 0;
                    z-index: 20;
                    backdrop-filter: blur(16px);
                    background: rgba(247, 241, 227, 0.82);
                    border-bottom: 1px solid var(--line);
                }

                .site-header__inner,
                .site-footer {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 18px;
                    padding: 18px 0;
                }

                .brand {
                    display: inline-flex;
                    gap: 12px;
                    align-items: center;
                    font-weight: 700;
                    letter-spacing: 0.02em;
                }

                .brand__mark {
                    width: 44px;
                    height: 44px;
                    display: grid;
                    place-items: center;
                    border-radius: 16px;
                    background: linear-gradient(135deg, var(--accent), #f2b15f);
                    color: white;
                    box-shadow: var(--shadow);
                    font-size: 1.35rem;
                }

                .nav {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    flex-wrap: wrap;
                }

                .nav-profile {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 44px;
                    height: 44px;
                    padding: 0;
                    border-radius: 999px;
                    border: 1px solid rgba(27, 27, 24, 0.14);
                    background: rgba(255, 255, 255, 0.72);
                    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.4);
                    overflow: hidden;
                }

                .profile-avatar {
                    width: 56px;
                    height: 56px;
                    display: inline-grid;
                    place-items: center;
                    border-radius: 999px;
                    background: linear-gradient(135deg, var(--accent), #f2b15f);
                    color: #fff;
                    font-weight: 700;
                    letter-spacing: 0.04em;
                    overflow: hidden;
                }

                .profile-avatar img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                }

                .profile-avatar--small {
                    width: 44px;
                    height: 44px;
                    font-size: 0.9rem;
                }

                .profile-avatar--large {
                    width: 108px;
                    height: 108px;
                    font-size: 2rem;
                    box-shadow: 0 18px 32px rgba(82, 57, 30, 0.18);
                }

                .profile-avatar--cover {
                    width: 148px;
                    height: 148px;
                    font-size: 2.6rem;
                    border: 6px solid rgba(255, 251, 244, 0.96);
                    box-shadow: 0 22px 40px rgba(54, 39, 24, 0.22);
                }

                .nav a,
                .button {
                    padding: 11px 18px;
                    border-radius: 999px;
                    border: 1px solid transparent;
                    transition: transform 0.24s ease, background-color 0.24s ease, box-shadow 0.24s ease, border-color 0.24s ease;
                }

                .nav a:hover,
                .button:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 12px 28px rgba(82, 57, 30, 0.12);
                }

                .button-primary,
                .button-secondary {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                }

                .button-primary {
                    background: var(--accent);
                    color: #fff;
                    border: 1px solid var(--accent);
                }

                .button-primary:hover,
                .button-primary:focus-visible {
                    background: #b95a27;
                    border-color: #b95a27;
                }

                .button-secondary {
                    background: rgba(255, 255, 255, 0.78);
                    border: 1px solid rgba(27, 27, 24, 0.18);
                    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.35);
                }

                .button-secondary:hover,
                .button-secondary:focus-visible {
                    background: rgba(255, 255, 255, 0.82);
                    border-color: rgba(27, 27, 24, 0.18);
                }

                .layout { padding: 42px 0 56px; }

                .panel {
                    background: var(--card);
                    border: 1px solid rgba(255, 255, 255, 0.7);
                    border-radius: var(--radius);
                    box-shadow: var(--shadow);
                    position: relative;
                    overflow: clip;
                }

                .hero {
                    display: grid;
                    grid-template-columns: 1.2fr 0.8fr;
                    gap: 28px;
                    padding: 28px;
                }

                .hero--showcase {
                    align-items: stretch;
                }

                .hero--showcase::before {
                    content: \"\";
                    position: absolute;
                    inset: auto -80px -120px auto;
                    width: 280px;
                    height: 280px;
                    border-radius: 999px;
                    background: radial-gradient(circle, rgba(207, 106, 50, 0.18) 0%, rgba(207, 106, 50, 0) 72%);
                    pointer-events: none;
                }

                h1, h2, h3 {
                    margin-top: 0;
                    line-height: 1.05;
                }

                h1 {
                    font-size: clamp(2.6rem, 7vw, 4.8rem);
                    margin-bottom: 18px;
                }

                .eyebrow,
                .muted { color: var(--muted); }

                .hero-copy p,
                .card p { line-height: 1.6; font-size: 1.02rem; }

                .hero-copy {
                    display: grid;
                    align-content: center;
                    position: relative;
                    z-index: 1;
                    gap: 14px;
                }

                .metrics,
                .grid { display: grid; gap: 18px; }

                .metrics {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    margin-top: 24px;
                }

                .grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    margin-top: 28px;
                }

                .card,
                .metric,
                .form-card {
                    padding: 24px;
                    border-radius: 22px;
                    background: rgba(255, 255, 255, 0.62);
                    border: 1px solid rgba(27, 27, 24, 0.08);
                    transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
                }

                .card:hover,
                .metric:hover,
                .form-card:hover,
                .feature-item:hover {
                    transform: translateY(-4px);
                    box-shadow: 0 24px 44px rgba(82, 57, 30, 0.15);
                    border-color: rgba(207, 106, 50, 0.18);
                }

                .metric strong {
                    display: block;
                    font-size: 2rem;
                    margin-bottom: 8px;
                }

                .stack { display: grid; gap: 16px; }

                .story-ribbon {
                    display: flex;
                    gap: 10px;
                    flex-wrap: wrap;
                    margin-top: 24px;
                }

                .story-ribbon span {
                    padding: 10px 14px;
                    border-radius: 999px;
                    background: rgba(255, 255, 255, 0.82);
                    border: 1px solid rgba(27, 27, 24, 0.16);
                    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.4);
                    color: var(--muted);
                }

                .hero-slideshow {
                    position: relative;
                    min-height: 520px;
                    overflow: hidden;
                    isolation: isolate;
                    background: #1c2b21;
                    transform: translateZ(0);
                }

                .hero-slideshow::after {
                    content: \"\";
                    position: absolute;
                    inset: 0;
                    background:
                        linear-gradient(180deg, rgba(14, 18, 16, 0.10) 0%, rgba(14, 18, 16, 0.58) 100%),
                        linear-gradient(135deg, rgba(207, 106, 50, 0.22) 0%, transparent 42%);
                    z-index: 1;
                }

                .hero-slideshow__frame {
                    position: absolute;
                    inset: 0;
                    margin: 0;
                    opacity: 0;
                    animation: slideshowFade 18s infinite;
                    will-change: opacity;
                }

                .hero-slideshow__frame:nth-child(2) { animation-delay: 6s; }
                .hero-slideshow__frame:nth-child(3) { animation-delay: 12s; }

                .hero-slideshow__image {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                    transform: scale(1.04);
                    animation: slideshowZoom 18s infinite;
                    filter: saturate(1.02) contrast(1.02);
                }

                .hero-slideshow__caption {
                    position: absolute;
                    left: 24px;
                    right: 24px;
                    bottom: 24px;
                    z-index: 2;
                    padding: 18px 20px;
                    border-radius: 20px;
                    background: rgba(250, 245, 238, 0.88);
                    border: 1px solid rgba(27, 27, 24, 0.10);
                    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.14);
                }

                .hero-slideshow__caption strong {
                    display: block;
                    margin-bottom: 6px;
                    font-size: 1.1rem;
                }

                .hero-slideshow__caption span {
                    color: var(--muted);
                    line-height: 1.5;
                }

                .hero-slideshow__dots {
                    position: absolute;
                    top: 24px;
                    right: 24px;
                    z-index: 2;
                    display: inline-flex;
                    gap: 8px;
                    padding: 10px 14px;
                    border-radius: 999px;
                    background: rgba(255, 251, 244, 0.72);
                    border: 1px solid rgba(27, 27, 24, 0.08);
                }

                .hero-slideshow__dots span {
                    width: 10px;
                    height: 10px;
                    border-radius: 999px;
                    background: rgba(27, 27, 24, 0.18);
                    animation: slideshowDot 18s infinite;
                }

                .hero-slideshow__dots span:nth-child(2) { animation-delay: 6s; }
                .hero-slideshow__dots span:nth-child(3) { animation-delay: 12s; }

                @keyframes slideshowFade {
                    0%,
                    29% { opacity: 1; }
                    33%,
                    100% { opacity: 0; }
                }

                @keyframes slideshowZoom {
                    0%,
                    33% { transform: scale(1.04); }
                    100% { transform: scale(1.1); }
                }

                @keyframes slideshowDot {
                    0%,
                    29% { background: var(--accent); transform: scale(1.1); }
                    33%,
                    100% { background: rgba(27, 27, 24, 0.18); transform: scale(1); }
                }

                .auth-wrap {
                    width: min(620px, 100%);
                    margin: 0 auto;
                }

                .auth-card {
                    padding: 34px 28px 28px;
                }

                .auth-form {
                    display: grid;
                    gap: 18px;
                }

                .form-group {
                    display: grid;
                    gap: 8px;
                }

                .form-help {
                    font-size: 0.95rem;
                    color: var(--muted);
                    margin: 0;
                }

                .field-error {
                    display: none;
                    margin: 0;
                    font-size: 0.92rem;
                    color: #8f2e2e;
                }

                .field-error.is-visible {
                    display: block;
                }

                .form-group ul {
                    margin: 0;
                    padding-left: 18px;
                    color: #8f2e2e;
                    font-size: 0.92rem;
                }

                .auth-form .button-primary {
                    width: 100%;
                    min-height: 54px;
                    padding: 14px 20px;
                    font-size: 1rem;
                    font-weight: 700;
                    letter-spacing: 0.01em;
                    box-shadow: 0 16px 34px rgba(207, 106, 50, 0.22);
                }

                .auth-form .button-primary:hover,
                .auth-form .button-primary:focus-visible {
                    transform: translateY(-2px);
                    box-shadow: 0 18px 38px rgba(185, 90, 39, 0.28);
                }

                form { display: grid; gap: 16px; }

                label {
                    display: block;
                    margin-bottom: 8px;
                    font-weight: 700;
                }

                input,
                select,
                textarea {
                    width: 100%;
                    padding: 14px 16px;
                    border: 1px solid rgba(27, 27, 24, 0.16);
                    border-radius: 14px;
                    background: rgba(255, 255, 255, 0.9);
                    font: inherit;
                }

                input:focus,
                select:focus,
                textarea:focus {
                    outline: none;
                    border-color: rgba(207, 106, 50, 0.6);
                    box-shadow: 0 0 0 4px rgba(207, 106, 50, 0.12);
                }

                input[aria-invalid=\"true\"],
                select[aria-invalid=\"true\"],
                textarea[aria-invalid=\"true\"] {
                    border-color: rgba(143, 46, 46, 0.5);
                    box-shadow: 0 0 0 4px rgba(143, 46, 46, 0.10);
                }

                .checkbox-row {
                    display: flex;
                    align-items: flex-start;
                    gap: 12px;
                    padding: 14px 16px;
                    border-radius: 16px;
                    background: rgba(255, 255, 255, 0.72);
                    border: 1px solid rgba(27, 27, 24, 0.08);
                }

                .checkbox-row input[type=\"checkbox\"] {
                    width: 18px;
                    height: 18px;
                    margin-top: 2px;
                    padding: 0;
                    flex: 0 0 auto;
                }

                .checkbox-row label {
                    margin: 0;
                    font-weight: 600;
                }

                .member-dashboard,
                .home-feature-band {
                    padding: 30px;
                }

                .member-dashboard {
                    background:
                        radial-gradient(circle at top right, rgba(207, 106, 50, 0.12), transparent 32%),
                        rgba(255, 251, 244, 0.92);
                }

                .grid--two {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .feature-list {
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 22px;
                    margin-top: 28px;
                }

                .quick-link-grid {
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 22px;
                    margin-top: 24px;
                    margin-bottom: 28px;
                }

                .quick-link-card {
                    display: grid;
                    grid-template-columns: 64px 1fr;
                    gap: 16px;
                    align-items: start;
                    padding: 20px;
                    border-radius: 22px;
                    background: rgba(255, 255, 255, 0.68);
                    border: 1px solid rgba(27, 27, 24, 0.08);
                    box-shadow: var(--shadow);
                    transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
                }

                .quick-link-card:hover {
                    transform: translateY(-4px);
                    box-shadow: 0 24px 44px rgba(82, 57, 30, 0.15);
                    border-color: rgba(207, 106, 50, 0.18);
                }

                .quick-link-card__icon {
                    width: 64px;
                    height: 64px;
                    display: grid;
                    place-items: center;
                    border-radius: 18px;
                    background: linear-gradient(135deg, rgba(207, 106, 50, 0.18), rgba(242, 177, 95, 0.24));
                    color: var(--accent);
                }

                .quick-link-card__icon svg {
                    width: 26px;
                    height: 26px;
                    stroke: currentColor;
                    fill: none;
                    stroke-width: 1.8;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                }

                .quick-link-card strong {
                    display: block;
                    margin-bottom: 8px;
                    font-size: 1.05rem;
                }

                .quick-link-card p {
                    margin: 0;
                    color: var(--muted);
                    line-height: 1.55;
                }

                .feature-item {
                    padding: 22px;
                    border-radius: 22px;
                    background: rgba(255, 255, 255, 0.64);
                    border: 1px solid rgba(27, 27, 24, 0.08);
                }

                .feature-item strong {
                    display: block;
                    margin-bottom: 8px;
                }

                .feature-item,
                .admin-spotlight-card {
                    backdrop-filter: blur(8px);
                }

                .home-feature-band--compact {
                    padding: 28px 30px;
                }

                .profile-page {
                    display: grid;
                    gap: 22px;
                }

                .profile-cover {
                    overflow: hidden;
                }

                .profile-cover__backdrop {
                    min-height: 220px;
                    background:
                        linear-gradient(135deg, rgba(207, 106, 50, 0.18), rgba(77, 107, 79, 0.20)),
                        url('https://images.unsplash.com/photo-1516934024742-b461fba47600?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
                }

                .profile-cover__content {
                    display: grid;
                    grid-template-columns: auto minmax(0, 1fr);
                    gap: 24px;
                    align-items: center;
                    padding: 0 30px 28px;
                    margin-top: -72px;
                    position: relative;
                    z-index: 1;
                }

                .profile-cover__avatar-wrap {
                    display: flex;
                    align-items: end;
                }

                .profile-photo-action,
                .profile-upload-trigger {
                    position: relative;
                    display: inline-flex;
                    width: fit-content;
                }

                .profile-photo-action__badge,
                .profile-upload-trigger__badge {
                    position: absolute;
                    right: 8px;
                    bottom: 10px;
                    width: 42px;
                    height: 42px;
                    display: grid;
                    place-items: center;
                    border-radius: 999px;
                    background: var(--accent);
                    color: #fff;
                    border: 3px solid rgba(255, 251, 244, 0.96);
                    box-shadow: 0 10px 18px rgba(82, 57, 30, 0.16);
                }

                .profile-photo-action__badge svg,
                .profile-upload-trigger__badge svg {
                    width: 18px;
                    height: 18px;
                    stroke: currentColor;
                    fill: none;
                    stroke-width: 2;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                }

                .profile-cover__main {
                    display: grid;
                    gap: 12px;
                    align-self: center;
                    min-width: 0;
                }

                .profile-title-stack {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    flex-wrap: wrap;
                }

                .profile-title-stack h1 {
                    margin-bottom: 0;
                    font-size: clamp(2.6rem, 6vw, 5rem);
                    line-height: 0.95;
                    word-break: break-word;
                }

                .profile-edit-inline {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 42px;
                    height: 42px;
                    color: var(--accent);
                    border-radius: 999px;
                    border: 1px solid rgba(27, 27, 24, 0.12);
                    background: rgba(255, 255, 255, 0.82);
                    text-decoration: none;
                    flex: 0 0 auto;
                }

                .profile-edit-inline svg {
                    width: 16px;
                    height: 16px;
                    stroke: currentColor;
                    fill: none;
                    stroke-width: 2;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                }

                .profile-cover__bio {
                    max-width: 62ch;
                    margin: 0;
                    color: var(--muted);
                    line-height: 1.65;
                }

                .profile-layout {
                    display: grid;
                    grid-template-columns: 320px minmax(0, 1fr);
                    gap: 22px;
                }

                .profile-sidebar,
                .profile-feed {
                    display: grid;
                    gap: 22px;
                }

                .profile-title-row {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                }

                .profile-title-row h1 {
                    margin-bottom: 0;
                }

                .profile-edit-link {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 42px;
                    height: 42px;
                    border-radius: 999px;
                    border: 1px solid rgba(27, 27, 24, 0.12);
                    background: rgba(255, 255, 255, 0.82);
                }

                .profile-edit-link svg {
                    width: 18px;
                    height: 18px;
                    stroke: currentColor;
                    fill: none;
                    stroke-width: 2;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                }

                .profile-side-card,
                .profile-feed-card {
                    background: rgba(255, 255, 255, 0.82);
                }

                .profile-feed-card__header {
                    display: flex;
                    align-items: start;
                    justify-content: space-between;
                    gap: 12px;
                    margin-bottom: 18px;
                }

                .profile-inline-action {
                    color: var(--accent);
                    font-weight: 700;
                    text-decoration: none;
                    white-space: nowrap;
                }

                .profile-info-list {
                    display: grid;
                    gap: 16px;
                }

                .profile-info-list > div {
                    padding-bottom: 14px;
                    border-bottom: 1px solid rgba(27, 27, 24, 0.08);
                }

                .profile-info-list > div:last-child {
                    padding-bottom: 0;
                    border-bottom: 0;
                }

                .profile-info-list strong {
                    display: block;
                    margin-bottom: 6px;
                }

                .profile-info-list span {
                    color: var(--muted);
                    line-height: 1.55;
                }

                .profile-detail-grid,
                .profile-status-grid,
                .profile-form-grid {
                    display: grid;
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    gap: 22px;
                }

                .profile-detail-item,
                .profile-status-box {
                    padding: 20px;
                    border-radius: 20px;
                    background: rgba(255, 255, 255, 0.66);
                    border: 1px solid rgba(27, 27, 24, 0.08);
                }

                .profile-detail-item small,
                .profile-status-box small {
                    display: block;
                    margin-bottom: 8px;
                    color: var(--muted);
                    text-transform: uppercase;
                    letter-spacing: 0.06em;
                    font-size: 0.74rem;
                    font-weight: 700;
                }

                .profile-detail-item strong,
                .profile-status-box strong {
                    display: grid;
                    margin-bottom: 8px;
                }

                .profile-status-box span {
                    color: var(--muted);
                    line-height: 1.55;
                }

                .profile-edit-page {
                    display: grid;
                }

                .profile-edit-panel {
                    padding: 30px;
                }

                .profile-edit-panel__intro {
                    display: flex;
                    align-items: center;
                    gap: 20px;
                    margin-bottom: 26px;
                }

                .profile-upload-trigger {
                    cursor: pointer;
                }

                .profile-upload-field {
                    display: grid;
                    gap: 8px;
                }

                .profile-upload-input {
                    padding: 10px 0;
                    border: 0;
                    background: transparent;
                }

                .profile-form {
                    display: grid;
                    gap: 18px;
                }

                .profile-form-actions {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    flex-wrap: wrap;
                }

                .profile-edit-wrap {
                    width: min(680px, 100%);
                }

                .flash-list {
                    display: grid;
                    gap: 12px;
                    margin-bottom: 22px;
                }

                .flash {
                    padding: 14px 18px;
                    border-radius: 16px;
                    border: 1px solid transparent;
                }

                .flash-success {
                    background: rgba(77, 107, 79, 0.12);
                    border-color: rgba(77, 107, 79, 0.28);
                }

                .flash-warning {
                    background: rgba(207, 106, 50, 0.12);
                    border-color: rgba(207, 106, 50, 0.28);
                }

                .flash-danger {
                    background: rgba(136, 36, 36, 0.12);
                    border-color: rgba(136, 36, 36, 0.28);
                }

                .site-footer {
                    min-height: 36px;
                    padding-bottom: 24px;
                }

                @media (max-width: 900px) {
                    .hero,
                    .metrics,
                    .grid,
                    .grid--two,
                    .feature-list,
                    .quick-link-grid,
                    .profile-grid,
                    .profile-layout,
                    .profile-detail-grid,
                    .profile-status-grid,
                    .profile-form-grid {
                        grid-template-columns: 1fr;
                    }

                    .hero-slideshow {
                        min-height: 420px;
                    }

                    .site-header__inner,
                    .site-footer,
                    .profile-edit-panel__intro {
                        flex-direction: column;
                        align-items: flex-start;
                    }

                    .profile-cover__content {
                        grid-template-columns: 1fr;
                        margin-top: -54px;
                        align-items: start;
                    }
                }

                @media (prefers-reduced-motion: reduce) {
                    *,
                    *::before,
                    *::after {
                        animation-duration: 0.01ms !important;
                        animation-iteration-count: 1 !important;
                        transition-duration: 0.01ms !important;
                        scroll-behavior: auto !important;
                    }
                }
            </style>
        {% endblock %}
        {% block javascripts %}{% endblock %}
    </head>
    <body>
        <header class=\"site-header\">
            <div class=\"shell site-header__inner\">
                <a class=\"brand\" href=\"{{ path('app_home') }}\">
                    <span class=\"brand__mark\">&#128062;</span>
                    <span>FurHope Animal Shelter</span>
                </a>
                <nav class=\"nav\">
                    <a href=\"{{ path('app_home') }}\">Home</a>
                    {% if app.user %}
                        <a href=\"{{ path('app_dashboard') }}\">Dashboard</a>
                        <a href=\"{{ path('feed_index') }}\">Social feed</a>
                        <a class=\"nav-profile\" href=\"{{ path('app_profile') }}\" aria-label=\"Open profile\">
                            <span class=\"profile-avatar profile-avatar--small\">
                                {% set navAvatarUrl = social_avatar_url(app.user) %}
                                {% if navAvatarUrl %}
                                    <img src=\"{{ navAvatarUrl }}\" alt=\"{{ app.user.fullName }}\" referrerpolicy=\"no-referrer\">
                                {% else %}
                                    {{ app.user.initials }}
                                {% endif %}
                            </span>
                        </a>
                        <a class=\"button-secondary\" href=\"{{ path('app_logout') }}\">Logout</a>
                    {% else %}
                        <a href=\"{{ path('app_login') }}\">Sign in</a>
                        <a class=\"button-primary\" href=\"{{ path('app_register') }}\">Create account</a>
                    {% endif %}
                </nav>
            </div>
        </header>

        <main class=\"layout\">
            <div class=\"shell\">
                <div class=\"flash-list\">
                    {% for label, messages in app.flashes %}
                        {% for message in messages %}
                            <div class=\"flash flash-{{ label }}\">{{ message }}</div>
                        {% endfor %}
                    {% endfor %}
                </div>

                {% block body %}{% endblock %}
            </div>
        </main>

        <footer class=\"shell site-footer\"></footer>
    </body>
</html>
", "base.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\base.html.twig");
    }
}
