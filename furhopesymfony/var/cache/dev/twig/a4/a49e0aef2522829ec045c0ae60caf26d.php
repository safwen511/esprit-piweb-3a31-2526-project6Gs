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

/* @EasyAdmin/crud/index.html.twig */
class __TwigTemplate_bf31adcbeeb706895206ce00b8ae55ac extends Template
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
            'body_id' => [$this, 'block_body_id'],
            'body_class' => [$this, 'block_body_class'],
            'configured_head_contents' => [$this, 'block_configured_head_contents'],
            'configured_body_contents' => [$this, 'block_configured_body_contents'],
            'configured_stylesheets' => [$this, 'block_configured_stylesheets'],
            'configured_javascripts' => [$this, 'block_configured_javascripts'],
            'content_title' => [$this, 'block_content_title'],
            'page_actions' => [$this, 'block_page_actions'],
            'filters' => [$this, 'block_filters'],
            'global_actions' => [$this, 'block_global_actions'],
            'batch_actions' => [$this, 'block_batch_actions'],
            'main' => [$this, 'block_main'],
            'table_head' => [$this, 'block_table_head'],
            'table_body' => [$this, 'block_table_body'],
            'table_body_row' => [$this, 'block_table_body_row'],
            'entity_row_attributes' => [$this, 'block_entity_row_attributes'],
            'entity_actions' => [$this, 'block_entity_actions'],
            'table_body_empty' => [$this, 'block_table_body_empty'],
            'table_footer' => [$this, 'block_table_footer'],
            'paginator' => [$this, 'block_paginator'],
            'delete_form' => [$this, 'block_delete_form'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 5
        return $this->load(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 5, $this->source); })()), "templatePath", ["layout"], "method", false, false, false, 5), 5);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/index.html.twig"));

        // line 4
        $context["ea"] = $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->ea();
        // line 6
        $context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 6, $this->source); })()), "i18n", [], "any", false, false, false, 6), "translationDomain", [], "any", false, false, false, 6);
        // line 11
        $context["ea_field_assets"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 11, $this->source); })()), "crud", [], "any", false, false, false, 11), "fieldAssets", [Twig\Extension\CoreExtension::constant("EasyCorp\\Bundle\\EasyAdminBundle\\Config\\Crud::PAGE_INDEX")], "method", false, false, false, 11);
        // line 46
        $context["has_batch_actions"] = (Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["batch_actions"]) || array_key_exists("batch_actions", $context) ? $context["batch_actions"] : (function () { throw new RuntimeError('Variable "batch_actions" does not exist.', 46, $this->source); })())) > 0);
        // line 5
        yield from $this->getParent($context)->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_id(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body_id"));

        yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["entities"]) || array_key_exists("entities", $context) ? $context["entities"] : (function () { throw new RuntimeError('Variable "entities" does not exist.', 8, $this->source); })())) > 0)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("ea-index-" . CoreExtension::getAttribute($this->env, $this->source, Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["entities"]) || array_key_exists("entities", $context) ? $context["entities"] : (function () { throw new RuntimeError('Variable "entities" does not exist.', 8, $this->source); })())), "name", [], "any", false, false, false, 8)), "html", null, true)) : (""));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_class(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body_class"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("ea-index" . (((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["entities"]) || array_key_exists("entities", $context) ? $context["entities"] : (function () { throw new RuntimeError('Variable "entities" does not exist.', 9, $this->source); })())) > 0)) ? ((" ea-index-" . CoreExtension::getAttribute($this->env, $this->source, Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["entities"]) || array_key_exists("entities", $context) ? $context["entities"] : (function () { throw new RuntimeError('Variable "entities" does not exist.', 9, $this->source); })())), "name", [], "any", false, false, false, 9))) : (""))), "html", null, true);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 13
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_configured_head_contents(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "configured_head_contents"));

        // line 14
        yield "    ";
        yield from $this->yieldParentBlock("configured_head_contents", $context, $blocks);
        yield "
    ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea_field_assets"]) || array_key_exists("ea_field_assets", $context) ? $context["ea_field_assets"] : (function () { throw new RuntimeError('Variable "ea_field_assets" does not exist.', 15, $this->source); })()), "headContents", [], "any", false, false, false, 15));
        foreach ($context['_seq'] as $context["_key"] => $context["htmlContent"]) {
            // line 16
            yield "        ";
            yield $context["htmlContent"];
            yield "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['htmlContent'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 20
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_configured_body_contents(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "configured_body_contents"));

        // line 21
        yield "    ";
        yield from $this->yieldParentBlock("configured_body_contents", $context, $blocks);
        yield "
    ";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea_field_assets"]) || array_key_exists("ea_field_assets", $context) ? $context["ea_field_assets"] : (function () { throw new RuntimeError('Variable "ea_field_assets" does not exist.', 22, $this->source); })()), "bodyContents", [], "any", false, false, false, 22));
        foreach ($context['_seq'] as $context["_key"] => $context["htmlContent"]) {
            // line 23
            yield "        ";
            yield $context["htmlContent"];
            yield "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['htmlContent'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
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
        yield "    ";
        yield from $this->yieldParentBlock("configured_stylesheets", $context, $blocks);
        yield "
    ";
        // line 29
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@EasyAdmin/includes/_css_assets.html.twig", ["assets" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea_field_assets"]) || array_key_exists("ea_field_assets", $context) ? $context["ea_field_assets"] : (function () { throw new RuntimeError('Variable "ea_field_assets" does not exist.', 29, $this->source); })()), "cssAssets", [], "any", false, false, false, 29)], false);
        yield "
    ";
        // line 30
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@EasyAdmin/includes/_encore_link_tags.html.twig", ["assets" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea_field_assets"]) || array_key_exists("ea_field_assets", $context) ? $context["ea_field_assets"] : (function () { throw new RuntimeError('Variable "ea_field_assets" does not exist.', 30, $this->source); })()), "webpackEncoreAssets", [], "any", false, false, false, 30)], false);
        yield "
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 33
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_configured_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "configured_javascripts"));

        // line 34
        yield "    ";
        yield from $this->yieldParentBlock("configured_javascripts", $context, $blocks);
        yield "
    ";
        // line 35
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@EasyAdmin/includes/_js_assets.html.twig", ["assets" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea_field_assets"]) || array_key_exists("ea_field_assets", $context) ? $context["ea_field_assets"] : (function () { throw new RuntimeError('Variable "ea_field_assets" does not exist.', 35, $this->source); })()), "jsAssets", [], "any", false, false, false, 35)], false);
        yield "
    ";
        // line 36
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@EasyAdmin/includes/_encore_script_tags.html.twig", ["assets" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea_field_assets"]) || array_key_exists("ea_field_assets", $context) ? $context["ea_field_assets"] : (function () { throw new RuntimeError('Variable "ea_field_assets" does not exist.', 36, $this->source); })()), "webpackEncoreAssets", [], "any", false, false, false, 36)], false);
        yield "
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 39
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_title"));

        // line 40
        $context["custom_page_title"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 40, $this->source); })()), "crud", [], "any", false, false, false, 40), "customPageTitle", ["index", null, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 40, $this->source); })()), "i18n", [], "any", false, false, false, 40), "translationParameters", [], "any", false, false, false, 40), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 40, $this->source); })()), "i18n", [], "any", false, false, false, 40), "translationDomain", [], "any", false, false, false, 40)], "method", false, false, false, 40);
        // line 41
        yield (((null === (isset($context["custom_page_title"]) || array_key_exists("custom_page_title", $context) ? $context["custom_page_title"] : (function () { throw new RuntimeError('Variable "custom_page_title" does not exist.', 41, $this->source); })()))) ? ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 42
(isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 42, $this->source); })()), "crud", [], "any", false, false, false, 42), "defaultPageTitle", ["index", null, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 42, $this->source); })()), "i18n", [], "any", false, false, false, 42), "translationParameters", [], "any", false, false, false, 42)], "method", false, false, false, 42), [],         // line 6
(isset($context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"]) || array_key_exists("__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206", $context) ? $context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206" does not exist.', 6, $this->source); })()))) : ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(        // line 43
(isset($context["custom_page_title"]) || array_key_exists("custom_page_title", $context) ? $context["custom_page_title"] : (function () { throw new RuntimeError('Variable "custom_page_title" does not exist.', 43, $this->source); })()), [],         // line 6
(isset($context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"]) || array_key_exists("__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206", $context) ? $context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206" does not exist.', 6, $this->source); })()))));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 47
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_actions(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_actions"));

        // line 48
        yield "    ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["filters"]) || array_key_exists("filters", $context) ? $context["filters"] : (function () { throw new RuntimeError('Variable "filters" does not exist.', 48, $this->source); })())) > 0)) {
            // line 49
            yield "        <div class=\"datagrid-filters\">
            ";
            // line 50
            yield from $this->unwrap()->yieldBlock('filters', $context, $blocks);
            // line 63
            yield "        </div>
    ";
        }
        // line 65
        yield "
    ";
        // line 66
        yield from $this->unwrap()->yieldBlock('global_actions', $context, $blocks);
        // line 77
        yield "    ";
        yield from $this->unwrap()->yieldBlock('batch_actions', $context, $blocks);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 50
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_filters(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "filters"));

        // line 51
        yield "                ";
        $context["applied_filters"] = Twig\Extension\CoreExtension::keys(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["ea"] ?? null), "request", [], "any", false, true, false, 51), "query", [], "any", false, true, false, 51), "all", [], "any", false, true, false, 51), "filters", [], "array", true, true, false, 51)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 51, $this->source); })()), "request", [], "any", false, false, false, 51), "query", [], "any", false, false, false, 51), "all", [], "any", false, false, false, 51), "filters", [], "array", false, false, false, 51), [])) : ([])));
        // line 52
        yield "                <div class=\"btn-group action-filters\">
                    <a href=\"#\" data-href=\"";
        // line 53
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->getAdminUrlGenerator(), "setAction", ["renderFilters"], "method", false, false, false, 53), "html", null, true);
        yield "\" class=\"btn btn-secondary btn-labeled btn-labeled-right action-filters-button disabled ";
        yield (((($tmp = (isset($context["applied_filters"]) || array_key_exists("applied_filters", $context) ? $context["applied_filters"] : (function () { throw new RuntimeError('Variable "applied_filters" does not exist.', 53, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("action-filters-applied") : (""));
        yield "\" data-bs-toggle=\"modal\" data-bs-target=\"#modal-filters\">
                        ";
        // line 54
        yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:filter"]);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->createTranslatable("filter.title", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 54, $this->source); })()), "i18n", [], "any", false, false, false, 54), "translationParameters", [], "any", false, false, false, 54), "EasyAdminBundle"), [],         // line 6
(isset($context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"]) || array_key_exists("__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206", $context) ? $context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206" does not exist.', 6, $this->source); })())), "html", null, true);
        // line 54
        if ((($tmp = (isset($context["applied_filters"]) || array_key_exists("applied_filters", $context) ? $context["applied_filters"] : (function () { throw new RuntimeError('Variable "applied_filters" does not exist.', 54, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " <span class=\"action-filters-button-count\">(";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["applied_filters"]) || array_key_exists("applied_filters", $context) ? $context["applied_filters"] : (function () { throw new RuntimeError('Variable "applied_filters" does not exist.', 54, $this->source); })())), "html", null, true);
            yield ")</span>";
        }
        // line 55
        yield "                    </a>
                    ";
        // line 56
        if ((($tmp = (isset($context["applied_filters"]) || array_key_exists("applied_filters", $context) ? $context["applied_filters"] : (function () { throw new RuntimeError('Variable "applied_filters" does not exist.', 56, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 57
            yield "                        <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->getAdminUrlGenerator(), "unset", ["filters"], "method", false, false, false, 57), "setAction", ["index"], "method", false, false, false, 57), "html", null, true);
            yield "\" class=\"btn btn-secondary action-filters-reset\">
                            ";
            // line 58
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:xmark"]);
            yield "
                        </a>
                    ";
        }
        // line 61
        yield "                </div>
            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 66
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_global_actions(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "global_actions"));

        // line 67
        yield "        <div class=\"global-actions\">
            ";
        // line 68
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::reverse($this->env->getCharset(), (isset($context["global_actions"]) || array_key_exists("global_actions", $context) ? $context["global_actions"] : (function () { throw new RuntimeError('Variable "global_actions" does not exist.', 68, $this->source); })())));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 69
            yield "                ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "isActionGroup", [], "any", false, false, false, 69)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 70
                yield "                    ";
                yield Twig\Extension\CoreExtension::include($this->env, $context, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "templatePath", [], "any", false, false, false, 70), ["group" => $context["item"], "entity" => null], false);
                yield "
                ";
            } else {
                // line 72
                yield "                    ";
                yield Twig\Extension\CoreExtension::include($this->env, $context, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "templatePath", [], "any", false, false, false, 72), ["action" => $context["item"]], false);
                yield "
                ";
            }
            // line 74
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        yield "        </div>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 77
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_batch_actions(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "batch_actions"));

        // line 78
        yield "        ";
        if ((($tmp = (isset($context["has_batch_actions"]) || array_key_exists("has_batch_actions", $context) ? $context["has_batch_actions"] : (function () { throw new RuntimeError('Variable "has_batch_actions" does not exist.', 78, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 79
            yield "            <div class=\"batch-actions d-none\">
                ";
            // line 80
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["batch_actions"]) || array_key_exists("batch_actions", $context) ? $context["batch_actions"] : (function () { throw new RuntimeError('Variable "batch_actions" does not exist.', 80, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["action"]) {
                // line 81
                yield "                    ";
                yield Twig\Extension\CoreExtension::include($this->env, $context, CoreExtension::getAttribute($this->env, $this->source, $context["action"], "templatePath", [], "any", false, false, false, 81), ["action" => $context["action"]], false);
                yield "
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['action'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 83
            yield "            </div>
        ";
        }
        // line 85
        yield "    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 88
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_main(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "main"));

        // line 89
        yield "    ";
        // line 90
        yield "    ";
        $context["sort_params"] = ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, true, false, 90), "query", [], "any", false, true, false, 90), "all", [], "any", false, true, false, 90), "sort", [], "array", true, true, false, 90)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 90, $this->source); })()), "request", [], "any", false, false, false, 90), "query", [], "any", false, false, false, 90), "all", [], "any", false, false, false, 90), "sort", [], "array", false, false, false, 90), [])) : ([]));
        // line 91
        yield "    ";
        $context["sort_field_name"] = Twig\Extension\CoreExtension::first($this->env->getCharset(), Twig\Extension\CoreExtension::keys((isset($context["sort_params"]) || array_key_exists("sort_params", $context) ? $context["sort_params"] : (function () { throw new RuntimeError('Variable "sort_params" does not exist.', 91, $this->source); })())));
        // line 92
        yield "    ";
        $context["sort_order"] = Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["sort_params"]) || array_key_exists("sort_params", $context) ? $context["sort_params"] : (function () { throw new RuntimeError('Variable "sort_params" does not exist.', 92, $this->source); })()));
        // line 93
        yield "    ";
        $context["some_results_are_hidden"] = Twig\Extension\CoreExtension::reduce($this->env, (isset($context["entities"]) || array_key_exists("entities", $context) ? $context["entities"] : (function () { throw new RuntimeError('Variable "entities" does not exist.', 93, $this->source); })()), function ($__some_results_are_hidden__, $__entity__) use ($context, $macros) { $context["some_results_are_hidden"] = $__some_results_are_hidden__; $context["entity"] = $__entity__; return ((isset($context["some_results_are_hidden"]) || array_key_exists("some_results_are_hidden", $context) ? $context["some_results_are_hidden"] : (function () { throw new RuntimeError('Variable "some_results_are_hidden" does not exist.', 93, $this->source); })()) ||  !CoreExtension::getAttribute($this->env, $this->source, (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 93, $this->source); })()), "isAccessible", [], "any", false, false, false, 93)); }, false);
        // line 94
        yield "    ";
        $context["has_footer"] = (Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["entities"]) || array_key_exists("entities", $context) ? $context["entities"] : (function () { throw new RuntimeError('Variable "entities" does not exist.', 94, $this->source); })())) != 0);
        // line 95
        yield "    ";
        $context["has_search"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 95, $this->source); })()), "crud", [], "any", false, false, false, 95), "isSearchEnabled", [], "any", false, false, false, 95);
        // line 96
        yield "    ";
        $context["has_filters"] = (Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["filters"]) || array_key_exists("filters", $context) ? $context["filters"] : (function () { throw new RuntimeError('Variable "filters" does not exist.', 96, $this->source); })())) > 0);
        // line 97
        yield "    ";
        $context["num_results"] = Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["entities"]) || array_key_exists("entities", $context) ? $context["entities"] : (function () { throw new RuntimeError('Variable "entities" does not exist.', 97, $this->source); })()));
        // line 98
        yield "
    <table class=\"table datagrid ";
        // line 99
        yield ((Twig\Extension\CoreExtension::testEmpty((isset($context["entities"]) || array_key_exists("entities", $context) ? $context["entities"] : (function () { throw new RuntimeError('Variable "entities" does not exist.', 99, $this->source); })()))) ? ("datagrid-empty") : (""));
        yield "\" data-default-action-trigger=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 99, $this->source); })()), "crud", [], "any", false, false, false, 99), "defaultRowActionTrigger", [], "any", false, false, false, 99), "html", null, true);
        yield "\">
        ";
        // line 100
        if (((isset($context["num_results"]) || array_key_exists("num_results", $context) ? $context["num_results"] : (function () { throw new RuntimeError('Variable "num_results" does not exist.', 100, $this->source); })()) > 0)) {
            // line 101
            yield "            <thead>
            ";
            // line 102
            yield from $this->unwrap()->yieldBlock('table_head', $context, $blocks);
            // line 138
            yield "            </thead>
        ";
        }
        // line 140
        yield "
        <tbody>
        ";
        // line 142
        yield from $this->unwrap()->yieldBlock('table_body', $context, $blocks);
        // line 232
        yield "        </tbody>

        <tfoot>
        ";
        // line 235
        yield from $this->unwrap()->yieldBlock('table_footer', $context, $blocks);
        // line 237
        yield "        </tfoot>
    </table>

    ";
        // line 240
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["entities"]) || array_key_exists("entities", $context) ? $context["entities"] : (function () { throw new RuntimeError('Variable "entities" does not exist.', 240, $this->source); })())) > 0)) {
            // line 241
            yield "        <div class=\"content-panel-footer without-padding without-border\">
            ";
            // line 242
            yield from $this->unwrap()->yieldBlock('paginator', $context, $blocks);
            // line 245
            yield "        </div>
    ";
        }
        // line 247
        yield "
    ";
        // line 248
        yield from $this->unwrap()->yieldBlock('delete_form', $context, $blocks);
        // line 251
        yield "
    ";
        // line 252
        if ((($tmp = (isset($context["has_filters"]) || array_key_exists("has_filters", $context) ? $context["has_filters"] : (function () { throw new RuntimeError('Variable "has_filters" does not exist.', 252, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 253
            yield "        ";
            yield Twig\Extension\CoreExtension::include($this->env, $context, "@EasyAdmin/crud/includes/_filters_modal.html.twig");
            yield "
    ";
        }
        // line 255
        yield "
    ";
        // line 256
        if ((($tmp = (isset($context["has_batch_actions"]) || array_key_exists("has_batch_actions", $context) ? $context["has_batch_actions"] : (function () { throw new RuntimeError('Variable "has_batch_actions" does not exist.', 256, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 257
            yield "        ";
            yield Twig\Extension\CoreExtension::include($this->env, $context, "@EasyAdmin/crud/includes/_batch_action_modal.html.twig", [], false);
            yield "
    ";
        }
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 102
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_table_head(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "table_head"));

        // line 103
        yield "                <tr>
                    ";
        // line 104
        if ((($tmp = (isset($context["has_batch_actions"]) || array_key_exists("has_batch_actions", $context) ? $context["has_batch_actions"] : (function () { throw new RuntimeError('Variable "has_batch_actions" does not exist.', 104, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 105
            yield "                        <th>
                            <div class=\"form-check\">
                                <span><input type=\"checkbox\" class=\"form-check-input form-batch-checkbox-all\" id=\"form-batch-checkbox-all\"></span>
                            </div>
                        </th>
                    ";
        }
        // line 111
        yield "
                    ";
        // line 112
        $context["ea_sort_asc"] = Twig\Extension\CoreExtension::constant("EasyCorp\\Bundle\\EasyAdminBundle\\Config\\Option\\SortOrder::ASC");
        // line 113
        yield "                    ";
        $context["ea_sort_desc"] = Twig\Extension\CoreExtension::constant("EasyCorp\\Bundle\\EasyAdminBundle\\Config\\Option\\SortOrder::DESC");
        // line 114
        yield "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((((CoreExtension::getAttribute($this->env, $this->source, Twig\Extension\CoreExtension::first($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, (isset($context["entities"]) || array_key_exists("entities", $context) ? $context["entities"] : (function () { throw new RuntimeError('Variable "entities" does not exist.', 114, $this->source); })()), function ($__e__) use ($context, $macros) { $context["e"] = $__e__; return CoreExtension::getAttribute($this->env, $this->source, (isset($context["e"]) || array_key_exists("e", $context) ? $context["e"] : (function () { throw new RuntimeError('Variable "e" does not exist.', 114, $this->source); })()), "isAccessible", [], "any", false, false, false, 114); })), "fields", [], "any", true, true, false, 114) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, Twig\Extension\CoreExtension::first($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, (isset($context["entities"]) || array_key_exists("entities", $context) ? $context["entities"] : (function () { throw new RuntimeError('Variable "entities" does not exist.', 114, $this->source); })()), function ($__e__) use ($context, $macros) { $context["e"] = $__e__; return CoreExtension::getAttribute($this->env, $this->source, (isset($context["e"]) || array_key_exists("e", $context) ? $context["e"] : (function () { throw new RuntimeError('Variable "e" does not exist.', 114, $this->source); })()), "isAccessible", [], "any", false, false, false, 114); })), "fields", [], "any", false, false, false, 114)))) ? (CoreExtension::getAttribute($this->env, $this->source, Twig\Extension\CoreExtension::first($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, (isset($context["entities"]) || array_key_exists("entities", $context) ? $context["entities"] : (function () { throw new RuntimeError('Variable "entities" does not exist.', 114, $this->source); })()), function ($__e__) use ($context, $macros) { $context["e"] = $__e__; return CoreExtension::getAttribute($this->env, $this->source, (isset($context["e"]) || array_key_exists("e", $context) ? $context["e"] : (function () { throw new RuntimeError('Variable "e" does not exist.', 114, $this->source); })()), "isAccessible", [], "any", false, false, false, 114); })), "fields", [], "any", false, false, false, 114)) : ([])));
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 115
            yield "                        ";
            $context["is_searchable"] = ((null == CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 115, $this->source); })()), "crud", [], "any", false, false, false, 115), "searchFields", [], "any", false, false, false, 115)) || CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "property", [], "any", false, false, false, 115), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 115, $this->source); })()), "crud", [], "any", false, false, false, 115), "searchFields", [], "any", false, false, false, 115)));
            // line 116
            yield "                        ";
            $context["is_sorting_field"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 116, $this->source); })()), "search", [], "any", false, false, false, 116), "isSortingField", [CoreExtension::getAttribute($this->env, $this->source, $context["field"], "property", [], "any", false, false, false, 116)], "method", false, false, false, 116);
            // line 117
            yield "                        ";
            $context["next_sort_direction"] = (((($tmp = (isset($context["is_sorting_field"]) || array_key_exists("is_sorting_field", $context) ? $context["is_sorting_field"] : (function () { throw new RuntimeError('Variable "is_sorting_field" does not exist.', 117, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ((((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 117, $this->source); })()), "search", [], "any", false, false, false, 117), "sortDirection", [CoreExtension::getAttribute($this->env, $this->source, $context["field"], "property", [], "any", false, false, false, 117)], "method", false, false, false, 117) == (isset($context["ea_sort_desc"]) || array_key_exists("ea_sort_desc", $context) ? $context["ea_sort_desc"] : (function () { throw new RuntimeError('Variable "ea_sort_desc" does not exist.', 117, $this->source); })()))) ? ((isset($context["ea_sort_asc"]) || array_key_exists("ea_sort_asc", $context) ? $context["ea_sort_asc"] : (function () { throw new RuntimeError('Variable "ea_sort_asc" does not exist.', 117, $this->source); })())) : ((isset($context["ea_sort_desc"]) || array_key_exists("ea_sort_desc", $context) ? $context["ea_sort_desc"] : (function () { throw new RuntimeError('Variable "ea_sort_desc" does not exist.', 117, $this->source); })())))) : ((isset($context["ea_sort_desc"]) || array_key_exists("ea_sort_desc", $context) ? $context["ea_sort_desc"] : (function () { throw new RuntimeError('Variable "ea_sort_desc" does not exist.', 117, $this->source); })())));
            // line 118
            yield "                        ";
            $context["column_icon"] = (((($tmp = (isset($context["is_sorting_field"]) || array_key_exists("is_sorting_field", $context) ? $context["is_sorting_field"] : (function () { throw new RuntimeError('Variable "is_sorting_field" does not exist.', 118, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (((((isset($context["next_sort_direction"]) || array_key_exists("next_sort_direction", $context) ? $context["next_sort_direction"] : (function () { throw new RuntimeError('Variable "next_sort_direction" does not exist.', 118, $this->source); })()) == (isset($context["ea_sort_desc"]) || array_key_exists("ea_sort_desc", $context) ? $context["ea_sort_desc"] : (function () { throw new RuntimeError('Variable "ea_sort_desc" does not exist.', 118, $this->source); })()))) ? ("internal:sort-arrow-up") : ("internal:sort-arrow-down"))) : ("internal:sort-arrows"));
            // line 119
            yield "
                        <th data-column=\"";
            // line 120
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "property", [], "any", false, false, false, 120), "html", null, true);
            yield "\" class=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "cssClass", [], "any", false, false, false, 120), "html", null, true);
            yield " ";
            yield (((($tmp = (isset($context["is_searchable"]) || array_key_exists("is_searchable", $context) ? $context["is_searchable"] : (function () { throw new RuntimeError('Variable "is_searchable" does not exist.', 120, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("searchable") : (""));
            yield " ";
            yield (((($tmp = (isset($context["is_sorting_field"]) || array_key_exists("is_sorting_field", $context) ? $context["is_sorting_field"] : (function () { throw new RuntimeError('Variable "is_sorting_field" does not exist.', 120, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("sorted") : (""));
            yield " ";
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["field"], "isVirtual", [], "any", false, false, false, 120)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("field-virtual") : (""));
            yield " header-for-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join(Twig\Extension\CoreExtension::filter($this->env, Twig\Extension\CoreExtension::split($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["field"], "cssClass", [], "any", false, false, false, 120), " "), function ($__class__) use ($context, $macros) { $context["class"] = $__class__; return (is_string($_v0 = (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 120, $this->source); })())) && is_string($_v1 = "field-") && str_starts_with($_v0, $_v1)); }), ""), "html", null, true);
            yield " text-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "textAlign", [], "any", false, false, false, 120), "html", null, true);
            yield "\" dir=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 120, $this->source); })()), "i18n", [], "any", false, false, false, 120), "textDirection", [], "any", false, false, false, 120), "html", null, true);
            yield "\">
                            ";
            // line 121
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["field"], "isSortable", [], "any", false, false, false, 121)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 122
                yield "                                ";
                $context["sortable_url"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->getAdminUrlGenerator(), "setController", [CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 122, $this->source); })()), "request", [], "any", false, false, false, 122), "attributes", [], "any", false, false, false, 122), "get", ["crudControllerFqcn"], "method", false, false, false, 122)], "method", false, false, false, 122), "setAction", ["index"], "method", false, false, false, 122), "set", ["page", 1], "method", false, false, false, 122), "set", ["sort", [CoreExtension::getAttribute($this->env, $this->source, $context["field"], "property", [], "any", false, false, false, 122) => (isset($context["next_sort_direction"]) || array_key_exists("next_sort_direction", $context) ? $context["next_sort_direction"] : (function () { throw new RuntimeError('Variable "next_sort_direction" does not exist.', 122, $this->source); })())]], "method", false, false, false, 122);
                // line 123
                yield "
                                <a href=\"";
                // line 124
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["sortable_url"]) || array_key_exists("sortable_url", $context) ? $context["sortable_url"] : (function () { throw new RuntimeError('Variable "sortable_url" does not exist.', 124, $this->source); })()), "html", null, true);
                yield "\">
                                    ";
                // line 125
                yield $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "label", [], "any", false, false, false, 125), [],                 // line 6
(isset($context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"]) || array_key_exists("__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206", $context) ? $context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206" does not exist.', 6, $this->source); })()));
                // line 125
                yield " ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => (isset($context["column_icon"]) || array_key_exists("column_icon", $context) ? $context["column_icon"] : (function () { throw new RuntimeError('Variable "column_icon" does not exist.', 125, $this->source); })())]);
                yield "
                                </a>
                            ";
            } else {
                // line 128
                yield "                                <span>";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "label", [], "any", false, false, false, 128), [],                 // line 6
(isset($context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"]) || array_key_exists("__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206", $context) ? $context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206" does not exist.', 6, $this->source); })()));
                // line 128
                yield "</span>
                            ";
            }
            // line 130
            yield "                        </th>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['field'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 132
        yield "
                    <th class=\"";
        // line 133
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 133, $this->source); })()), "crud", [], "any", false, false, false, 133), "showEntityActionsAsDropdown", [], "any", false, false, false, 133)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("actions-as-dropdown-table-head") : (""));
        yield "\" dir=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 133, $this->source); })()), "i18n", [], "any", false, false, false, 133), "textDirection", [], "any", false, false, false, 133), "html", null, true);
        yield "\">
                        <span class=\"visually-hidden\">";
        // line 134
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->createTranslatable("action.entity_actions", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 134, $this->source); })()), "i18n", [], "any", false, false, false, 134), "translationParameters", [], "any", false, false, false, 134), "EasyAdminBundle"), [],         // line 6
(isset($context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"]) || array_key_exists("__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206", $context) ? $context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206" does not exist.', 6, $this->source); })())), "html", null, true);
        // line 134
        yield "</span>
                    </th>
                </tr>
            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 142
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_table_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "table_body"));

        // line 143
        yield "            ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["entities"]) || array_key_exists("entities", $context) ? $context["entities"] : (function () { throw new RuntimeError('Variable "entities" does not exist.', 143, $this->source); })()));
        $context['_iterated'] = false;
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
        foreach ($context['_seq'] as $context["_key"] => $context["entity"]) {
            // line 144
            yield "                ";
            yield from $this->unwrap()->yieldBlock('table_body_row', $context, $blocks);
            // line 201
            yield "            ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        if (!$context['_iterated']) {
            // line 202
            yield "                ";
            yield from $this->unwrap()->yieldBlock('table_body_empty', $context, $blocks);
            // line 222
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['entity'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 223
        yield "
            ";
        // line 224
        if ((($tmp = (isset($context["some_results_are_hidden"]) || array_key_exists("some_results_are_hidden", $context) ? $context["some_results_are_hidden"] : (function () { throw new RuntimeError('Variable "some_results_are_hidden" does not exist.', 224, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 225
            yield "                <tr class=\"datagrid-row-empty\">
                    <td class=\"text-center\" colspan=\"100\">
                        <span class=\"datagrid-row-empty-message\">";
            // line 227
            yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:lock", "class" => "mr-1"]);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("datagrid.hidden_results", [], "EasyAdminBundle"), "html", null, true);
            yield "</span>
                    </td>
                </tr>
            ";
        }
        // line 231
        yield "        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 144
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_table_body_row(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "table_body_row"));

        // line 145
        yield "                ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 145, $this->source); })()), "isAccessible", [], "any", false, false, false, 145)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 146
            yield "                    <tr data-id=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 146, $this->source); })()), "primaryKeyValueAsString", [], "any", false, false, false, 146), "html", null, true);
            yield "\" ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 146, $this->source); })()), "defaultActionUrl", [], "any", false, false, false, 146)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "data-default-action-url=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 146, $this->source); })()), "defaultActionUrl", [], "any", false, false, false, 146), "html", null, true);
                yield "\" class=\"ea-clickable-row\" role=\"link\" tabindex=\"0\"";
            }
            yield " ";
            yield from $this->unwrap()->yieldBlock('entity_row_attributes', $context, $blocks);
            yield ">
                        ";
            // line 147
            if ((($tmp = (isset($context["has_batch_actions"]) || array_key_exists("has_batch_actions", $context) ? $context["has_batch_actions"] : (function () { throw new RuntimeError('Variable "has_batch_actions" does not exist.', 147, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 148
                yield "                            <td class=\"batch-actions-selector\">
                                <div class=\"form-check\">
                                    <input type=\"checkbox\" class=\"form-check-input form-batch-checkbox\" id=\"form-batch-checkbox-";
                // line 150
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["loop"]) || array_key_exists("loop", $context) ? $context["loop"] : (function () { throw new RuntimeError('Variable "loop" does not exist.', 150, $this->source); })()), "index0", [], "any", false, false, false, 150), "html", null, true);
                yield "\" value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 150, $this->source); })()), "primaryKeyValue", [], "any", false, false, false, 150), "html", null, true);
                yield "\">
                                </div>
                            </td>
                        ";
            }
            // line 154
            yield "
                        ";
            // line 155
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 155, $this->source); })()), "fields", [], "any", false, false, false, 155));
            foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                // line 156
                yield "                            ";
                $context["is_searchable"] = ((null == CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 156, $this->source); })()), "crud", [], "any", false, false, false, 156), "searchFields", [], "any", false, false, false, 156)) || CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "property", [], "any", false, false, false, 156), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 156, $this->source); })()), "crud", [], "any", false, false, false, 156), "searchFields", [], "any", false, false, false, 156)));
                // line 157
                yield "
                            <td data-column=\"";
                // line 158
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "property", [], "any", false, false, false, 158), "html", null, true);
                yield "\" data-label=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "label", [], "any", false, false, false, 158), [],                 // line 6
(isset($context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"]) || array_key_exists("__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206", $context) ? $context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206" does not exist.', 6, $this->source); })())), "html");
                // line 158
                yield "\" class=\"";
                yield (((($tmp = (isset($context["is_searchable"]) || array_key_exists("is_searchable", $context) ? $context["is_searchable"] : (function () { throw new RuntimeError('Variable "is_searchable" does not exist.', 158, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("searchable") : (""));
                yield " ";
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["field"], "property", [], "any", false, false, false, 158) == (isset($context["sort_field_name"]) || array_key_exists("sort_field_name", $context) ? $context["sort_field_name"] : (function () { throw new RuntimeError('Variable "sort_field_name" does not exist.', 158, $this->source); })()))) ? ("sorted") : (""));
                yield " text-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "textAlign", [], "any", false, false, false, 158), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "cssClass", [], "any", false, false, false, 158), "html", null, true);
                yield "\" dir=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 158, $this->source); })()), "i18n", [], "any", false, false, false, 158), "textDirection", [], "any", false, false, false, 158), "html", null, true);
                yield "\" ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "htmlAttributes", [], "any", false, false, false, 158));
                foreach ($context['_seq'] as $context["name"] => $context["value"]) {
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["name"], "html", null, true);
                    yield "=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html_attr");
                    yield "\" ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['name'], $context['value'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                yield ">
                                ";
                // line 159
                yield Twig\Extension\CoreExtension::include($this->env, $context, CoreExtension::getAttribute($this->env, $this->source, $context["field"], "templatePath", [], "any", false, false, false, 159), ["field" => $context["field"], "entity" => (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 159, $this->source); })())], false);
                yield "
                            </td>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['field'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 162
            yield "
                        ";
            // line 163
            yield from $this->unwrap()->yieldBlock('entity_actions', $context, $blocks);
            // line 197
            yield "                    </tr>

                ";
        }
        // line 200
        yield "                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 146
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_entity_row_attributes(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "entity_row_attributes"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 163
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_entity_actions(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "entity_actions"));

        // line 164
        yield "                            <td class=\"actions ";
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 164, $this->source); })()), "crud", [], "any", false, false, false, 164), "showEntityActionsAsDropdown", [], "any", false, false, false, 164)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("actions-as-dropdown") : (""));
        yield "\">
                                ";
        // line 165
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 165, $this->source); })()), "actions", [], "any", false, false, false, 165), "count", [], "any", false, false, false, 165) > 0)) {
            // line 166
            yield "                                    ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 166, $this->source); })()), "crud", [], "any", false, false, false, 166), "showEntityActionsAsDropdown", [], "any", false, false, false, 166)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 167
                yield "                                        ";
                $context["hasAnyActionWithIcon"] = (Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 167, $this->source); })()), "actions", [], "any", false, false, false, 167), function ($__item__) use ($context, $macros) { $context["item"] = $__item__; return (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["item"]) || array_key_exists("item", $context) ? $context["item"] : (function () { throw new RuntimeError('Variable "item" does not exist.', 167, $this->source); })()), "isActionGroup", [], "any", false, false, false, 167)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (false) : ( !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["item"]) || array_key_exists("item", $context) ? $context["item"] : (function () { throw new RuntimeError('Variable "item" does not exist.', 167, $this->source); })()), "icon", [], "any", false, false, false, 167)))); })) > 0);
                // line 168
                yield "                                        ";
                $_v2 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
                $preRendered = $_v2->preRender("ea:ActionMenu", Twig\Extension\CoreExtension::toArray(["class" => "dropdown-actions"]));
                if (null !== $preRendered) {
                    yield $preRendered; 
                } else {
                    $preRenderEvent = $_v2->startEmbedComponent("ea:ActionMenu", Twig\Extension\CoreExtension::toArray(["class" => "dropdown-actions"]), $context, "@EasyAdmin/crud/index.html.twig", 27663508481);
                    $embeddedContext = $preRenderEvent->getVariables();
                    $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
                    $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
                    $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 27663508481);
                    $this->load("@EasyAdmin/crud/index.html.twig", 168, "27663508481")->display($embeddedContext, $embeddedBlocks);
                    $_v2->finishEmbedComponent();
                }
                // line 185
                yield "                                    ";
            } else {
                // line 186
                yield "                                        ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 186, $this->source); })()), "actions", [], "any", false, false, false, 186));
                foreach ($context['_seq'] as $context["_key"] => $context["action"]) {
                    // line 187
                    yield "                                            ";
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["action"], "isActionGroup", [], "any", false, false, false, 187)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 188
                        yield "                                                ";
                        yield Twig\Extension\CoreExtension::include($this->env, $context, CoreExtension::getAttribute($this->env, $this->source, $context["action"], "templatePath", [], "any", false, false, false, 188), ["group" => $context["action"], "entity" => (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 188, $this->source); })())], false);
                        yield "
                                            ";
                    } else {
                        // line 190
                        yield "                                                ";
                        yield Twig\Extension\CoreExtension::include($this->env, $context, CoreExtension::getAttribute($this->env, $this->source, $context["action"], "templatePath", [], "any", false, false, false, 190), ["action" => $context["action"], "entity" => (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 190, $this->source); })()), "isIncludedInDropdown" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 190, $this->source); })()), "crud", [], "any", false, false, false, 190), "showEntityActionsAsDropdown", [], "any", false, false, false, 190)], false);
                        yield "
                                            ";
                    }
                    // line 192
                    yield "                                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['action'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 193
                yield "                                    ";
            }
            // line 194
            yield "                                ";
        }
        // line 195
        yield "                            </td>
                        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 202
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_table_body_empty(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "table_body_empty"));

        // line 203
        yield "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(range(1, 14));
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
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 204
            yield "                        <tr class=\"empty-row\">
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                        </tr>

                        ";
            // line 213
            if ((3 == CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 213))) {
                // line 214
                yield "                            <tr class=\"no-results\">
                                <td colspan=\"100\">
                                    ";
                // line 216
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->createTranslatable("datagrid.no_results", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 216, $this->source); })()), "i18n", [], "any", false, false, false, 216), "translationParameters", [], "any", false, false, false, 216), "EasyAdminBundle"), [],                 // line 6
(isset($context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"]) || array_key_exists("__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206", $context) ? $context["__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206"] : (function () { throw new RuntimeError('Variable "__internal_trans_default_domain7ef3c118ccfab12c5ee65c5e56454206" does not exist.', 6, $this->source); })())), "html", null, true);
                // line 216
                yield "
                                </td>
                            </tr>
                        ";
            }
            // line 220
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
        unset($context['_seq'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 221
        yield "                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 235
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_table_footer(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "table_footer"));

        // line 236
        yield "        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 242
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_paginator(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "paginator"));

        // line 243
        yield "                ";
        yield Twig\Extension\CoreExtension::include($this->env, $context, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 243, $this->source); })()), "templatePath", ["crud/paginator"], "method", false, false, false, 243), ["render_detailed_pagination" =>  !(isset($context["some_results_are_hidden"]) || array_key_exists("some_results_are_hidden", $context) ? $context["some_results_are_hidden"] : (function () { throw new RuntimeError('Variable "some_results_are_hidden" does not exist.', 243, $this->source); })())]);
        yield "
            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 248
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_delete_form(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "delete_form"));

        // line 249
        yield "        ";
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig", [], false);
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
        return "@EasyAdmin/crud/index.html.twig";
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
        return array (  1112 => 249,  1102 => 248,  1091 => 243,  1081 => 242,  1073 => 236,  1063 => 235,  1055 => 221,  1041 => 220,  1035 => 216,  1033 => 6,  1032 => 216,  1028 => 214,  1026 => 213,  1015 => 204,  997 => 203,  987 => 202,  978 => 195,  975 => 194,  972 => 193,  966 => 192,  960 => 190,  954 => 188,  951 => 187,  946 => 186,  943 => 185,  928 => 168,  925 => 167,  922 => 166,  920 => 165,  915 => 164,  905 => 163,  889 => 146,  881 => 200,  876 => 197,  874 => 163,  871 => 162,  862 => 159,  837 => 158,  835 => 6,  832 => 158,  829 => 157,  826 => 156,  822 => 155,  819 => 154,  810 => 150,  806 => 148,  804 => 147,  791 => 146,  788 => 145,  778 => 144,  770 => 231,  761 => 227,  757 => 225,  755 => 224,  752 => 223,  746 => 222,  743 => 202,  730 => 201,  727 => 144,  708 => 143,  698 => 142,  687 => 134,  685 => 6,  684 => 134,  678 => 133,  675 => 132,  668 => 130,  664 => 128,  662 => 6,  660 => 128,  653 => 125,  651 => 6,  650 => 125,  646 => 124,  643 => 123,  640 => 122,  638 => 121,  620 => 120,  617 => 119,  614 => 118,  611 => 117,  608 => 116,  605 => 115,  600 => 114,  597 => 113,  595 => 112,  592 => 111,  584 => 105,  582 => 104,  579 => 103,  569 => 102,  557 => 257,  555 => 256,  552 => 255,  546 => 253,  544 => 252,  541 => 251,  539 => 248,  536 => 247,  532 => 245,  530 => 242,  527 => 241,  525 => 240,  520 => 237,  518 => 235,  513 => 232,  511 => 142,  507 => 140,  503 => 138,  501 => 102,  498 => 101,  496 => 100,  490 => 99,  487 => 98,  484 => 97,  481 => 96,  478 => 95,  475 => 94,  472 => 93,  469 => 92,  466 => 91,  463 => 90,  461 => 89,  451 => 88,  443 => 85,  439 => 83,  430 => 81,  426 => 80,  423 => 79,  420 => 78,  410 => 77,  401 => 75,  395 => 74,  389 => 72,  383 => 70,  380 => 69,  376 => 68,  373 => 67,  363 => 66,  354 => 61,  348 => 58,  343 => 57,  341 => 56,  338 => 55,  332 => 54,  330 => 6,  327 => 54,  321 => 53,  318 => 52,  315 => 51,  305 => 50,  296 => 77,  294 => 66,  291 => 65,  287 => 63,  285 => 50,  282 => 49,  279 => 48,  269 => 47,  261 => 6,  260 => 43,  259 => 6,  258 => 42,  257 => 41,  255 => 40,  245 => 39,  235 => 36,  231 => 35,  226 => 34,  216 => 33,  206 => 30,  202 => 29,  197 => 28,  187 => 27,  172 => 23,  168 => 22,  163 => 21,  153 => 20,  138 => 16,  134 => 15,  129 => 14,  119 => 13,  102 => 9,  85 => 8,  78 => 5,  76 => 46,  74 => 11,  72 => 6,  70 => 4,  60 => 5,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{# @var entities \\EasyCorp\\Bundle\\EasyAdminBundle\\Collection\\EntityCollection #}
{# @var paginator \\EasyCorp\\Bundle\\EasyAdminBundle\\Orm\\EntityPaginator #}
{% set ea = ea() %}
{% extends ea.templatePath('layout') %}
{% trans_default_domain ea.i18n.translationDomain %}

{% block body_id entities|length > 0 ? 'ea-index-' ~ entities|first.name : '' %}
{% block body_class 'ea-index' ~ (entities|length > 0 ? ' ea-index-' ~ entities|first.name : '') %}

{% set ea_field_assets = ea.crud.fieldAssets(constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Crud::PAGE_INDEX')) %}

{% block configured_head_contents %}
    {{ parent() }}
    {% for htmlContent in ea_field_assets.headContents %}
        {{ htmlContent|raw }}
    {% endfor %}
{% endblock %}

{% block configured_body_contents %}
    {{ parent() }}
    {% for htmlContent in ea_field_assets.bodyContents %}
        {{ htmlContent|raw }}
    {% endfor %}
{% endblock %}

{% block configured_stylesheets %}
    {{ parent() }}
    {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea_field_assets.cssAssets}, with_context: false) }}
    {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea_field_assets.webpackEncoreAssets}, with_context: false) }}
{% endblock %}

{% block configured_javascripts %}
    {{ parent() }}
    {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea_field_assets.jsAssets}, with_context: false) }}
    {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea_field_assets.webpackEncoreAssets}, with_context: false) }}
{% endblock %}

{% block content_title %}
    {%- set custom_page_title = ea.crud.customPageTitle('index', null, ea.i18n.translationParameters, ea.i18n.translationDomain) -%}
    {{- custom_page_title is null
        ? ea.crud.defaultPageTitle('index', null, ea.i18n.translationParameters)|trans|raw
        : custom_page_title|trans|raw -}}
{% endblock %}

{% set has_batch_actions = batch_actions|length > 0 %}
{% block page_actions %}
    {% if filters|length > 0 %}
        <div class=\"datagrid-filters\">
            {% block filters %}
                {% set applied_filters = ea.request.query.all['filters']|default([])|keys %}
                <div class=\"btn-group action-filters\">
                    <a href=\"#\" data-href=\"{{ ea_url().setAction('renderFilters') }}\" class=\"btn btn-secondary btn-labeled btn-labeled-right action-filters-button disabled {{ applied_filters ? 'action-filters-applied' }}\" data-bs-toggle=\"modal\" data-bs-target=\"#modal-filters\">
                        {{ component('ea:Icon', { name: 'internal:filter' }) }} {{ t('filter.title', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}{% if applied_filters %} <span class=\"action-filters-button-count\">({{ applied_filters|length }})</span>{% endif %}
                    </a>
                    {% if applied_filters %}
                        <a href=\"{{ ea_url().unset('filters').setAction('index') }}\" class=\"btn btn-secondary action-filters-reset\">
                            {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                        </a>
                    {% endif %}
                </div>
            {% endblock filters %}
        </div>
    {% endif %}

    {% block global_actions %}
        <div class=\"global-actions\">
            {% for item in global_actions|reverse %}
                {% if item.isActionGroup %}
                    {{ include(item.templatePath, {group: item, entity: null}, with_context: false) }}
                {% else %}
                    {{ include(item.templatePath, {action: item}, with_context: false) }}
                {% endif %}
            {% endfor %}
        </div>
    {% endblock global_actions %}
    {% block batch_actions %}
        {% if has_batch_actions %}
            <div class=\"batch-actions d-none\">
                {% for action in batch_actions %}
                    {{ include(action.templatePath, {action: action}, with_context: false) }}
                {% endfor %}
            </div>
        {% endif %}
    {% endblock %}
{% endblock page_actions %}

{% block main %}
    {# sort can be multiple; let's consider the sorting field the first one #}
    {% set sort_params = app.request.query.all['sort']|default({}) %}
    {% set sort_field_name = sort_params|keys|first %}
    {% set sort_order = sort_params|first %}
    {% set some_results_are_hidden = entities|reduce((some_results_are_hidden, entity) => some_results_are_hidden or not entity.isAccessible, false) %}
    {% set has_footer = entities|length != 0 %}
    {% set has_search = ea.crud.isSearchEnabled %}
    {% set has_filters = filters|length > 0 %}
    {% set num_results = entities|length %}

    <table class=\"table datagrid {{ entities is empty ? 'datagrid-empty' }}\" data-default-action-trigger=\"{{ ea.crud.defaultRowActionTrigger }}\">
        {% if num_results > 0 %}
            <thead>
            {% block table_head %}
                <tr>
                    {% if has_batch_actions %}
                        <th>
                            <div class=\"form-check\">
                                <span><input type=\"checkbox\" class=\"form-check-input form-batch-checkbox-all\" id=\"form-batch-checkbox-all\"></span>
                            </div>
                        </th>
                    {% endif %}

                    {% set ea_sort_asc = constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Option\\\\SortOrder::ASC') %}
                    {% set ea_sort_desc = constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Option\\\\SortOrder::DESC') %}
                    {% for field in entities|filter(e => e.isAccessible)|first.fields ?? [] %}
                        {% set is_searchable = null == ea.crud.searchFields or field.property in ea.crud.searchFields %}
                        {% set is_sorting_field = ea.search.isSortingField(field.property) %}
                        {% set next_sort_direction = is_sorting_field ? (ea.search.sortDirection(field.property) == ea_sort_desc ? ea_sort_asc : ea_sort_desc) : ea_sort_desc %}
                        {% set column_icon = is_sorting_field ? (next_sort_direction == ea_sort_desc ? 'internal:sort-arrow-up' : 'internal:sort-arrow-down') : 'internal:sort-arrows' %}

                        <th data-column=\"{{ field.property }}\" class=\"{{ field.cssClass }} {{ is_searchable ? 'searchable' }} {{ is_sorting_field ? 'sorted' }} {{ field.isVirtual ? 'field-virtual' }} header-for-{{ field.cssClass|split(' ')|filter(class => class starts with 'field-')|join('') }} text-{{ field.textAlign }}\" dir=\"{{ ea.i18n.textDirection }}\">
                            {% if field.isSortable %}
                                {% set sortable_url = ea_url().setController(ea.request.attributes.get('crudControllerFqcn')).setAction('index').set('page', 1).set('sort', {(field.property): next_sort_direction}) %}

                                <a href=\"{{ sortable_url }}\">
                                    {{ field.label|trans|raw }} {{ component('ea:Icon', { name: (column_icon) }) }}
                                </a>
                            {% else %}
                                <span>{{ field.label|trans|raw }}</span>
                            {% endif %}
                        </th>
                    {% endfor %}

                    <th class=\"{{ ea.crud.showEntityActionsAsDropdown ? 'actions-as-dropdown-table-head' }}\" dir=\"{{ ea.i18n.textDirection }}\">
                        <span class=\"visually-hidden\">{{ t('action.entity_actions', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}</span>
                    </th>
                </tr>
            {% endblock table_head %}
            </thead>
        {% endif %}

        <tbody>
        {% block table_body %}
            {% for entity in entities %}
                {% block table_body_row %}
                {% if entity.isAccessible %}
                    <tr data-id=\"{{ entity.primaryKeyValueAsString }}\" {% if entity.defaultActionUrl %}data-default-action-url=\"{{ entity.defaultActionUrl }}\" class=\"ea-clickable-row\" role=\"link\" tabindex=\"0\"{% endif %} {% block entity_row_attributes %}{% endblock %}>
                        {% if has_batch_actions %}
                            <td class=\"batch-actions-selector\">
                                <div class=\"form-check\">
                                    <input type=\"checkbox\" class=\"form-check-input form-batch-checkbox\" id=\"form-batch-checkbox-{{ loop.index0 }}\" value=\"{{ entity.primaryKeyValue }}\">
                                </div>
                            </td>
                        {% endif %}

                        {% for field in entity.fields %}
                            {% set is_searchable = null == ea.crud.searchFields or field.property in ea.crud.searchFields %}

                            <td data-column=\"{{ field.property }}\" data-label=\"{{ field.label|trans|e('html') }}\" class=\"{{ is_searchable ? 'searchable' }} {{ field.property == sort_field_name ? 'sorted' }} text-{{ field.textAlign }} {{ field.cssClass }}\" dir=\"{{ ea.i18n.textDirection }}\" {% for name, value in field.htmlAttributes %}{{ name }}=\"{{ value|e('html_attr') }}\" {% endfor %}>
                                {{ include(field.templatePath, {field: field, entity: entity}, with_context: false) }}
                            </td>
                        {% endfor %}

                        {% block entity_actions %}
                            <td class=\"actions {{ ea.crud.showEntityActionsAsDropdown ? 'actions-as-dropdown' }}\">
                                {% if entity.actions.count > 0 %}
                                    {% if ea.crud.showEntityActionsAsDropdown %}
                                        {% set hasAnyActionWithIcon = entity.actions|filter(item => item.isActionGroup ? false : item.icon is not null)|length > 0 %}
                                        {% component 'ea:ActionMenu' with { class: 'dropdown-actions' } %}
                                            {% block content %}{% component 'ea:ActionMenu:Button' with { withoutDropdownToggleMarker: true } %}
                                                {% block content %}{{ component('ea:Icon', { name: 'internal:dots-horizontal' }) }}
                                            {% endblock %}{% endcomponent %}

                                            {% component 'ea:ActionMenu:Overlay' %}
                                                {% block content %}{% component 'ea:ActionMenu:ActionList' with { hasSubmenus: (entity.actions|filter(item => item.isActionGroup)|length > 0) } %}
                                                    {% block content %}{% for item in entity.actions %}
                                                        {% if item.isActionGroup %}
                                                            {{ component('ea:ActionMenu:ActionList:ItemGroup', { group: (item), showBlankIcons: (hasAnyActionWithIcon), entity: (entity) }) }}
                                                        {% else %}
                                                            {{ component('ea:ActionMenu:ActionList:Item', { class: (item.cssClass)~' dropdown-item-variant-'~(item.variant.value), url: (item.linkUrl), icon: (item.icon), 'icon:class': 'action-icon', htmlAttributes: (item.htmlAttributes|ea_html_attrs), renderAsForm: (item.isRenderedAsForm), label: (item.label|trans), 'label:class': 'action-label', renderLabelRaw: true, showBlankIcons: (hasAnyActionWithIcon) }) }}
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}{% endcomponent %}
                                            {% endblock %}{% endcomponent %}
                                        {% endblock %}{% endcomponent %}
                                    {% else %}
                                        {% for action in entity.actions %}
                                            {% if action.isActionGroup %}
                                                {{ include(action.templatePath, {group: action, entity: entity}, with_context: false) }}
                                            {% else %}
                                                {{ include(action.templatePath, {action: action, entity: entity, isIncludedInDropdown: ea.crud.showEntityActionsAsDropdown}, with_context: false) }}
                                            {% endif %}
                                        {% endfor %}
                                    {% endif %}
                                {% endif %}
                            </td>
                        {% endblock entity_actions %}
                    </tr>

                {% endif %}
                {% endblock table_body_row %}
            {% else %}
                {% block table_body_empty %}
                    {% for i in 1..14 %}
                        <tr class=\"empty-row\">
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                        </tr>

                        {% if 3 == loop.index %}
                            <tr class=\"no-results\">
                                <td colspan=\"100\">
                                    {{ t('datagrid.no_results', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}
                                </td>
                            </tr>
                        {% endif %}
                    {% endfor %}
                {% endblock table_body_empty %}
            {% endfor %}

            {% if some_results_are_hidden %}
                <tr class=\"datagrid-row-empty\">
                    <td class=\"text-center\" colspan=\"100\">
                        <span class=\"datagrid-row-empty-message\">{{ component('ea:Icon', { name: 'internal:lock', class: 'mr-1' }) }} {{ 'datagrid.hidden_results'|trans({}, 'EasyAdminBundle') }}</span>
                    </td>
                </tr>
            {% endif %}
        {% endblock table_body %}
        </tbody>

        <tfoot>
        {% block table_footer %}
        {% endblock table_footer %}
        </tfoot>
    </table>

    {% if entities|length > 0 %}
        <div class=\"content-panel-footer without-padding without-border\">
            {% block paginator %}
                {{ include(ea.templatePath('crud/paginator'), {render_detailed_pagination: not some_results_are_hidden}) }}
            {% endblock paginator %}
        </div>
    {% endif %}

    {% block delete_form %}
        {{ include('@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig', with_context: false) }}
    {% endblock delete_form %}

    {% if has_filters %}
        {{ include('@EasyAdmin/crud/includes/_filters_modal.html.twig') }}
    {% endif %}

    {% if has_batch_actions %}
        {{ include('@EasyAdmin/crud/includes/_batch_action_modal.html.twig', {}, with_context: false) }}
    {% endif %}
{% endblock main %}
", "@EasyAdmin/crud/index.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\index.html.twig");
    }
}


/* @EasyAdmin/crud/index.html.twig */
class __TwigTemplate_bf31adcbeeb706895206ce00b8ae55ac___27663508481 extends Template
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
        // line 168
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 168, $this->source); })()), 168);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/index.html.twig"));

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

    // line 169
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $_v3 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v3->preRender("ea:ActionMenu:Button", Twig\Extension\CoreExtension::toArray(["withoutDropdownToggleMarker" => true]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v3->startEmbedComponent("ea:ActionMenu:Button", Twig\Extension\CoreExtension::toArray(["withoutDropdownToggleMarker" => true]), $context, "@EasyAdmin/crud/index.html.twig", 35549415901);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 35549415901);
            $this->load("@EasyAdmin/crud/index.html.twig", 169, "35549415901")->display($embeddedContext, $embeddedBlocks);
            $_v3->finishEmbedComponent();
        }
        // line 172
        yield "
                                            ";
        // line 173
        $_v4 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v4->preRender("ea:ActionMenu:Overlay", Twig\Extension\CoreExtension::toArray([]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v4->startEmbedComponent("ea:ActionMenu:Overlay", Twig\Extension\CoreExtension::toArray([]), $context, "@EasyAdmin/crud/index.html.twig", 7074454491);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 7074454491);
            $this->load("@EasyAdmin/crud/index.html.twig", 173, "7074454491")->display($embeddedContext, $embeddedBlocks);
            $_v4->finishEmbedComponent();
        }
        // line 184
        yield "                                        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/crud/index.html.twig";
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
        return array (  1507 => 184,  1493 => 173,  1490 => 172,  1467 => 169,  1436 => 168,  1112 => 249,  1102 => 248,  1091 => 243,  1081 => 242,  1073 => 236,  1063 => 235,  1055 => 221,  1041 => 220,  1035 => 216,  1033 => 6,  1032 => 216,  1028 => 214,  1026 => 213,  1015 => 204,  997 => 203,  987 => 202,  978 => 195,  975 => 194,  972 => 193,  966 => 192,  960 => 190,  954 => 188,  951 => 187,  946 => 186,  943 => 185,  928 => 168,  925 => 167,  922 => 166,  920 => 165,  915 => 164,  905 => 163,  889 => 146,  881 => 200,  876 => 197,  874 => 163,  871 => 162,  862 => 159,  837 => 158,  835 => 6,  832 => 158,  829 => 157,  826 => 156,  822 => 155,  819 => 154,  810 => 150,  806 => 148,  804 => 147,  791 => 146,  788 => 145,  778 => 144,  770 => 231,  761 => 227,  757 => 225,  755 => 224,  752 => 223,  746 => 222,  743 => 202,  730 => 201,  727 => 144,  708 => 143,  698 => 142,  687 => 134,  685 => 6,  684 => 134,  678 => 133,  675 => 132,  668 => 130,  664 => 128,  662 => 6,  660 => 128,  653 => 125,  651 => 6,  650 => 125,  646 => 124,  643 => 123,  640 => 122,  638 => 121,  620 => 120,  617 => 119,  614 => 118,  611 => 117,  608 => 116,  605 => 115,  600 => 114,  597 => 113,  595 => 112,  592 => 111,  584 => 105,  582 => 104,  579 => 103,  569 => 102,  557 => 257,  555 => 256,  552 => 255,  546 => 253,  544 => 252,  541 => 251,  539 => 248,  536 => 247,  532 => 245,  530 => 242,  527 => 241,  525 => 240,  520 => 237,  518 => 235,  513 => 232,  511 => 142,  507 => 140,  503 => 138,  501 => 102,  498 => 101,  496 => 100,  490 => 99,  487 => 98,  484 => 97,  481 => 96,  478 => 95,  475 => 94,  472 => 93,  469 => 92,  466 => 91,  463 => 90,  461 => 89,  451 => 88,  443 => 85,  439 => 83,  430 => 81,  426 => 80,  423 => 79,  420 => 78,  410 => 77,  401 => 75,  395 => 74,  389 => 72,  383 => 70,  380 => 69,  376 => 68,  373 => 67,  363 => 66,  354 => 61,  348 => 58,  343 => 57,  341 => 56,  338 => 55,  332 => 54,  330 => 6,  327 => 54,  321 => 53,  318 => 52,  315 => 51,  305 => 50,  296 => 77,  294 => 66,  291 => 65,  287 => 63,  285 => 50,  282 => 49,  279 => 48,  269 => 47,  261 => 6,  260 => 43,  259 => 6,  258 => 42,  257 => 41,  255 => 40,  245 => 39,  235 => 36,  231 => 35,  226 => 34,  216 => 33,  206 => 30,  202 => 29,  197 => 28,  187 => 27,  172 => 23,  168 => 22,  163 => 21,  153 => 20,  138 => 16,  134 => 15,  129 => 14,  119 => 13,  102 => 9,  85 => 8,  78 => 5,  76 => 46,  74 => 11,  72 => 6,  70 => 4,  60 => 5,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{# @var entities \\EasyCorp\\Bundle\\EasyAdminBundle\\Collection\\EntityCollection #}
{# @var paginator \\EasyCorp\\Bundle\\EasyAdminBundle\\Orm\\EntityPaginator #}
{% set ea = ea() %}
{% extends ea.templatePath('layout') %}
{% trans_default_domain ea.i18n.translationDomain %}

{% block body_id entities|length > 0 ? 'ea-index-' ~ entities|first.name : '' %}
{% block body_class 'ea-index' ~ (entities|length > 0 ? ' ea-index-' ~ entities|first.name : '') %}

{% set ea_field_assets = ea.crud.fieldAssets(constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Crud::PAGE_INDEX')) %}

{% block configured_head_contents %}
    {{ parent() }}
    {% for htmlContent in ea_field_assets.headContents %}
        {{ htmlContent|raw }}
    {% endfor %}
{% endblock %}

{% block configured_body_contents %}
    {{ parent() }}
    {% for htmlContent in ea_field_assets.bodyContents %}
        {{ htmlContent|raw }}
    {% endfor %}
{% endblock %}

{% block configured_stylesheets %}
    {{ parent() }}
    {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea_field_assets.cssAssets}, with_context: false) }}
    {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea_field_assets.webpackEncoreAssets}, with_context: false) }}
{% endblock %}

{% block configured_javascripts %}
    {{ parent() }}
    {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea_field_assets.jsAssets}, with_context: false) }}
    {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea_field_assets.webpackEncoreAssets}, with_context: false) }}
{% endblock %}

{% block content_title %}
    {%- set custom_page_title = ea.crud.customPageTitle('index', null, ea.i18n.translationParameters, ea.i18n.translationDomain) -%}
    {{- custom_page_title is null
        ? ea.crud.defaultPageTitle('index', null, ea.i18n.translationParameters)|trans|raw
        : custom_page_title|trans|raw -}}
{% endblock %}

{% set has_batch_actions = batch_actions|length > 0 %}
{% block page_actions %}
    {% if filters|length > 0 %}
        <div class=\"datagrid-filters\">
            {% block filters %}
                {% set applied_filters = ea.request.query.all['filters']|default([])|keys %}
                <div class=\"btn-group action-filters\">
                    <a href=\"#\" data-href=\"{{ ea_url().setAction('renderFilters') }}\" class=\"btn btn-secondary btn-labeled btn-labeled-right action-filters-button disabled {{ applied_filters ? 'action-filters-applied' }}\" data-bs-toggle=\"modal\" data-bs-target=\"#modal-filters\">
                        {{ component('ea:Icon', { name: 'internal:filter' }) }} {{ t('filter.title', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}{% if applied_filters %} <span class=\"action-filters-button-count\">({{ applied_filters|length }})</span>{% endif %}
                    </a>
                    {% if applied_filters %}
                        <a href=\"{{ ea_url().unset('filters').setAction('index') }}\" class=\"btn btn-secondary action-filters-reset\">
                            {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                        </a>
                    {% endif %}
                </div>
            {% endblock filters %}
        </div>
    {% endif %}

    {% block global_actions %}
        <div class=\"global-actions\">
            {% for item in global_actions|reverse %}
                {% if item.isActionGroup %}
                    {{ include(item.templatePath, {group: item, entity: null}, with_context: false) }}
                {% else %}
                    {{ include(item.templatePath, {action: item}, with_context: false) }}
                {% endif %}
            {% endfor %}
        </div>
    {% endblock global_actions %}
    {% block batch_actions %}
        {% if has_batch_actions %}
            <div class=\"batch-actions d-none\">
                {% for action in batch_actions %}
                    {{ include(action.templatePath, {action: action}, with_context: false) }}
                {% endfor %}
            </div>
        {% endif %}
    {% endblock %}
{% endblock page_actions %}

{% block main %}
    {# sort can be multiple; let's consider the sorting field the first one #}
    {% set sort_params = app.request.query.all['sort']|default({}) %}
    {% set sort_field_name = sort_params|keys|first %}
    {% set sort_order = sort_params|first %}
    {% set some_results_are_hidden = entities|reduce((some_results_are_hidden, entity) => some_results_are_hidden or not entity.isAccessible, false) %}
    {% set has_footer = entities|length != 0 %}
    {% set has_search = ea.crud.isSearchEnabled %}
    {% set has_filters = filters|length > 0 %}
    {% set num_results = entities|length %}

    <table class=\"table datagrid {{ entities is empty ? 'datagrid-empty' }}\" data-default-action-trigger=\"{{ ea.crud.defaultRowActionTrigger }}\">
        {% if num_results > 0 %}
            <thead>
            {% block table_head %}
                <tr>
                    {% if has_batch_actions %}
                        <th>
                            <div class=\"form-check\">
                                <span><input type=\"checkbox\" class=\"form-check-input form-batch-checkbox-all\" id=\"form-batch-checkbox-all\"></span>
                            </div>
                        </th>
                    {% endif %}

                    {% set ea_sort_asc = constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Option\\\\SortOrder::ASC') %}
                    {% set ea_sort_desc = constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Option\\\\SortOrder::DESC') %}
                    {% for field in entities|filter(e => e.isAccessible)|first.fields ?? [] %}
                        {% set is_searchable = null == ea.crud.searchFields or field.property in ea.crud.searchFields %}
                        {% set is_sorting_field = ea.search.isSortingField(field.property) %}
                        {% set next_sort_direction = is_sorting_field ? (ea.search.sortDirection(field.property) == ea_sort_desc ? ea_sort_asc : ea_sort_desc) : ea_sort_desc %}
                        {% set column_icon = is_sorting_field ? (next_sort_direction == ea_sort_desc ? 'internal:sort-arrow-up' : 'internal:sort-arrow-down') : 'internal:sort-arrows' %}

                        <th data-column=\"{{ field.property }}\" class=\"{{ field.cssClass }} {{ is_searchable ? 'searchable' }} {{ is_sorting_field ? 'sorted' }} {{ field.isVirtual ? 'field-virtual' }} header-for-{{ field.cssClass|split(' ')|filter(class => class starts with 'field-')|join('') }} text-{{ field.textAlign }}\" dir=\"{{ ea.i18n.textDirection }}\">
                            {% if field.isSortable %}
                                {% set sortable_url = ea_url().setController(ea.request.attributes.get('crudControllerFqcn')).setAction('index').set('page', 1).set('sort', {(field.property): next_sort_direction}) %}

                                <a href=\"{{ sortable_url }}\">
                                    {{ field.label|trans|raw }} {{ component('ea:Icon', { name: (column_icon) }) }}
                                </a>
                            {% else %}
                                <span>{{ field.label|trans|raw }}</span>
                            {% endif %}
                        </th>
                    {% endfor %}

                    <th class=\"{{ ea.crud.showEntityActionsAsDropdown ? 'actions-as-dropdown-table-head' }}\" dir=\"{{ ea.i18n.textDirection }}\">
                        <span class=\"visually-hidden\">{{ t('action.entity_actions', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}</span>
                    </th>
                </tr>
            {% endblock table_head %}
            </thead>
        {% endif %}

        <tbody>
        {% block table_body %}
            {% for entity in entities %}
                {% block table_body_row %}
                {% if entity.isAccessible %}
                    <tr data-id=\"{{ entity.primaryKeyValueAsString }}\" {% if entity.defaultActionUrl %}data-default-action-url=\"{{ entity.defaultActionUrl }}\" class=\"ea-clickable-row\" role=\"link\" tabindex=\"0\"{% endif %} {% block entity_row_attributes %}{% endblock %}>
                        {% if has_batch_actions %}
                            <td class=\"batch-actions-selector\">
                                <div class=\"form-check\">
                                    <input type=\"checkbox\" class=\"form-check-input form-batch-checkbox\" id=\"form-batch-checkbox-{{ loop.index0 }}\" value=\"{{ entity.primaryKeyValue }}\">
                                </div>
                            </td>
                        {% endif %}

                        {% for field in entity.fields %}
                            {% set is_searchable = null == ea.crud.searchFields or field.property in ea.crud.searchFields %}

                            <td data-column=\"{{ field.property }}\" data-label=\"{{ field.label|trans|e('html') }}\" class=\"{{ is_searchable ? 'searchable' }} {{ field.property == sort_field_name ? 'sorted' }} text-{{ field.textAlign }} {{ field.cssClass }}\" dir=\"{{ ea.i18n.textDirection }}\" {% for name, value in field.htmlAttributes %}{{ name }}=\"{{ value|e('html_attr') }}\" {% endfor %}>
                                {{ include(field.templatePath, {field: field, entity: entity}, with_context: false) }}
                            </td>
                        {% endfor %}

                        {% block entity_actions %}
                            <td class=\"actions {{ ea.crud.showEntityActionsAsDropdown ? 'actions-as-dropdown' }}\">
                                {% if entity.actions.count > 0 %}
                                    {% if ea.crud.showEntityActionsAsDropdown %}
                                        {% set hasAnyActionWithIcon = entity.actions|filter(item => item.isActionGroup ? false : item.icon is not null)|length > 0 %}
                                        {% component 'ea:ActionMenu' with { class: 'dropdown-actions' } %}
                                            {% block content %}{% component 'ea:ActionMenu:Button' with { withoutDropdownToggleMarker: true } %}
                                                {% block content %}{{ component('ea:Icon', { name: 'internal:dots-horizontal' }) }}
                                            {% endblock %}{% endcomponent %}

                                            {% component 'ea:ActionMenu:Overlay' %}
                                                {% block content %}{% component 'ea:ActionMenu:ActionList' with { hasSubmenus: (entity.actions|filter(item => item.isActionGroup)|length > 0) } %}
                                                    {% block content %}{% for item in entity.actions %}
                                                        {% if item.isActionGroup %}
                                                            {{ component('ea:ActionMenu:ActionList:ItemGroup', { group: (item), showBlankIcons: (hasAnyActionWithIcon), entity: (entity) }) }}
                                                        {% else %}
                                                            {{ component('ea:ActionMenu:ActionList:Item', { class: (item.cssClass)~' dropdown-item-variant-'~(item.variant.value), url: (item.linkUrl), icon: (item.icon), 'icon:class': 'action-icon', htmlAttributes: (item.htmlAttributes|ea_html_attrs), renderAsForm: (item.isRenderedAsForm), label: (item.label|trans), 'label:class': 'action-label', renderLabelRaw: true, showBlankIcons: (hasAnyActionWithIcon) }) }}
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}{% endcomponent %}
                                            {% endblock %}{% endcomponent %}
                                        {% endblock %}{% endcomponent %}
                                    {% else %}
                                        {% for action in entity.actions %}
                                            {% if action.isActionGroup %}
                                                {{ include(action.templatePath, {group: action, entity: entity}, with_context: false) }}
                                            {% else %}
                                                {{ include(action.templatePath, {action: action, entity: entity, isIncludedInDropdown: ea.crud.showEntityActionsAsDropdown}, with_context: false) }}
                                            {% endif %}
                                        {% endfor %}
                                    {% endif %}
                                {% endif %}
                            </td>
                        {% endblock entity_actions %}
                    </tr>

                {% endif %}
                {% endblock table_body_row %}
            {% else %}
                {% block table_body_empty %}
                    {% for i in 1..14 %}
                        <tr class=\"empty-row\">
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                        </tr>

                        {% if 3 == loop.index %}
                            <tr class=\"no-results\">
                                <td colspan=\"100\">
                                    {{ t('datagrid.no_results', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}
                                </td>
                            </tr>
                        {% endif %}
                    {% endfor %}
                {% endblock table_body_empty %}
            {% endfor %}

            {% if some_results_are_hidden %}
                <tr class=\"datagrid-row-empty\">
                    <td class=\"text-center\" colspan=\"100\">
                        <span class=\"datagrid-row-empty-message\">{{ component('ea:Icon', { name: 'internal:lock', class: 'mr-1' }) }} {{ 'datagrid.hidden_results'|trans({}, 'EasyAdminBundle') }}</span>
                    </td>
                </tr>
            {% endif %}
        {% endblock table_body %}
        </tbody>

        <tfoot>
        {% block table_footer %}
        {% endblock table_footer %}
        </tfoot>
    </table>

    {% if entities|length > 0 %}
        <div class=\"content-panel-footer without-padding without-border\">
            {% block paginator %}
                {{ include(ea.templatePath('crud/paginator'), {render_detailed_pagination: not some_results_are_hidden}) }}
            {% endblock paginator %}
        </div>
    {% endif %}

    {% block delete_form %}
        {{ include('@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig', with_context: false) }}
    {% endblock delete_form %}

    {% if has_filters %}
        {{ include('@EasyAdmin/crud/includes/_filters_modal.html.twig') }}
    {% endif %}

    {% if has_batch_actions %}
        {{ include('@EasyAdmin/crud/includes/_batch_action_modal.html.twig', {}, with_context: false) }}
    {% endif %}
{% endblock main %}
", "@EasyAdmin/crud/index.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\index.html.twig");
    }
}


/* @EasyAdmin/crud/index.html.twig */
class __TwigTemplate_bf31adcbeeb706895206ce00b8ae55ac___35549415901 extends Template
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
        // line 169
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 169, $this->source); })()), 169);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/index.html.twig"));

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

    // line 170
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:dots-horizontal"]);
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
        return "@EasyAdmin/crud/index.html.twig";
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
        return array (  1859 => 170,  1828 => 169,  1507 => 184,  1493 => 173,  1490 => 172,  1467 => 169,  1436 => 168,  1112 => 249,  1102 => 248,  1091 => 243,  1081 => 242,  1073 => 236,  1063 => 235,  1055 => 221,  1041 => 220,  1035 => 216,  1033 => 6,  1032 => 216,  1028 => 214,  1026 => 213,  1015 => 204,  997 => 203,  987 => 202,  978 => 195,  975 => 194,  972 => 193,  966 => 192,  960 => 190,  954 => 188,  951 => 187,  946 => 186,  943 => 185,  928 => 168,  925 => 167,  922 => 166,  920 => 165,  915 => 164,  905 => 163,  889 => 146,  881 => 200,  876 => 197,  874 => 163,  871 => 162,  862 => 159,  837 => 158,  835 => 6,  832 => 158,  829 => 157,  826 => 156,  822 => 155,  819 => 154,  810 => 150,  806 => 148,  804 => 147,  791 => 146,  788 => 145,  778 => 144,  770 => 231,  761 => 227,  757 => 225,  755 => 224,  752 => 223,  746 => 222,  743 => 202,  730 => 201,  727 => 144,  708 => 143,  698 => 142,  687 => 134,  685 => 6,  684 => 134,  678 => 133,  675 => 132,  668 => 130,  664 => 128,  662 => 6,  660 => 128,  653 => 125,  651 => 6,  650 => 125,  646 => 124,  643 => 123,  640 => 122,  638 => 121,  620 => 120,  617 => 119,  614 => 118,  611 => 117,  608 => 116,  605 => 115,  600 => 114,  597 => 113,  595 => 112,  592 => 111,  584 => 105,  582 => 104,  579 => 103,  569 => 102,  557 => 257,  555 => 256,  552 => 255,  546 => 253,  544 => 252,  541 => 251,  539 => 248,  536 => 247,  532 => 245,  530 => 242,  527 => 241,  525 => 240,  520 => 237,  518 => 235,  513 => 232,  511 => 142,  507 => 140,  503 => 138,  501 => 102,  498 => 101,  496 => 100,  490 => 99,  487 => 98,  484 => 97,  481 => 96,  478 => 95,  475 => 94,  472 => 93,  469 => 92,  466 => 91,  463 => 90,  461 => 89,  451 => 88,  443 => 85,  439 => 83,  430 => 81,  426 => 80,  423 => 79,  420 => 78,  410 => 77,  401 => 75,  395 => 74,  389 => 72,  383 => 70,  380 => 69,  376 => 68,  373 => 67,  363 => 66,  354 => 61,  348 => 58,  343 => 57,  341 => 56,  338 => 55,  332 => 54,  330 => 6,  327 => 54,  321 => 53,  318 => 52,  315 => 51,  305 => 50,  296 => 77,  294 => 66,  291 => 65,  287 => 63,  285 => 50,  282 => 49,  279 => 48,  269 => 47,  261 => 6,  260 => 43,  259 => 6,  258 => 42,  257 => 41,  255 => 40,  245 => 39,  235 => 36,  231 => 35,  226 => 34,  216 => 33,  206 => 30,  202 => 29,  197 => 28,  187 => 27,  172 => 23,  168 => 22,  163 => 21,  153 => 20,  138 => 16,  134 => 15,  129 => 14,  119 => 13,  102 => 9,  85 => 8,  78 => 5,  76 => 46,  74 => 11,  72 => 6,  70 => 4,  60 => 5,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{# @var entities \\EasyCorp\\Bundle\\EasyAdminBundle\\Collection\\EntityCollection #}
{# @var paginator \\EasyCorp\\Bundle\\EasyAdminBundle\\Orm\\EntityPaginator #}
{% set ea = ea() %}
{% extends ea.templatePath('layout') %}
{% trans_default_domain ea.i18n.translationDomain %}

{% block body_id entities|length > 0 ? 'ea-index-' ~ entities|first.name : '' %}
{% block body_class 'ea-index' ~ (entities|length > 0 ? ' ea-index-' ~ entities|first.name : '') %}

{% set ea_field_assets = ea.crud.fieldAssets(constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Crud::PAGE_INDEX')) %}

{% block configured_head_contents %}
    {{ parent() }}
    {% for htmlContent in ea_field_assets.headContents %}
        {{ htmlContent|raw }}
    {% endfor %}
{% endblock %}

{% block configured_body_contents %}
    {{ parent() }}
    {% for htmlContent in ea_field_assets.bodyContents %}
        {{ htmlContent|raw }}
    {% endfor %}
{% endblock %}

{% block configured_stylesheets %}
    {{ parent() }}
    {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea_field_assets.cssAssets}, with_context: false) }}
    {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea_field_assets.webpackEncoreAssets}, with_context: false) }}
{% endblock %}

{% block configured_javascripts %}
    {{ parent() }}
    {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea_field_assets.jsAssets}, with_context: false) }}
    {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea_field_assets.webpackEncoreAssets}, with_context: false) }}
{% endblock %}

{% block content_title %}
    {%- set custom_page_title = ea.crud.customPageTitle('index', null, ea.i18n.translationParameters, ea.i18n.translationDomain) -%}
    {{- custom_page_title is null
        ? ea.crud.defaultPageTitle('index', null, ea.i18n.translationParameters)|trans|raw
        : custom_page_title|trans|raw -}}
{% endblock %}

{% set has_batch_actions = batch_actions|length > 0 %}
{% block page_actions %}
    {% if filters|length > 0 %}
        <div class=\"datagrid-filters\">
            {% block filters %}
                {% set applied_filters = ea.request.query.all['filters']|default([])|keys %}
                <div class=\"btn-group action-filters\">
                    <a href=\"#\" data-href=\"{{ ea_url().setAction('renderFilters') }}\" class=\"btn btn-secondary btn-labeled btn-labeled-right action-filters-button disabled {{ applied_filters ? 'action-filters-applied' }}\" data-bs-toggle=\"modal\" data-bs-target=\"#modal-filters\">
                        {{ component('ea:Icon', { name: 'internal:filter' }) }} {{ t('filter.title', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}{% if applied_filters %} <span class=\"action-filters-button-count\">({{ applied_filters|length }})</span>{% endif %}
                    </a>
                    {% if applied_filters %}
                        <a href=\"{{ ea_url().unset('filters').setAction('index') }}\" class=\"btn btn-secondary action-filters-reset\">
                            {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                        </a>
                    {% endif %}
                </div>
            {% endblock filters %}
        </div>
    {% endif %}

    {% block global_actions %}
        <div class=\"global-actions\">
            {% for item in global_actions|reverse %}
                {% if item.isActionGroup %}
                    {{ include(item.templatePath, {group: item, entity: null}, with_context: false) }}
                {% else %}
                    {{ include(item.templatePath, {action: item}, with_context: false) }}
                {% endif %}
            {% endfor %}
        </div>
    {% endblock global_actions %}
    {% block batch_actions %}
        {% if has_batch_actions %}
            <div class=\"batch-actions d-none\">
                {% for action in batch_actions %}
                    {{ include(action.templatePath, {action: action}, with_context: false) }}
                {% endfor %}
            </div>
        {% endif %}
    {% endblock %}
{% endblock page_actions %}

{% block main %}
    {# sort can be multiple; let's consider the sorting field the first one #}
    {% set sort_params = app.request.query.all['sort']|default({}) %}
    {% set sort_field_name = sort_params|keys|first %}
    {% set sort_order = sort_params|first %}
    {% set some_results_are_hidden = entities|reduce((some_results_are_hidden, entity) => some_results_are_hidden or not entity.isAccessible, false) %}
    {% set has_footer = entities|length != 0 %}
    {% set has_search = ea.crud.isSearchEnabled %}
    {% set has_filters = filters|length > 0 %}
    {% set num_results = entities|length %}

    <table class=\"table datagrid {{ entities is empty ? 'datagrid-empty' }}\" data-default-action-trigger=\"{{ ea.crud.defaultRowActionTrigger }}\">
        {% if num_results > 0 %}
            <thead>
            {% block table_head %}
                <tr>
                    {% if has_batch_actions %}
                        <th>
                            <div class=\"form-check\">
                                <span><input type=\"checkbox\" class=\"form-check-input form-batch-checkbox-all\" id=\"form-batch-checkbox-all\"></span>
                            </div>
                        </th>
                    {% endif %}

                    {% set ea_sort_asc = constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Option\\\\SortOrder::ASC') %}
                    {% set ea_sort_desc = constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Option\\\\SortOrder::DESC') %}
                    {% for field in entities|filter(e => e.isAccessible)|first.fields ?? [] %}
                        {% set is_searchable = null == ea.crud.searchFields or field.property in ea.crud.searchFields %}
                        {% set is_sorting_field = ea.search.isSortingField(field.property) %}
                        {% set next_sort_direction = is_sorting_field ? (ea.search.sortDirection(field.property) == ea_sort_desc ? ea_sort_asc : ea_sort_desc) : ea_sort_desc %}
                        {% set column_icon = is_sorting_field ? (next_sort_direction == ea_sort_desc ? 'internal:sort-arrow-up' : 'internal:sort-arrow-down') : 'internal:sort-arrows' %}

                        <th data-column=\"{{ field.property }}\" class=\"{{ field.cssClass }} {{ is_searchable ? 'searchable' }} {{ is_sorting_field ? 'sorted' }} {{ field.isVirtual ? 'field-virtual' }} header-for-{{ field.cssClass|split(' ')|filter(class => class starts with 'field-')|join('') }} text-{{ field.textAlign }}\" dir=\"{{ ea.i18n.textDirection }}\">
                            {% if field.isSortable %}
                                {% set sortable_url = ea_url().setController(ea.request.attributes.get('crudControllerFqcn')).setAction('index').set('page', 1).set('sort', {(field.property): next_sort_direction}) %}

                                <a href=\"{{ sortable_url }}\">
                                    {{ field.label|trans|raw }} {{ component('ea:Icon', { name: (column_icon) }) }}
                                </a>
                            {% else %}
                                <span>{{ field.label|trans|raw }}</span>
                            {% endif %}
                        </th>
                    {% endfor %}

                    <th class=\"{{ ea.crud.showEntityActionsAsDropdown ? 'actions-as-dropdown-table-head' }}\" dir=\"{{ ea.i18n.textDirection }}\">
                        <span class=\"visually-hidden\">{{ t('action.entity_actions', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}</span>
                    </th>
                </tr>
            {% endblock table_head %}
            </thead>
        {% endif %}

        <tbody>
        {% block table_body %}
            {% for entity in entities %}
                {% block table_body_row %}
                {% if entity.isAccessible %}
                    <tr data-id=\"{{ entity.primaryKeyValueAsString }}\" {% if entity.defaultActionUrl %}data-default-action-url=\"{{ entity.defaultActionUrl }}\" class=\"ea-clickable-row\" role=\"link\" tabindex=\"0\"{% endif %} {% block entity_row_attributes %}{% endblock %}>
                        {% if has_batch_actions %}
                            <td class=\"batch-actions-selector\">
                                <div class=\"form-check\">
                                    <input type=\"checkbox\" class=\"form-check-input form-batch-checkbox\" id=\"form-batch-checkbox-{{ loop.index0 }}\" value=\"{{ entity.primaryKeyValue }}\">
                                </div>
                            </td>
                        {% endif %}

                        {% for field in entity.fields %}
                            {% set is_searchable = null == ea.crud.searchFields or field.property in ea.crud.searchFields %}

                            <td data-column=\"{{ field.property }}\" data-label=\"{{ field.label|trans|e('html') }}\" class=\"{{ is_searchable ? 'searchable' }} {{ field.property == sort_field_name ? 'sorted' }} text-{{ field.textAlign }} {{ field.cssClass }}\" dir=\"{{ ea.i18n.textDirection }}\" {% for name, value in field.htmlAttributes %}{{ name }}=\"{{ value|e('html_attr') }}\" {% endfor %}>
                                {{ include(field.templatePath, {field: field, entity: entity}, with_context: false) }}
                            </td>
                        {% endfor %}

                        {% block entity_actions %}
                            <td class=\"actions {{ ea.crud.showEntityActionsAsDropdown ? 'actions-as-dropdown' }}\">
                                {% if entity.actions.count > 0 %}
                                    {% if ea.crud.showEntityActionsAsDropdown %}
                                        {% set hasAnyActionWithIcon = entity.actions|filter(item => item.isActionGroup ? false : item.icon is not null)|length > 0 %}
                                        {% component 'ea:ActionMenu' with { class: 'dropdown-actions' } %}
                                            {% block content %}{% component 'ea:ActionMenu:Button' with { withoutDropdownToggleMarker: true } %}
                                                {% block content %}{{ component('ea:Icon', { name: 'internal:dots-horizontal' }) }}
                                            {% endblock %}{% endcomponent %}

                                            {% component 'ea:ActionMenu:Overlay' %}
                                                {% block content %}{% component 'ea:ActionMenu:ActionList' with { hasSubmenus: (entity.actions|filter(item => item.isActionGroup)|length > 0) } %}
                                                    {% block content %}{% for item in entity.actions %}
                                                        {% if item.isActionGroup %}
                                                            {{ component('ea:ActionMenu:ActionList:ItemGroup', { group: (item), showBlankIcons: (hasAnyActionWithIcon), entity: (entity) }) }}
                                                        {% else %}
                                                            {{ component('ea:ActionMenu:ActionList:Item', { class: (item.cssClass)~' dropdown-item-variant-'~(item.variant.value), url: (item.linkUrl), icon: (item.icon), 'icon:class': 'action-icon', htmlAttributes: (item.htmlAttributes|ea_html_attrs), renderAsForm: (item.isRenderedAsForm), label: (item.label|trans), 'label:class': 'action-label', renderLabelRaw: true, showBlankIcons: (hasAnyActionWithIcon) }) }}
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}{% endcomponent %}
                                            {% endblock %}{% endcomponent %}
                                        {% endblock %}{% endcomponent %}
                                    {% else %}
                                        {% for action in entity.actions %}
                                            {% if action.isActionGroup %}
                                                {{ include(action.templatePath, {group: action, entity: entity}, with_context: false) }}
                                            {% else %}
                                                {{ include(action.templatePath, {action: action, entity: entity, isIncludedInDropdown: ea.crud.showEntityActionsAsDropdown}, with_context: false) }}
                                            {% endif %}
                                        {% endfor %}
                                    {% endif %}
                                {% endif %}
                            </td>
                        {% endblock entity_actions %}
                    </tr>

                {% endif %}
                {% endblock table_body_row %}
            {% else %}
                {% block table_body_empty %}
                    {% for i in 1..14 %}
                        <tr class=\"empty-row\">
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                        </tr>

                        {% if 3 == loop.index %}
                            <tr class=\"no-results\">
                                <td colspan=\"100\">
                                    {{ t('datagrid.no_results', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}
                                </td>
                            </tr>
                        {% endif %}
                    {% endfor %}
                {% endblock table_body_empty %}
            {% endfor %}

            {% if some_results_are_hidden %}
                <tr class=\"datagrid-row-empty\">
                    <td class=\"text-center\" colspan=\"100\">
                        <span class=\"datagrid-row-empty-message\">{{ component('ea:Icon', { name: 'internal:lock', class: 'mr-1' }) }} {{ 'datagrid.hidden_results'|trans({}, 'EasyAdminBundle') }}</span>
                    </td>
                </tr>
            {% endif %}
        {% endblock table_body %}
        </tbody>

        <tfoot>
        {% block table_footer %}
        {% endblock table_footer %}
        </tfoot>
    </table>

    {% if entities|length > 0 %}
        <div class=\"content-panel-footer without-padding without-border\">
            {% block paginator %}
                {{ include(ea.templatePath('crud/paginator'), {render_detailed_pagination: not some_results_are_hidden}) }}
            {% endblock paginator %}
        </div>
    {% endif %}

    {% block delete_form %}
        {{ include('@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig', with_context: false) }}
    {% endblock delete_form %}

    {% if has_filters %}
        {{ include('@EasyAdmin/crud/includes/_filters_modal.html.twig') }}
    {% endif %}

    {% if has_batch_actions %}
        {{ include('@EasyAdmin/crud/includes/_batch_action_modal.html.twig', {}, with_context: false) }}
    {% endif %}
{% endblock main %}
", "@EasyAdmin/crud/index.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\index.html.twig");
    }
}


/* @EasyAdmin/crud/index.html.twig */
class __TwigTemplate_bf31adcbeeb706895206ce00b8ae55ac___7074454491 extends Template
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
        // line 173
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 173, $this->source); })()), 173);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/index.html.twig"));

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

    // line 174
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $_v5 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v5->preRender("ea:ActionMenu:ActionList", Twig\Extension\CoreExtension::toArray(["hasSubmenus" => (Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 174, $this->source); })()), "actions", [], "any", false, false, false, 174), function ($__item__) use ($context, $macros) { $context["item"] = $__item__; return CoreExtension::getAttribute($this->env, $this->source, (isset($context["item"]) || array_key_exists("item", $context) ? $context["item"] : (function () { throw new RuntimeError('Variable "item" does not exist.', 174, $this->source); })()), "isActionGroup", [], "any", false, false, false, 174); })) > 0)]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v5->startEmbedComponent("ea:ActionMenu:ActionList", Twig\Extension\CoreExtension::toArray(["hasSubmenus" => (Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 174, $this->source); })()), "actions", [], "any", false, false, false, 174), function ($__item__) use ($context, $macros) { $context["item"] = $__item__; return CoreExtension::getAttribute($this->env, $this->source, (isset($context["item"]) || array_key_exists("item", $context) ? $context["item"] : (function () { throw new RuntimeError('Variable "item" does not exist.', 174, $this->source); })()), "isActionGroup", [], "any", false, false, false, 174); })) > 0)]), $context, "@EasyAdmin/crud/index.html.twig", 30250330661);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 30250330661);
            $this->load("@EasyAdmin/crud/index.html.twig", 174, "30250330661")->display($embeddedContext, $embeddedBlocks);
            $_v5->finishEmbedComponent();
        }
        // line 183
        yield "                                            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/crud/index.html.twig";
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
        return array (  2245 => 183,  2222 => 174,  2191 => 173,  1859 => 170,  1828 => 169,  1507 => 184,  1493 => 173,  1490 => 172,  1467 => 169,  1436 => 168,  1112 => 249,  1102 => 248,  1091 => 243,  1081 => 242,  1073 => 236,  1063 => 235,  1055 => 221,  1041 => 220,  1035 => 216,  1033 => 6,  1032 => 216,  1028 => 214,  1026 => 213,  1015 => 204,  997 => 203,  987 => 202,  978 => 195,  975 => 194,  972 => 193,  966 => 192,  960 => 190,  954 => 188,  951 => 187,  946 => 186,  943 => 185,  928 => 168,  925 => 167,  922 => 166,  920 => 165,  915 => 164,  905 => 163,  889 => 146,  881 => 200,  876 => 197,  874 => 163,  871 => 162,  862 => 159,  837 => 158,  835 => 6,  832 => 158,  829 => 157,  826 => 156,  822 => 155,  819 => 154,  810 => 150,  806 => 148,  804 => 147,  791 => 146,  788 => 145,  778 => 144,  770 => 231,  761 => 227,  757 => 225,  755 => 224,  752 => 223,  746 => 222,  743 => 202,  730 => 201,  727 => 144,  708 => 143,  698 => 142,  687 => 134,  685 => 6,  684 => 134,  678 => 133,  675 => 132,  668 => 130,  664 => 128,  662 => 6,  660 => 128,  653 => 125,  651 => 6,  650 => 125,  646 => 124,  643 => 123,  640 => 122,  638 => 121,  620 => 120,  617 => 119,  614 => 118,  611 => 117,  608 => 116,  605 => 115,  600 => 114,  597 => 113,  595 => 112,  592 => 111,  584 => 105,  582 => 104,  579 => 103,  569 => 102,  557 => 257,  555 => 256,  552 => 255,  546 => 253,  544 => 252,  541 => 251,  539 => 248,  536 => 247,  532 => 245,  530 => 242,  527 => 241,  525 => 240,  520 => 237,  518 => 235,  513 => 232,  511 => 142,  507 => 140,  503 => 138,  501 => 102,  498 => 101,  496 => 100,  490 => 99,  487 => 98,  484 => 97,  481 => 96,  478 => 95,  475 => 94,  472 => 93,  469 => 92,  466 => 91,  463 => 90,  461 => 89,  451 => 88,  443 => 85,  439 => 83,  430 => 81,  426 => 80,  423 => 79,  420 => 78,  410 => 77,  401 => 75,  395 => 74,  389 => 72,  383 => 70,  380 => 69,  376 => 68,  373 => 67,  363 => 66,  354 => 61,  348 => 58,  343 => 57,  341 => 56,  338 => 55,  332 => 54,  330 => 6,  327 => 54,  321 => 53,  318 => 52,  315 => 51,  305 => 50,  296 => 77,  294 => 66,  291 => 65,  287 => 63,  285 => 50,  282 => 49,  279 => 48,  269 => 47,  261 => 6,  260 => 43,  259 => 6,  258 => 42,  257 => 41,  255 => 40,  245 => 39,  235 => 36,  231 => 35,  226 => 34,  216 => 33,  206 => 30,  202 => 29,  197 => 28,  187 => 27,  172 => 23,  168 => 22,  163 => 21,  153 => 20,  138 => 16,  134 => 15,  129 => 14,  119 => 13,  102 => 9,  85 => 8,  78 => 5,  76 => 46,  74 => 11,  72 => 6,  70 => 4,  60 => 5,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{# @var entities \\EasyCorp\\Bundle\\EasyAdminBundle\\Collection\\EntityCollection #}
{# @var paginator \\EasyCorp\\Bundle\\EasyAdminBundle\\Orm\\EntityPaginator #}
{% set ea = ea() %}
{% extends ea.templatePath('layout') %}
{% trans_default_domain ea.i18n.translationDomain %}

{% block body_id entities|length > 0 ? 'ea-index-' ~ entities|first.name : '' %}
{% block body_class 'ea-index' ~ (entities|length > 0 ? ' ea-index-' ~ entities|first.name : '') %}

{% set ea_field_assets = ea.crud.fieldAssets(constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Crud::PAGE_INDEX')) %}

{% block configured_head_contents %}
    {{ parent() }}
    {% for htmlContent in ea_field_assets.headContents %}
        {{ htmlContent|raw }}
    {% endfor %}
{% endblock %}

{% block configured_body_contents %}
    {{ parent() }}
    {% for htmlContent in ea_field_assets.bodyContents %}
        {{ htmlContent|raw }}
    {% endfor %}
{% endblock %}

{% block configured_stylesheets %}
    {{ parent() }}
    {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea_field_assets.cssAssets}, with_context: false) }}
    {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea_field_assets.webpackEncoreAssets}, with_context: false) }}
{% endblock %}

{% block configured_javascripts %}
    {{ parent() }}
    {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea_field_assets.jsAssets}, with_context: false) }}
    {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea_field_assets.webpackEncoreAssets}, with_context: false) }}
{% endblock %}

{% block content_title %}
    {%- set custom_page_title = ea.crud.customPageTitle('index', null, ea.i18n.translationParameters, ea.i18n.translationDomain) -%}
    {{- custom_page_title is null
        ? ea.crud.defaultPageTitle('index', null, ea.i18n.translationParameters)|trans|raw
        : custom_page_title|trans|raw -}}
{% endblock %}

{% set has_batch_actions = batch_actions|length > 0 %}
{% block page_actions %}
    {% if filters|length > 0 %}
        <div class=\"datagrid-filters\">
            {% block filters %}
                {% set applied_filters = ea.request.query.all['filters']|default([])|keys %}
                <div class=\"btn-group action-filters\">
                    <a href=\"#\" data-href=\"{{ ea_url().setAction('renderFilters') }}\" class=\"btn btn-secondary btn-labeled btn-labeled-right action-filters-button disabled {{ applied_filters ? 'action-filters-applied' }}\" data-bs-toggle=\"modal\" data-bs-target=\"#modal-filters\">
                        {{ component('ea:Icon', { name: 'internal:filter' }) }} {{ t('filter.title', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}{% if applied_filters %} <span class=\"action-filters-button-count\">({{ applied_filters|length }})</span>{% endif %}
                    </a>
                    {% if applied_filters %}
                        <a href=\"{{ ea_url().unset('filters').setAction('index') }}\" class=\"btn btn-secondary action-filters-reset\">
                            {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                        </a>
                    {% endif %}
                </div>
            {% endblock filters %}
        </div>
    {% endif %}

    {% block global_actions %}
        <div class=\"global-actions\">
            {% for item in global_actions|reverse %}
                {% if item.isActionGroup %}
                    {{ include(item.templatePath, {group: item, entity: null}, with_context: false) }}
                {% else %}
                    {{ include(item.templatePath, {action: item}, with_context: false) }}
                {% endif %}
            {% endfor %}
        </div>
    {% endblock global_actions %}
    {% block batch_actions %}
        {% if has_batch_actions %}
            <div class=\"batch-actions d-none\">
                {% for action in batch_actions %}
                    {{ include(action.templatePath, {action: action}, with_context: false) }}
                {% endfor %}
            </div>
        {% endif %}
    {% endblock %}
{% endblock page_actions %}

{% block main %}
    {# sort can be multiple; let's consider the sorting field the first one #}
    {% set sort_params = app.request.query.all['sort']|default({}) %}
    {% set sort_field_name = sort_params|keys|first %}
    {% set sort_order = sort_params|first %}
    {% set some_results_are_hidden = entities|reduce((some_results_are_hidden, entity) => some_results_are_hidden or not entity.isAccessible, false) %}
    {% set has_footer = entities|length != 0 %}
    {% set has_search = ea.crud.isSearchEnabled %}
    {% set has_filters = filters|length > 0 %}
    {% set num_results = entities|length %}

    <table class=\"table datagrid {{ entities is empty ? 'datagrid-empty' }}\" data-default-action-trigger=\"{{ ea.crud.defaultRowActionTrigger }}\">
        {% if num_results > 0 %}
            <thead>
            {% block table_head %}
                <tr>
                    {% if has_batch_actions %}
                        <th>
                            <div class=\"form-check\">
                                <span><input type=\"checkbox\" class=\"form-check-input form-batch-checkbox-all\" id=\"form-batch-checkbox-all\"></span>
                            </div>
                        </th>
                    {% endif %}

                    {% set ea_sort_asc = constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Option\\\\SortOrder::ASC') %}
                    {% set ea_sort_desc = constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Option\\\\SortOrder::DESC') %}
                    {% for field in entities|filter(e => e.isAccessible)|first.fields ?? [] %}
                        {% set is_searchable = null == ea.crud.searchFields or field.property in ea.crud.searchFields %}
                        {% set is_sorting_field = ea.search.isSortingField(field.property) %}
                        {% set next_sort_direction = is_sorting_field ? (ea.search.sortDirection(field.property) == ea_sort_desc ? ea_sort_asc : ea_sort_desc) : ea_sort_desc %}
                        {% set column_icon = is_sorting_field ? (next_sort_direction == ea_sort_desc ? 'internal:sort-arrow-up' : 'internal:sort-arrow-down') : 'internal:sort-arrows' %}

                        <th data-column=\"{{ field.property }}\" class=\"{{ field.cssClass }} {{ is_searchable ? 'searchable' }} {{ is_sorting_field ? 'sorted' }} {{ field.isVirtual ? 'field-virtual' }} header-for-{{ field.cssClass|split(' ')|filter(class => class starts with 'field-')|join('') }} text-{{ field.textAlign }}\" dir=\"{{ ea.i18n.textDirection }}\">
                            {% if field.isSortable %}
                                {% set sortable_url = ea_url().setController(ea.request.attributes.get('crudControllerFqcn')).setAction('index').set('page', 1).set('sort', {(field.property): next_sort_direction}) %}

                                <a href=\"{{ sortable_url }}\">
                                    {{ field.label|trans|raw }} {{ component('ea:Icon', { name: (column_icon) }) }}
                                </a>
                            {% else %}
                                <span>{{ field.label|trans|raw }}</span>
                            {% endif %}
                        </th>
                    {% endfor %}

                    <th class=\"{{ ea.crud.showEntityActionsAsDropdown ? 'actions-as-dropdown-table-head' }}\" dir=\"{{ ea.i18n.textDirection }}\">
                        <span class=\"visually-hidden\">{{ t('action.entity_actions', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}</span>
                    </th>
                </tr>
            {% endblock table_head %}
            </thead>
        {% endif %}

        <tbody>
        {% block table_body %}
            {% for entity in entities %}
                {% block table_body_row %}
                {% if entity.isAccessible %}
                    <tr data-id=\"{{ entity.primaryKeyValueAsString }}\" {% if entity.defaultActionUrl %}data-default-action-url=\"{{ entity.defaultActionUrl }}\" class=\"ea-clickable-row\" role=\"link\" tabindex=\"0\"{% endif %} {% block entity_row_attributes %}{% endblock %}>
                        {% if has_batch_actions %}
                            <td class=\"batch-actions-selector\">
                                <div class=\"form-check\">
                                    <input type=\"checkbox\" class=\"form-check-input form-batch-checkbox\" id=\"form-batch-checkbox-{{ loop.index0 }}\" value=\"{{ entity.primaryKeyValue }}\">
                                </div>
                            </td>
                        {% endif %}

                        {% for field in entity.fields %}
                            {% set is_searchable = null == ea.crud.searchFields or field.property in ea.crud.searchFields %}

                            <td data-column=\"{{ field.property }}\" data-label=\"{{ field.label|trans|e('html') }}\" class=\"{{ is_searchable ? 'searchable' }} {{ field.property == sort_field_name ? 'sorted' }} text-{{ field.textAlign }} {{ field.cssClass }}\" dir=\"{{ ea.i18n.textDirection }}\" {% for name, value in field.htmlAttributes %}{{ name }}=\"{{ value|e('html_attr') }}\" {% endfor %}>
                                {{ include(field.templatePath, {field: field, entity: entity}, with_context: false) }}
                            </td>
                        {% endfor %}

                        {% block entity_actions %}
                            <td class=\"actions {{ ea.crud.showEntityActionsAsDropdown ? 'actions-as-dropdown' }}\">
                                {% if entity.actions.count > 0 %}
                                    {% if ea.crud.showEntityActionsAsDropdown %}
                                        {% set hasAnyActionWithIcon = entity.actions|filter(item => item.isActionGroup ? false : item.icon is not null)|length > 0 %}
                                        {% component 'ea:ActionMenu' with { class: 'dropdown-actions' } %}
                                            {% block content %}{% component 'ea:ActionMenu:Button' with { withoutDropdownToggleMarker: true } %}
                                                {% block content %}{{ component('ea:Icon', { name: 'internal:dots-horizontal' }) }}
                                            {% endblock %}{% endcomponent %}

                                            {% component 'ea:ActionMenu:Overlay' %}
                                                {% block content %}{% component 'ea:ActionMenu:ActionList' with { hasSubmenus: (entity.actions|filter(item => item.isActionGroup)|length > 0) } %}
                                                    {% block content %}{% for item in entity.actions %}
                                                        {% if item.isActionGroup %}
                                                            {{ component('ea:ActionMenu:ActionList:ItemGroup', { group: (item), showBlankIcons: (hasAnyActionWithIcon), entity: (entity) }) }}
                                                        {% else %}
                                                            {{ component('ea:ActionMenu:ActionList:Item', { class: (item.cssClass)~' dropdown-item-variant-'~(item.variant.value), url: (item.linkUrl), icon: (item.icon), 'icon:class': 'action-icon', htmlAttributes: (item.htmlAttributes|ea_html_attrs), renderAsForm: (item.isRenderedAsForm), label: (item.label|trans), 'label:class': 'action-label', renderLabelRaw: true, showBlankIcons: (hasAnyActionWithIcon) }) }}
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}{% endcomponent %}
                                            {% endblock %}{% endcomponent %}
                                        {% endblock %}{% endcomponent %}
                                    {% else %}
                                        {% for action in entity.actions %}
                                            {% if action.isActionGroup %}
                                                {{ include(action.templatePath, {group: action, entity: entity}, with_context: false) }}
                                            {% else %}
                                                {{ include(action.templatePath, {action: action, entity: entity, isIncludedInDropdown: ea.crud.showEntityActionsAsDropdown}, with_context: false) }}
                                            {% endif %}
                                        {% endfor %}
                                    {% endif %}
                                {% endif %}
                            </td>
                        {% endblock entity_actions %}
                    </tr>

                {% endif %}
                {% endblock table_body_row %}
            {% else %}
                {% block table_body_empty %}
                    {% for i in 1..14 %}
                        <tr class=\"empty-row\">
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                        </tr>

                        {% if 3 == loop.index %}
                            <tr class=\"no-results\">
                                <td colspan=\"100\">
                                    {{ t('datagrid.no_results', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}
                                </td>
                            </tr>
                        {% endif %}
                    {% endfor %}
                {% endblock table_body_empty %}
            {% endfor %}

            {% if some_results_are_hidden %}
                <tr class=\"datagrid-row-empty\">
                    <td class=\"text-center\" colspan=\"100\">
                        <span class=\"datagrid-row-empty-message\">{{ component('ea:Icon', { name: 'internal:lock', class: 'mr-1' }) }} {{ 'datagrid.hidden_results'|trans({}, 'EasyAdminBundle') }}</span>
                    </td>
                </tr>
            {% endif %}
        {% endblock table_body %}
        </tbody>

        <tfoot>
        {% block table_footer %}
        {% endblock table_footer %}
        </tfoot>
    </table>

    {% if entities|length > 0 %}
        <div class=\"content-panel-footer without-padding without-border\">
            {% block paginator %}
                {{ include(ea.templatePath('crud/paginator'), {render_detailed_pagination: not some_results_are_hidden}) }}
            {% endblock paginator %}
        </div>
    {% endif %}

    {% block delete_form %}
        {{ include('@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig', with_context: false) }}
    {% endblock delete_form %}

    {% if has_filters %}
        {{ include('@EasyAdmin/crud/includes/_filters_modal.html.twig') }}
    {% endif %}

    {% if has_batch_actions %}
        {{ include('@EasyAdmin/crud/includes/_batch_action_modal.html.twig', {}, with_context: false) }}
    {% endif %}
{% endblock main %}
", "@EasyAdmin/crud/index.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\index.html.twig");
    }
}


/* @EasyAdmin/crud/index.html.twig */
class __TwigTemplate_bf31adcbeeb706895206ce00b8ae55ac___30250330661 extends Template
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
        // line 174
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 174, $this->source); })()), 174);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/index.html.twig"));

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

    // line 175
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 175, $this->source); })()), "actions", [], "any", false, false, false, 175));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 176
            yield "                                                        ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "isActionGroup", [], "any", false, false, false, 176)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 177
                yield "                                                            ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:ItemGroup", ["group" => $context["item"], "showBlankIcons" => (isset($context["hasAnyActionWithIcon"]) || array_key_exists("hasAnyActionWithIcon", $context) ? $context["hasAnyActionWithIcon"] : (function () { throw new RuntimeError('Variable "hasAnyActionWithIcon" does not exist.', 177, $this->source); })()), "entity" => (isset($context["entity"]) || array_key_exists("entity", $context) ? $context["entity"] : (function () { throw new RuntimeError('Variable "entity" does not exist.', 177, $this->source); })())]);
                yield "
                                                        ";
            } else {
                // line 179
                yield "                                                            ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Item", ["class" => ((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "cssClass", [], "any", false, false, false, 179) . " dropdown-item-variant-") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "variant", [], "any", false, false, false, 179), "value", [], "any", false, false, false, 179)), "url" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "linkUrl", [], "any", false, false, false, 179), "icon" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "icon", [], "any", false, false, false, 179), "icon:class" => "action-icon", "htmlAttributes" => $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->processHtmlAttributes(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "htmlAttributes", [], "any", false, false, false, 179)), "renderAsForm" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "isRenderedAsForm", [], "any", false, false, false, 179), "label" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 179)), "label:class" => "action-label", "renderLabelRaw" => true, "showBlankIcons" => (isset($context["hasAnyActionWithIcon"]) || array_key_exists("hasAnyActionWithIcon", $context) ? $context["hasAnyActionWithIcon"] : (function () { throw new RuntimeError('Variable "hasAnyActionWithIcon" does not exist.', 179, $this->source); })())]);
                yield "
                                                        ";
            }
            // line 181
            yield "                                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 182
        yield "                                                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/crud/index.html.twig";
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
        return array (  2631 => 182,  2625 => 181,  2619 => 179,  2613 => 177,  2610 => 176,  2597 => 175,  2566 => 174,  2245 => 183,  2222 => 174,  2191 => 173,  1859 => 170,  1828 => 169,  1507 => 184,  1493 => 173,  1490 => 172,  1467 => 169,  1436 => 168,  1112 => 249,  1102 => 248,  1091 => 243,  1081 => 242,  1073 => 236,  1063 => 235,  1055 => 221,  1041 => 220,  1035 => 216,  1033 => 6,  1032 => 216,  1028 => 214,  1026 => 213,  1015 => 204,  997 => 203,  987 => 202,  978 => 195,  975 => 194,  972 => 193,  966 => 192,  960 => 190,  954 => 188,  951 => 187,  946 => 186,  943 => 185,  928 => 168,  925 => 167,  922 => 166,  920 => 165,  915 => 164,  905 => 163,  889 => 146,  881 => 200,  876 => 197,  874 => 163,  871 => 162,  862 => 159,  837 => 158,  835 => 6,  832 => 158,  829 => 157,  826 => 156,  822 => 155,  819 => 154,  810 => 150,  806 => 148,  804 => 147,  791 => 146,  788 => 145,  778 => 144,  770 => 231,  761 => 227,  757 => 225,  755 => 224,  752 => 223,  746 => 222,  743 => 202,  730 => 201,  727 => 144,  708 => 143,  698 => 142,  687 => 134,  685 => 6,  684 => 134,  678 => 133,  675 => 132,  668 => 130,  664 => 128,  662 => 6,  660 => 128,  653 => 125,  651 => 6,  650 => 125,  646 => 124,  643 => 123,  640 => 122,  638 => 121,  620 => 120,  617 => 119,  614 => 118,  611 => 117,  608 => 116,  605 => 115,  600 => 114,  597 => 113,  595 => 112,  592 => 111,  584 => 105,  582 => 104,  579 => 103,  569 => 102,  557 => 257,  555 => 256,  552 => 255,  546 => 253,  544 => 252,  541 => 251,  539 => 248,  536 => 247,  532 => 245,  530 => 242,  527 => 241,  525 => 240,  520 => 237,  518 => 235,  513 => 232,  511 => 142,  507 => 140,  503 => 138,  501 => 102,  498 => 101,  496 => 100,  490 => 99,  487 => 98,  484 => 97,  481 => 96,  478 => 95,  475 => 94,  472 => 93,  469 => 92,  466 => 91,  463 => 90,  461 => 89,  451 => 88,  443 => 85,  439 => 83,  430 => 81,  426 => 80,  423 => 79,  420 => 78,  410 => 77,  401 => 75,  395 => 74,  389 => 72,  383 => 70,  380 => 69,  376 => 68,  373 => 67,  363 => 66,  354 => 61,  348 => 58,  343 => 57,  341 => 56,  338 => 55,  332 => 54,  330 => 6,  327 => 54,  321 => 53,  318 => 52,  315 => 51,  305 => 50,  296 => 77,  294 => 66,  291 => 65,  287 => 63,  285 => 50,  282 => 49,  279 => 48,  269 => 47,  261 => 6,  260 => 43,  259 => 6,  258 => 42,  257 => 41,  255 => 40,  245 => 39,  235 => 36,  231 => 35,  226 => 34,  216 => 33,  206 => 30,  202 => 29,  197 => 28,  187 => 27,  172 => 23,  168 => 22,  163 => 21,  153 => 20,  138 => 16,  134 => 15,  129 => 14,  119 => 13,  102 => 9,  85 => 8,  78 => 5,  76 => 46,  74 => 11,  72 => 6,  70 => 4,  60 => 5,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{# @var entities \\EasyCorp\\Bundle\\EasyAdminBundle\\Collection\\EntityCollection #}
{# @var paginator \\EasyCorp\\Bundle\\EasyAdminBundle\\Orm\\EntityPaginator #}
{% set ea = ea() %}
{% extends ea.templatePath('layout') %}
{% trans_default_domain ea.i18n.translationDomain %}

{% block body_id entities|length > 0 ? 'ea-index-' ~ entities|first.name : '' %}
{% block body_class 'ea-index' ~ (entities|length > 0 ? ' ea-index-' ~ entities|first.name : '') %}

{% set ea_field_assets = ea.crud.fieldAssets(constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Crud::PAGE_INDEX')) %}

{% block configured_head_contents %}
    {{ parent() }}
    {% for htmlContent in ea_field_assets.headContents %}
        {{ htmlContent|raw }}
    {% endfor %}
{% endblock %}

{% block configured_body_contents %}
    {{ parent() }}
    {% for htmlContent in ea_field_assets.bodyContents %}
        {{ htmlContent|raw }}
    {% endfor %}
{% endblock %}

{% block configured_stylesheets %}
    {{ parent() }}
    {{ include('@EasyAdmin/includes/_css_assets.html.twig', {assets: ea_field_assets.cssAssets}, with_context: false) }}
    {{ include('@EasyAdmin/includes/_encore_link_tags.html.twig', {assets: ea_field_assets.webpackEncoreAssets}, with_context: false) }}
{% endblock %}

{% block configured_javascripts %}
    {{ parent() }}
    {{ include('@EasyAdmin/includes/_js_assets.html.twig', {assets: ea_field_assets.jsAssets}, with_context: false) }}
    {{ include('@EasyAdmin/includes/_encore_script_tags.html.twig', {assets: ea_field_assets.webpackEncoreAssets}, with_context: false) }}
{% endblock %}

{% block content_title %}
    {%- set custom_page_title = ea.crud.customPageTitle('index', null, ea.i18n.translationParameters, ea.i18n.translationDomain) -%}
    {{- custom_page_title is null
        ? ea.crud.defaultPageTitle('index', null, ea.i18n.translationParameters)|trans|raw
        : custom_page_title|trans|raw -}}
{% endblock %}

{% set has_batch_actions = batch_actions|length > 0 %}
{% block page_actions %}
    {% if filters|length > 0 %}
        <div class=\"datagrid-filters\">
            {% block filters %}
                {% set applied_filters = ea.request.query.all['filters']|default([])|keys %}
                <div class=\"btn-group action-filters\">
                    <a href=\"#\" data-href=\"{{ ea_url().setAction('renderFilters') }}\" class=\"btn btn-secondary btn-labeled btn-labeled-right action-filters-button disabled {{ applied_filters ? 'action-filters-applied' }}\" data-bs-toggle=\"modal\" data-bs-target=\"#modal-filters\">
                        {{ component('ea:Icon', { name: 'internal:filter' }) }} {{ t('filter.title', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}{% if applied_filters %} <span class=\"action-filters-button-count\">({{ applied_filters|length }})</span>{% endif %}
                    </a>
                    {% if applied_filters %}
                        <a href=\"{{ ea_url().unset('filters').setAction('index') }}\" class=\"btn btn-secondary action-filters-reset\">
                            {{ component('ea:Icon', { name: 'internal:xmark' }) }}
                        </a>
                    {% endif %}
                </div>
            {% endblock filters %}
        </div>
    {% endif %}

    {% block global_actions %}
        <div class=\"global-actions\">
            {% for item in global_actions|reverse %}
                {% if item.isActionGroup %}
                    {{ include(item.templatePath, {group: item, entity: null}, with_context: false) }}
                {% else %}
                    {{ include(item.templatePath, {action: item}, with_context: false) }}
                {% endif %}
            {% endfor %}
        </div>
    {% endblock global_actions %}
    {% block batch_actions %}
        {% if has_batch_actions %}
            <div class=\"batch-actions d-none\">
                {% for action in batch_actions %}
                    {{ include(action.templatePath, {action: action}, with_context: false) }}
                {% endfor %}
            </div>
        {% endif %}
    {% endblock %}
{% endblock page_actions %}

{% block main %}
    {# sort can be multiple; let's consider the sorting field the first one #}
    {% set sort_params = app.request.query.all['sort']|default({}) %}
    {% set sort_field_name = sort_params|keys|first %}
    {% set sort_order = sort_params|first %}
    {% set some_results_are_hidden = entities|reduce((some_results_are_hidden, entity) => some_results_are_hidden or not entity.isAccessible, false) %}
    {% set has_footer = entities|length != 0 %}
    {% set has_search = ea.crud.isSearchEnabled %}
    {% set has_filters = filters|length > 0 %}
    {% set num_results = entities|length %}

    <table class=\"table datagrid {{ entities is empty ? 'datagrid-empty' }}\" data-default-action-trigger=\"{{ ea.crud.defaultRowActionTrigger }}\">
        {% if num_results > 0 %}
            <thead>
            {% block table_head %}
                <tr>
                    {% if has_batch_actions %}
                        <th>
                            <div class=\"form-check\">
                                <span><input type=\"checkbox\" class=\"form-check-input form-batch-checkbox-all\" id=\"form-batch-checkbox-all\"></span>
                            </div>
                        </th>
                    {% endif %}

                    {% set ea_sort_asc = constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Option\\\\SortOrder::ASC') %}
                    {% set ea_sort_desc = constant('EasyCorp\\\\Bundle\\\\EasyAdminBundle\\\\Config\\\\Option\\\\SortOrder::DESC') %}
                    {% for field in entities|filter(e => e.isAccessible)|first.fields ?? [] %}
                        {% set is_searchable = null == ea.crud.searchFields or field.property in ea.crud.searchFields %}
                        {% set is_sorting_field = ea.search.isSortingField(field.property) %}
                        {% set next_sort_direction = is_sorting_field ? (ea.search.sortDirection(field.property) == ea_sort_desc ? ea_sort_asc : ea_sort_desc) : ea_sort_desc %}
                        {% set column_icon = is_sorting_field ? (next_sort_direction == ea_sort_desc ? 'internal:sort-arrow-up' : 'internal:sort-arrow-down') : 'internal:sort-arrows' %}

                        <th data-column=\"{{ field.property }}\" class=\"{{ field.cssClass }} {{ is_searchable ? 'searchable' }} {{ is_sorting_field ? 'sorted' }} {{ field.isVirtual ? 'field-virtual' }} header-for-{{ field.cssClass|split(' ')|filter(class => class starts with 'field-')|join('') }} text-{{ field.textAlign }}\" dir=\"{{ ea.i18n.textDirection }}\">
                            {% if field.isSortable %}
                                {% set sortable_url = ea_url().setController(ea.request.attributes.get('crudControllerFqcn')).setAction('index').set('page', 1).set('sort', {(field.property): next_sort_direction}) %}

                                <a href=\"{{ sortable_url }}\">
                                    {{ field.label|trans|raw }} {{ component('ea:Icon', { name: (column_icon) }) }}
                                </a>
                            {% else %}
                                <span>{{ field.label|trans|raw }}</span>
                            {% endif %}
                        </th>
                    {% endfor %}

                    <th class=\"{{ ea.crud.showEntityActionsAsDropdown ? 'actions-as-dropdown-table-head' }}\" dir=\"{{ ea.i18n.textDirection }}\">
                        <span class=\"visually-hidden\">{{ t('action.entity_actions', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}</span>
                    </th>
                </tr>
            {% endblock table_head %}
            </thead>
        {% endif %}

        <tbody>
        {% block table_body %}
            {% for entity in entities %}
                {% block table_body_row %}
                {% if entity.isAccessible %}
                    <tr data-id=\"{{ entity.primaryKeyValueAsString }}\" {% if entity.defaultActionUrl %}data-default-action-url=\"{{ entity.defaultActionUrl }}\" class=\"ea-clickable-row\" role=\"link\" tabindex=\"0\"{% endif %} {% block entity_row_attributes %}{% endblock %}>
                        {% if has_batch_actions %}
                            <td class=\"batch-actions-selector\">
                                <div class=\"form-check\">
                                    <input type=\"checkbox\" class=\"form-check-input form-batch-checkbox\" id=\"form-batch-checkbox-{{ loop.index0 }}\" value=\"{{ entity.primaryKeyValue }}\">
                                </div>
                            </td>
                        {% endif %}

                        {% for field in entity.fields %}
                            {% set is_searchable = null == ea.crud.searchFields or field.property in ea.crud.searchFields %}

                            <td data-column=\"{{ field.property }}\" data-label=\"{{ field.label|trans|e('html') }}\" class=\"{{ is_searchable ? 'searchable' }} {{ field.property == sort_field_name ? 'sorted' }} text-{{ field.textAlign }} {{ field.cssClass }}\" dir=\"{{ ea.i18n.textDirection }}\" {% for name, value in field.htmlAttributes %}{{ name }}=\"{{ value|e('html_attr') }}\" {% endfor %}>
                                {{ include(field.templatePath, {field: field, entity: entity}, with_context: false) }}
                            </td>
                        {% endfor %}

                        {% block entity_actions %}
                            <td class=\"actions {{ ea.crud.showEntityActionsAsDropdown ? 'actions-as-dropdown' }}\">
                                {% if entity.actions.count > 0 %}
                                    {% if ea.crud.showEntityActionsAsDropdown %}
                                        {% set hasAnyActionWithIcon = entity.actions|filter(item => item.isActionGroup ? false : item.icon is not null)|length > 0 %}
                                        {% component 'ea:ActionMenu' with { class: 'dropdown-actions' } %}
                                            {% block content %}{% component 'ea:ActionMenu:Button' with { withoutDropdownToggleMarker: true } %}
                                                {% block content %}{{ component('ea:Icon', { name: 'internal:dots-horizontal' }) }}
                                            {% endblock %}{% endcomponent %}

                                            {% component 'ea:ActionMenu:Overlay' %}
                                                {% block content %}{% component 'ea:ActionMenu:ActionList' with { hasSubmenus: (entity.actions|filter(item => item.isActionGroup)|length > 0) } %}
                                                    {% block content %}{% for item in entity.actions %}
                                                        {% if item.isActionGroup %}
                                                            {{ component('ea:ActionMenu:ActionList:ItemGroup', { group: (item), showBlankIcons: (hasAnyActionWithIcon), entity: (entity) }) }}
                                                        {% else %}
                                                            {{ component('ea:ActionMenu:ActionList:Item', { class: (item.cssClass)~' dropdown-item-variant-'~(item.variant.value), url: (item.linkUrl), icon: (item.icon), 'icon:class': 'action-icon', htmlAttributes: (item.htmlAttributes|ea_html_attrs), renderAsForm: (item.isRenderedAsForm), label: (item.label|trans), 'label:class': 'action-label', renderLabelRaw: true, showBlankIcons: (hasAnyActionWithIcon) }) }}
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endblock %}{% endcomponent %}
                                            {% endblock %}{% endcomponent %}
                                        {% endblock %}{% endcomponent %}
                                    {% else %}
                                        {% for action in entity.actions %}
                                            {% if action.isActionGroup %}
                                                {{ include(action.templatePath, {group: action, entity: entity}, with_context: false) }}
                                            {% else %}
                                                {{ include(action.templatePath, {action: action, entity: entity, isIncludedInDropdown: ea.crud.showEntityActionsAsDropdown}, with_context: false) }}
                                            {% endif %}
                                        {% endfor %}
                                    {% endif %}
                                {% endif %}
                            </td>
                        {% endblock entity_actions %}
                    </tr>

                {% endif %}
                {% endblock table_body_row %}
            {% else %}
                {% block table_body_empty %}
                    {% for i in 1..14 %}
                        <tr class=\"empty-row\">
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                        </tr>

                        {% if 3 == loop.index %}
                            <tr class=\"no-results\">
                                <td colspan=\"100\">
                                    {{ t('datagrid.no_results', ea.i18n.translationParameters, 'EasyAdminBundle')|trans }}
                                </td>
                            </tr>
                        {% endif %}
                    {% endfor %}
                {% endblock table_body_empty %}
            {% endfor %}

            {% if some_results_are_hidden %}
                <tr class=\"datagrid-row-empty\">
                    <td class=\"text-center\" colspan=\"100\">
                        <span class=\"datagrid-row-empty-message\">{{ component('ea:Icon', { name: 'internal:lock', class: 'mr-1' }) }} {{ 'datagrid.hidden_results'|trans({}, 'EasyAdminBundle') }}</span>
                    </td>
                </tr>
            {% endif %}
        {% endblock table_body %}
        </tbody>

        <tfoot>
        {% block table_footer %}
        {% endblock table_footer %}
        </tfoot>
    </table>

    {% if entities|length > 0 %}
        <div class=\"content-panel-footer without-padding without-border\">
            {% block paginator %}
                {{ include(ea.templatePath('crud/paginator'), {render_detailed_pagination: not some_results_are_hidden}) }}
            {% endblock paginator %}
        </div>
    {% endif %}

    {% block delete_form %}
        {{ include('@EasyAdmin/crud/includes/_action_confirmation_modal.html.twig', with_context: false) }}
    {% endblock delete_form %}

    {% if has_filters %}
        {{ include('@EasyAdmin/crud/includes/_filters_modal.html.twig') }}
    {% endif %}

    {% if has_batch_actions %}
        {{ include('@EasyAdmin/crud/includes/_batch_action_modal.html.twig', {}, with_context: false) }}
    {% endif %}
{% endblock main %}
", "@EasyAdmin/crud/index.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\index.html.twig");
    }
}
