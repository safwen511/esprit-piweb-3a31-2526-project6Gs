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

/* @EasyAdmin/crud/paginator.html.twig */
class __TwigTemplate_b4fbd05f5f9617da6a8bf58ecc3a02bf extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@EasyAdmin/crud/paginator.html.twig"));

        // line 3
        $context["ea"] = $this->extensions['EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension']->ea();
        // line 5
        yield "
<div class=\"list-pagination\">
    <div class=\"list-pagination-counter\">
        ";
        // line 8
        if ((($tmp = ((array_key_exists("render_detailed_pagination", $context)) ? ((isset($context["render_detailed_pagination"]) || array_key_exists("render_detailed_pagination", $context) ? $context["render_detailed_pagination"] : (function () { throw new RuntimeError('Variable "render_detailed_pagination" does not exist.', 8, $this->source); })())) : (true))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 9
            yield "            ";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("paginator.results", ["%count%" => Twig\Extension\CoreExtension::sprintf(CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 9, $this->source); })()), "numResults", [], "any", false, false, false, 9))], "EasyAdminBundle");
            yield "
        ";
        }
        // line 11
        yield "    </div>
    ";
        // line 12
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 12, $this->source); })()), "hasPreviousPage", [], "any", false, false, false, 12) || CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 12, $this->source); })()), "hasNextPage", [], "any", false, false, false, 12))) {
            // line 13
            yield "        <nav class=\"pager list-pagination-paginator ";
            yield (((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 13, $this->source); })()), "hasPreviousPage", [], "any", false, false, false, 13)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("first-page") : (""));
            yield " ";
            yield (((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 13, $this->source); })()), "hasNextPage", [], "any", false, false, false, 13)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("last-page") : (""));
            yield "\">
            <ul class=\"pagination\">
                <li class=\"page-item page-item-previous ";
            // line 15
            yield (((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 15, $this->source); })()), "hasPreviousPage", [], "any", false, false, false, 15)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("disabled") : (""));
            yield "\">
                    <a class=\"page-link\" href=\"";
            // line 16
            yield (((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 16, $this->source); })()), "hasPreviousPage", [], "any", false, false, false, 16)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("#") : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 16, $this->source); })()), "generateUrlForPage", [CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 16, $this->source); })()), "previousPage", [], "any", false, false, false, 16)], "method", false, false, false, 16), "html", null, true)));
            yield "\">
                        ";
            // line 17
            if (("rtl" == CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 17, $this->source); })()), "i18n", [], "any", false, false, false, 17), "textDirection", [], "any", false, false, false, 17))) {
                // line 18
                yield "                            ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:chevron-right", "class" => "mx-1", "aria-hidden" => "true"]);
                yield "
                        ";
            } else {
                // line 20
                yield "                            ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:chevron-left", "class" => "mx-1", "aria-hidden" => "true"]);
                yield "
                        ";
            }
            // line 22
            yield "
                        <span class=\"btn-label\">";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("paginator.previous", [], "EasyAdminBundle"), "html", null, true);
            yield "</span>
                    </a>
                </li>

                ";
            // line 27
            if ((($tmp = ((array_key_exists("render_detailed_pagination", $context)) ? ((isset($context["render_detailed_pagination"]) || array_key_exists("render_detailed_pagination", $context) ? $context["render_detailed_pagination"] : (function () { throw new RuntimeError('Variable "render_detailed_pagination" does not exist.', 27, $this->source); })())) : (true))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 28
                yield "                    ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 28, $this->source); })()), "pageRange", [], "any", false, false, false, 28));
                foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                    // line 29
                    yield "                        <li class=\"page-item ";
                    yield ((($context["page"] == CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 29, $this->source); })()), "currentPage", [], "any", false, false, false, 29))) ? ("active") : (""));
                    yield " ";
                    yield (((null === $context["page"])) ? ("disabled") : (""));
                    yield "\">
                            ";
                    // line 30
                    if ((null === $context["page"])) {
                        // line 31
                        yield "                                <span class=\"page-link\">&hellip;</span>
                            ";
                    } else {
                        // line 33
                        yield "                                <a class=\"page-link\" href=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 33, $this->source); })()), "generateUrlForPage", [$context["page"]], "method", false, false, false, 33), "html", null, true);
                        yield "\">";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["page"], "html", null, true);
                        yield "</a>
                            ";
                    }
                    // line 35
                    yield "                        </li>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['page'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 37
                yield "                ";
            } else {
                // line 38
                yield "                    <li class=\"page-item active ";
                yield (((null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 38, $this->source); })()), "currentPage", [], "any", false, false, false, 38))) ? ("disabled") : (""));
                yield "\">
                        <a class=\"page-link\" href=\"";
                // line 39
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 39, $this->source); })()), "generateUrlForPage", [CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 39, $this->source); })()), "currentPage", [], "any", false, false, false, 39)], "method", false, false, false, 39), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 39, $this->source); })()), "currentPage", [], "any", false, false, false, 39), "html", null, true);
                yield "</a>
                    </li>
                ";
            }
            // line 42
            yield "
                <li class=\"page-item page-item-next ";
            // line 43
            yield (((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 43, $this->source); })()), "hasNextPage", [], "any", false, false, false, 43)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("disabled") : (""));
            yield "\">
                    <a class=\"page-link\" href=\"";
            // line 44
            yield (((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 44, $this->source); })()), "hasNextPage", [], "any", false, false, false, 44)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("#") : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 44, $this->source); })()), "generateUrlForPage", [CoreExtension::getAttribute($this->env, $this->source, (isset($context["paginator"]) || array_key_exists("paginator", $context) ? $context["paginator"] : (function () { throw new RuntimeError('Variable "paginator" does not exist.', 44, $this->source); })()), "nextPage", [], "any", false, false, false, 44)], "method", false, false, false, 44), "html", null, true)));
            yield "\">
                        <span class=\"btn-label\">";
            // line 45
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("paginator.next", [], "EasyAdminBundle"), "html", null, true);
            yield "</span>

                        ";
            // line 47
            if (("rtl" == CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["ea"]) || array_key_exists("ea", $context) ? $context["ea"] : (function () { throw new RuntimeError('Variable "ea" does not exist.', 47, $this->source); })()), "i18n", [], "any", false, false, false, 47), "textDirection", [], "any", false, false, false, 47))) {
                // line 48
                yield "                            ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:chevron-left", "class" => "mx-1", "aria-hidden" => "true"]);
                yield "
                        ";
            } else {
                // line 50
                yield "                            ";
                yield $this->env->getRuntime('Symfony\UX\TwigComponent\Twig\ComponentRuntime')->render("ea:Icon", ["name" => "internal:chevron-right", "class" => "mx-1", "aria-hidden" => "true"]);
                yield "
                        ";
            }
            // line 52
            yield "                    </a>
                </li>
            </ul>
        </nav>
    ";
        }
        // line 57
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
        return "@EasyAdmin/crud/paginator.html.twig";
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
        return array (  193 => 57,  186 => 52,  180 => 50,  174 => 48,  172 => 47,  167 => 45,  163 => 44,  159 => 43,  156 => 42,  148 => 39,  143 => 38,  140 => 37,  133 => 35,  125 => 33,  121 => 31,  119 => 30,  112 => 29,  107 => 28,  105 => 27,  98 => 23,  95 => 22,  89 => 20,  83 => 18,  81 => 17,  77 => 16,  73 => 15,  65 => 13,  63 => 12,  60 => 11,  54 => 9,  52 => 8,  47 => 5,  45 => 3,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# @var ea \\EasyCorp\\Bundle\\EasyAdminBundle\\Context\\AdminContext #}
{# @var paginator \\EasyCorp\\Bundle\\EasyAdminBundle\\Orm\\EntityPaginator #}
{% set ea = ea() %}
{% trans_default_domain 'EasyAdminBundle' %}

<div class=\"list-pagination\">
    <div class=\"list-pagination-counter\">
        {% if render_detailed_pagination is defined ? render_detailed_pagination : true %}
            {{ 'paginator.results'|trans({'%count%': paginator.numResults|format})|raw }}
        {% endif %}
    </div>
    {% if paginator.hasPreviousPage or paginator.hasNextPage %}
        <nav class=\"pager list-pagination-paginator {{ not paginator.hasPreviousPage ? 'first-page' }} {{ not paginator.hasNextPage ? 'last-page' }}\">
            <ul class=\"pagination\">
                <li class=\"page-item page-item-previous {{ not paginator.hasPreviousPage ? 'disabled' }}\">
                    <a class=\"page-link\" href=\"{{ not paginator.hasPreviousPage ? '#' : paginator.generateUrlForPage(paginator.previousPage) }}\">
                        {% if 'rtl' == ea.i18n.textDirection %}
                            {{ component('ea:Icon', { name: 'internal:chevron-right', class: 'mx-1', 'aria-hidden': 'true' }) }}
                        {% else %}
                            {{ component('ea:Icon', { name: 'internal:chevron-left', class: 'mx-1', 'aria-hidden': 'true' }) }}
                        {% endif %}

                        <span class=\"btn-label\">{{ 'paginator.previous'|trans }}</span>
                    </a>
                </li>

                {% if render_detailed_pagination is defined ? render_detailed_pagination : true %}
                    {% for page in paginator.pageRange %}
                        <li class=\"page-item {{ page == paginator.currentPage ? 'active' }} {{ page is null ? 'disabled' }}\">
                            {% if page is null %}
                                <span class=\"page-link\">&hellip;</span>
                            {% else %}
                                <a class=\"page-link\" href=\"{{ paginator.generateUrlForPage(page) }}\">{{ page }}</a>
                            {% endif %}
                        </li>
                    {% endfor %}
                {% else %}
                    <li class=\"page-item active {{ paginator.currentPage is null ? 'disabled' }}\">
                        <a class=\"page-link\" href=\"{{ paginator.generateUrlForPage(paginator.currentPage) }}\">{{ paginator.currentPage }}</a>
                    </li>
                {% endif %}

                <li class=\"page-item page-item-next {{ not paginator.hasNextPage ? 'disabled' }}\">
                    <a class=\"page-link\" href=\"{{ not paginator.hasNextPage ? '#' : paginator.generateUrlForPage(paginator.nextPage) }}\">
                        <span class=\"btn-label\">{{ 'paginator.next'|trans }}</span>

                        {% if 'rtl' == ea.i18n.textDirection %}
                            {{ component('ea:Icon', { name: 'internal:chevron-left', class: 'mx-1', 'aria-hidden': 'true' }) }}
                        {% else %}
                            {{ component('ea:Icon', { name: 'internal:chevron-right', class: 'mx-1', 'aria-hidden': 'true' }) }}
                        {% endif %}
                    </a>
                </li>
            </ul>
        </nav>
    {% endif %}
</div>
", "@EasyAdmin/crud/paginator.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\vendor\\easycorp\\easyadmin-bundle\\templates\\crud\\paginator.html.twig");
    }
}
