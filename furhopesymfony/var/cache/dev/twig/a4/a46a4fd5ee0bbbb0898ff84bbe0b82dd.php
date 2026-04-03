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

/* @EasyAdmin/page/login.html.twig */
class __TwigTemplate_3074bc11138b8515c4e842641ecb8bf6 extends Template
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
            'body_class' => [$this, 'block_body_class'],
            'page_title' => [$this, 'block_page_title'],
            'head_favicon' => [$this, 'block_head_favicon'],
            'wrapper_wrapper' => [$this, 'block_wrapper_wrapper'],
            'header_logo' => [$this, 'block_header_logo'],
            'login_form_wrapper' => [$this, 'block_login_form_wrapper'],
            'login_form_credentials_wrapper' => [$this, 'block_login_form_credentials_wrapper'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 3
        return $this->load((((null != (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 3, $this->source); })()))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 3, $this->source); })()), "templatePath", ["layout"], "method", false, false, false, 3)) : ("@EasyAdmin/page/login_minimal.html.twig")), 3);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/page/login.html.twig"));

        // line 2
        $context["ea"] = $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->ea();
        // line 4
        $context["__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986"] = (((null != (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 4, $this->source); })()))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 4, $this->source); })()), "i18n", [], "any", false, false, false, 4), "translationDomain", [], "any", false, false, false, 4)) : (((array_key_exists("translation_domain", $context)) ? ((((array_key_exists("translation_domain", $context) &&  !(null === $context["translation_domain"]))) ? ($context["translation_domain"]) : ("messages"))) : (""))));
        // line 3
        yield from $this->getParent($context)->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_class(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body_class"));

        yield "page-login";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_title"));

        yield ((array_key_exists("page_title", $context)) ? ((isset($context["page_title"]) || array_key_exists("page_title", $context) ? $context["page_title"] : (function () { throw new RuntimeError('Variable "page_title" does not exist.', 7, $this->source); })())) : ((((null != (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 7, $this->source); })()))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 7, $this->source); })()), "dashboardTitle", [], "any", false, false, false, 7)) : (""))));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head_favicon(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head_favicon"));

        // line 10
        yield "    ";
        if ((($tmp = ((array_key_exists("favicon_path", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["favicon_path"]) || array_key_exists("favicon_path", $context) ? $context["favicon_path"] : (function () { throw new RuntimeError('Variable "favicon_path" does not exist.', 10, $this->source); })()), false)) : (false))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 11
            yield "        <link rel=\"shortcut icon\" href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["favicon_path"]) || array_key_exists("favicon_path", $context) ? $context["favicon_path"] : (function () { throw new RuntimeError('Variable "favicon_path" does not exist.', 11, $this->source); })()), "html", null, true);
            yield "\">
    ";
        } else {
            // line 13
            yield "        ";
            yield from $this->yieldParentBlock("head_favicon", $context, $blocks);
            yield "
    ";
        }
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 17
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_wrapper_wrapper(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "wrapper_wrapper"));

        // line 18
        yield "    ";
        $context["page_title"] =         $this->unwrap()->renderBlock("page_title", $context, $blocks);
        // line 19
        yield "    ";
        $context["_username_label"] = ((array_key_exists("username_label", $context)) ? ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans((isset($context["username_label"]) || array_key_exists("username_label", $context) ? $context["username_label"] : (function () { throw new RuntimeError('Variable "username_label" does not exist.', 19, $this->source); })()), [],         // line 4
(isset($context["__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986"]) || array_key_exists("__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986", $context) ? $context["__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986" does not exist.', 4, $this->source); })()))) : ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("login_page.username", [], "EasyAdminBundle")));
        // line 20
        yield "    ";
        $context["_password_label"] = ((array_key_exists("password_label", $context)) ? ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans((isset($context["password_label"]) || array_key_exists("password_label", $context) ? $context["password_label"] : (function () { throw new RuntimeError('Variable "password_label" does not exist.', 20, $this->source); })()), [],         // line 4
(isset($context["__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986"]) || array_key_exists("__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986", $context) ? $context["__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986" does not exist.', 4, $this->source); })()))) : ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("login_page.password", [], "EasyAdminBundle")));
        // line 21
        yield "    ";
        $context["_forgot_password_label"] = ((array_key_exists("forgot_password_label", $context)) ? ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans((isset($context["forgot_password_label"]) || array_key_exists("forgot_password_label", $context) ? $context["forgot_password_label"] : (function () { throw new RuntimeError('Variable "forgot_password_label" does not exist.', 21, $this->source); })()), [],         // line 4
(isset($context["__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986"]) || array_key_exists("__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986", $context) ? $context["__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986" does not exist.', 4, $this->source); })()))) : ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("login_page.forgot_password", [], "EasyAdminBundle")));
        // line 22
        yield "    ";
        $context["_remember_me_label"] = ((array_key_exists("remember_me_label", $context)) ? ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans((isset($context["remember_me_label"]) || array_key_exists("remember_me_label", $context) ? $context["remember_me_label"] : (function () { throw new RuntimeError('Variable "remember_me_label" does not exist.', 22, $this->source); })()), [],         // line 4
(isset($context["__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986"]) || array_key_exists("__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986", $context) ? $context["__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986" does not exist.', 4, $this->source); })()))) : ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("login_page.remember_me", [], "EasyAdminBundle")));
        // line 23
        yield "    ";
        $context["_sign_in_label"] = ((array_key_exists("sign_in_label", $context)) ? ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans((isset($context["sign_in_label"]) || array_key_exists("sign_in_label", $context) ? $context["sign_in_label"] : (function () { throw new RuntimeError('Variable "sign_in_label" does not exist.', 23, $this->source); })()), [],         // line 4
(isset($context["__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986"]) || array_key_exists("__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986", $context) ? $context["__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain9f7ade5f6d7e8f6a94a457ea1b324986" does not exist.', 4, $this->source); })()))) : ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("login_page.sign_in", [], "EasyAdminBundle")));
        // line 24
        yield "
    ";
        // line 25
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@EasyAdmin/flash_messages.html.twig");
        yield "

    <div class=\"login-wrapper\">
        <header class=\"main-header\">
            <div id=\"header-logo\">
                ";
        // line 30
        yield from $this->unwrap()->yieldBlock('header_logo', $context, $blocks);
        // line 43
        yield "            </div>
        </header>

        <section class=\"content\">
            ";
        // line 47
        if ((($tmp = ((array_key_exists("error", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 47, $this->source); })()), false)) : (false))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 48
            yield "                <div class=\"w-100 alert alert-danger rounded mb-3\">
                    ";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 49, $this->source); })()), "messageKey", [], "any", false, false, false, 49), CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 49, $this->source); })()), "messageData", [], "any", false, false, false, 49), "security"), "html", null, true);
            yield "
                </div>
            ";
        }
        // line 52
        yield "
            ";
        // line 53
        yield from $this->unwrap()->yieldBlock('login_form_wrapper', $context, $blocks);
        // line 101
        yield "        </section>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 30
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_header_logo(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_logo"));

        // line 31
        yield "                    ";
        if ((($tmp = (isset($context["page_title"]) || array_key_exists("page_title", $context) ? $context["page_title"] : (function () { throw new RuntimeError('Variable "page_title" does not exist.', 31, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 32
            yield "                        ";
            if ((null != (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 32, $this->source); })()))) {
                // line 33
                yield "                            <a class=\"logo ";
                yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["page_title"]) || array_key_exists("page_title", $context) ? $context["page_title"] : (function () { throw new RuntimeError('Variable "page_title" does not exist.', 33, $this->source); })())) > 14)) ? ("logo-long") : (""));
                yield "\" title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::striptags((isset($context["page_title"]) || array_key_exists("page_title", $context) ? $context["page_title"] : (function () { throw new RuntimeError('Variable "page_title" does not exist.', 33, $this->source); })())), "html", null, true);
                yield "\" href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 33, $this->source); })()), "dashboardRouteName", [], "any", false, false, false, 33));
                yield "\">
                                ";
                // line 34
                yield (isset($context["page_title"]) || array_key_exists("page_title", $context) ? $context["page_title"] : (function () { throw new RuntimeError('Variable "page_title" does not exist.', 34, $this->source); })());
                yield "
                            </a>
                        ";
            } else {
                // line 37
                yield "                            <div class=\"logo ";
                yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["page_title"]) || array_key_exists("page_title", $context) ? $context["page_title"] : (function () { throw new RuntimeError('Variable "page_title" does not exist.', 37, $this->source); })())) > 14)) ? ("logo-long") : (""));
                yield "\">
                                ";
                // line 38
                yield (isset($context["page_title"]) || array_key_exists("page_title", $context) ? $context["page_title"] : (function () { throw new RuntimeError('Variable "page_title" does not exist.', 38, $this->source); })());
                yield "
                            </div>
                        ";
            }
            // line 41
            yield "                    ";
        }
        // line 42
        yield "                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 53
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_login_form_wrapper(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "login_form_wrapper"));

        // line 54
        yield "            <form method=\"post\" action=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("action", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["action"]) || array_key_exists("action", $context) ? $context["action"] : (function () { throw new RuntimeError('Variable "action" does not exist.', 54, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\">
                ";
        // line 55
        if ((($tmp = ((array_key_exists("csrf_token_intention", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["csrf_token_intention"]) || array_key_exists("csrf_token_intention", $context) ? $context["csrf_token_intention"] : (function () { throw new RuntimeError('Variable "csrf_token_intention" does not exist.', 55, $this->source); })()), false)) : (false))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 56
            yield "                    <input type=\"hidden\" name=\"_csrf_token\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken((isset($context["csrf_token_intention"]) || array_key_exists("csrf_token_intention", $context) ? $context["csrf_token_intention"] : (function () { throw new RuntimeError('Variable "csrf_token_intention" does not exist.', 56, $this->source); })())), "html", null, true);
            yield "\">
                ";
        }
        // line 58
        yield "
                <input type=\"hidden\" name=\"";
        // line 59
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("target_path_parameter", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["target_path_parameter"]) || array_key_exists("target_path_parameter", $context) ? $context["target_path_parameter"] : (function () { throw new RuntimeError('Variable "target_path_parameter" does not exist.', 59, $this->source); })()), "_target_path")) : ("_target_path")), "html", null, true);
        yield "\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("target_path", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["target_path"]) || array_key_exists("target_path", $context) ? $context["target_path"] : (function () { throw new RuntimeError('Variable "target_path" does not exist.', 59, $this->source); })()), (((null != (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 59, $this->source); })()))) ? ($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 59, $this->source); })()), "dashboardRouteName", [], "any", false, false, false, 59))) : ("/")))) : ((((null != (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 59, $this->source); })()))) ? ($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 59, $this->source); })()), "dashboardRouteName", [], "any", false, false, false, 59))) : ("/")))), "html", null, true);
        yield "\" />

                ";
        // line 61
        yield from $this->unwrap()->yieldBlock('login_form_credentials_wrapper', $context, $blocks);
        // line 82
        yield "
                ";
        // line 83
        if ((($tmp = ((array_key_exists("remember_me_enabled", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["remember_me_enabled"]) || array_key_exists("remember_me_enabled", $context) ? $context["remember_me_enabled"] : (function () { throw new RuntimeError('Variable "remember_me_enabled" does not exist.', 83, $this->source); })()), false)) : (false))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 84
            yield "                    <div class=\"form-group\">
                        <input class=\"form-check-input\" type=\"checkbox\" id=\"remember_me\" name=\"";
            // line 85
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("remember_me_parameter", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["remember_me_parameter"]) || array_key_exists("remember_me_parameter", $context) ? $context["remember_me_parameter"] : (function () { throw new RuntimeError('Variable "remember_me_parameter" does not exist.', 85, $this->source); })()), "_remember_me")) : ("_remember_me")), "html", null, true);
            yield "\" ";
            yield (((($tmp = ((array_key_exists("remember_me_checked", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["remember_me_checked"]) || array_key_exists("remember_me_checked", $context) ? $context["remember_me_checked"] : (function () { throw new RuntimeError('Variable "remember_me_checked" does not exist.', 85, $this->source); })()), false)) : (false))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("checked") : (""));
            yield ">
                        <label class=\"form-check-label\" for=\"remember_me\">
                            ";
            // line 87
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["_remember_me_label"]) || array_key_exists("_remember_me_label", $context) ? $context["_remember_me_label"] : (function () { throw new RuntimeError('Variable "_remember_me_label" does not exist.', 87, $this->source); })()), "html", null, true);
            yield "
                        </label>
                    </div>
                ";
        }
        // line 91
        yield "
                ";
        // line 92
        $_v0 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v0->preRender("ea:Button", Twig\Extension\CoreExtension::toArray(["type" => "submit", "variant" => "primary", "size" => "lg", "isBlock" => true, "htmlAttributes" => "{class: 'btn-block'}"]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v0->startEmbedComponent("ea:Button", Twig\Extension\CoreExtension::toArray(["type" => "submit", "variant" => "primary", "size" => "lg", "isBlock" => true, "htmlAttributes" => "{class: 'btn-block'}"]), $context, "@EasyAdmin/page/login.html.twig", 13169386621);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 13169386621);
            $this->load("@EasyAdmin/page/login.html.twig", 92, "13169386621")->display($embeddedContext, $embeddedBlocks);
            $_v0->finishEmbedComponent();
        }
        // line 93
        yield "            </form>

            ";
        // line 98
        yield "                <script src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("login.js", Twig\Extension\CoreExtension::constant("EasyCorp\\Bundle\\EasyAdminBundle\\Asset\\AssetPackage::PACKAGE_NAME")), "html", null, true);
        yield "\"></script>
            ";
        // line 100
        yield "            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 61
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_login_form_credentials_wrapper(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "login_form_credentials_wrapper"));

        // line 62
        yield "                    <div class=\"form-group\">
                        <label class=\"form-control-label required\" for=\"username\">";
        // line 63
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["_username_label"]) || array_key_exists("_username_label", $context) ? $context["_username_label"] : (function () { throw new RuntimeError('Variable "_username_label" does not exist.', 63, $this->source); })()), "html", null, true);
        yield "</label>
                        <div class=\"form-widget\">
                            <input type=\"text\" id=\"username\" name=\"";
        // line 65
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("username_parameter", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["username_parameter"]) || array_key_exists("username_parameter", $context) ? $context["username_parameter"] : (function () { throw new RuntimeError('Variable "username_parameter" does not exist.', 65, $this->source); })()), "_username")) : ("_username")), "html", null, true);
        yield "\" class=\"form-control\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("last_username", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 65, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\" required autofocus autocomplete=\"username\">
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <label class=\"form-control-label required\" for=\"password\">";
        // line 70
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["_password_label"]) || array_key_exists("_password_label", $context) ? $context["_password_label"] : (function () { throw new RuntimeError('Variable "_password_label" does not exist.', 70, $this->source); })()), "html", null, true);
        yield "</label>
                        <div class=\"form-widget\">
                            <input type=\"password\" id=\"password\" name=\"";
        // line 72
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("password_parameter", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["password_parameter"]) || array_key_exists("password_parameter", $context) ? $context["password_parameter"] : (function () { throw new RuntimeError('Variable "password_parameter" does not exist.', 72, $this->source); })()), "_password")) : ("_password")), "html", null, true);
        yield "\" class=\"form-control\" required autocomplete=\"current-password\">
                        </div>

                        ";
        // line 75
        if ((($tmp = ((array_key_exists("forgot_password_enabled", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["forgot_password_enabled"]) || array_key_exists("forgot_password_enabled", $context) ? $context["forgot_password_enabled"] : (function () { throw new RuntimeError('Variable "forgot_password_enabled" does not exist.', 75, $this->source); })()), false)) : (false))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 76
            yield "                            <div class=\"form-text\">
                                <a href=\"";
            // line 77
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("forgot_password_path", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["forgot_password_path"]) || array_key_exists("forgot_password_path", $context) ? $context["forgot_password_path"] : (function () { throw new RuntimeError('Variable "forgot_password_path" does not exist.', 77, $this->source); })()), "#")) : ("#")), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["_forgot_password_label"]) || array_key_exists("_forgot_password_label", $context) ? $context["_forgot_password_label"] : (function () { throw new RuntimeError('Variable "_forgot_password_label" does not exist.', 77, $this->source); })()), "html", null, true);
            yield "</a>
                            </div>
                        ";
        }
        // line 80
        yield "                    </div>
                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/page/login.html.twig";
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
        return array (  406 => 80,  398 => 77,  395 => 76,  393 => 75,  387 => 72,  382 => 70,  372 => 65,  367 => 63,  364 => 62,  354 => 61,  346 => 100,  341 => 98,  337 => 93,  323 => 92,  320 => 91,  313 => 87,  306 => 85,  303 => 84,  301 => 83,  298 => 82,  296 => 61,  289 => 59,  286 => 58,  280 => 56,  278 => 55,  273 => 54,  263 => 53,  255 => 42,  252 => 41,  246 => 38,  241 => 37,  235 => 34,  226 => 33,  223 => 32,  220 => 31,  210 => 30,  200 => 101,  198 => 53,  195 => 52,  189 => 49,  186 => 48,  184 => 47,  178 => 43,  176 => 30,  168 => 25,  165 => 24,  163 => 4,  161 => 23,  159 => 4,  157 => 22,  155 => 4,  153 => 21,  151 => 4,  149 => 20,  147 => 4,  145 => 19,  142 => 18,  132 => 17,  120 => 13,  114 => 11,  111 => 10,  101 => 9,  84 => 7,  67 => 6,  60 => 3,  58 => 4,  56 => 2,  46 => 3,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Provider\\AdminContextProvider #}
{% set ea = ea() %}
{% extends null != ea ? ea.templatePath('layout') : '@EasyAdmin/page/login_minimal.html.twig' %}
{% trans_default_domain null != ea ? ea.i18n.translationDomain : (translation_domain is defined ? translation_domain ?? 'messages') %}

{% block body_class 'page-login' %}
{% block page_title %}{{ page_title is defined ? page_title|raw : (null != ea ? ea.dashboardTitle|raw : '') }}{% endblock %}

{% block head_favicon %}
    {% if favicon_path|default(false) %}
        <link rel=\"shortcut icon\" href=\"{{ favicon_path }}\">
    {% else %}
        {{ parent() }}
    {% endif %}
{% endblock %}

{% block wrapper_wrapper %}
    {% set page_title = block('page_title') %}
    {% set _username_label = username_label is defined ? username_label|trans : 'login_page.username'|trans({}, 'EasyAdminBundle') %}
    {% set _password_label = password_label is defined ? password_label|trans : 'login_page.password'|trans({}, 'EasyAdminBundle') %}
    {% set _forgot_password_label = forgot_password_label is defined ? forgot_password_label|trans : 'login_page.forgot_password'|trans({}, 'EasyAdminBundle') %}
    {% set _remember_me_label = remember_me_label is defined ? remember_me_label|trans : 'login_page.remember_me'|trans({}, 'EasyAdminBundle') %}
    {% set _sign_in_label = sign_in_label is defined ? sign_in_label|trans : 'login_page.sign_in'|trans({}, 'EasyAdminBundle') %}

    {{ include('@EasyAdmin/flash_messages.html.twig') }}

    <div class=\"login-wrapper\">
        <header class=\"main-header\">
            <div id=\"header-logo\">
                {% block header_logo %}
                    {% if page_title %}
                        {% if null != ea %}
                            <a class=\"logo {{ page_title|length > 14 ? 'logo-long' }}\" title=\"{{ page_title|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                {{ page_title|raw }}
                            </a>
                        {% else %}
                            <div class=\"logo {{ page_title|length > 14 ? 'logo-long' }}\">
                                {{ page_title|raw }}
                            </div>
                        {% endif %}
                    {% endif %}
                {% endblock header_logo %}
            </div>
        </header>

        <section class=\"content\">
            {% if error|default(false) %}
                <div class=\"w-100 alert alert-danger rounded mb-3\">
                    {{ error.messageKey|trans(error.messageData, 'security') }}
                </div>
            {% endif %}

            {% block login_form_wrapper %}
            <form method=\"post\" action=\"{{ action|default('') }}\">
                {% if csrf_token_intention|default(false) %}
                    <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token(csrf_token_intention) }}\">
                {% endif %}

                <input type=\"hidden\" name=\"{{ target_path_parameter|default('_target_path') }}\" value=\"{{ target_path|default(null != ea ? path(ea.dashboardRouteName) : '/') }}\" />

                {% block login_form_credentials_wrapper %}
                    <div class=\"form-group\">
                        <label class=\"form-control-label required\" for=\"username\">{{ _username_label }}</label>
                        <div class=\"form-widget\">
                            <input type=\"text\" id=\"username\" name=\"{{ username_parameter|default('_username') }}\" class=\"form-control\" value=\"{{ last_username|default('') }}\" required autofocus autocomplete=\"username\">
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <label class=\"form-control-label required\" for=\"password\">{{ _password_label }}</label>
                        <div class=\"form-widget\">
                            <input type=\"password\" id=\"password\" name=\"{{ password_parameter|default('_password') }}\" class=\"form-control\" required autocomplete=\"current-password\">
                        </div>

                        {% if forgot_password_enabled|default(false) %}
                            <div class=\"form-text\">
                                <a href=\"{{ forgot_password_path|default('#') }}\">{{ _forgot_password_label }}</a>
                            </div>
                        {% endif %}
                    </div>
                {% endblock login_form_credentials_wrapper %}

                {% if remember_me_enabled|default(false) %}
                    <div class=\"form-group\">
                        <input class=\"form-check-input\" type=\"checkbox\" id=\"remember_me\" name=\"{{ remember_me_parameter|default('_remember_me') }}\" {{ remember_me_checked|default(false) ? 'checked' }}>
                        <label class=\"form-check-label\" for=\"remember_me\">
                            {{ _remember_me_label }}
                        </label>
                    </div>
                {% endif %}

                {% component 'ea:Button' with { type: 'submit', variant: 'primary', size: 'lg', isBlock: true, htmlAttributes: '{class: \\'btn-block\\'}' } %}{% block content %}{{ _sign_in_label }}{% endblock %}{% endcomponent %}
            </form>

            {% guard function csp_nonce %}
                <script src=\"{{ asset('login.js', constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Asset\\\\AssetPackage::PACKAGE_NAME')) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
            {% else %}
                <script src=\"{{ asset('login.js', constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Asset\\\\AssetPackage::PACKAGE_NAME')) }}\"></script>
            {% endguard %}
            {% endblock login_form_wrapper %}
        </section>
    </div>
{% endblock %}
", "@EasyAdmin/page/login.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\page\\login.html.twig");
    }
}


/* @EasyAdmin/page/login.html.twig */
class __TwigTemplate_3074bc11138b8515c4e842641ecb8bf6___13169386621 extends Template
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
        // line 92
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 92, $this->source); })()), 92);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/page/login.html.twig"));

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

    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["_sign_in_label"]) || array_key_exists("_sign_in_label", $context) ? $context["_sign_in_label"] : (function () { throw new RuntimeError('Variable "_sign_in_label" does not exist.', 92, $this->source); })()), "html", null, true);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/page/login.html.twig";
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
        return array (  572 => 92,  406 => 80,  398 => 77,  395 => 76,  393 => 75,  387 => 72,  382 => 70,  372 => 65,  367 => 63,  364 => 62,  354 => 61,  346 => 100,  341 => 98,  337 => 93,  323 => 92,  320 => 91,  313 => 87,  306 => 85,  303 => 84,  301 => 83,  298 => 82,  296 => 61,  289 => 59,  286 => 58,  280 => 56,  278 => 55,  273 => 54,  263 => 53,  255 => 42,  252 => 41,  246 => 38,  241 => 37,  235 => 34,  226 => 33,  223 => 32,  220 => 31,  210 => 30,  200 => 101,  198 => 53,  195 => 52,  189 => 49,  186 => 48,  184 => 47,  178 => 43,  176 => 30,  168 => 25,  165 => 24,  163 => 4,  161 => 23,  159 => 4,  157 => 22,  155 => 4,  153 => 21,  151 => 4,  149 => 20,  147 => 4,  145 => 19,  142 => 18,  132 => 17,  120 => 13,  114 => 11,  111 => 10,  101 => 9,  84 => 7,  67 => 6,  60 => 3,  58 => 4,  56 => 2,  46 => 3,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Provider\\AdminContextProvider #}
{% set ea = ea() %}
{% extends null != ea ? ea.templatePath('layout') : '@EasyAdmin/page/login_minimal.html.twig' %}
{% trans_default_domain null != ea ? ea.i18n.translationDomain : (translation_domain is defined ? translation_domain ?? 'messages') %}

{% block body_class 'page-login' %}
{% block page_title %}{{ page_title is defined ? page_title|raw : (null != ea ? ea.dashboardTitle|raw : '') }}{% endblock %}

{% block head_favicon %}
    {% if favicon_path|default(false) %}
        <link rel=\"shortcut icon\" href=\"{{ favicon_path }}\">
    {% else %}
        {{ parent() }}
    {% endif %}
{% endblock %}

{% block wrapper_wrapper %}
    {% set page_title = block('page_title') %}
    {% set _username_label = username_label is defined ? username_label|trans : 'login_page.username'|trans({}, 'EasyAdminBundle') %}
    {% set _password_label = password_label is defined ? password_label|trans : 'login_page.password'|trans({}, 'EasyAdminBundle') %}
    {% set _forgot_password_label = forgot_password_label is defined ? forgot_password_label|trans : 'login_page.forgot_password'|trans({}, 'EasyAdminBundle') %}
    {% set _remember_me_label = remember_me_label is defined ? remember_me_label|trans : 'login_page.remember_me'|trans({}, 'EasyAdminBundle') %}
    {% set _sign_in_label = sign_in_label is defined ? sign_in_label|trans : 'login_page.sign_in'|trans({}, 'EasyAdminBundle') %}

    {{ include('@EasyAdmin/flash_messages.html.twig') }}

    <div class=\"login-wrapper\">
        <header class=\"main-header\">
            <div id=\"header-logo\">
                {% block header_logo %}
                    {% if page_title %}
                        {% if null != ea %}
                            <a class=\"logo {{ page_title|length > 14 ? 'logo-long' }}\" title=\"{{ page_title|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                {{ page_title|raw }}
                            </a>
                        {% else %}
                            <div class=\"logo {{ page_title|length > 14 ? 'logo-long' }}\">
                                {{ page_title|raw }}
                            </div>
                        {% endif %}
                    {% endif %}
                {% endblock header_logo %}
            </div>
        </header>

        <section class=\"content\">
            {% if error|default(false) %}
                <div class=\"w-100 alert alert-danger rounded mb-3\">
                    {{ error.messageKey|trans(error.messageData, 'security') }}
                </div>
            {% endif %}

            {% block login_form_wrapper %}
            <form method=\"post\" action=\"{{ action|default('') }}\">
                {% if csrf_token_intention|default(false) %}
                    <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token(csrf_token_intention) }}\">
                {% endif %}

                <input type=\"hidden\" name=\"{{ target_path_parameter|default('_target_path') }}\" value=\"{{ target_path|default(null != ea ? path(ea.dashboardRouteName) : '/') }}\" />

                {% block login_form_credentials_wrapper %}
                    <div class=\"form-group\">
                        <label class=\"form-control-label required\" for=\"username\">{{ _username_label }}</label>
                        <div class=\"form-widget\">
                            <input type=\"text\" id=\"username\" name=\"{{ username_parameter|default('_username') }}\" class=\"form-control\" value=\"{{ last_username|default('') }}\" required autofocus autocomplete=\"username\">
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <label class=\"form-control-label required\" for=\"password\">{{ _password_label }}</label>
                        <div class=\"form-widget\">
                            <input type=\"password\" id=\"password\" name=\"{{ password_parameter|default('_password') }}\" class=\"form-control\" required autocomplete=\"current-password\">
                        </div>

                        {% if forgot_password_enabled|default(false) %}
                            <div class=\"form-text\">
                                <a href=\"{{ forgot_password_path|default('#') }}\">{{ _forgot_password_label }}</a>
                            </div>
                        {% endif %}
                    </div>
                {% endblock login_form_credentials_wrapper %}

                {% if remember_me_enabled|default(false) %}
                    <div class=\"form-group\">
                        <input class=\"form-check-input\" type=\"checkbox\" id=\"remember_me\" name=\"{{ remember_me_parameter|default('_remember_me') }}\" {{ remember_me_checked|default(false) ? 'checked' }}>
                        <label class=\"form-check-label\" for=\"remember_me\">
                            {{ _remember_me_label }}
                        </label>
                    </div>
                {% endif %}

                {% component 'ea:Button' with { type: 'submit', variant: 'primary', size: 'lg', isBlock: true, htmlAttributes: '{class: \\'btn-block\\'}' } %}{% block content %}{{ _sign_in_label }}{% endblock %}{% endcomponent %}
            </form>

            {% guard function csp_nonce %}
                <script src=\"{{ asset('login.js', constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Asset\\\\AssetPackage::PACKAGE_NAME')) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
            {% else %}
                <script src=\"{{ asset('login.js', constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Asset\\\\AssetPackage::PACKAGE_NAME')) }}\"></script>
            {% endguard %}
            {% endblock login_form_wrapper %}
        </section>
    </div>
{% endblock %}
", "@EasyAdmin/page/login.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\page\\login.html.twig");
    }
}
