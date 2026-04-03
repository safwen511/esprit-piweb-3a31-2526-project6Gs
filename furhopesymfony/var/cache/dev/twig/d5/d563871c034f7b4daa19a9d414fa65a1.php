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

/* post/show.html.twig */
class __TwigTemplate_04bfd8ce0064113dc71dde989df20b0c extends Template
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
            'javascripts' => [$this, 'block_javascripts'],
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "post/show.html.twig"));

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

        yield "Post #";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 3, $this->source); })()), "id", [], "any", false, false, false, 3), "html", null, true);
        yield " | FurHope";
        
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("styles/social-feed.css"), "html", null, true);
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
        yield "    <section class=\"social-page\">
        <div class=\"social-detail\">
            <div class=\"social-detail__main\">
                ";
        // line 14
        yield Twig\Extension\CoreExtension::include($this->env, $context, "feed/_post_card.html.twig", ["postCard" => (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 14, $this->source); })()), "detailMode" => true]);
        yield "

                <section class=\"social-card\">
                    <div class=\"social-card__header\">
                        <div>
                            <p class=\"social-kicker\">Join the thread</p>
                            <h2>Comment on this post</h2>
                        </div>
                        <a class=\"social-inline-link\" href=\"";
        // line 22
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("feed_index");
        yield "\">Back to feed</a>
                    </div>

                    <form method=\"post\" action=\"";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_create", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 25, $this->source); })()), "id", [], "any", false, false, false, 25)]), "html", null, true);
        yield "\" class=\"comment-form\">
                        <input type=\"hidden\" name=\"_token\" value=\"";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("comment_post_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 26, $this->source); })()), "id", [], "any", false, false, false, 26))), "html", null, true);
        yield "\">
                        <textarea name=\"body\" rows=\"4\" placeholder=\"Add a thoughtful comment, rescue update, or adoption insight...\"></textarea>
                        <div class=\"social-inline-actions\">
                            <button type=\"submit\" class=\"button-primary\">Post comment</button>
                        </div>
                    </form>
                </section>

                <section class=\"social-card\">
                    <div class=\"social-card__header\">
                        <div>
                            <p class=\"social-kicker\">Nested replies</p>
                            <h2>Discussion</h2>
                        </div>
                        <span class=\"social-badge\">";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["commentCount"]) || array_key_exists("commentCount", $context) ? $context["commentCount"] : (function () { throw new RuntimeError('Variable "commentCount" does not exist.', 40, $this->source); })()), "html", null, true);
        yield "</span>
                    </div>

                    ";
        // line 43
        if (((isset($context["commentCount"]) || array_key_exists("commentCount", $context) ? $context["commentCount"] : (function () { throw new RuntimeError('Variable "commentCount" does not exist.', 43, $this->source); })()) == 0)) {
            // line 44
            yield "                        <div class=\"empty-state\">
                            <strong>No comments yet.</strong>
                            <span>Start the conversation and help the next adopter learn more about this animal.</span>
                        </div>
                    ";
        } else {
            // line 49
            yield "                        <div class=\"comment-thread\">
                            ";
            // line 50
            yield Twig\Extension\CoreExtension::include($this->env, $context, "post/_comment_tree.html.twig", ["commentsByParent" =>             // line 51
(isset($context["commentsByParent"]) || array_key_exists("commentsByParent", $context) ? $context["commentsByParent"] : (function () { throw new RuntimeError('Variable "commentsByParent" does not exist.', 51, $this->source); })()), "parentKey" => "root", "postCard" =>             // line 53
(isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 53, $this->source); })())]);
            // line 54
            yield "
                        </div>
                    ";
        }
        // line 57
        yield "                </section>
            </div>
        </div>
    </section>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 63
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 64
        yield "    <script>
        (() => {
            document.querySelectorAll('[data-reply-toggle]').forEach((button) => {
                button.addEventListener('click', () => {
                    const target = document.querySelector(`[data-reply-form=\"\${button.dataset.replyToggle}\"]`);
                    if (!target) {
                        return;
                    }

                    const isHidden = target.hasAttribute('hidden');
                    if (isHidden) {
                        target.removeAttribute('hidden');
                        const textarea = target.querySelector('textarea');
                        if (textarea) {
                            textarea.focus();
                        }
                    } else {
                        target.setAttribute('hidden', 'hidden');
                    }
                });
            });
        })();
    </script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "post/show.html.twig";
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
        return array (  206 => 64,  196 => 63,  184 => 57,  179 => 54,  177 => 53,  176 => 51,  175 => 50,  172 => 49,  165 => 44,  163 => 43,  157 => 40,  140 => 26,  136 => 25,  130 => 22,  119 => 14,  114 => 11,  104 => 10,  94 => 7,  89 => 6,  79 => 5,  60 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Post #{{ post.id }} | FurHope{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <link rel=\"stylesheet\" href=\"{{ asset('styles/social-feed.css') }}\">
{% endblock %}

{% block body %}
    <section class=\"social-page\">
        <div class=\"social-detail\">
            <div class=\"social-detail__main\">
                {{ include('feed/_post_card.html.twig', { postCard: postCard, detailMode: true }) }}

                <section class=\"social-card\">
                    <div class=\"social-card__header\">
                        <div>
                            <p class=\"social-kicker\">Join the thread</p>
                            <h2>Comment on this post</h2>
                        </div>
                        <a class=\"social-inline-link\" href=\"{{ path('feed_index') }}\">Back to feed</a>
                    </div>

                    <form method=\"post\" action=\"{{ path('comment_create', { id: post.id }) }}\" class=\"comment-form\">
                        <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('comment_post_' ~ post.id) }}\">
                        <textarea name=\"body\" rows=\"4\" placeholder=\"Add a thoughtful comment, rescue update, or adoption insight...\"></textarea>
                        <div class=\"social-inline-actions\">
                            <button type=\"submit\" class=\"button-primary\">Post comment</button>
                        </div>
                    </form>
                </section>

                <section class=\"social-card\">
                    <div class=\"social-card__header\">
                        <div>
                            <p class=\"social-kicker\">Nested replies</p>
                            <h2>Discussion</h2>
                        </div>
                        <span class=\"social-badge\">{{ commentCount }}</span>
                    </div>

                    {% if commentCount == 0 %}
                        <div class=\"empty-state\">
                            <strong>No comments yet.</strong>
                            <span>Start the conversation and help the next adopter learn more about this animal.</span>
                        </div>
                    {% else %}
                        <div class=\"comment-thread\">
                            {{ include('post/_comment_tree.html.twig', {
                                commentsByParent: commentsByParent,
                                parentKey: 'root',
                                postCard: postCard
                            }) }}
                        </div>
                    {% endif %}
                </section>
            </div>
        </div>
    </section>
{% endblock %}

{% block javascripts %}
    <script>
        (() => {
            document.querySelectorAll('[data-reply-toggle]').forEach((button) => {
                button.addEventListener('click', () => {
                    const target = document.querySelector(`[data-reply-form=\"\${button.dataset.replyToggle}\"]`);
                    if (!target) {
                        return;
                    }

                    const isHidden = target.hasAttribute('hidden');
                    if (isHidden) {
                        target.removeAttribute('hidden');
                        const textarea = target.querySelector('textarea');
                        if (textarea) {
                            textarea.focus();
                        }
                    } else {
                        target.setAttribute('hidden', 'hidden');
                    }
                });
            });
        })();
    </script>
{% endblock %}
", "post/show.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\post\\show.html.twig");
    }
}
