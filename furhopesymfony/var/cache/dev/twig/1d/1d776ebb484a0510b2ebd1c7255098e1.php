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

/* @EasyAdmin/crud/action_group.html.twig */
class __TwigTemplate_630172394fba75e3849a60c627707f40 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/action_group.html.twig"));

        // line 3
        $context["has_main_action"] = CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 3, $this->source); })()), "hasMainAction", [], "any", false, false, false, 3);
        // line 4
        $context["main_action"] = CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 4, $this->source); })()), "mainAction", [], "any", false, false, false, 4);
        // line 5
        yield "
<div class=\"btn-group action-group\" ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 6, $this->source); })()), "htmlAttributes", [], "any", false, false, false, 6));
        foreach ($context['_seq'] as $context["name"] => $context["value"]) {
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["name"], "html", null, true);
            yield "=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["value"], "trans", [], "any", true, true, false, 6)) ? ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans($context["value"])) : ($context["value"])), "html");
            yield "\" ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['name'], $context['value'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        yield ">
    ";
        // line 7
        if ((($tmp = (isset($context["has_main_action"]) || array_key_exists("has_main_action", $context) ? $context["has_main_action"] : (function () { throw new RuntimeError('Variable "has_main_action" does not exist.', 7, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " ";
            // line 8
            yield "        ";
            $_v0 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
            $preRendered = $_v0->preRender("ea:Button", Twig\Extension\CoreExtension::toArray(["variant" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 8, $this->source); })()), "variant", [], "any", false, false, false, 8), "htmlElement" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "htmlElement", [], "any", false, false, false, 8), "class" => ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "cssClass", [], "any", false, false, false, 8) . " ") . CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "addedCssClass", [], "any", false, false, false, 8)), "href" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "htmlElement", [], "any", false, false, false, 8), "isLink", [], "any", false, false, false, 8)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "linkUrl", [], "any", false, false, false, 8)) : (null)), "action" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "htmlElement", [], "any", false, false, false, 8), "isForm", [], "any", false, false, false, 8)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "linkUrl", [], "any", false, false, false, 8)) : (null)), "method" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "htmlElement", [], "any", false, false, false, 8), "isForm", [], "any", false, false, false, 8)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("POST") : (null)), "icon" => ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "icon", [], "any", false, false, false, 8)) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "icon", [], "any", false, false, false, 8)) : (CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 8, $this->source); })()), "icon", [], "any", false, false, false, 8))), "htmlAttributes" => Twig\Extension\CoreExtension::filter($this->env, Twig\Extension\CoreExtension::merge($this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->processHtmlAttributes(CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "htmlAttributes", [], "any", false, false, false, 8)), ["data-action-group-name-main-action" => true, "data-ea-action-url" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "htmlElement", [], "any", false, false, false, 8), "isButton", [], "any", false, false, false, 8)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "linkUrl", [], "any", false, false, false, 8)) : (null))]), function ($__v__) use ($context, $macros) { $context["v"] = $__v__; return  !(null === (isset($context["v"]) || array_key_exists("v", $context) ? $context["v"] : (function () { throw new RuntimeError('Variable "v" does not exist.', 8, $this->source); })())); })]));
            if (null !== $preRendered) {
                yield $preRendered; 
            } else {
                $preRenderEvent = $_v0->startEmbedComponent("ea:Button", Twig\Extension\CoreExtension::toArray(["variant" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 8, $this->source); })()), "variant", [], "any", false, false, false, 8), "htmlElement" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "htmlElement", [], "any", false, false, false, 8), "class" => ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "cssClass", [], "any", false, false, false, 8) . " ") . CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "addedCssClass", [], "any", false, false, false, 8)), "href" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "htmlElement", [], "any", false, false, false, 8), "isLink", [], "any", false, false, false, 8)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "linkUrl", [], "any", false, false, false, 8)) : (null)), "action" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "htmlElement", [], "any", false, false, false, 8), "isForm", [], "any", false, false, false, 8)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "linkUrl", [], "any", false, false, false, 8)) : (null)), "method" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "htmlElement", [], "any", false, false, false, 8), "isForm", [], "any", false, false, false, 8)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("POST") : (null)), "icon" => ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "icon", [], "any", false, false, false, 8)) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "icon", [], "any", false, false, false, 8)) : (CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 8, $this->source); })()), "icon", [], "any", false, false, false, 8))), "htmlAttributes" => Twig\Extension\CoreExtension::filter($this->env, Twig\Extension\CoreExtension::merge($this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->processHtmlAttributes(CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "htmlAttributes", [], "any", false, false, false, 8)), ["data-action-group-name-main-action" => true, "data-ea-action-url" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "htmlElement", [], "any", false, false, false, 8), "isButton", [], "any", false, false, false, 8)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 8, $this->source); })()), "linkUrl", [], "any", false, false, false, 8)) : (null))]), function ($__v__) use ($context, $macros) { $context["v"] = $__v__; return  !(null === (isset($context["v"]) || array_key_exists("v", $context) ? $context["v"] : (function () { throw new RuntimeError('Variable "v" does not exist.', 8, $this->source); })())); })]), $context, "@EasyAdmin/crud/action_group.html.twig", 7386223461);
                $embeddedContext = $preRenderEvent->getVariables();
                $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
                $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
                $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 7386223461);
                $this->load("@EasyAdmin/crud/action_group.html.twig", 8, "7386223461")->display($embeddedContext, $embeddedBlocks);
                $_v0->finishEmbedComponent();
            }
            // line 12
            yield "
        ";
            // line 13
            $_v1 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
            $preRendered = $_v1->preRender("ea:Button", Twig\Extension\CoreExtension::toArray(["variant" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 13, $this->source); })()), "variant", [], "any", false, false, false, 13), "htmlElement" => "button", "type" => "button", "class" => (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 13, $this->source); })()), "cssClass", [], "any", false, false, false, 13) . " ") . CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 13, $this->source); })()), "addedCssClass", [], "any", false, false, false, 13)) . " dropdown-toggle dropdown-toggle-split"), "htmlAttributes" => ["data-bs-toggle" => "dropdown", "aria-expanded" => "false"], "label:class" => "visually-hidden"]));
            if (null !== $preRendered) {
                yield $preRendered; 
            } else {
                $preRenderEvent = $_v1->startEmbedComponent("ea:Button", Twig\Extension\CoreExtension::toArray(["variant" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 13, $this->source); })()), "variant", [], "any", false, false, false, 13), "htmlElement" => "button", "type" => "button", "class" => (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 13, $this->source); })()), "cssClass", [], "any", false, false, false, 13) . " ") . CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 13, $this->source); })()), "addedCssClass", [], "any", false, false, false, 13)) . " dropdown-toggle dropdown-toggle-split"), "htmlAttributes" => ["data-bs-toggle" => "dropdown", "aria-expanded" => "false"], "label:class" => "visually-hidden"]), $context, "@EasyAdmin/crud/action_group.html.twig", 29748985831);
                $embeddedContext = $preRenderEvent->getVariables();
                $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
                $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
                $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 29748985831);
                $this->load("@EasyAdmin/crud/action_group.html.twig", 13, "29748985831")->display($embeddedContext, $embeddedBlocks);
                $_v1->finishEmbedComponent();
            }
            // line 16
            yield "    ";
        } else {
            yield " ";
            // line 17
            yield "        ";
            $_v2 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
            $preRendered = $_v2->preRender("ea:Button", Twig\Extension\CoreExtension::toArray(["variant" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 17, $this->source); })()), "variant", [], "any", false, false, false, 17), "class" => (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 17, $this->source); })()), "cssClass", [], "any", false, false, false, 17) . " ") . CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 17, $this->source); })()), "addedCssClass", [], "any", false, false, false, 17)) . " dropdown-toggle"), "htmlElement" => "button", "type" => "button", "icon" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 17, $this->source); })()), "icon", [], "any", false, false, false, 17), "htmlAttributes" => ["data-bs-toggle" => "dropdown", "aria-expanded" => "false"]]));
            if (null !== $preRendered) {
                yield $preRendered; 
            } else {
                $preRenderEvent = $_v2->startEmbedComponent("ea:Button", Twig\Extension\CoreExtension::toArray(["variant" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 17, $this->source); })()), "variant", [], "any", false, false, false, 17), "class" => (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 17, $this->source); })()), "cssClass", [], "any", false, false, false, 17) . " ") . CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 17, $this->source); })()), "addedCssClass", [], "any", false, false, false, 17)) . " dropdown-toggle"), "htmlElement" => "button", "type" => "button", "icon" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 17, $this->source); })()), "icon", [], "any", false, false, false, 17), "htmlAttributes" => ["data-bs-toggle" => "dropdown", "aria-expanded" => "false"]]), $context, "@EasyAdmin/crud/action_group.html.twig", 30574258061);
                $embeddedContext = $preRenderEvent->getVariables();
                $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
                $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
                $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 30574258061);
                $this->load("@EasyAdmin/crud/action_group.html.twig", 17, "30574258061")->display($embeddedContext, $embeddedBlocks);
                $_v2->finishEmbedComponent();
            }
            // line 21
            yield "    ";
        }
        // line 22
        yield "
    ";
        // line 23
        $_v3 = $this->env->getRuntime("Symfony\\UX\\TwigComponent\\Twig\\ComponentRuntime");
        $preRendered = $_v3->preRender("ea:ActionMenu:ActionList", Twig\Extension\CoreExtension::toArray(["class" => "dropdown-menu"]));
        if (null !== $preRendered) {
            yield $preRendered; 
        } else {
            $preRenderEvent = $_v3->startEmbedComponent("ea:ActionMenu:ActionList", Twig\Extension\CoreExtension::toArray(["class" => "dropdown-menu"]), $context, "@EasyAdmin/crud/action_group.html.twig", 25918203721);
            $embeddedContext = $preRenderEvent->getVariables();
            $embeddedContext["__parent__"] = $preRenderEvent->getTemplate();
            $embeddedContext["outerBlocks"] ??= new \Symfony\UX\TwigComponent\BlockStack();
            $embeddedBlocks = $embeddedContext["outerBlocks"]->convert($blocks, 25918203721);
            $this->load("@EasyAdmin/crud/action_group.html.twig", 23, "25918203721")->display($embeddedContext, $embeddedBlocks);
            $_v3->finishEmbedComponent();
        }
        // line 38
        yield "</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/crud/action_group.html.twig";
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
        return array (  140 => 38,  126 => 23,  123 => 22,  120 => 21,  105 => 17,  101 => 16,  87 => 13,  84 => 12,  69 => 8,  66 => 7,  52 => 6,  49 => 5,  47 => 4,  45 => 3,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var group \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\ActionGroupDto #}
{# @var entity \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\EntityDto #}
{% set has_main_action = group.hasMainAction %}
{% set main_action = group.mainAction %}

<div class=\"btn-group action-group\" {% for name, value in group.htmlAttributes %}{{ name }}=\"{{ (value.trans is defined ? value|trans : value)|e('html') }}\" {% endfor %}>
    {% if has_main_action %} {# render as a split button (main button with action + dropdown toggle) #}
        {% component 'ea:Button' with { variant: (group.variant), htmlElement: (main_action.htmlElement), class: (main_action.cssClass)~' '~(main_action.addedCssClass), href: (main_action.htmlElement.isLink ? main_action.linkUrl : null), action: (main_action.htmlElement.isForm ? main_action.linkUrl : null), method: (main_action.htmlElement.isForm ? 'POST' : null), icon: (main_action.icon ?: group.icon), htmlAttributes: (main_action.htmlAttributes|ea_html_attrs|merge({'data-action-group-name-main-action': true, 'data-ea-action-url': main_action.htmlElement.isButton ? main_action.linkUrl : null})|filter((v) => v is not null)) } %}
            {% block content %}{% set main_action_label = main_action.label|trans %}
            {%- if main_action_label is not same as(false) -%}{{ main_action_label|raw }}{%- endif -%}
        {% endblock %}{% endcomponent %}

        {% component 'ea:Button' with { variant: (group.variant), htmlElement: 'button', type: 'button', class: (main_action.cssClass)~' '~(main_action.addedCssClass)~' dropdown-toggle dropdown-toggle-split', htmlAttributes: ({'data-bs-toggle': 'dropdown', 'aria-expanded': 'false'}), 'label:class': 'visually-hidden' } %}
            {% block content %}{{ 'action.toggle_dropdown'|trans(domain: 'EasyAdminBundle') }}
        {% endblock %}{% endcomponent %}
    {% else %} {# render as a single button that toggles the dropdown (no main action) #}
        {% component 'ea:Button' with { variant: (group.variant), class: (group.cssClass)~' '~(group.addedCssClass)~' dropdown-toggle', htmlElement: 'button', type: 'button', icon: (group.icon), htmlAttributes: ({'data-bs-toggle': 'dropdown', 'aria-expanded': 'false'}) } %}
            {% block content %}{% set group_label = group.label|trans %}
            {%- if group_label is not same as(false) -%}{{ group_label|raw }}{%- endif -%}
        {% endblock %}{% endcomponent %}
    {% endif %}

    {% component 'ea:ActionMenu:ActionList' with { class: 'dropdown-menu' } %}
        {% block content %}{% for item in group.items %}
            {% if item is iterable and item.type is defined %}
                {% if item.type == 'divider' %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                {% elseif item.type == 'header' %}
                    {% set item_label = item.content|trans %}
                    {{ component('ea:ActionMenu:ActionList:Header', { label: (item_label), renderLabelRaw: 'true' }) }}
                {% endif %}
            {% else %}
                {# item is an ActionDto #}
                {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), icon: (item.icon), class: (item.cssClass)~' dropdown-item-variant-'~(item.variant.value), htmlAttributes: (item.htmlAttributes|ea_html_attrs), renderAsForm: (item.isRenderedAsForm), url: (item.linkUrl), renderLabelRaw: 'true', showBlankIcons: (group.hasAnyActionWithIcon) }) }}
            {% endif %}
        {% endfor %}
    {% endblock %}{% endcomponent %}
</div>
", "@EasyAdmin/crud/action_group.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\action_group.html.twig");
    }
}


/* @EasyAdmin/crud/action_group.html.twig */
class __TwigTemplate_630172394fba75e3849a60c627707f40___7386223461 extends Template
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
        // line 8
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 8, $this->source); })()), 8);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/action_group.html.twig"));

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

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $context["main_action_label"] = $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["main_action"]) || array_key_exists("main_action", $context) ? $context["main_action"] : (function () { throw new RuntimeError('Variable "main_action" does not exist.', 9, $this->source); })()), "label", [], "any", false, false, false, 9));
        // line 10
        if ((($tmp =  !((isset($context["main_action_label"]) || array_key_exists("main_action_label", $context) ? $context["main_action_label"] : (function () { throw new RuntimeError('Variable "main_action_label" does not exist.', 10, $this->source); })()) === false)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield (isset($context["main_action_label"]) || array_key_exists("main_action_label", $context) ? $context["main_action_label"] : (function () { throw new RuntimeError('Variable "main_action_label" does not exist.', 10, $this->source); })());
        }
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/crud/action_group.html.twig";
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
        return array (  283 => 10,  272 => 9,  241 => 8,  140 => 38,  126 => 23,  123 => 22,  120 => 21,  105 => 17,  101 => 16,  87 => 13,  84 => 12,  69 => 8,  66 => 7,  52 => 6,  49 => 5,  47 => 4,  45 => 3,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var group \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\ActionGroupDto #}
{# @var entity \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\EntityDto #}
{% set has_main_action = group.hasMainAction %}
{% set main_action = group.mainAction %}

<div class=\"btn-group action-group\" {% for name, value in group.htmlAttributes %}{{ name }}=\"{{ (value.trans is defined ? value|trans : value)|e('html') }}\" {% endfor %}>
    {% if has_main_action %} {# render as a split button (main button with action + dropdown toggle) #}
        {% component 'ea:Button' with { variant: (group.variant), htmlElement: (main_action.htmlElement), class: (main_action.cssClass)~' '~(main_action.addedCssClass), href: (main_action.htmlElement.isLink ? main_action.linkUrl : null), action: (main_action.htmlElement.isForm ? main_action.linkUrl : null), method: (main_action.htmlElement.isForm ? 'POST' : null), icon: (main_action.icon ?: group.icon), htmlAttributes: (main_action.htmlAttributes|ea_html_attrs|merge({'data-action-group-name-main-action': true, 'data-ea-action-url': main_action.htmlElement.isButton ? main_action.linkUrl : null})|filter((v) => v is not null)) } %}
            {% block content %}{% set main_action_label = main_action.label|trans %}
            {%- if main_action_label is not same as(false) -%}{{ main_action_label|raw }}{%- endif -%}
        {% endblock %}{% endcomponent %}

        {% component 'ea:Button' with { variant: (group.variant), htmlElement: 'button', type: 'button', class: (main_action.cssClass)~' '~(main_action.addedCssClass)~' dropdown-toggle dropdown-toggle-split', htmlAttributes: ({'data-bs-toggle': 'dropdown', 'aria-expanded': 'false'}), 'label:class': 'visually-hidden' } %}
            {% block content %}{{ 'action.toggle_dropdown'|trans(domain: 'EasyAdminBundle') }}
        {% endblock %}{% endcomponent %}
    {% else %} {# render as a single button that toggles the dropdown (no main action) #}
        {% component 'ea:Button' with { variant: (group.variant), class: (group.cssClass)~' '~(group.addedCssClass)~' dropdown-toggle', htmlElement: 'button', type: 'button', icon: (group.icon), htmlAttributes: ({'data-bs-toggle': 'dropdown', 'aria-expanded': 'false'}) } %}
            {% block content %}{% set group_label = group.label|trans %}
            {%- if group_label is not same as(false) -%}{{ group_label|raw }}{%- endif -%}
        {% endblock %}{% endcomponent %}
    {% endif %}

    {% component 'ea:ActionMenu:ActionList' with { class: 'dropdown-menu' } %}
        {% block content %}{% for item in group.items %}
            {% if item is iterable and item.type is defined %}
                {% if item.type == 'divider' %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                {% elseif item.type == 'header' %}
                    {% set item_label = item.content|trans %}
                    {{ component('ea:ActionMenu:ActionList:Header', { label: (item_label), renderLabelRaw: 'true' }) }}
                {% endif %}
            {% else %}
                {# item is an ActionDto #}
                {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), icon: (item.icon), class: (item.cssClass)~' dropdown-item-variant-'~(item.variant.value), htmlAttributes: (item.htmlAttributes|ea_html_attrs), renderAsForm: (item.isRenderedAsForm), url: (item.linkUrl), renderLabelRaw: 'true', showBlankIcons: (group.hasAnyActionWithIcon) }) }}
            {% endif %}
        {% endfor %}
    {% endblock %}{% endcomponent %}
</div>
", "@EasyAdmin/crud/action_group.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\action_group.html.twig");
    }
}


/* @EasyAdmin/crud/action_group.html.twig */
class __TwigTemplate_630172394fba75e3849a60c627707f40___29748985831 extends Template
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
        // line 13
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 13, $this->source); })()), 13);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/action_group.html.twig"));

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

    // line 14
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("action.toggle_dropdown", [], "EasyAdminBundle"), "html", null, true);
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
        return "@EasyAdmin/crud/action_group.html.twig";
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
        return array (  416 => 14,  385 => 13,  283 => 10,  272 => 9,  241 => 8,  140 => 38,  126 => 23,  123 => 22,  120 => 21,  105 => 17,  101 => 16,  87 => 13,  84 => 12,  69 => 8,  66 => 7,  52 => 6,  49 => 5,  47 => 4,  45 => 3,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var group \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\ActionGroupDto #}
{# @var entity \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\EntityDto #}
{% set has_main_action = group.hasMainAction %}
{% set main_action = group.mainAction %}

<div class=\"btn-group action-group\" {% for name, value in group.htmlAttributes %}{{ name }}=\"{{ (value.trans is defined ? value|trans : value)|e('html') }}\" {% endfor %}>
    {% if has_main_action %} {# render as a split button (main button with action + dropdown toggle) #}
        {% component 'ea:Button' with { variant: (group.variant), htmlElement: (main_action.htmlElement), class: (main_action.cssClass)~' '~(main_action.addedCssClass), href: (main_action.htmlElement.isLink ? main_action.linkUrl : null), action: (main_action.htmlElement.isForm ? main_action.linkUrl : null), method: (main_action.htmlElement.isForm ? 'POST' : null), icon: (main_action.icon ?: group.icon), htmlAttributes: (main_action.htmlAttributes|ea_html_attrs|merge({'data-action-group-name-main-action': true, 'data-ea-action-url': main_action.htmlElement.isButton ? main_action.linkUrl : null})|filter((v) => v is not null)) } %}
            {% block content %}{% set main_action_label = main_action.label|trans %}
            {%- if main_action_label is not same as(false) -%}{{ main_action_label|raw }}{%- endif -%}
        {% endblock %}{% endcomponent %}

        {% component 'ea:Button' with { variant: (group.variant), htmlElement: 'button', type: 'button', class: (main_action.cssClass)~' '~(main_action.addedCssClass)~' dropdown-toggle dropdown-toggle-split', htmlAttributes: ({'data-bs-toggle': 'dropdown', 'aria-expanded': 'false'}), 'label:class': 'visually-hidden' } %}
            {% block content %}{{ 'action.toggle_dropdown'|trans(domain: 'EasyAdminBundle') }}
        {% endblock %}{% endcomponent %}
    {% else %} {# render as a single button that toggles the dropdown (no main action) #}
        {% component 'ea:Button' with { variant: (group.variant), class: (group.cssClass)~' '~(group.addedCssClass)~' dropdown-toggle', htmlElement: 'button', type: 'button', icon: (group.icon), htmlAttributes: ({'data-bs-toggle': 'dropdown', 'aria-expanded': 'false'}) } %}
            {% block content %}{% set group_label = group.label|trans %}
            {%- if group_label is not same as(false) -%}{{ group_label|raw }}{%- endif -%}
        {% endblock %}{% endcomponent %}
    {% endif %}

    {% component 'ea:ActionMenu:ActionList' with { class: 'dropdown-menu' } %}
        {% block content %}{% for item in group.items %}
            {% if item is iterable and item.type is defined %}
                {% if item.type == 'divider' %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                {% elseif item.type == 'header' %}
                    {% set item_label = item.content|trans %}
                    {{ component('ea:ActionMenu:ActionList:Header', { label: (item_label), renderLabelRaw: 'true' }) }}
                {% endif %}
            {% else %}
                {# item is an ActionDto #}
                {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), icon: (item.icon), class: (item.cssClass)~' dropdown-item-variant-'~(item.variant.value), htmlAttributes: (item.htmlAttributes|ea_html_attrs), renderAsForm: (item.isRenderedAsForm), url: (item.linkUrl), renderLabelRaw: 'true', showBlankIcons: (group.hasAnyActionWithIcon) }) }}
            {% endif %}
        {% endfor %}
    {% endblock %}{% endcomponent %}
</div>
", "@EasyAdmin/crud/action_group.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\action_group.html.twig");
    }
}


/* @EasyAdmin/crud/action_group.html.twig */
class __TwigTemplate_630172394fba75e3849a60c627707f40___30574258061 extends Template
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
        // line 17
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 17, $this->source); })()), 17);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/action_group.html.twig"));

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

    // line 18
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $context["group_label"] = $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 18, $this->source); })()), "label", [], "any", false, false, false, 18));
        // line 19
        if ((($tmp =  !((isset($context["group_label"]) || array_key_exists("group_label", $context) ? $context["group_label"] : (function () { throw new RuntimeError('Variable "group_label" does not exist.', 19, $this->source); })()) === false)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield (isset($context["group_label"]) || array_key_exists("group_label", $context) ? $context["group_label"] : (function () { throw new RuntimeError('Variable "group_label" does not exist.', 19, $this->source); })());
        }
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/crud/action_group.html.twig";
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
        return array (  569 => 19,  558 => 18,  527 => 17,  416 => 14,  385 => 13,  283 => 10,  272 => 9,  241 => 8,  140 => 38,  126 => 23,  123 => 22,  120 => 21,  105 => 17,  101 => 16,  87 => 13,  84 => 12,  69 => 8,  66 => 7,  52 => 6,  49 => 5,  47 => 4,  45 => 3,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var group \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\ActionGroupDto #}
{# @var entity \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\EntityDto #}
{% set has_main_action = group.hasMainAction %}
{% set main_action = group.mainAction %}

<div class=\"btn-group action-group\" {% for name, value in group.htmlAttributes %}{{ name }}=\"{{ (value.trans is defined ? value|trans : value)|e('html') }}\" {% endfor %}>
    {% if has_main_action %} {# render as a split button (main button with action + dropdown toggle) #}
        {% component 'ea:Button' with { variant: (group.variant), htmlElement: (main_action.htmlElement), class: (main_action.cssClass)~' '~(main_action.addedCssClass), href: (main_action.htmlElement.isLink ? main_action.linkUrl : null), action: (main_action.htmlElement.isForm ? main_action.linkUrl : null), method: (main_action.htmlElement.isForm ? 'POST' : null), icon: (main_action.icon ?: group.icon), htmlAttributes: (main_action.htmlAttributes|ea_html_attrs|merge({'data-action-group-name-main-action': true, 'data-ea-action-url': main_action.htmlElement.isButton ? main_action.linkUrl : null})|filter((v) => v is not null)) } %}
            {% block content %}{% set main_action_label = main_action.label|trans %}
            {%- if main_action_label is not same as(false) -%}{{ main_action_label|raw }}{%- endif -%}
        {% endblock %}{% endcomponent %}

        {% component 'ea:Button' with { variant: (group.variant), htmlElement: 'button', type: 'button', class: (main_action.cssClass)~' '~(main_action.addedCssClass)~' dropdown-toggle dropdown-toggle-split', htmlAttributes: ({'data-bs-toggle': 'dropdown', 'aria-expanded': 'false'}), 'label:class': 'visually-hidden' } %}
            {% block content %}{{ 'action.toggle_dropdown'|trans(domain: 'EasyAdminBundle') }}
        {% endblock %}{% endcomponent %}
    {% else %} {# render as a single button that toggles the dropdown (no main action) #}
        {% component 'ea:Button' with { variant: (group.variant), class: (group.cssClass)~' '~(group.addedCssClass)~' dropdown-toggle', htmlElement: 'button', type: 'button', icon: (group.icon), htmlAttributes: ({'data-bs-toggle': 'dropdown', 'aria-expanded': 'false'}) } %}
            {% block content %}{% set group_label = group.label|trans %}
            {%- if group_label is not same as(false) -%}{{ group_label|raw }}{%- endif -%}
        {% endblock %}{% endcomponent %}
    {% endif %}

    {% component 'ea:ActionMenu:ActionList' with { class: 'dropdown-menu' } %}
        {% block content %}{% for item in group.items %}
            {% if item is iterable and item.type is defined %}
                {% if item.type == 'divider' %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                {% elseif item.type == 'header' %}
                    {% set item_label = item.content|trans %}
                    {{ component('ea:ActionMenu:ActionList:Header', { label: (item_label), renderLabelRaw: 'true' }) }}
                {% endif %}
            {% else %}
                {# item is an ActionDto #}
                {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), icon: (item.icon), class: (item.cssClass)~' dropdown-item-variant-'~(item.variant.value), htmlAttributes: (item.htmlAttributes|ea_html_attrs), renderAsForm: (item.isRenderedAsForm), url: (item.linkUrl), renderLabelRaw: 'true', showBlankIcons: (group.hasAnyActionWithIcon) }) }}
            {% endif %}
        {% endfor %}
    {% endblock %}{% endcomponent %}
</div>
", "@EasyAdmin/crud/action_group.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\action_group.html.twig");
    }
}


/* @EasyAdmin/crud/action_group.html.twig */
class __TwigTemplate_630172394fba75e3849a60c627707f40___25918203721 extends Template
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
        // line 23
        return $this->load((isset($context["__parent__"]) || array_key_exists("__parent__", $context) ? $context["__parent__"] : (function () { throw new RuntimeError('Variable "__parent__" does not exist.', 23, $this->source); })()), 23);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/action_group.html.twig"));

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

    // line 24
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 24, $this->source); })()), "items", [], "any", false, false, false, 24));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 25
            yield "            ";
            if ((is_iterable($context["item"]) && CoreExtension::getAttribute($this->env, $this->source, $context["item"], "type", [], "any", true, true, false, 25))) {
                // line 26
                yield "                ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 26) == "divider")) {
                    // line 27
                    yield "                    ";
                    yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Divider");
                    yield "
                ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 28
$context["item"], "type", [], "any", false, false, false, 28) == "header")) {
                    // line 29
                    yield "                    ";
                    $context["item_label"] = $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "content", [], "any", false, false, false, 29));
                    // line 30
                    yield "                    ";
                    yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Header", ["label" => (isset($context["item_label"]) || array_key_exists("item_label", $context) ? $context["item_label"] : (function () { throw new RuntimeError('Variable "item_label" does not exist.', 30, $this->source); })()), "renderLabelRaw" => "true"]);
                    yield "
                ";
                }
                // line 32
                yield "            ";
            } else {
                // line 33
                yield "                ";
                // line 34
                yield "                ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:ActionMenu:ActionList:Item", ["label" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 34)), "icon" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "icon", [], "any", false, false, false, 34), "class" => ((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "cssClass", [], "any", false, false, false, 34) . " dropdown-item-variant-") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "variant", [], "any", false, false, false, 34), "value", [], "any", false, false, false, 34)), "htmlAttributes" => $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->processHtmlAttributes(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "htmlAttributes", [], "any", false, false, false, 34)), "renderAsForm" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "isRenderedAsForm", [], "any", false, false, false, 34), "url" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "linkUrl", [], "any", false, false, false, 34), "renderLabelRaw" => "true", "showBlankIcons" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["group"]) || array_key_exists("group", $context) ? $context["group"] : (function () { throw new RuntimeError('Variable "group" does not exist.', 34, $this->source); })()), "hasAnyActionWithIcon", [], "any", false, false, false, 34)]);
                yield "
            ";
            }
            // line 36
            yield "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        yield "    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@EasyAdmin/crud/action_group.html.twig";
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
        return array (  754 => 37,  748 => 36,  742 => 34,  740 => 33,  737 => 32,  731 => 30,  728 => 29,  726 => 28,  721 => 27,  718 => 26,  715 => 25,  702 => 24,  671 => 23,  569 => 19,  558 => 18,  527 => 17,  416 => 14,  385 => 13,  283 => 10,  272 => 9,  241 => 8,  140 => 38,  126 => 23,  123 => 22,  120 => 21,  105 => 17,  101 => 16,  87 => 13,  84 => 12,  69 => 8,  66 => 7,  52 => 6,  49 => 5,  47 => 4,  45 => 3,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var group \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\ActionGroupDto #}
{# @var entity \\EasyCorp\\Bundle\\EasyAdminBundle\\Dto\\EntityDto #}
{% set has_main_action = group.hasMainAction %}
{% set main_action = group.mainAction %}

<div class=\"btn-group action-group\" {% for name, value in group.htmlAttributes %}{{ name }}=\"{{ (value.trans is defined ? value|trans : value)|e('html') }}\" {% endfor %}>
    {% if has_main_action %} {# render as a split button (main button with action + dropdown toggle) #}
        {% component 'ea:Button' with { variant: (group.variant), htmlElement: (main_action.htmlElement), class: (main_action.cssClass)~' '~(main_action.addedCssClass), href: (main_action.htmlElement.isLink ? main_action.linkUrl : null), action: (main_action.htmlElement.isForm ? main_action.linkUrl : null), method: (main_action.htmlElement.isForm ? 'POST' : null), icon: (main_action.icon ?: group.icon), htmlAttributes: (main_action.htmlAttributes|ea_html_attrs|merge({'data-action-group-name-main-action': true, 'data-ea-action-url': main_action.htmlElement.isButton ? main_action.linkUrl : null})|filter((v) => v is not null)) } %}
            {% block content %}{% set main_action_label = main_action.label|trans %}
            {%- if main_action_label is not same as(false) -%}{{ main_action_label|raw }}{%- endif -%}
        {% endblock %}{% endcomponent %}

        {% component 'ea:Button' with { variant: (group.variant), htmlElement: 'button', type: 'button', class: (main_action.cssClass)~' '~(main_action.addedCssClass)~' dropdown-toggle dropdown-toggle-split', htmlAttributes: ({'data-bs-toggle': 'dropdown', 'aria-expanded': 'false'}), 'label:class': 'visually-hidden' } %}
            {% block content %}{{ 'action.toggle_dropdown'|trans(domain: 'EasyAdminBundle') }}
        {% endblock %}{% endcomponent %}
    {% else %} {# render as a single button that toggles the dropdown (no main action) #}
        {% component 'ea:Button' with { variant: (group.variant), class: (group.cssClass)~' '~(group.addedCssClass)~' dropdown-toggle', htmlElement: 'button', type: 'button', icon: (group.icon), htmlAttributes: ({'data-bs-toggle': 'dropdown', 'aria-expanded': 'false'}) } %}
            {% block content %}{% set group_label = group.label|trans %}
            {%- if group_label is not same as(false) -%}{{ group_label|raw }}{%- endif -%}
        {% endblock %}{% endcomponent %}
    {% endif %}

    {% component 'ea:ActionMenu:ActionList' with { class: 'dropdown-menu' } %}
        {% block content %}{% for item in group.items %}
            {% if item is iterable and item.type is defined %}
                {% if item.type == 'divider' %}
                    {{ component('ea:ActionMenu:ActionList:Divider') }}
                {% elseif item.type == 'header' %}
                    {% set item_label = item.content|trans %}
                    {{ component('ea:ActionMenu:ActionList:Header', { label: (item_label), renderLabelRaw: 'true' }) }}
                {% endif %}
            {% else %}
                {# item is an ActionDto #}
                {{ component('ea:ActionMenu:ActionList:Item', { label: (item.label|trans), icon: (item.icon), class: (item.cssClass)~' dropdown-item-variant-'~(item.variant.value), htmlAttributes: (item.htmlAttributes|ea_html_attrs), renderAsForm: (item.isRenderedAsForm), url: (item.linkUrl), renderLabelRaw: 'true', showBlankIcons: (group.hasAnyActionWithIcon) }) }}
            {% endif %}
        {% endfor %}
    {% endblock %}{% endcomponent %}
</div>
", "@EasyAdmin/crud/action_group.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\action_group.html.twig");
    }
}
