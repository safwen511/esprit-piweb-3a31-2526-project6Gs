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

/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56 extends Template
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
            'head_metas' => [$this, 'block_head_metas'],
            'page_title' => [$this, 'block_page_title'],
            'head_stylesheets' => [$this, 'block_head_stylesheets'],
            'configured_stylesheets' => [$this, 'block_configured_stylesheets'],
            'head_favicon' => [$this, 'block_head_favicon'],
            'head_javascript' => [$this, 'block_head_javascript'],
            'importmap' => [$this, 'block_importmap'],
            'configured_javascripts' => [$this, 'block_configured_javascripts'],
            'configured_head_contents' => [$this, 'block_configured_head_contents'],
            'body' => [$this, 'block_body'],
            'body_attr' => [$this, 'block_body_attr'],
            'body_id' => [$this, 'block_body_id'],
            'body_class' => [$this, 'block_body_class'],
            'javascript_page_layout' => [$this, 'block_javascript_page_layout'],
            'javascript_page_color_scheme' => [$this, 'block_javascript_page_color_scheme'],
            'wrapper_wrapper' => [$this, 'block_wrapper_wrapper'],
            'flash_messages' => [$this, 'block_flash_messages'],
            'user_menu' => [$this, 'block_user_menu'],
            'wrapper' => [$this, 'block_wrapper'],
            'responsive_header' => [$this, 'block_responsive_header'],
            'responsive_header_logo' => [$this, 'block_responsive_header_logo'],
            'sidebar' => [$this, 'block_sidebar'],
            'header' => [$this, 'block_header'],
            'header_navbar' => [$this, 'block_header_navbar'],
            'header_logo' => [$this, 'block_header_logo'],
            'main_menu_wrapper' => [$this, 'block_main_menu_wrapper'],
            'main_content_wrapper' => [$this, 'block_main_content_wrapper'],
            'content_top_header' => [$this, 'block_content_top_header'],
            'search_wrapper' => [$this, 'block_search_wrapper'],
            'search' => [$this, 'block_search'],
            'search_form' => [$this, 'block_search_form'],
            'search_form_filters' => [$this, 'block_search_form_filters'],
            'header_custom_menu_wrapper' => [$this, 'block_header_custom_menu_wrapper'],
            'header_custom_menu' => [$this, 'block_header_custom_menu'],
            'settings_dropdown_wrapper' => [$this, 'block_settings_dropdown_wrapper'],
            'content' => [$this, 'block_content'],
            'content_header_wrapper' => [$this, 'block_content_header_wrapper'],
            'content_header' => [$this, 'block_content_header'],
            'content_title' => [$this, 'block_content_title'],
            'content_help' => [$this, 'block_content_help'],
            'page_actions_wrapper' => [$this, 'block_page_actions_wrapper'],
            'page_actions' => [$this, 'block_page_actions'],
            'main' => [$this, 'block_main'],
            'content_footer_wrapper' => [$this, 'block_content_footer_wrapper'],
            'content_footer' => [$this, 'block_content_footer'],
            'body_javascript' => [$this, 'block_body_javascript'],
            'configured_body_contents' => [$this, 'block_configured_body_contents'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

        // line 2
        $context["ea"] = $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->ea();
        // line 3
        $context["__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 3, $this->source); })()), "i18n", [], "any", false, false, false, 3), "translationDomain", [], "any", false, false, false, 3);
        // line 4
        yield "
<!DOCTYPE html>
<html lang=\"";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 6, $this->source); })()), "i18n", [], "any", false, false, false, 6), "htmlLocale", [], "any", false, false, false, 6), "html", null, true);
        yield "\" dir=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 6, $this->source); })()), "i18n", [], "any", false, false, false, 6), "textDirection", [], "any", false, false, false, 6), "html", null, true);
        yield "\" data-turbo=\"false\">
<head>
    ";
        // line 8
        yield from $this->unwrap()->yieldBlock('head_metas', $context, $blocks);
        // line 15
        yield "
    ";
        // line 16
        $context["page_title_block_output"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            yield from $this->unwrap()->yieldBlock('page_title', $context, $blocks);
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 17
        yield "    <title>";
        yield Twig\Extension\CoreExtension::striptags((isset($context["page_title_block_output"]) || array_key_exists("page_title_block_output", $context) ? $context["page_title_block_output"] : (function () { throw new RuntimeError('Variable "page_title_block_output" does not exist.', 17, $this->source); })()));
        yield "</title>

    ";
        // line 19
        yield from $this->unwrap()->yieldBlock('head_stylesheets', $context, $blocks);
        // line 26
        yield "
    ";
        // line 27
        yield from $this->unwrap()->yieldBlock('configured_stylesheets', $context, $blocks);
        // line 31
        yield "
    ";
        // line 32
        yield from $this->unwrap()->yieldBlock('head_favicon', $context, $blocks);
        // line 35
        yield "
    ";
        // line 36
        yield from $this->unwrap()->yieldBlock('head_javascript', $context, $blocks);
        // line 47
        yield "
    ";
        // line 48
        yield from $this->unwrap()->yieldBlock('configured_javascripts', $context, $blocks);
        // line 52
        yield "
    ";
        // line 53
        yield from $this->unwrap()->yieldBlock('configured_head_contents', $context, $blocks);
        // line 58
        yield "</head>

";
        // line 60
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 384
        yield "</html>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head_metas(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head_metas"));

        // line 9
        yield "        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 16
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_title"));

        yield from         $this->unwrap()->yieldBlock("content_title", $context, $blocks);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 19
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head_stylesheets"));

        // line 20
        yield "        ";
        // line 23
        yield "            <link rel=\"stylesheet\" href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("app.css", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 23, $this->source); })()), "assets", [], "any", false, false, false, 23), "defaultAssetPackageName", [], "any", false, false, false, 23)), "html", null, true);
        yield "\">
        ";
        // line 25
        yield "    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 27
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_configured_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "configured_stylesheets"));

        // line 28
        yield "        ";
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@EasyAdmin/includes/_css_assets.html.twig", ["assets" => (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["ea"] ?? null), "assets", [], "any", false, true, false, 28), "cssAssets", [], "any", true, true, false, 28) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 28, $this->source); })()), "assets", [], "any", false, false, false, 28), "cssAssets", [], "any", false, false, false, 28)))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 28, $this->source); })()), "assets", [], "any", false, false, false, 28), "cssAssets", [], "any", false, false, false, 28)) : ([]))], false);
        yield "
        ";
        // line 29
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@EasyAdmin/includes/_encore_link_tags.html.twig", ["assets" => (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["ea"] ?? null), "assets", [], "any", false, true, false, 29), "webpackEncoreAssets", [], "any", true, true, false, 29) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 29, $this->source); })()), "assets", [], "any", false, false, false, 29), "webpackEncoreAssets", [], "any", false, false, false, 29)))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 29, $this->source); })()), "assets", [], "any", false, false, false, 29), "webpackEncoreAssets", [], "any", false, false, false, 29)) : ([]))], false);
        yield "
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 32
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head_favicon(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head_favicon"));

        // line 33
        yield "        <link rel=\"shortcut icon\" href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 33, $this->source); })()), "dashboardFaviconPath", [], "any", false, false, false, 33)), "html", null, true);
        yield "\">
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 36
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head_javascript(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head_javascript"));

        // line 37
        yield "        ";
        // line 40
        yield "            <script src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("app.js", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 40, $this->source); })()), "assets", [], "any", false, false, false, 40), "defaultAssetPackageName", [], "any", false, false, false, 40)), "html", null, true);
        yield "\"></script>
        ";
        // line 42
        yield "
        ";
        // line 43
        yield from $this->unwrap()->yieldBlock('importmap', $context, $blocks);
        // line 46
        yield "    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 43
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_importmap(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "importmap"));

        // line 44
        yield "            ";
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@EasyAdmin/includes/_importmap.html.twig", ["assets" => (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["ea"] ?? null), "assets", [], "any", false, true, false, 44), "assetMapperAssets", [], "any", true, true, false, 44) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 44, $this->source); })()), "assets", [], "any", false, false, false, 44), "assetMapperAssets", [], "any", false, false, false, 44)))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 44, $this->source); })()), "assets", [], "any", false, false, false, 44), "assetMapperAssets", [], "any", false, false, false, 44)) : ([]))], false);
        yield "
        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 48
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_configured_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "configured_javascripts"));

        // line 49
        yield "        ";
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@EasyAdmin/includes/_js_assets.html.twig", ["assets" => (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["ea"] ?? null), "assets", [], "any", false, true, false, 49), "jsAssets", [], "any", true, true, false, 49) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 49, $this->source); })()), "assets", [], "any", false, false, false, 49), "jsAssets", [], "any", false, false, false, 49)))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 49, $this->source); })()), "assets", [], "any", false, false, false, 49), "jsAssets", [], "any", false, false, false, 49)) : ([]))], false);
        yield "
        ";
        // line 50
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@EasyAdmin/includes/_encore_script_tags.html.twig", ["assets" => (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["ea"] ?? null), "assets", [], "any", false, true, false, 50), "webpackEncoreAssets", [], "any", true, true, false, 50) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 50, $this->source); })()), "assets", [], "any", false, false, false, 50), "webpackEncoreAssets", [], "any", false, false, false, 50)))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 50, $this->source); })()), "assets", [], "any", false, false, false, 50), "webpackEncoreAssets", [], "any", false, false, false, 50)) : ([]))], false);
        yield "
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 53
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_configured_head_contents(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "configured_head_contents"));

        // line 54
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["ea"] ?? null), "assets", [], "any", false, true, false, 54), "headContents", [], "any", true, true, false, 54) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 54, $this->source); })()), "assets", [], "any", false, false, false, 54), "headContents", [], "any", false, false, false, 54)))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 54, $this->source); })()), "assets", [], "any", false, false, false, 54), "headContents", [], "any", false, false, false, 54)) : ([])));
        foreach ($context['_seq'] as $context["_key"] => $context["htmlContent"]) {
            // line 55
            yield "            ";
            yield $context["htmlContent"];
            yield "
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['htmlContent'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 57
        yield "    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 60
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 61
        yield "    <body ";
        yield from $this->unwrap()->yieldBlock('body_attr', $context, $blocks);
        // line 62
        yield "        id=\"";
        yield from $this->unwrap()->yieldBlock('body_id', $context, $blocks);
        yield "\"
        class=\"ea ";
        // line 63
        yield from $this->unwrap()->yieldBlock('body_class', $context, $blocks);
        yield "\"
        data-ea-content-width=\"";
        // line 64
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["ea"] ?? null), "crud", [], "any", false, true, false, 64), "contentWidth", [], "any", true, true, false, 64) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 64, $this->source); })()), "crud", [], "any", false, false, false, 64), "contentWidth", [], "any", false, false, false, 64)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 64, $this->source); })()), "crud", [], "any", false, false, false, 64), "contentWidth", [], "any", false, false, false, 64), "html", null, true)) : ((((CoreExtension::getAttribute($this->env, $this->source, ($context["ea"] ?? null), "dashboardContentWidth", [], "any", true, true, false, 64) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 64, $this->source); })()), "dashboardContentWidth", [], "any", false, false, false, 64)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 64, $this->source); })()), "dashboardContentWidth", [], "any", false, false, false, 64), "html", null, true)) : ("normal"))));
        yield "\"
        data-ea-sidebar-width=\"";
        // line 65
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["ea"] ?? null), "crud", [], "any", false, true, false, 65), "sidebarWidth", [], "any", true, true, false, 65) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 65, $this->source); })()), "crud", [], "any", false, false, false, 65), "sidebarWidth", [], "any", false, false, false, 65)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 65, $this->source); })()), "crud", [], "any", false, false, false, 65), "sidebarWidth", [], "any", false, false, false, 65), "html", null, true)) : ((((CoreExtension::getAttribute($this->env, $this->source, ($context["ea"] ?? null), "dashboardSidebarWidth", [], "any", true, true, false, 65) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 65, $this->source); })()), "dashboardSidebarWidth", [], "any", false, false, false, 65)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 65, $this->source); })()), "dashboardSidebarWidth", [], "any", false, false, false, 65), "html", null, true)) : ("normal"))));
        yield "\"
        data-ea-dark-scheme-is-enabled=\"";
        // line 66
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 66, $this->source); })()), "dashboardHasDarkModeEnabled", [], "any", false, false, false, 66)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("true") : ("false"));
        yield "\"
        data-ea-default-color-scheme=\"";
        // line 67
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 67, $this->source); })()), "dashboardDefaultColorScheme", [], "any", false, false, false, 67), "html", null, true);
        yield "\"
        data-ea-icon-set=\"";
        // line 68
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 68, $this->source); })()), "assets", [], "any", false, false, false, 68), "iconSet", [], "any", false, false, false, 68), "html", null, true);
        yield "\"
        data-ea-icon-prefix=\"";
        // line 69
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 69, $this->source); })()), "assets", [], "any", false, false, false, 69), "defaultIconPrefix", [], "any", false, false, false, 69), "html", null, true);
        yield "\"
    >
    ";
        // line 71
        yield from $this->unwrap()->yieldBlock('javascript_page_layout', $context, $blocks);
        // line 78
        yield "    ";
        yield from $this->unwrap()->yieldBlock('javascript_page_color_scheme', $context, $blocks);
        // line 85
        yield "
    ";
        // line 86
        yield from $this->unwrap()->yieldBlock('wrapper_wrapper', $context, $blocks);
        // line 374
        yield "
    ";
        // line 375
        yield from $this->unwrap()->yieldBlock('body_javascript', $context, $blocks);
        // line 376
        yield "
    ";
        // line 377
        yield from $this->unwrap()->yieldBlock('configured_body_contents', $context, $blocks);
        // line 382
        yield "    </body>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 61
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_attr(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body_attr"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 62
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_id(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body_id"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 63
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_class(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body_class"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 71
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascript_page_layout(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascript_page_layout"));

        // line 72
        yield "        ";
        // line 75
        yield "            <script src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("page-layout.js", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 75, $this->source); })()), "assets", [], "any", false, false, false, 75), "defaultAssetPackageName", [], "any", false, false, false, 75)), "html", null, true);
        yield "\"></script>
        ";
        // line 77
        yield "    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 78
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascript_page_color_scheme(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascript_page_color_scheme"));

        // line 79
        yield "        ";
        // line 82
        yield "            <script src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("page-color-scheme.js", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 82, $this->source); })()), "assets", [], "any", false, false, false, 82), "defaultAssetPackageName", [], "any", false, false, false, 82)), "html", null, true);
        yield "\"></script>
        ";
        // line 84
        yield "    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 86
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_wrapper_wrapper(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "wrapper_wrapper"));

        // line 87
        yield "        ";
        yield from $this->unwrap()->yieldBlock('flash_messages', $context, $blocks);
        // line 90
        yield "
        ";
        // line 91
        $context["user_menu_avatar"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 92
            yield "            ";
            if ((null == CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 92, $this->source); })()), "userMenu", [], "any", false, false, false, 92), "avatarUrl", [], "any", false, false, false, 92))) {
                // line 93
                yield "                <span class=\"user-avatar\">
                    ";
                // line 94
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:user"]);
                yield "
                </span>
            ";
            } else {
                // line 97
                yield "                <img class=\"user-avatar\" src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 97, $this->source); })()), "userMenu", [], "any", false, false, false, 97), "avatarUrl", [], "any", false, false, false, 97), "html", null, true);
                yield "\" />
            ";
            }
            // line 99
            yield "        ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 100
        yield "
        ";
        // line 101
        $context["user_menu"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 102
            yield "            ";
            yield from $this->unwrap()->yieldBlock('user_menu', $context, $blocks);
            // line 119
            yield "        ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 120
        yield "
        ";
        // line 121
        $context["impersonator_permission"] = ((Twig\Extension\CoreExtension::constant("Symfony\\Component\\Security\\Core\\Authorization\\Voter\\AuthenticatedVoter::IS_IMPERSONATOR", null, true)) ? ("IS_IMPERSONATOR") : ("ROLE_PREVIOUS_ADMIN"));
        // line 122
        yield "
        ";
        // line 123
        $context["user_menu_dropdown"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 124
            yield "            ";
            $_v0 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
            $preRendered = $_v0->preRender("ea:ActionMenu:ActionList", Twig\Extension\CoreExtension::toArray([]));
            if (null !== $preRendered) {
                yield $preRendered; 
            } else {
                $preRenderEvent = $_v0->startEmbedComponent("ea:ActionMenu:ActionList", Twig\Extension\CoreExtension::toArray([]), $context, "@EasyAdmin/layout.html.twig", 4991107621);
                $embeddedContext = $preRenderEvent->getVariables();
                $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
                $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
                $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 4991107621);
                $this->load("@EasyAdmin/layout.html.twig", 124, "4991107621")->display($embeddedContext, $embeddedBlocks);
                $_v0->finishEmbedComponent();
            }
            // line 135
            yield "        ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 136
        yield "
        ";
        // line 137
        $context["settings_dropdown"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 138
            yield "            ";
            if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 138, $this->source); })()), "dashboardLocales", [], "any", false, false, false, 138) || CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 138, $this->source); })()), "dashboardHasDarkModeEnabled", [], "any", false, false, false, 138))) {
                // line 139
                yield "                ";
                $_v1 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
                $preRendered = $_v1->preRender("ea:ActionMenu", Twig\Extension\CoreExtension::toArray(["class" => "dropdown-settings"]));
                if (null !== $preRendered) {
                    yield $preRendered; 
                } else {
                    $preRenderEvent = $_v1->startEmbedComponent("ea:ActionMenu", Twig\Extension\CoreExtension::toArray(["class" => "dropdown-settings"]), $context, "@EasyAdmin/layout.html.twig", 20482372061);
                    $embeddedContext = $preRenderEvent->getVariables();
                    $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
                    $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
                    $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 20482372061);
                    $this->load("@EasyAdmin/layout.html.twig", 139, "20482372061")->display($embeddedContext, $embeddedBlocks);
                    $_v1->finishEmbedComponent();
                }
                // line 172
                yield "            ";
            }
            // line 173
            yield "        ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 174
        yield "
        <div class=\"wrapper\">
            ";
        // line 176
        yield from $this->unwrap()->yieldBlock('wrapper', $context, $blocks);
        // line 372
        yield "        </div>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 87
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_flash_messages(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "flash_messages"));

        // line 88
        yield "            ";
        yield Twig\Extension\CoreExtension::include($this->env, $context, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 88, $this->source); })()), "templatePath", ["flash_messages"], "method", false, false, false, 88));
        yield "
        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 102
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_user_menu(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "user_menu"));

        // line 103
        yield "                ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 103, $this->source); })()), "userMenu", [], "any", false, false, false, 103), "items", [], "any", false, false, false, 103)) > 0)) {
            // line 104
            yield "                    ";
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Divider");
            yield "

                    ";
            // line 106
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 106, $this->source); })()), "userMenu", [], "any", false, false, false, 106), "items", [], "any", false, false, false, 106));
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
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 107
                yield "                        ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "isMenuSection", [], "any", false, false, false, 107)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 108
                    yield "                            ";
                    if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 108)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 109
                        yield "                                ";
                        yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Divider");
                        yield "
                            ";
                    }
                    // line 111
                    yield "
                            ";
                    // line 112
                    yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Header", ["label" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 112), [],                     // line 3
(isset($context["__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5"]) || array_key_exists("__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5", $context) ? $context["__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5" does not exist.', 3, $this->source); })())), "class" => CoreExtension::getAttribute($this->env, $this->source,                     // line 112
$context["item"], "cssClass", [], "any", false, false, false, 112), "icon" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "icon", [], "any", false, false, false, 112), "htmlAttributes" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "htmlAttributes", [], "any", false, false, false, 112)]);
                    yield "
                        ";
                } else {
                    // line 114
                    yield "                            ";
                    yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Item", ["label" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 114), [],                     // line 3
(isset($context["__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5"]) || array_key_exists("__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5", $context) ? $context["__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5" does not exist.', 3, $this->source); })())), "class" => ("user-action " . CoreExtension::getAttribute($this->env, $this->source,                     // line 114
$context["item"], "cssClass", [], "any", false, false, false, 114)), "icon" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "icon", [], "any", false, false, false, 114), "url" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "linkUrl", [], "any", false, false, false, 114), "target" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "linkTarget", [], "any", false, false, false, 114), "rel" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "linkRel", [], "any", false, false, false, 114), "referrerpolicy" => "origin-when-cross-origin", "htmlAttributes" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "htmlAttributes", [], "any", false, false, false, 114)]);
                    yield "
                        ";
                }
                // line 116
                yield "                    ";
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
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 117
            yield "                ";
        }
        // line 118
        yield "            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 176
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_wrapper(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "wrapper"));

        // line 177
        yield "                <div class=\"responsive-header\">
                    ";
        // line 178
        yield from $this->unwrap()->yieldBlock('responsive_header', $context, $blocks);
        // line 206
        yield "                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        ";
        // line 210
        yield from $this->unwrap()->yieldBlock('sidebar', $context, $blocks);
        // line 232
        yield "
                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                ";
        // line 236
        yield from $this->unwrap()->yieldBlock('main_content_wrapper', $context, $blocks);
        // line 371
        yield "            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 178
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_responsive_header(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "responsive_header"));

        // line 179
        yield "                        ";
        $_v2 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v2->preRender("ea:Button", Twig\Extension\CoreExtension::toArray(["type" => "button", "isInvisible" => true, "icon" => "internal:menu-bars", "id" => "navigation-toggler", "aria-label" => "Toggle navigation"]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v2->startEmbedComponent("ea:Button", Twig\Extension\CoreExtension::toArray(["type" => "button", "isInvisible" => true, "icon" => "internal:menu-bars", "id" => "navigation-toggler", "aria-label" => "Toggle navigation"]), $context, "@EasyAdmin/layout.html.twig", 5112697781);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 5112697781);
            $this->load("@EasyAdmin/layout.html.twig", 179, "5112697781")->display($embeddedContext, $embeddedBlocks);
            $_v2->finishEmbedComponent();
        }
        // line 180
        yield "
                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            ";
        // line 182
        yield from $this->unwrap()->yieldBlock('responsive_header_logo', $context, $blocks);
        // line 187
        yield "                        </div>

                        ";
        // line 189
        $_v3 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v3->preRender("ea:ActionMenu", Twig\Extension\CoreExtension::toArray(["class" => ("ms-auto user-menu-wrapper " . (((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted((isset($context["impersonator_permission"]) || array_key_exists("impersonator_permission", $context) ? $context["impersonator_permission"] : (function () { throw new RuntimeError('Variable "impersonator_permission" does not exist.', 189, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("user-is-impersonated") : ("")))]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v3->startEmbedComponent("ea:ActionMenu", Twig\Extension\CoreExtension::toArray(["class" => ("ms-auto user-menu-wrapper " . (((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted((isset($context["impersonator_permission"]) || array_key_exists("impersonator_permission", $context) ? $context["impersonator_permission"] : (function () { throw new RuntimeError('Variable "impersonator_permission" does not exist.', 189, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("user-is-impersonated") : ("")))]), $context, "@EasyAdmin/layout.html.twig", 25816779171);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 25816779171);
            $this->load("@EasyAdmin/layout.html.twig", 189, "25816779171")->display($embeddedContext, $embeddedBlocks);
            $_v3->finishEmbedComponent();
        }
        // line 203
        yield "
                        ";
        // line 204
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["settings_dropdown"]) || array_key_exists("settings_dropdown", $context) ? $context["settings_dropdown"] : (function () { throw new RuntimeError('Variable "settings_dropdown" does not exist.', 204, $this->source); })()), "html", null, true);
        yield "
                    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 182
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_responsive_header_logo(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "responsive_header_logo"));

        // line 183
        yield "                                <a class=\"responsive-logo\" title=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 183, $this->source); })()), "dashboardTitle", [], "any", false, false, false, 183)), "html", null, true);
        yield "\" href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 183, $this->source); })()), "dashboardRouteName", [], "any", false, false, false, 183));
        yield "\">
                                    ";
        // line 184
        yield CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 184, $this->source); })()), "dashboardTitle", [], "any", false, false, false, 184);
        yield "
                                </a>
                            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 210
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_sidebar(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sidebar"));

        // line 211
        yield "                            <header class=\"main-header\">
                                ";
        // line 212
        yield from $this->unwrap()->yieldBlock('header', $context, $blocks);
        // line 226
        yield "                            </header>

                            ";
        // line 228
        yield from $this->unwrap()->yieldBlock('main_menu_wrapper', $context, $blocks);
        // line 231
        yield "                        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 212
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_header(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header"));

        // line 213
        yield "                                <nav class=\"navbar\" role=\"navigation\">
                                    ";
        // line 214
        yield from $this->unwrap()->yieldBlock('header_navbar', $context, $blocks);
        // line 224
        yield "                                </nav>
                                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 214
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_header_navbar(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_navbar"));

        // line 215
        yield "                                        <div id=\"header-logo\">
                                            ";
        // line 216
        yield from $this->unwrap()->yieldBlock('header_logo', $context, $blocks);
        // line 222
        yield "                                        </div>
                                    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 216
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_header_logo(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_logo"));

        // line 217
        yield "                                                <a class=\"logo\" title=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 217, $this->source); })()), "dashboardTitle", [], "any", false, false, false, 217)), "html", null, true);
        yield "\" href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 217, $this->source); })()), "dashboardRouteName", [], "any", false, false, false, 217));
        yield "\">
                                                    <span class=\"logo-custom\">";
        // line 218
        yield CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 218, $this->source); })()), "dashboardTitle", [], "any", false, false, false, 218);
        yield "</span>
                                                    <span class=\"logo-compact\">";
        // line 219
        yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:home"]);
        yield "</span>
                                                </a>
                                            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 228
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_main_menu_wrapper(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "main_menu_wrapper"));

        // line 229
        yield "                                ";
        yield Twig\Extension\CoreExtension::include($this->env, $context, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 229, $this->source); })()), "templatePath", ["main_menu"], "method", false, false, false, 229));
        yield "
                            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 236
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_main_content_wrapper(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "main_content_wrapper"));

        // line 237
        yield "                <section class=\"main-content\">
                    ";
        // line 238
        $context["has_search"] = ( !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 238, $this->source); })()), "crud", [], "any", false, false, false, 238)) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 238, $this->source); })()), "crud", [], "any", false, false, false, 238), "isSearchEnabled", [], "any", false, false, false, 238));
        // line 239
        yield "                    <aside class=\"content-top ";
        yield (((($tmp = (isset($context["has_search"]) || array_key_exists("has_search", $context) ? $context["has_search"] : (function () { throw new RuntimeError('Variable "has_search" does not exist.', 239, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("ea-search-enabled") : ("ea-search-disabled"));
        yield "\">
                        ";
        // line 240
        yield from $this->unwrap()->yieldBlock('content_top_header', $context, $blocks);
        // line 321
        yield "                    </aside>

                    <div class=\"content-wrapper\">
                        ";
        // line 324
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 366
        yield "
                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 240
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content_top_header(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_top_header"));

        // line 241
        yield "                            ";
        yield from $this->unwrap()->yieldBlock('search_wrapper', $context, $blocks);
        // line 298
        yield "
                            ";
        // line 299
        yield from $this->unwrap()->yieldBlock('header_custom_menu_wrapper', $context, $blocks);
        // line 316
        yield "
                            ";
        // line 317
        yield from $this->unwrap()->yieldBlock('settings_dropdown_wrapper', $context, $blocks);
        // line 320
        yield "                        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 241
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_search_wrapper(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "search_wrapper"));

        // line 242
        yield "                            <div class=\"content-search\">
                                ";
        // line 243
        if ((($tmp = (isset($context["has_search"]) || array_key_exists("has_search", $context) ? $context["has_search"] : (function () { throw new RuntimeError('Variable "has_search" does not exist.', 243, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 244
            yield "                                    ";
            yield from $this->unwrap()->yieldBlock('search', $context, $blocks);
            // line 295
            yield "                                ";
        }
        // line 296
        yield "                            </div>
                            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 244
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_search(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "search"));

        // line 245
        yield "                                        ";
        $context["formActionUrl"] = null;
        // line 246
        yield "                                        ";
        $context["crudController"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 246, $this->source); })()), "request", [], "any", false, false, false, 246), "attributes", [], "any", false, false, false, 246), "get", ["crudControllerFqcn"], "method", false, false, false, 246);
        // line 247
        yield "                                        ";
        $context["formActionUrl"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->getAdminUrlGenerator(), "setController", [(isset($context["crudController"]) || array_key_exists("crudController", $context) ? $context["crudController"] : (function () { throw new RuntimeError('Variable "crudController" does not exist.', 247, $this->source); })())], "method", false, false, false, 247), "setAction", ["index"], "method", false, false, false, 247), "set", ["page", 1], "method", false, false, false, 247);
        // line 248
        yield "                                        <form class=\"form-action-search\" method=\"get\" ";
        if ((($tmp = (isset($context["formActionUrl"]) || array_key_exists("formActionUrl", $context) ? $context["formActionUrl"] : (function () { throw new RuntimeError('Variable "formActionUrl" does not exist.', 248, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["formActionUrl"]) || array_key_exists("formActionUrl", $context) ? $context["formActionUrl"] : (function () { throw new RuntimeError('Variable "formActionUrl" does not exist.', 248, $this->source); })()), "html", null, true);
            yield "\"";
        }
        yield ">
                                            ";
        // line 249
        yield from $this->unwrap()->yieldBlock('search_form', $context, $blocks);
        // line 293
        yield "                                        </form>
                                    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 249
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_search_form(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "search_form"));

        // line 250
        yield "                                                ";
        yield from $this->unwrap()->yieldBlock('search_form_filters', $context, $blocks);
        // line 275
        yield "
                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        ";
        // line 278
        yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:search", "class" => "content-search-icon"]);
        yield "

                                                        <label class=\"content-search-label\" data-value=\"";
        // line 280
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 280, $this->source); })()), "request", [], "any", false, false, false, 280), "query", [], "any", false, false, false, 280), "get", ["query"], "method", false, false, false, 280), "html", null, true);
        yield "\">
                                                            <input class=\"form-control ";
        // line 281
        yield (((null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 281, $this->source); })()), "request", [], "any", false, false, false, 281), "query", [], "any", false, false, false, 281), "get", ["query"], "method", false, false, false, 281))) ? ("is-blank") : (""));
        yield "\" type=\"search\" name=\"query\" value=\"";
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, true, false, 281), "query", [], "any", false, true, false, 281), "get", ["query"], "method", true, true, false, 281) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 281, $this->source); })()), "request", [], "any", false, false, false, 281), "query", [], "any", false, false, false, 281), "get", ["query"], "method", false, false, false, 281)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 281, $this->source); })()), "request", [], "any", false, false, false, 281), "query", [], "any", false, false, false, 281), "get", ["query"], "method", false, false, false, 281), "html", null, true)) : (""));
        yield "\" placeholder=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->createTranslatable("action.search", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 281, $this->source); })()), "i18n", [], "any", false, false, false, 281), "translationParameters", [], "any", false, false, false, 281), "EasyAdminBundle"), [],         // line 3
(isset($context["__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5"]) || array_key_exists("__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5", $context) ? $context["__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5" does not exist.', 3, $this->source); })())), "html", null, true);
        // line 281
        yield "\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"";
        if (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 281, $this->source); })()), "crud", [], "any", false, false, false, 281), "currentAction", [], "any", false, false, false, 281) == "index") && (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 281, $this->source); })()), "crud", [], "any", false, false, false, 281), "autofocusSearch", [], "any", false, false, false, 281) == true))) {
            yield " autofocus=\"autofocus\"";
        }
        yield ">
                                                        </label>

                                                        ";
        // line 284
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 284, $this->source); })()), "request", [], "any", false, false, false, 284), "query", [], "any", false, false, false, 284), "get", ["query"], "method", false, false, false, 284)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 285
            yield "                                                            ";
            $context["search_reset_url"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->getAdminUrlGenerator(), "unset", ["query"], "method", false, false, false, 285), "unset", ["page"], "method", false, false, false, 285), "setController", [(isset($context["crudController"]) || array_key_exists("crudController", $context) ? $context["crudController"] : (function () { throw new RuntimeError('Variable "crudController" does not exist.', 285, $this->source); })())], "method", false, false, false, 285), "setAction", ["index"], "method", false, false, false, 285);
            // line 286
            yield "                                                            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search_reset_url"]) || array_key_exists("search_reset_url", $context) ? $context["search_reset_url"] : (function () { throw new RuntimeError('Variable "search_reset_url" does not exist.', 286, $this->source); })()), "html", null, true);
            yield "\" class=\"content-search-reset\">
                                                                ";
            // line 287
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:xmark"]);
            yield "
                                                            </a>
                                                        ";
        }
        // line 290
        yield "                                                    </div>
                                                </div>
                                            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 250
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_search_form_filters(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "search_form_filters"));

        // line 251
        yield "                                                    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 251, $this->source); })()), "search", [], "any", false, false, false, 251), "appliedFilters", [], "any", false, false, false, 251));
        foreach ($context['_seq'] as $context["field"] => $context["fieldValue"]) {
            // line 252
            yield "                                                        ";
            if (is_iterable($context["fieldValue"])) {
                // line 253
                yield "                                                            ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable($context["fieldValue"]);
                foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                    // line 254
                    yield "                                                                ";
                    // line 255
                    yield "                                                                ";
                    if (is_iterable($context["value"])) {
                        // line 256
                        yield "                                                                    ";
                        $context['_parent'] = $context;
                        $context['_seq'] = CoreExtension::ensureTraversable($context["value"]);
                        foreach ($context['_seq'] as $context["index"] => $context["iterValue"]) {
                            // line 257
                            yield "                                                                        ";
                            // line 258
                            yield "                                                                        ";
                            if (is_iterable($context["iterValue"])) {
                                // line 259
                                yield "                                                                            ";
                                $context['_parent'] = $context;
                                $context['_seq'] = CoreExtension::ensureTraversable($context["iterValue"]);
                                foreach ($context['_seq'] as $context["subIndex"] => $context["subIterValue"]) {
                                    // line 260
                                    yield "                                                                                <input type=\"hidden\" name=\"filters[";
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["field"], "html", null, true);
                                    yield "][";
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
                                    yield "][";
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["index"], "html", null, true);
                                    yield "][";
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["subIndex"], "html", null, true);
                                    yield "]\" value=\"";
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["subIterValue"], "html", null, true);
                                    yield "\">
                                                                            ";
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['subIndex'], $context['subIterValue'], $context['_parent']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 262
                                yield "                                                                        ";
                            } else {
                                // line 263
                                yield "                                                                            <input type=\"hidden\" name=\"filters[";
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["field"], "html", null, true);
                                yield "][";
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
                                yield "][";
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["index"], "html", null, true);
                                yield "]\" value=\"";
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["iterValue"], "html", null, true);
                                yield "\">
                                                                        ";
                            }
                            // line 265
                            yield "                                                                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['index'], $context['iterValue'], $context['_parent']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 266
                        yield "                                                                ";
                    } else {
                        // line 267
                        yield "                                                                    <input type=\"hidden\" name=\"filters[";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["field"], "html", null, true);
                        yield "][";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
                        yield "]\" value=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html", null, true);
                        yield "\">
                                                                ";
                    }
                    // line 269
                    yield "                                                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['key'], $context['value'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 270
                yield "                                                        ";
            } else {
                // line 271
                yield "                                                            <input type=\"hidden\" name=\"filters[";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["field"], "html", null, true);
                yield "]\" value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["fieldValue"], "html", null, true);
                yield "\">
                                                        ";
            }
            // line 273
            yield "                                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['field'], $context['fieldValue'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 274
        yield "                                                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 299
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_header_custom_menu_wrapper(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_custom_menu_wrapper"));

        // line 300
        yield "                            <div class=\"navbar-custom-menu\">
                                ";
        // line 301
        yield from $this->unwrap()->yieldBlock('header_custom_menu', $context, $blocks);
        // line 314
        yield "                            </div>
                            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 301
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_header_custom_menu(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_custom_menu"));

        // line 302
        yield "                                    ";
        $_v4 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v4->preRender("ea:ActionMenu", Twig\Extension\CoreExtension::toArray(["class" => ("user-menu-wrapper " . (((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted((isset($context["impersonator_permission"]) || array_key_exists("impersonator_permission", $context) ? $context["impersonator_permission"] : (function () { throw new RuntimeError('Variable "impersonator_permission" does not exist.', 302, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("user-is-impersonated") : ("")))]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v4->startEmbedComponent("ea:ActionMenu", Twig\Extension\CoreExtension::toArray(["class" => ("user-menu-wrapper " . (((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted((isset($context["impersonator_permission"]) || array_key_exists("impersonator_permission", $context) ? $context["impersonator_permission"] : (function () { throw new RuntimeError('Variable "impersonator_permission" does not exist.', 302, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("user-is-impersonated") : ("")))]), $context, "@EasyAdmin/layout.html.twig", 33123698431);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 33123698431);
            $this->load("@EasyAdmin/layout.html.twig", 302, "33123698431")->display($embeddedContext, $embeddedBlocks);
            $_v4->finishEmbedComponent();
        }
        // line 313
        yield "                                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 317
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_settings_dropdown_wrapper(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "settings_dropdown_wrapper"));

        // line 318
        yield "                                ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["settings_dropdown"]) || array_key_exists("settings_dropdown", $context) ? $context["settings_dropdown"] : (function () { throw new RuntimeError('Variable "settings_dropdown" does not exist.', 318, $this->source); })()), "html", null, true);
        yield "
                            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 324
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 325
        yield "                            <article class=\"content\">
                                ";
        // line 326
        yield from $this->unwrap()->yieldBlock('content_header_wrapper', $context, $blocks);
        // line 352
        yield "
                                <section id=\"main\" class=\"content-body\">
                                    ";
        // line 354
        yield from $this->unwrap()->yieldBlock('main', $context, $blocks);
        // line 355
        yield "                                </section>

                                ";
        // line 357
        yield from $this->unwrap()->yieldBlock('content_footer_wrapper', $context, $blocks);
        // line 364
        yield "                            </article>
                        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 326
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content_header_wrapper(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_header_wrapper"));

        // line 327
        yield "                                    ";
        $context["crud_help_message"] = (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["ea"] ?? null), "crud", [], "any", false, true, false, 327), "helpMessage", [], "any", true, true, false, 327) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 327, $this->source); })()), "crud", [], "any", false, false, false, 327), "helpMessage", [], "any", false, false, false, 327)))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 327, $this->source); })()), "crud", [], "any", false, false, false, 327), "helpMessage", [], "any", false, false, false, 327)) : (null));
        // line 328
        yield "                                    ";
        // line 329
        yield "                                    ";
        $context["has_help_message"] = (( !((isset($context["crud_help_message"]) || array_key_exists("crud_help_message", $context) ? $context["crud_help_message"] : (function () { throw new RuntimeError('Variable "crud_help_message" does not exist.', 329, $this->source); })()) === false) &&  !(null === (isset($context["crud_help_message"]) || array_key_exists("crud_help_message", $context) ? $context["crud_help_message"] : (function () { throw new RuntimeError('Variable "crud_help_message" does not exist.', 329, $this->source); })()))) &&  !((isset($context["crud_help_message"]) || array_key_exists("crud_help_message", $context) ? $context["crud_help_message"] : (function () { throw new RuntimeError('Variable "crud_help_message" does not exist.', 329, $this->source); })()) === ""));
        // line 330
        yield "                                    <section class=\"content-header\">
                                        ";
        // line 331
        yield from $this->unwrap()->yieldBlock('content_header', $context, $blocks);
        // line 350
        yield "                                    </section>
                                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 331
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content_header(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_header"));

        // line 332
        yield "                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    ";
        // line 334
        yield from $this->unwrap()->yieldBlock('content_title', $context, $blocks);
        // line 335
        yield "
                                                    ";
        // line 336
        yield from $this->unwrap()->yieldBlock('content_help', $context, $blocks);
        // line 343
        yield "                                                </h1>
                                            </div>

                                            ";
        // line 346
        yield from $this->unwrap()->yieldBlock('page_actions_wrapper', $context, $blocks);
        // line 349
        yield "                                        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 334
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_title"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 336
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content_help(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_help"));

        // line 337
        yield "                                                        ";
        if ((($tmp = (isset($context["has_help_message"]) || array_key_exists("has_help_message", $context) ? $context["has_help_message"] : (function () { throw new RuntimeError('Variable "has_help_message" does not exist.', 337, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 338
            yield "                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 338, $this->source); })()), "crud", [], "any", false, false, false, 338), "helpMessage", [], "any", false, false, false, 338), [],             // line 3
(isset($context["__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5"]) || array_key_exists("__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5", $context) ? $context["__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain50b8e341924d6f4bc8d86dfac44ce6d5" does not exist.', 3, $this->source); })())), "html");
            // line 338
            yield "\">
                                                                ";
            // line 339
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:circle-info"]);
            yield "
                                                            </a>
                                                        ";
        }
        // line 342
        yield "                                                    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 346
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_actions_wrapper(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_actions_wrapper"));

        // line 347
        yield "                                                <div class=\"page-actions\">";
        yield from $this->unwrap()->yieldBlock('page_actions', $context, $blocks);
        yield "</div>
                                            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_actions(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_actions"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 354
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_main(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "main"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 357
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content_footer_wrapper(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_footer_wrapper"));

        // line 358
        yield "                                    ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(        $this->unwrap()->renderBlock("content_footer", $context, $blocks))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 359
            yield "                                        <section class=\"content-footer\">
                                            ";
            // line 360
            yield from $this->unwrap()->yieldBlock('content_footer', $context, $blocks);
            // line 361
            yield "                                        </section>
                                    ";
        }
        // line 363
        yield "                                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 360
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content_footer(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_footer"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 375
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_javascript(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body_javascript"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 377
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_configured_body_contents(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "configured_body_contents"));

        // line 378
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["ea"] ?? null), "assets", [], "any", false, true, false, 378), "bodyContents", [], "any", true, true, false, 378) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 378, $this->source); })()), "assets", [], "any", false, false, false, 378), "bodyContents", [], "any", false, false, false, 378)))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 378, $this->source); })()), "assets", [], "any", false, false, false, 378), "bodyContents", [], "any", false, false, false, 378)) : ([])));
        foreach ($context['_seq'] as $context["_key"] => $context["htmlContent"]) {
            // line 379
            yield "            ";
            yield $context["htmlContent"];
            yield "
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['htmlContent'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 381
        yield "    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/layout.html.twig";
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
        return array (  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}


/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56___4991107621 extends Template
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
        // line 124
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 124, $this->source); })()), 124);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

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

    // line 125
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $_v5 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v5->preRender("ea:ActionMenu:ActionList:Content", Twig\Extension\CoreExtension::toArray(["class" => "dropdown-user-details"]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v5->startEmbedComponent("ea:ActionMenu:ActionList:Content", Twig\Extension\CoreExtension::toArray(["class" => "dropdown-user-details"]), $context, "@EasyAdmin/layout.html.twig", 17905018841);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 17905018841);
            $this->load("@EasyAdmin/layout.html.twig", 125, "17905018841")->display($embeddedContext, $embeddedBlocks);
            $_v5->finishEmbedComponent();
        }
        // line 132
        yield "
                ";
        // line 133
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["user_menu"]) || array_key_exists("user_menu", $context) ? $context["user_menu"] : (function () { throw new RuntimeError('Variable "user_menu" does not exist.', 133, $this->source); })()), "html", null, true);
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
        return "@EasyAdmin/layout.html.twig";
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
        return array (  2263 => 133,  2260 => 132,  2237 => 125,  2206 => 124,  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}


/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56___17905018841 extends Template
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
        // line 125
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 125, $this->source); })()), 125);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

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

    // line 126
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        yield "<div>";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["user_menu_avatar"]) || array_key_exists("user_menu_avatar", $context) ? $context["user_menu_avatar"] : (function () { throw new RuntimeError('Variable "user_menu_avatar" does not exist.', 126, $this->source); })()), "html", null, true);
        yield "</div>
                    <div>
                        <span class=\"user-label\">";
        // line 128
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("user.logged_in_as", [], "EasyAdminBundle"), "html", null, true);
        yield "</span>
                        <span class=\"user-name\">";
        // line 129
        yield (((null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 129, $this->source); })()), "user", [], "any", false, false, false, 129))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("user.anonymous", [], "EasyAdminBundle"), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 129, $this->source); })()), "userMenu", [], "any", false, false, false, 129), "name", [], "any", false, false, false, 129), "html", null, true)));
        yield "</span>
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
        return "@EasyAdmin/layout.html.twig";
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
        return array (  2761 => 129,  2757 => 128,  2742 => 126,  2711 => 125,  2263 => 133,  2260 => 132,  2237 => 125,  2206 => 124,  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}


/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56___20482372061 extends Template
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
        // line 139
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 139, $this->source); })()), 139);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

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

    // line 140
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $_v6 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v6->preRender("ea:ActionMenu:Button", Twig\Extension\CoreExtension::toArray(["class" => "dropdown-settings-button", "data-bs-offset" => "0,5", "withoutDropdownToggleMarker" => true]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v6->startEmbedComponent("ea:ActionMenu:Button", Twig\Extension\CoreExtension::toArray(["class" => "dropdown-settings-button", "data-bs-offset" => "0,5", "withoutDropdownToggleMarker" => true]), $context, "@EasyAdmin/layout.html.twig", 12840266131);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 12840266131);
            $this->load("@EasyAdmin/layout.html.twig", 140, "12840266131")->display($embeddedContext, $embeddedBlocks);
            $_v6->finishEmbedComponent();
        }
        // line 143
        yield "
                    ";
        // line 144
        $_v7 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v7->preRender("ea:ActionMenu:Overlay", Twig\Extension\CoreExtension::toArray([]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v7->startEmbedComponent("ea:ActionMenu:Overlay", Twig\Extension\CoreExtension::toArray([]), $context, "@EasyAdmin/layout.html.twig", 12733288761);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 12733288761);
            $this->load("@EasyAdmin/layout.html.twig", 144, "12733288761")->display($embeddedContext, $embeddedBlocks);
            $_v7->finishEmbedComponent();
        }
        // line 171
        yield "                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/layout.html.twig";
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
        return array (  3281 => 171,  3267 => 144,  3264 => 143,  3241 => 140,  3210 => 139,  2761 => 129,  2757 => 128,  2742 => 126,  2711 => 125,  2263 => 133,  2260 => 132,  2237 => 125,  2206 => 124,  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}


/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56___12840266131 extends Template
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
        // line 140
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 140, $this->source); })()), 140);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

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

    // line 141
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:gear"]);
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
        return "@EasyAdmin/layout.html.twig";
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
        return array (  3758 => 141,  3727 => 140,  3281 => 171,  3267 => 144,  3264 => 143,  3241 => 140,  3210 => 139,  2761 => 129,  2757 => 128,  2742 => 126,  2711 => 125,  2263 => 133,  2260 => 132,  2237 => 125,  2206 => 124,  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}


/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56___12733288761 extends Template
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
        // line 144
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 144, $this->source); })()), 144);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

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

    // line 145
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $_v8 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v8->preRender("ea:ActionMenu:ActionList", Twig\Extension\CoreExtension::toArray([]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v8->startEmbedComponent("ea:ActionMenu:ActionList", Twig\Extension\CoreExtension::toArray([]), $context, "@EasyAdmin/layout.html.twig", 10214616261);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 10214616261);
            $this->load("@EasyAdmin/layout.html.twig", 145, "10214616261")->display($embeddedContext, $embeddedBlocks);
            $_v8->finishEmbedComponent();
        }
        // line 170
        yield "                    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/layout.html.twig";
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
        return array (  4269 => 170,  4246 => 145,  4215 => 144,  3758 => 141,  3727 => 140,  3281 => 171,  3267 => 144,  3264 => 143,  3241 => 140,  3210 => 139,  2761 => 129,  2757 => 128,  2742 => 126,  2711 => 125,  2263 => 133,  2260 => 132,  2237 => 125,  2206 => 124,  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}


/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56___10214616261 extends Template
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
        // line 145
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 145, $this->source); })()), 145);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

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

    // line 146
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 146, $this->source); })()), "dashboardLocales", [], "any", false, false, false, 146)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 147
            yield "                                ";
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Header", ["class" => "dropdown-locales-label", "label" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("settings.locale", [], "EasyAdminBundle")]);
            yield "
                            ";
        }
        // line 149
        yield "
                            ";
        // line 150
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 150, $this->source); })()), "dashboardLocales", [], "any", false, false, false, 150));
        foreach ($context['_seq'] as $context["_key"] => $context["localeDto"]) {
            // line 151
            yield "                                ";
            $context["url"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->getAdminUrlGenerator(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 151, $this->source); })()), "current_route_parameters", [], "any", false, false, false, 151)), "set", ["_locale", CoreExtension::getAttribute($this->env, $this->source,             // line 152
$context["localeDto"], "locale", [], "any", false, false, false, 152)], "method", false, false, false, 151), "set", ["entityId", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 153
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 153, $this->source); })()), "request", [], "any", false, false, false, 153), "attributes", [], "any", false, false, false, 153), "get", ["entityId"], "method", false, false, false, 153)], "method", false, false, false, 152);
            // line 154
            yield "
                                ";
            // line 155
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Item", ["class" => (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 155, $this->source); })()), "request", [], "any", false, false, false, 155), "locale", [], "any", false, false, false, 155) == CoreExtension::getAttribute($this->env, $this->source, $context["localeDto"], "locale", [], "any", false, false, false, 155))) ? ("active") : ("")), "url" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["url"]) || array_key_exists("url", $context) ? $context["url"] : (function () { throw new RuntimeError('Variable "url" does not exist.', 155, $this->source); })()), "generateUrl", [], "method", false, false, false, 155), "icon" => CoreExtension::getAttribute($this->env, $this->source, $context["localeDto"], "icon", [], "any", false, false, false, 155), "label" => CoreExtension::getAttribute($this->env, $this->source, $context["localeDto"], "name", [], "any", false, false, false, 155)]);
            yield "
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['localeDto'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 157
        yield "
                            ";
        // line 158
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 158, $this->source); })()), "dashboardHasDarkModeEnabled", [], "any", false, false, false, 158)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 159
            yield "                                ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 159, $this->source); })()), "dashboardLocales", [], "any", false, false, false, 159)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 160
                yield "                                    ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Divider");
                yield "
                                ";
            }
            // line 162
            yield "
                                ";
            // line 163
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Header", ["class" => "dropdown-appearance-label", "label" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("settings.appearance.label", [], "EasyAdminBundle")]);
            yield "

                                ";
            // line 165
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Item", ["class" => "dropdown-appearance-item", "url" => "#", "icon" => "internal:sun", "data-ea-color-scheme" => "light", "label" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("settings.appearance.light", [], "EasyAdminBundle")]);
            yield "
                                ";
            // line 166
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Item", ["class" => "dropdown-appearance-item", "url" => "#", "icon" => "internal:moon", "data-ea-color-scheme" => "dark", "label" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("settings.appearance.dark", [], "EasyAdminBundle")]);
            yield "
                                ";
            // line 167
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Item", ["class" => "dropdown-appearance-item active", "url" => "#", "icon" => "internal:desktop", "data-ea-color-scheme" => "auto", "label" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("settings.appearance.auto", [], "EasyAdminBundle")]);
            yield "
                            ";
        }
        // line 169
        yield "                        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/layout.html.twig";
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
        return array (  4821 => 169,  4816 => 167,  4812 => 166,  4808 => 165,  4803 => 163,  4800 => 162,  4794 => 160,  4791 => 159,  4789 => 158,  4786 => 157,  4778 => 155,  4775 => 154,  4773 => 153,  4772 => 152,  4770 => 151,  4766 => 150,  4763 => 149,  4757 => 147,  4746 => 146,  4715 => 145,  4269 => 170,  4246 => 145,  4215 => 144,  3758 => 141,  3727 => 140,  3281 => 171,  3267 => 144,  3264 => 143,  3241 => 140,  3210 => 139,  2761 => 129,  2757 => 128,  2742 => 126,  2711 => 125,  2263 => 133,  2260 => 132,  2237 => 125,  2206 => 124,  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}


/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56___5112697781 extends Template
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
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 179
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 179, $this->source); })()), 179);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

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
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/layout.html.twig";
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
        return array (  5266 => 179,  4821 => 169,  4816 => 167,  4812 => 166,  4808 => 165,  4803 => 163,  4800 => 162,  4794 => 160,  4791 => 159,  4789 => 158,  4786 => 157,  4778 => 155,  4775 => 154,  4773 => 153,  4772 => 152,  4770 => 151,  4766 => 150,  4763 => 149,  4757 => 147,  4746 => 146,  4715 => 145,  4269 => 170,  4246 => 145,  4215 => 144,  3758 => 141,  3727 => 140,  3281 => 171,  3267 => 144,  3264 => 143,  3241 => 140,  3210 => 139,  2761 => 129,  2757 => 128,  2742 => 126,  2711 => 125,  2263 => 133,  2260 => 132,  2237 => 125,  2206 => 124,  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}


/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56___25816779171 extends Template
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
        // line 189
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 189, $this->source); })()), 189);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

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

    // line 190
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $_v9 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v9->preRender("ea:ActionMenu:Button", Twig\Extension\CoreExtension::toArray(["class" => "user-details", "data-bs-offset" => "0,5", "withoutDropdownToggleMarker" => true]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v9->startEmbedComponent("ea:ActionMenu:Button", Twig\Extension\CoreExtension::toArray(["class" => "user-details", "data-bs-offset" => "0,5", "withoutDropdownToggleMarker" => true]), $context, "@EasyAdmin/layout.html.twig", 41800700721);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 41800700721);
            $this->load("@EasyAdmin/layout.html.twig", 190, "41800700721")->display($embeddedContext, $embeddedBlocks);
            $_v9->finishEmbedComponent();
        }
        // line 199
        yield "                            ";
        $_v10 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v10->preRender("ea:ActionMenu:Overlay", Twig\Extension\CoreExtension::toArray([]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v10->startEmbedComponent("ea:ActionMenu:Overlay", Twig\Extension\CoreExtension::toArray([]), $context, "@EasyAdmin/layout.html.twig", 21638978841);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 21638978841);
            $this->load("@EasyAdmin/layout.html.twig", 199, "21638978841")->display($embeddedContext, $embeddedBlocks);
            $_v10->finishEmbedComponent();
        }
        // line 202
        yield "                        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/layout.html.twig";
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
        return array (  5804 => 202,  5789 => 199,  5766 => 190,  5735 => 189,  5266 => 179,  4821 => 169,  4816 => 167,  4812 => 166,  4808 => 165,  4803 => 163,  4800 => 162,  4794 => 160,  4791 => 159,  4789 => 158,  4786 => 157,  4778 => 155,  4775 => 154,  4773 => 153,  4772 => 152,  4770 => 151,  4766 => 150,  4763 => 149,  4757 => 147,  4746 => 146,  4715 => 145,  4269 => 170,  4246 => 145,  4215 => 144,  3758 => 141,  3727 => 140,  3281 => 171,  3267 => 144,  3264 => 143,  3241 => 140,  3210 => 139,  2761 => 129,  2757 => 128,  2742 => 126,  2711 => 125,  2263 => 133,  2260 => 132,  2237 => 125,  2206 => 124,  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}


/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56___41800700721 extends Template
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
        // line 190
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 190, $this->source); })()), 190);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

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

    // line 193
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 193, $this->source); })()), "userMenu", [], "any", false, false, false, 193), "avatarDisplayed", [], "any", false, false, false, 193)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 194
            yield "                                    ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["user_menu_avatar"]) || array_key_exists("user_menu_avatar", $context) ? $context["user_menu_avatar"] : (function () { throw new RuntimeError('Variable "user_menu_avatar" does not exist.', 194, $this->source); })()), "html", null, true);
            yield "
                                ";
        } else {
            // line 196
            yield "                                    ";
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["class" => "user-avatar", "name" => (((($tmp =  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 196, $this->source); })()), "user", [], "any", false, false, false, 196))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("internal:user") : ("internal:user-xmark"))]);
            yield "
                                ";
        }
        // line 198
        yield "                            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/layout.html.twig";
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
        return array (  6304 => 198,  6298 => 196,  6292 => 194,  6281 => 193,  6250 => 190,  5804 => 202,  5789 => 199,  5766 => 190,  5735 => 189,  5266 => 179,  4821 => 169,  4816 => 167,  4812 => 166,  4808 => 165,  4803 => 163,  4800 => 162,  4794 => 160,  4791 => 159,  4789 => 158,  4786 => 157,  4778 => 155,  4775 => 154,  4773 => 153,  4772 => 152,  4770 => 151,  4766 => 150,  4763 => 149,  4757 => 147,  4746 => 146,  4715 => 145,  4269 => 170,  4246 => 145,  4215 => 144,  3758 => 141,  3727 => 140,  3281 => 171,  3267 => 144,  3264 => 143,  3241 => 140,  3210 => 139,  2761 => 129,  2757 => 128,  2742 => 126,  2711 => 125,  2263 => 133,  2260 => 132,  2237 => 125,  2206 => 124,  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}


/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56___21638978841 extends Template
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
        // line 199
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 199, $this->source); })()), 199);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

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

    // line 200
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["user_menu_dropdown"]) || array_key_exists("user_menu_dropdown", $context) ? $context["user_menu_dropdown"] : (function () { throw new RuntimeError('Variable "user_menu_dropdown" does not exist.', 200, $this->source); })()), "html", null, true);
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
        return "@EasyAdmin/layout.html.twig";
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
        return array (  6781 => 200,  6750 => 199,  6304 => 198,  6298 => 196,  6292 => 194,  6281 => 193,  6250 => 190,  5804 => 202,  5789 => 199,  5766 => 190,  5735 => 189,  5266 => 179,  4821 => 169,  4816 => 167,  4812 => 166,  4808 => 165,  4803 => 163,  4800 => 162,  4794 => 160,  4791 => 159,  4789 => 158,  4786 => 157,  4778 => 155,  4775 => 154,  4773 => 153,  4772 => 152,  4770 => 151,  4766 => 150,  4763 => 149,  4757 => 147,  4746 => 146,  4715 => 145,  4269 => 170,  4246 => 145,  4215 => 144,  3758 => 141,  3727 => 140,  3281 => 171,  3267 => 144,  3264 => 143,  3241 => 140,  3210 => 139,  2761 => 129,  2757 => 128,  2742 => 126,  2711 => 125,  2263 => 133,  2260 => 132,  2237 => 125,  2206 => 124,  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}


/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56___33123698431 extends Template
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
        // line 302
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 302, $this->source); })()), 302);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

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

    // line 303
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $_v11 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v11->preRender("ea:ActionMenu:Button", Twig\Extension\CoreExtension::toArray(["class" => "user-details", "withoutDropdownToggleMarker" => true]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v11->startEmbedComponent("ea:ActionMenu:Button", Twig\Extension\CoreExtension::toArray(["class" => "user-details", "withoutDropdownToggleMarker" => true]), $context, "@EasyAdmin/layout.html.twig", 29932872051);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 29932872051);
            $this->load("@EasyAdmin/layout.html.twig", 303, "29932872051")->display($embeddedContext, $embeddedBlocks);
            $_v11->finishEmbedComponent();
        }
        // line 309
        yield "                                        ";
        $_v12 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v12->preRender("ea:ActionMenu:Overlay", Twig\Extension\CoreExtension::toArray([]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v12->startEmbedComponent("ea:ActionMenu:Overlay", Twig\Extension\CoreExtension::toArray([]), $context, "@EasyAdmin/layout.html.twig", 13880589391);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 13880589391);
            $this->load("@EasyAdmin/layout.html.twig", 309, "13880589391")->display($embeddedContext, $embeddedBlocks);
            $_v12->finishEmbedComponent();
        }
        // line 312
        yield "                                    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/layout.html.twig";
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
        return array (  7307 => 312,  7292 => 309,  7269 => 303,  7238 => 302,  6781 => 200,  6750 => 199,  6304 => 198,  6298 => 196,  6292 => 194,  6281 => 193,  6250 => 190,  5804 => 202,  5789 => 199,  5766 => 190,  5735 => 189,  5266 => 179,  4821 => 169,  4816 => 167,  4812 => 166,  4808 => 165,  4803 => 163,  4800 => 162,  4794 => 160,  4791 => 159,  4789 => 158,  4786 => 157,  4778 => 155,  4775 => 154,  4773 => 153,  4772 => 152,  4770 => 151,  4766 => 150,  4763 => 149,  4757 => 147,  4746 => 146,  4715 => 145,  4269 => 170,  4246 => 145,  4215 => 144,  3758 => 141,  3727 => 140,  3281 => 171,  3267 => 144,  3264 => 143,  3241 => 140,  3210 => 139,  2761 => 129,  2757 => 128,  2742 => 126,  2711 => 125,  2263 => 133,  2260 => 132,  2237 => 125,  2206 => 124,  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}


/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56___29932872051 extends Template
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
        // line 303
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 303, $this->source); })()), 303);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

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

    // line 304
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["user_menu_avatar"]) || array_key_exists("user_menu_avatar", $context) ? $context["user_menu_avatar"] : (function () { throw new RuntimeError('Variable "user_menu_avatar" does not exist.', 304, $this->source); })()), "html", null, true);
        yield "
                                            ";
        // line 305
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 305, $this->source); })()), "userMenu", [], "any", false, false, false, 305), "isNameDisplayed", [], "any", false, false, false, 305)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 306
            yield "                                                <span class=\"user-name\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 306, $this->source); })()), "userMenu", [], "any", false, false, false, 306), "name", [], "any", false, false, false, 306), "html", null, true);
            yield "</span>
                                            ";
        }
        // line 308
        yield "                                        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/layout.html.twig";
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
        return array (  7805 => 308,  7799 => 306,  7797 => 305,  7784 => 304,  7753 => 303,  7307 => 312,  7292 => 309,  7269 => 303,  7238 => 302,  6781 => 200,  6750 => 199,  6304 => 198,  6298 => 196,  6292 => 194,  6281 => 193,  6250 => 190,  5804 => 202,  5789 => 199,  5766 => 190,  5735 => 189,  5266 => 179,  4821 => 169,  4816 => 167,  4812 => 166,  4808 => 165,  4803 => 163,  4800 => 162,  4794 => 160,  4791 => 159,  4789 => 158,  4786 => 157,  4778 => 155,  4775 => 154,  4773 => 153,  4772 => 152,  4770 => 151,  4766 => 150,  4763 => 149,  4757 => 147,  4746 => 146,  4715 => 145,  4269 => 170,  4246 => 145,  4215 => 144,  3758 => 141,  3727 => 140,  3281 => 171,  3267 => 144,  3264 => 143,  3241 => 140,  3210 => 139,  2761 => 129,  2757 => 128,  2742 => 126,  2711 => 125,  2263 => 133,  2260 => 132,  2237 => 125,  2206 => 124,  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}


/* @EasyAdmin/layout.html.twig */
class __TwigTemplate_180dadf4e88b5cabd5ebd0ad2868dd56___13880589391 extends Template
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
        // line 309
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 309, $this->source); })()), 309);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/layout.html.twig"));

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

    // line 310
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["user_menu_dropdown"]) || array_key_exists("user_menu_dropdown", $context) ? $context["user_menu_dropdown"] : (function () { throw new RuntimeError('Variable "user_menu_dropdown" does not exist.', 310, $this->source); })()), "html", null, true);
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
        return "@EasyAdmin/layout.html.twig";
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
        return array (  8282 => 310,  8251 => 309,  7805 => 308,  7799 => 306,  7797 => 305,  7784 => 304,  7753 => 303,  7307 => 312,  7292 => 309,  7269 => 303,  7238 => 302,  6781 => 200,  6750 => 199,  6304 => 198,  6298 => 196,  6292 => 194,  6281 => 193,  6250 => 190,  5804 => 202,  5789 => 199,  5766 => 190,  5735 => 189,  5266 => 179,  4821 => 169,  4816 => 167,  4812 => 166,  4808 => 165,  4803 => 163,  4800 => 162,  4794 => 160,  4791 => 159,  4789 => 158,  4786 => 157,  4778 => 155,  4775 => 154,  4773 => 153,  4772 => 152,  4770 => 151,  4766 => 150,  4763 => 149,  4757 => 147,  4746 => 146,  4715 => 145,  4269 => 170,  4246 => 145,  4215 => 144,  3758 => 141,  3727 => 140,  3281 => 171,  3267 => 144,  3264 => 143,  3241 => 140,  3210 => 139,  2761 => 129,  2757 => 128,  2742 => 126,  2711 => 125,  2263 => 133,  2260 => 132,  2237 => 125,  2206 => 124,  1760 => 381,  1751 => 379,  1746 => 378,  1736 => 377,  1720 => 375,  1704 => 360,  1696 => 363,  1692 => 361,  1690 => 360,  1687 => 359,  1684 => 358,  1674 => 357,  1658 => 354,  1632 => 347,  1622 => 346,  1614 => 342,  1608 => 339,  1605 => 338,  1603 => 3,  1601 => 338,  1598 => 337,  1588 => 336,  1572 => 334,  1564 => 349,  1562 => 346,  1557 => 343,  1555 => 336,  1552 => 335,  1550 => 334,  1546 => 332,  1536 => 331,  1527 => 350,  1525 => 331,  1522 => 330,  1519 => 329,  1517 => 328,  1514 => 327,  1504 => 326,  1495 => 364,  1493 => 357,  1489 => 355,  1487 => 354,  1483 => 352,  1481 => 326,  1478 => 325,  1468 => 324,  1457 => 318,  1447 => 317,  1439 => 313,  1424 => 302,  1414 => 301,  1405 => 314,  1403 => 301,  1400 => 300,  1390 => 299,  1382 => 274,  1376 => 273,  1368 => 271,  1365 => 270,  1359 => 269,  1349 => 267,  1346 => 266,  1340 => 265,  1328 => 263,  1325 => 262,  1308 => 260,  1303 => 259,  1300 => 258,  1298 => 257,  1293 => 256,  1290 => 255,  1288 => 254,  1283 => 253,  1280 => 252,  1275 => 251,  1265 => 250,  1255 => 290,  1249 => 287,  1244 => 286,  1241 => 285,  1239 => 284,  1230 => 281,  1228 => 3,  1223 => 281,  1219 => 280,  1214 => 278,  1209 => 275,  1206 => 250,  1196 => 249,  1187 => 293,  1185 => 249,  1176 => 248,  1173 => 247,  1170 => 246,  1167 => 245,  1157 => 244,  1148 => 296,  1145 => 295,  1142 => 244,  1140 => 243,  1137 => 242,  1127 => 241,  1119 => 320,  1117 => 317,  1114 => 316,  1112 => 299,  1109 => 298,  1106 => 241,  1096 => 240,  1084 => 366,  1082 => 324,  1077 => 321,  1075 => 240,  1070 => 239,  1068 => 238,  1065 => 237,  1055 => 236,  1044 => 229,  1034 => 228,  1023 => 219,  1019 => 218,  1012 => 217,  1002 => 216,  993 => 222,  991 => 216,  988 => 215,  978 => 214,  969 => 224,  967 => 214,  964 => 213,  954 => 212,  946 => 231,  944 => 228,  940 => 226,  938 => 212,  935 => 211,  925 => 210,  914 => 184,  907 => 183,  897 => 182,  887 => 204,  884 => 203,  870 => 189,  866 => 187,  864 => 182,  860 => 180,  845 => 179,  835 => 178,  827 => 371,  825 => 236,  819 => 232,  817 => 210,  811 => 206,  809 => 178,  806 => 177,  796 => 176,  788 => 118,  785 => 117,  771 => 116,  766 => 114,  765 => 3,  763 => 114,  758 => 112,  757 => 3,  756 => 112,  753 => 111,  747 => 109,  744 => 108,  741 => 107,  724 => 106,  718 => 104,  715 => 103,  705 => 102,  694 => 88,  684 => 87,  675 => 372,  673 => 176,  669 => 174,  665 => 173,  662 => 172,  647 => 139,  644 => 138,  642 => 137,  639 => 136,  635 => 135,  620 => 124,  618 => 123,  615 => 122,  613 => 121,  610 => 120,  606 => 119,  603 => 102,  601 => 101,  598 => 100,  594 => 99,  588 => 97,  582 => 94,  579 => 93,  576 => 92,  574 => 91,  571 => 90,  568 => 87,  558 => 86,  550 => 84,  545 => 82,  543 => 79,  533 => 78,  525 => 77,  520 => 75,  518 => 72,  508 => 71,  492 => 63,  476 => 62,  460 => 61,  451 => 382,  449 => 377,  446 => 376,  444 => 375,  441 => 374,  439 => 86,  436 => 85,  433 => 78,  431 => 71,  426 => 69,  422 => 68,  418 => 67,  414 => 66,  410 => 65,  406 => 64,  402 => 63,  397 => 62,  394 => 61,  384 => 60,  376 => 57,  367 => 55,  362 => 54,  352 => 53,  342 => 50,  337 => 49,  327 => 48,  316 => 44,  306 => 43,  298 => 46,  296 => 43,  293 => 42,  288 => 40,  286 => 37,  276 => 36,  265 => 33,  255 => 32,  245 => 29,  240 => 28,  230 => 27,  222 => 25,  217 => 23,  215 => 20,  205 => 19,  188 => 16,  175 => 9,  165 => 8,  156 => 384,  154 => 60,  150 => 58,  148 => 53,  145 => 52,  143 => 48,  140 => 47,  138 => 36,  135 => 35,  133 => 32,  130 => 31,  128 => 27,  125 => 26,  123 => 19,  117 => 17,  112 => 16,  109 => 15,  107 => 8,  100 => 6,  96 => 4,  94 => 3,  92 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{% set ea = ea() %}
{% trans_default_domain ea.i18n.translationDomain %}

<!DOCTYPE html>
<html lang=\"{{ ea.i18n.htmlLocale }}\" dir=\"{{ ea.i18n.textDirection }}\" data-turbo=\"false\">
<head>
    {% block head_metas %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache\" />
        <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
        <meta name=\"generator\" content=\"EasyAdmin\" />
    {% endblock head_metas %}

    {% set page_title_block_output %}{% block page_title %}{{ block('content_title') }}{% endblock %}{% endset %}
    <title>{{ page_title_block_output|striptags|raw }}</title>

    {% block head_stylesheets %}
        {% guard function csp_nonce %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('style') }}\">
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ asset('app.css', ea.assets.defaultAssetPackageName) }}\">
        {% endguard %}
    {% endblock %}

    {% block configured_stylesheets %}
        {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea.assets.cssAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block head_favicon %}
        <link rel=\"shortcut icon\" href=\"{{ asset(ea.dashboardFaviconPath) }}\">
    {% endblock %}

    {% block head_javascript %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('app.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}

        {% block importmap %}
            {{ include('@EasyAdmin/includes/_importmap.html.twig', {assets: ea.assets.assetMapperAssets ?? []}, with_context: false) }}
        {% endblock %}
    {% endblock head_javascript %}

    {% block configured_javascripts %}
        {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea.assets.jsAssets ?? []}, with_context: false) }}
        {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea.assets.webpackEncoreAssets ?? []}, with_context: false) }}
    {% endblock %}

    {% block configured_head_contents %}
        {% for htmlContent in ea.assets.headContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
</head>

{% block body %}
    <body {% block body_attr %}{% endblock %}
        id=\"{% block body_id %}{% endblock %}\"
        class=\"ea {% block body_class %}{% endblock %}\"
        data-ea-content-width=\"{{ ea.crud.contentWidth ?? ea.dashboardContentWidth ?? 'normal' }}\"
        data-ea-sidebar-width=\"{{ ea.crud.sidebarWidth ?? ea.dashboardSidebarWidth ?? 'normal' }}\"
        data-ea-dark-scheme-is-enabled=\"{{ ea.dashboardHasDarkModeEnabled ? 'true' : 'false' }}\"
        data-ea-default-color-scheme=\"{{ ea.dashboardDefaultColorScheme }}\"
        data-ea-icon-set=\"{{ ea.assets.iconSet }}\"
        data-ea-icon-prefix=\"{{ ea.assets.defaultIconPrefix }}\"
    >
    {% block javascript_page_layout %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-layout.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_layout %}
    {% block javascript_page_color_scheme %}
        {% guard function csp_nonce %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\" nonce=\"{{ csp_nonce('script') }}\"></script>
        {% else %}
            <script src=\"{{ asset('page-color-scheme.js', ea.assets.defaultAssetPackageName) }}\"></script>
        {% endguard %}
    {% endblock javascript_page_color_scheme %}

    {% block wrapper_wrapper %}
        {% block flash_messages %}
            {{ include(ea.templatePath('flash_messages')) }}
        {% endblock flash_messages %}

        {% set user_menu_avatar %}
            {% if null == ea.userMenu.avatarUrl %}
                <span class=\"user-avatar\">
                    {{ component('ea:Icon', { name: 'internal:user' }) }}
                </span>
            {% else %}
                <img class=\"user-avatar\" src=\"{{ ea.userMenu.avatarUrl }}\" />
            {% endif %}
        {% endset %}

        {% set user_menu %}
            {% block user_menu %}
                {% if ea.userMenu.items|length > 0 %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}

                    {% for item in ea.userMenu.items %}
                        {% if item.isMenuSection %}
                            {% if not loop.first %}
                                {{ component('ea:ActionMenu:ActionList:Divider') }}
                            {% endif %}

                            {{ component('ea:ActionMenu:ActionList:Header', { label: (item.label|trans), class: (item.cssClass), icon: (item.icon), htmlAttributes: (item.htmlAttributes) }) }}
                        {% else %}
                            {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), class: 'user-action '~(item.cssClass), icon: (item.icon), url: (item.linkUrl), target: (item.linkTarget), rel: (item.linkRel), referrerpolicy: 'origin-when-cross-origin', htmlAttributes: (item.htmlAttributes) }) }}
                        {% endif %}
                    {% endfor %}
                {% endif %}
            {% endblock %}
        {% endset %}

        {% set impersonator_permission = constant('Symfony\\\\Component\\\\Security\\\\Core\\\\Authorization\\\\Voter\\\\AuthenticatedVoter::IS_IMPERSONATOR') is defined ? 'IS_IMPERSONATOR' : 'ROLE_PREVIOUS_ADMIN' %}

        {% set user_menu_dropdown %}
            {% component 'ea:ActionMenu:ActionList' %}
                {% block content %}{% component 'ea:ActionMenu:ActionList:Content' with { class: 'dropdown-user-details' } %}
                    {% block content %}<div>{{ user_menu_avatar }}</div>
                    <div>
                        <span class=\"user-label\">{{ 'user.logged_in_as'|trans(domain: 'EasyAdminBundle') }}</span>
                        <span class=\"user-name\">{{ ea.user is null ? 'user.anonymous'|trans(domain: 'EasyAdminBundle') : ea.userMenu.name }}</span>
                    </div>
                {% endblock %}{% endcomponent %}

                {{ user_menu }}
            {% endblock %}{% endcomponent %}
        {% endset %}

        {% set settings_dropdown %}
            {% if ea.dashboardLocales or ea.dashboardHasDarkModeEnabled %}
                {% component 'ea:ActionMenu' with { class: 'dropdown-settings' } %}
                    {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'dropdown-settings-button', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                        {% block content %}{{ component('ea:Icon', { name: 'internal:gear' }) }}
                    {% endblock %}{% endcomponent %}

                    {% component 'ea:ActionMenu:Overlay' %}
                        {% block content %}{% component 'ea:ActionMenu:ActionList' %}
                            {% block content %}{% if ea.dashboardLocales %}
                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-locales-label', label: ('settings.locale'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}

                            {% for localeDto in ea.dashboardLocales %}
                                {% set url = ea_url(app.current_route_parameters)
                                    .set('_locale', localeDto.locale)
                                    .set('entityId', app.request.attributes.get('entityId')) %}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: (app.request.locale == localeDto.locale ? 'active'), url: (url.generateUrl()), icon: (localeDto.icon), label: (localeDto.name) }) }}
                            {% endfor %}

                            {% if ea.dashboardHasDarkModeEnabled %}
                                {% if ea.dashboardLocales %}
                                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                                {% endif %}

                                {{ component('ea:ActionMenu:ActionList:Header', { class: 'dropdown-appearance-label', label: ('settings.appearance.label'|trans(domain: 'EasyAdminBundle')) }) }}

                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:sun', 'data-ea-color-scheme': 'light', label: ('settings.appearance.light'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item', url: '#', icon: 'internal:moon', 'data-ea-color-scheme': 'dark', label: ('settings.appearance.dark'|trans(domain: 'EasyAdminBundle')) }) }}
                                {{ component('ea:ActionMenu:ActionList:Item', { class: 'dropdown-appearance-item active', url: '#', icon: 'internal:desktop', 'data-ea-color-scheme': 'auto', label: ('settings.appearance.auto'|trans(domain: 'EasyAdminBundle')) }) }}
                            {% endif %}
                        {% endblock %}{% endcomponent %}
                    {% endblock %}{% endcomponent %}
                {% endblock %}{% endcomponent %}
            {% endif %}
        {% endset %}

        <div class=\"wrapper\">
            {% block wrapper %}
                <div class=\"responsive-header\">
                    {% block responsive_header %}
                        {% component 'ea:Button' with { type: 'button', isInvisible: true, icon: 'internal:menu-bars', id: 'navigation-toggler', 'aria-label': 'Toggle navigation' } %}{% endcomponent %}

                        <div id=\"responsive-header-logo\" class=\"text-truncate ms-auto\">
                            {% block responsive_header_logo %}
                                <a class=\"responsive-logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                    {{ ea.dashboardTitle|raw }}
                                </a>
                            {% endblock responsive_header_logo %}
                        </div>

                        {% component 'ea:ActionMenu' with { class: 'ms-auto user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                            {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', 'data-bs-offset': '0,5', withoutDropdownToggleMarker: true } %}
                                {# to make the site design consistent, always display the user avatar in responsive header
                                   and hide the user name (because there's no space left) regardless of the user config #}
                                {% block content %}{% if ea.userMenu.avatarDisplayed %}
                                    {{ user_menu_avatar }}
                                {% else %}
                                    {{ component('ea:Icon', { class: 'user-avatar', name: (ea.user is not null ? 'internal:user' : 'internal:user-xmark') }) }}
                                {% endif %}
                            {% endblock %}{% endcomponent %}
                            {% component 'ea:ActionMenu:Overlay' %}
                                {% block content %}{{ user_menu_dropdown }}
                            {% endblock %}{% endcomponent %}
                        {% endblock %}{% endcomponent %}

                        {{ settings_dropdown }}
                    {% endblock responsive_header %}
                </div>

                <div class=\"sidebar-wrapper\">
                    <aside class=\"sidebar\">
                        {% block sidebar %}
                            <header class=\"main-header\">
                                {% block header %}
                                <nav class=\"navbar\" role=\"navigation\">
                                    {% block header_navbar %}
                                        <div id=\"header-logo\">
                                            {% block header_logo %}
                                                <a class=\"logo\" title=\"{{ ea.dashboardTitle|striptags }}\" href=\"{{ path(ea.dashboardRouteName) }}\">
                                                    <span class=\"logo-custom\">{{ ea.dashboardTitle|raw }}</span>
                                                    <span class=\"logo-compact\">{{ component('ea:Icon', { name: 'internal:home' }) }}</span>
                                                </a>
                                            {% endblock header_logo %}
                                        </div>
                                    {% endblock header_navbar %}
                                </nav>
                                {% endblock header %}
                            </header>

                            {% block main_menu_wrapper %}
                                {{ include(ea.templatePath('main_menu')) }}
                            {% endblock main_menu_wrapper %}
                        {% endblock sidebar %}

                        <div id=\"sidebar-resizer-handler\" class=\"resizer-handler resizer-handler-left\"></div>
                    </aside>
                </div>
                {% block main_content_wrapper %}
                <section class=\"main-content\">
                    {% set has_search = ea.crud is not null and ea.crud.isSearchEnabled %}
                    <aside class=\"content-top {{ has_search ? 'ea-search-enabled' : 'ea-search-disabled' }}\">
                        {% block content_top_header %}
                            {% block search_wrapper %}
                            <div class=\"content-search\">
                                {% if has_search %}
                                    {% block search %}
                                        {% set formActionUrl = null %}
                                        {% set crudController = ea.request.attributes.get('crudControllerFqcn') %}
                                        {% set formActionUrl = ea_url().setController(crudController).setAction('index').set('page', 1) %}
                                        <form class=\"form-action-search\" method=\"get\" {% if formActionUrl %}action=\"{{ formActionUrl }}\"{% endif %}>
                                            {% block search_form %}
                                                {% block search_form_filters %}
                                                    {% for field, fieldValue in ea.search.appliedFilters %}
                                                        {% if fieldValue is iterable %}
                                                            {% for key, value in fieldValue %}
                                                                {# This code re-applies your filters on searches, an iterable check is needed in cases we have more than one object for a filter #}
                                                                {% if value is iterable %}
                                                                    {% for index, iterValue in value %}
                                                                        {# This sub-level iterable check is needed in cases we have more complex filters like the DateTimeFilter cf. issue #5038 #}
                                                                        {% if iterValue is iterable %}
                                                                            {% for subIndex, subIterValue in iterValue %}
                                                                                <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}][{{ subIndex }}]\" value=\"{{ subIterValue }}\">
                                                                            {% endfor %}
                                                                        {% else %}
                                                                            <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}][{{ index }}]\" value=\"{{ iterValue }}\">
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% else %}
                                                                    <input type=\"hidden\" name=\"filters[{{ field }}][{{ key }}]\" value=\"{{ value }}\">
                                                                {% endif %}
                                                            {% endfor %}
                                                        {% else %}
                                                            <input type=\"hidden\" name=\"filters[{{ field }}]\" value=\"{{ fieldValue }}\">
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}

                                                <div class=\"form-group\">
                                                    <div class=\"form-widget\">
                                                        {{ component('ea:Icon', { name: 'internal:search', class: 'content-search-icon' }) }}

                                                        <label class=\"content-search-label\" data-value=\"{{ app.request.query.get('query') }}\">
                                                            <input class=\"form-control {{ app.request.query.get('query') is null ? 'is-blank' }}\" type=\"search\" name=\"query\" value=\"{{ app.request.query.get('query') ?? '' }}\" placeholder=\"{{ t('action.search', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}\" spellcheck=\"false\" autocorrect=\"off\" onInput=\"this.parentNode.dataset.value=this.value\"{% if ea.crud.currentAction == 'index' and ea.crud.autofocusSearch == true %} autofocus=\"autofocus\"{% endif %}>
                                                        </label>

                                                        {% if app.request.query.get('query') %}
                                                            {% set search_reset_url = ea_url().unset('query').unset('page').setController(crudController).setAction('index') %}
                                                            <a href=\"{{ search_reset_url }}\" class=\"content-search-reset\">
                                                                {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                                                            </a>
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            {% endblock %}
                                        </form>
                                    {% endblock search %}
                                {% endif %}
                            </div>
                            {% endblock search_wrapper %}

                            {% block header_custom_menu_wrapper %}
                            <div class=\"navbar-custom-menu\">
                                {% block header_custom_menu %}
                                    {% component 'ea:ActionMenu' with { class: 'user-menu-wrapper '~(is_granted(impersonator_permission) ? 'user-is-impersonated') } %}
                                        {% block content %}{% component 'ea:ActionMenu:Button' with { class: 'user-details', withoutDropdownToggleMarker: true } %}
                                            {% block content %}{{ user_menu_avatar }}
                                            {% if ea.userMenu.isNameDisplayed %}
                                                <span class=\"user-name\">{{ ea.userMenu.name }}</span>
                                            {% endif %}
                                        {% endblock %}{% endcomponent %}
                                        {% component 'ea:ActionMenu:Overlay' %}
                                            {% block content %}{{ user_menu_dropdown }}
                                        {% endblock %}{% endcomponent %}
                                    {% endblock %}{% endcomponent %}
                                {% endblock header_custom_menu %}
                            </div>
                            {% endblock header_custom_menu_wrapper %}

                            {% block settings_dropdown_wrapper %}
                                {{ settings_dropdown }}
                            {% endblock settings_dropdown_wrapper %}
                        {% endblock content_top_header %}
                    </aside>

                    <div class=\"content-wrapper\">
                        {% block content %}
                            <article class=\"content\">
                                {% block content_header_wrapper %}
                                    {% set crud_help_message = ea.crud.helpMessage ?? null %}
                                    {# don't use 'crud_help_message is not empty' here; it'll trigger deprecation messages: Method TranslatableMessage::__toString() is deprecated #}
                                    {% set has_help_message = crud_help_message is not same as(false) and crud_help_message is not null and crud_help_message is not same as('') %}
                                    <section class=\"content-header\">
                                        {% block content_header %}
                                            <div class=\"content-header-title\">
                                                <h1 class=\"title\">
                                                    {% block content_title %}{% endblock %}

                                                    {% block content_help %}
                                                        {% if has_help_message %}
                                                            <a tabindex=\"0\" class=\"content-header-help\" data-bs-toggle=\"popover\" data-bs-custom-class=\"ea-content-help-popover\" data-bs-animation=\"true\" data-bs-html=\"true\" data-bs-placement=\"bottom\" data-bs-trigger=\"focus\" data-bs-content=\"{{ ea.crud.helpMessage|trans|e('html') }}\">
                                                                {{ component('ea:Icon', { name: 'internal:circle-info' }) }}
                                                            </a>
                                                        {% endif %}
                                                    {% endblock %}
                                                </h1>
                                            </div>

                                            {% block page_actions_wrapper %}
                                                <div class=\"page-actions\">{% block page_actions %}{% endblock %}</div>
                                            {% endblock %}
                                        {% endblock content_header %}
                                    </section>
                                {% endblock content_header_wrapper %}

                                <section id=\"main\" class=\"content-body\">
                                    {% block main %}{% endblock %}
                                </section>

                                {% block content_footer_wrapper %}
                                    {% if block('content_footer') is not empty %}
                                        <section class=\"content-footer\">
                                            {% block content_footer %}{% endblock %}
                                        </section>
                                    {% endif %}
                                {% endblock %}
                            </article>
                        {% endblock content %}

                        <div id=\"content-resizer-handler\" class=\"resizer-handler resizer-handler-right\"></div>
                    </div>
                </section>
                {% endblock main_content_wrapper %}
            {% endblock wrapper %}
        </div>
    {% endblock wrapper_wrapper %}

    {% block body_javascript %}{% endblock body_javascript %}

    {% block configured_body_contents %}
        {% for htmlContent in ea.assets.bodyContents ?? [] %}
            {{ htmlContent|raw }}
        {% endfor %}
    {% endblock %}
    </body>
{% endblock body %}
</html>
", "@EasyAdmin/layout.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\layout.html.twig");
    }
}
