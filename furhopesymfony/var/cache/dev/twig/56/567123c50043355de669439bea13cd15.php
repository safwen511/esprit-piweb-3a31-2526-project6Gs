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

/* post/_comment_tree.html.twig */
class __TwigTemplate_c3e6d288273b6133b4ae31b4ffc5c091 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "post/_comment_tree.html.twig"));

        // line 1
        $context["branch"] = ((CoreExtension::getAttribute($this->env, $this->source, ($context["commentsByParent"] ?? null), (isset($context["parentKey"]) || array_key_exists("parentKey", $context) ? $context["parentKey"] : (function () { throw new RuntimeError('Variable "parentKey" does not exist.', 1, $this->source); })()), [], "array", true, true, false, 1)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["commentsByParent"]) || array_key_exists("commentsByParent", $context) ? $context["commentsByParent"] : (function () { throw new RuntimeError('Variable "commentsByParent" does not exist.', 1, $this->source); })()), (isset($context["parentKey"]) || array_key_exists("parentKey", $context) ? $context["parentKey"] : (function () { throw new RuntimeError('Variable "parentKey" does not exist.', 1, $this->source); })()), [], "array", false, false, false, 1), [])) : ([]));
        // line 2
        yield "
";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["branch"]) || array_key_exists("branch", $context) ? $context["branch"] : (function () { throw new RuntimeError('Variable "branch" does not exist.', 3, $this->source); })()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 4
            yield "    <article class=\"comment-thread__item ";
            yield ((((isset($context["parentKey"]) || array_key_exists("parentKey", $context) ? $context["parentKey"] : (function () { throw new RuntimeError('Variable "parentKey" does not exist.', 4, $this->source); })()) != "root")) ? ("is-reply") : (""));
            yield "\">
        <div class=\"comment-thread__card\">
            <div class=\"comment-thread__header\">
                <div class=\"social-contact-card__main\">
                    <span class=\"profile-avatar profile-avatar--small\">
                        ";
            // line 9
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "author", [], "any", false, false, false, 9), "avatarUrl", [], "any", false, false, false, 9)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 10
                yield "                            <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "author", [], "any", false, false, false, 10), "avatarUrl", [], "any", false, false, false, 10), "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "author", [], "any", false, false, false, 10), "name", [], "any", false, false, false, 10), "html", null, true);
                yield "\" referrerpolicy=\"no-referrer\">
                        ";
            } else {
                // line 12
                yield "                            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "author", [], "any", false, false, false, 12), "initials", [], "any", false, false, false, 12), "html", null, true);
                yield "
                        ";
            }
            // line 14
            yield "                    </span>

                    <div>
                        <strong>";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "author", [], "any", false, false, false, 17), "name", [], "any", false, false, false, 17), "html", null, true);
            yield "</strong>
                        <div class=\"social-post-card__subline\">
                            <span>";
            // line 19
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "author", [], "any", false, false, false, 19), "handle", [], "any", false, false, false, 19), "html", null, true);
            yield "</span>
                            <span class=\"social-dot\"></span>
                            <span title=\"";
            // line 21
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "createdLabel", [], "any", false, false, false, 21), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "createdRelative", [], "any", false, false, false, 21), "html", null, true);
            yield "</span>
                        </div>
                    </div>
                </div>
            </div>

            <p class=\"comment-thread__body\">";
            // line 27
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "body", [], "any", false, false, false, 27), "html", null, true);
            yield "</p>

            <div class=\"comment-thread__actions\">
                <button type=\"button\" class=\"social-inline-link social-inline-link--button\" data-reply-toggle=\"";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 30), "html", null, true);
            yield "\">Reply</button>
                ";
            // line 31
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "canDelete", [], "any", false, false, false, 31)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 32
                yield "                    <form method=\"post\" action=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 32)]), "html", null, true);
                yield "\" onsubmit=\"return confirm('Delete this comment?');\">
                        <input type=\"hidden\" name=\"_token\" value=\"";
                // line 33
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_comment_" . CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 33))), "html", null, true);
                yield "\">
                        <button type=\"submit\" class=\"social-inline-link social-inline-link--button social-inline-link--danger\">Delete</button>
                    </form>
                ";
            }
            // line 37
            yield "            </div>

            <form method=\"post\" action=\"";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_create", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 39, $this->source); })()), "id", [], "any", false, false, false, 39)]), "html", null, true);
            yield "\" class=\"comment-form comment-form--reply\" data-reply-form=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 39), "html", null, true);
            yield "\" hidden>
                <input type=\"hidden\" name=\"_token\" value=\"";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("comment_post_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 40, $this->source); })()), "id", [], "any", false, false, false, 40))), "html", null, true);
            yield "\">
                <input type=\"hidden\" name=\"parent_comment_id\" value=\"";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 41), "html", null, true);
            yield "\">
                <textarea name=\"body\" rows=\"3\" placeholder=\"Write a reply...\"></textarea>
                <div class=\"social-inline-actions\">
                    <button type=\"submit\" class=\"button-secondary\">Post reply</button>
                </div>
            </form>
        </div>

        ";
            // line 49
            yield Twig\Extension\CoreExtension::include($this->env, $context, "post/_comment_tree.html.twig", ["commentsByParent" =>             // line 50
(isset($context["commentsByParent"]) || array_key_exists("commentsByParent", $context) ? $context["commentsByParent"] : (function () { throw new RuntimeError('Variable "commentsByParent" does not exist.', 50, $this->source); })()), "parentKey" => CoreExtension::getAttribute($this->env, $this->source,             // line 51
$context["comment"], "id", [], "any", false, false, false, 51), "postCard" =>             // line 52
(isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 52, $this->source); })())]);
            // line 53
            yield "
    </article>
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
        unset($context['_seq'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "post/_comment_tree.html.twig";
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
        return array (  172 => 53,  170 => 52,  169 => 51,  168 => 50,  167 => 49,  156 => 41,  152 => 40,  146 => 39,  142 => 37,  135 => 33,  130 => 32,  128 => 31,  124 => 30,  118 => 27,  107 => 21,  102 => 19,  97 => 17,  92 => 14,  86 => 12,  78 => 10,  76 => 9,  67 => 4,  50 => 3,  47 => 2,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% set branch = commentsByParent[parentKey]|default([]) %}

{% for comment in branch %}
    <article class=\"comment-thread__item {{ parentKey != 'root' ? 'is-reply' : '' }}\">
        <div class=\"comment-thread__card\">
            <div class=\"comment-thread__header\">
                <div class=\"social-contact-card__main\">
                    <span class=\"profile-avatar profile-avatar--small\">
                        {% if comment.author.avatarUrl %}
                            <img src=\"{{ comment.author.avatarUrl }}\" alt=\"{{ comment.author.name }}\" referrerpolicy=\"no-referrer\">
                        {% else %}
                            {{ comment.author.initials }}
                        {% endif %}
                    </span>

                    <div>
                        <strong>{{ comment.author.name }}</strong>
                        <div class=\"social-post-card__subline\">
                            <span>{{ comment.author.handle }}</span>
                            <span class=\"social-dot\"></span>
                            <span title=\"{{ comment.createdLabel }}\">{{ comment.createdRelative }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <p class=\"comment-thread__body\">{{ comment.body }}</p>

            <div class=\"comment-thread__actions\">
                <button type=\"button\" class=\"social-inline-link social-inline-link--button\" data-reply-toggle=\"{{ comment.id }}\">Reply</button>
                {% if comment.canDelete %}
                    <form method=\"post\" action=\"{{ path('comment_delete', { id: comment.id }) }}\" onsubmit=\"return confirm('Delete this comment?');\">
                        <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_comment_' ~ comment.id) }}\">
                        <button type=\"submit\" class=\"social-inline-link social-inline-link--button social-inline-link--danger\">Delete</button>
                    </form>
                {% endif %}
            </div>

            <form method=\"post\" action=\"{{ path('comment_create', { id: postCard.id }) }}\" class=\"comment-form comment-form--reply\" data-reply-form=\"{{ comment.id }}\" hidden>
                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('comment_post_' ~ postCard.id) }}\">
                <input type=\"hidden\" name=\"parent_comment_id\" value=\"{{ comment.id }}\">
                <textarea name=\"body\" rows=\"3\" placeholder=\"Write a reply...\"></textarea>
                <div class=\"social-inline-actions\">
                    <button type=\"submit\" class=\"button-secondary\">Post reply</button>
                </div>
            </form>
        </div>

        {{ include('post/_comment_tree.html.twig', {
            commentsByParent: commentsByParent,
            parentKey: comment.id,
            postCard: postCard
        }) }}
    </article>
{% endfor %}
", "post/_comment_tree.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\post\\_comment_tree.html.twig");
    }
}
