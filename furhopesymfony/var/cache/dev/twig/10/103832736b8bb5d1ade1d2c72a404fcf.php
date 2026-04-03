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

/* feed/index.html.twig */
class __TwigTemplate_2ab1b3487a0e708adab0e71e3662d025 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "feed/index.html.twig"));

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

        yield "Social feed | FurHope";
        
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
        yield "    <div class=\"social-page\">
        <div class=\"social-shell\">
            <aside class=\"social-rail social-rail--left\">
                <section class=\"social-card social-card--profile\">
                    <div class=\"social-card__cover\"></div>
                    <div class=\"social-card__content\">
                        <div class=\"social-user-chip social-user-chip--profile\">
                            <span class=\"profile-avatar profile-avatar--large\">
                                ";
        // line 19
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["viewer"]) || array_key_exists("viewer", $context) ? $context["viewer"] : (function () { throw new RuntimeError('Variable "viewer" does not exist.', 19, $this->source); })()), "avatarUrl", [], "any", false, false, false, 19)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 20
            yield "                                    <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["viewer"]) || array_key_exists("viewer", $context) ? $context["viewer"] : (function () { throw new RuntimeError('Variable "viewer" does not exist.', 20, $this->source); })()), "avatarUrl", [], "any", false, false, false, 20), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["viewer"]) || array_key_exists("viewer", $context) ? $context["viewer"] : (function () { throw new RuntimeError('Variable "viewer" does not exist.', 20, $this->source); })()), "name", [], "any", false, false, false, 20), "html", null, true);
            yield "\" referrerpolicy=\"no-referrer\">
                                ";
        } else {
            // line 22
            yield "                                    ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["viewer"]) || array_key_exists("viewer", $context) ? $context["viewer"] : (function () { throw new RuntimeError('Variable "viewer" does not exist.', 22, $this->source); })()), "initials", [], "any", false, false, false, 22), "html", null, true);
            yield "
                                ";
        }
        // line 24
        yield "                            </span>

                            <div>
                                <p class=\"social-kicker\">Rescue profile</p>
                                <h2>";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["viewer"]) || array_key_exists("viewer", $context) ? $context["viewer"] : (function () { throw new RuntimeError('Variable "viewer" does not exist.', 28, $this->source); })()), "name", [], "any", false, false, false, 28), "html", null, true);
        yield "</h2>
                                <p class=\"social-handle\">";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["viewer"]) || array_key_exists("viewer", $context) ? $context["viewer"] : (function () { throw new RuntimeError('Variable "viewer" does not exist.', 29, $this->source); })()), "handle", [], "any", false, false, false, 29), "html", null, true);
        yield "</p>
                                <p class=\"social-muted\">";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["viewer"]) || array_key_exists("viewer", $context) ? $context["viewer"] : (function () { throw new RuntimeError('Variable "viewer" does not exist.', 30, $this->source); })()), "email", [], "any", false, false, false, 30), "html", null, true);
        yield "</p>
                            </div>
                        </div>

                        <div class=\"social-stat-grid\">
                            ";
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 35, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["stat"]) {
            // line 36
            yield "                                <article>
                                    <strong>";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stat"], "value", [], "any", false, false, false, 37), "html", null, true);
            yield "</strong>
                                    <span>";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stat"], "label", [], "any", false, false, false, 38), "html", null, true);
            yield "</span>
                                </article>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['stat'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        yield "                        </div>

                        <div class=\"social-inline-actions\">
                            <a class=\"button-secondary\" href=\"";
        // line 44
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dashboard");
        yield "\">Dashboard</a>
                            <a class=\"button-secondary\" href=\"";
        // line 45
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile");
        yield "\">Profile</a>
                        </div>
                    </div>
                </section>

                <section class=\"social-card\">
                    <div class=\"social-card__header\">
                        <div>
                            <p class=\"social-kicker\">Find friends</p>
                            <h3>Search members live</h3>
                        </div>
                        <span class=\"social-badge\">";
        // line 56
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["friendIds"]) || array_key_exists("friendIds", $context) ? $context["friendIds"] : (function () { throw new RuntimeError('Variable "friendIds" does not exist.', 56, $this->source); })())), "html", null, true);
        yield "</span>
                    </div>

                    <form method=\"get\" action=\"";
        // line 59
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("feed_index");
        yield "\" class=\"social-live-search\" data-social-search>
                        <label for=\"social-search-input\" class=\"social-visually-hidden\">Search by name or email</label>
                        <div class=\"social-live-search__row\">
                            <input
                                id=\"social-search-input\"
                                type=\"search\"
                                name=\"q\"
                                value=\"";
        // line 66
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["searchTerm"]) || array_key_exists("searchTerm", $context) ? $context["searchTerm"] : (function () { throw new RuntimeError('Variable "searchTerm" does not exist.', 66, $this->source); })()), "html", null, true);
        yield "\"
                                placeholder=\"Type a name or email...\"
                                autocomplete=\"off\"
                                data-social-search-input
                            >
                            <button type=\"submit\" class=\"button-primary\">Find</button>
                        </div>
                        <p class=\"social-muted\">Results refresh as you type.</p>
                    </form>

                    <div class=\"social-card__body\" id=\"social-search-results\" data-social-search-results>
                        ";
        // line 77
        yield Twig\Extension\CoreExtension::include($this->env, $context, "feed/_connection_results.html.twig", ["searchTerm" =>         // line 78
(isset($context["searchTerm"]) || array_key_exists("searchTerm", $context) ? $context["searchTerm"] : (function () { throw new RuntimeError('Variable "searchTerm" does not exist.', 78, $this->source); })()), "searchCards" =>         // line 79
(isset($context["searchCards"]) || array_key_exists("searchCards", $context) ? $context["searchCards"] : (function () { throw new RuntimeError('Variable "searchCards" does not exist.', 79, $this->source); })()), "friendPreview" =>         // line 80
(isset($context["friendPreview"]) || array_key_exists("friendPreview", $context) ? $context["friendPreview"] : (function () { throw new RuntimeError('Variable "friendPreview" does not exist.', 80, $this->source); })())]);
        // line 81
        yield "
                    </div>
                </section>
            </aside>

            <main class=\"social-main\">
                <section class=\"social-hero-card\">
                    <div>
                        <p class=\"social-kicker\">Community social feed</p>
                        <h1>Animal stories, rescue moments, and friend updates.</h1>
                        <p>
                            Friends, requests, notifications, and posts each have their own breathing room now, so the feed feels
                            easier to scan and more natural to use.
                        </p>
                    </div>

                    <div class=\"social-chip-row\">
                        <span class=\"social-chip\">Animal-first</span>
                        <span class=\"social-chip\">Live search</span>
                        <span class=\"social-chip\">Nested threads</span>
                    </div>
                </section>

                <section class=\"social-overview-grid\">
                    <article class=\"social-overview-card\">
                        <small>Friends</small>
                        <strong>";
        // line 107
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["friendIds"]) || array_key_exists("friendIds", $context) ? $context["friendIds"] : (function () { throw new RuntimeError('Variable "friendIds" does not exist.', 107, $this->source); })())), "html", null, true);
        yield "</strong>
                        <span>Your rescue network inside FurHope.</span>
                    </article>

                    <article class=\"social-overview-card\">
                        <small>Pending requests</small>
                        <strong>";
        // line 113
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["requestCards"]) || array_key_exists("requestCards", $context) ? $context["requestCards"] : (function () { throw new RuntimeError('Variable "requestCards" does not exist.', 113, $this->source); })())), "html", null, true);
        yield "</strong>
                        <span>People waiting to connect with you.</span>
                    </article>

                    <article class=\"social-overview-card\">
                        <small>Unread notifications</small>
                        <strong>";
        // line 119
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["unreadNotificationCount"]) || array_key_exists("unreadNotificationCount", $context) ? $context["unreadNotificationCount"] : (function () { throw new RuntimeError('Variable "unreadNotificationCount" does not exist.', 119, $this->source); })()), "html", null, true);
        yield "</strong>
                        <span>Likes, comments, and replies that need your attention.</span>
                    </article>
                </section>

                ";
        // line 124
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty((isset($context["storyCards"]) || array_key_exists("storyCards", $context) ? $context["storyCards"] : (function () { throw new RuntimeError('Variable "storyCards" does not exist.', 124, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 125
            yield "                    <section class=\"social-card\">
                        <div class=\"social-card__header\">
                            <div>
                                <p class=\"social-kicker\">Animal stories</p>
                                <h3>Photo moments from the feed</h3>
                            </div>
                        </div>

                        <div class=\"social-story-row\">
                            ";
            // line 134
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["storyCards"]) || array_key_exists("storyCards", $context) ? $context["storyCards"] : (function () { throw new RuntimeError('Variable "storyCards" does not exist.', 134, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["story"]) {
                // line 135
                yield "                                <a class=\"social-story-card\" href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["story"], "postId", [], "any", false, false, false, 135)]), "html", null, true);
                yield "\">
                                    <img src=\"";
                // line 136
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "mediaUrl", [], "any", false, false, false, 136), "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "caption", [], "any", false, false, false, 136), "html", null, true);
                yield "\" referrerpolicy=\"no-referrer\">
                                    <span class=\"social-story-card__shade\"></span>
                                    <div class=\"social-story-card__meta\">
                                        <strong>";
                // line 139
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["story"], "author", [], "any", false, false, false, 139), "name", [], "any", false, false, false, 139), "html", null, true);
                yield "</strong>
                                        <span>";
                // line 140
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "caption", [], "any", false, false, false, 140), "html", null, true);
                yield "</span>
                                    </div>
                                </a>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['story'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 144
            yield "                        </div>
                    </section>
                ";
        }
        // line 147
        yield "
                <section class=\"social-card social-card--composer\">
                    <div class=\"social-card__header\">
                        <div>
                            <p class=\"social-kicker\">Create</p>
                            <h2>Share a new animal update</h2>
                        </div>
                        <a class=\"social-inline-link\" href=\"";
        // line 154
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_new");
        yield "\">Open full composer</a>
                    </div>

                    ";
        // line 157
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 157, $this->source); })()), 'form_start', ["action" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_new"), "attr" => ["class" => "social-compose-form"]]);
        yield "
                        <div class=\"social-compose-form__main\">
                            ";
        // line 159
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 159, $this->source); })()), "caption", [], "any", false, false, false, 159), 'label');
        yield "
                            ";
        // line 160
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 160, $this->source); })()), "caption", [], "any", false, false, false, 160), 'widget', ["attr" => ["class" => "social-compose-form__caption"]]);
        yield "
                            ";
        // line 161
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 161, $this->source); })()), "caption", [], "any", false, false, false, 161), 'errors');
        yield "
                        </div>

                        <div class=\"social-form-grid\">
                            <div>
                                ";
        // line 166
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 166, $this->source); })()), "mediaType", [], "any", false, false, false, 166), 'label');
        yield "
                                ";
        // line 167
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 167, $this->source); })()), "mediaType", [], "any", false, false, false, 167), 'widget');
        yield "
                                ";
        // line 168
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 168, $this->source); })()), "mediaType", [], "any", false, false, false, 168), 'errors');
        yield "
                            </div>
                            <div>
                                ";
        // line 171
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 171, $this->source); })()), "visibility", [], "any", false, false, false, 171), 'label');
        yield "
                                ";
        // line 172
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 172, $this->source); })()), "visibility", [], "any", false, false, false, 172), 'widget');
        yield "
                                ";
        // line 173
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 173, $this->source); })()), "visibility", [], "any", false, false, false, 173), 'errors');
        yield "
                            </div>
                        </div>

                        <div class=\"social-form-grid\">
                            <div>
                                ";
        // line 179
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 179, $this->source); })()), "mediaPath", [], "any", false, false, false, 179), 'label');
        yield "
                                ";
        // line 180
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 180, $this->source); })()), "mediaPath", [], "any", false, false, false, 180), 'widget');
        yield "
                                ";
        // line 181
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 181, $this->source); })()), "mediaPath", [], "any", false, false, false, 181), 'errors');
        yield "
                            </div>
                            <div>
                                ";
        // line 184
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 184, $this->source); })()), "mediaFile", [], "any", false, false, false, 184), 'label');
        yield "
                                ";
        // line 185
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 185, $this->source); })()), "mediaFile", [], "any", false, false, false, 185), 'widget');
        yield "
                                ";
        // line 186
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 186, $this->source); })()), "mediaFile", [], "any", false, false, false, 186), 'errors');
        yield "
                            </div>
                        </div>

                        ";
        // line 190
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 190, $this->source); })()), 'rest');
        yield "

                        <div class=\"social-inline-actions\">
                            <button type=\"submit\" class=\"button-primary\">Publish to feed</button>
                            <p class=\"social-muted\">Paste a URL, keep a Windows local path, or upload a file directly from your computer.</p>
                        </div>
                    ";
        // line 196
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["postForm"]) || array_key_exists("postForm", $context) ? $context["postForm"] : (function () { throw new RuntimeError('Variable "postForm" does not exist.', 196, $this->source); })()), 'form_end', ["render_rest" => false]);
        yield "
                </section>

                <section class=\"social-post-list\">
                    ";
        // line 200
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["feedPosts"]) || array_key_exists("feedPosts", $context) ? $context["feedPosts"] : (function () { throw new RuntimeError('Variable "feedPosts" does not exist.', 200, $this->source); })()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["postCard"]) {
            // line 201
            yield "                        ";
            yield Twig\Extension\CoreExtension::include($this->env, $context, "feed/_post_card.html.twig", ["postCard" => $context["postCard"], "detailMode" => false]);
            yield "
                    ";
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
        // line 202
        if (!$context['_iterated']) {
            // line 203
            yield "                        <section class=\"social-card empty-state empty-state--large\">
                            <strong>No visible posts yet.</strong>
                            <span>Publish the first update and bring this animal community to life.</span>
                        </section>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['postCard'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 208
        yield "                </section>
            </main>

            <aside class=\"social-rail social-rail--right\">
                <section class=\"social-card\">
                    <div class=\"social-card__header\">
                        <div>
                            <p class=\"social-kicker\">Friend requests</p>
                            <h3>Requests waiting for you</h3>
                        </div>
                        <span class=\"social-badge\">";
        // line 218
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["requestCards"]) || array_key_exists("requestCards", $context) ? $context["requestCards"] : (function () { throw new RuntimeError('Variable "requestCards" does not exist.', 218, $this->source); })())), "html", null, true);
        yield "</span>
                    </div>

                    <div class=\"social-card__body social-stack\">
                        ";
        // line 222
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["requestCards"]) || array_key_exists("requestCards", $context) ? $context["requestCards"] : (function () { throw new RuntimeError('Variable "requestCards" does not exist.', 222, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["request"]) {
            // line 223
            yield "                            <article class=\"social-request-card\">
                                <div class=\"social-contact-card__main\">
                                    <span class=\"profile-avatar profile-avatar--small\">
                                        ";
            // line 226
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["request"], "sender", [], "any", false, false, false, 226), "avatarUrl", [], "any", false, false, false, 226)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 227
                yield "                                            <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["request"], "sender", [], "any", false, false, false, 227), "avatarUrl", [], "any", false, false, false, 227), "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["request"], "sender", [], "any", false, false, false, 227), "name", [], "any", false, false, false, 227), "html", null, true);
                yield "\" referrerpolicy=\"no-referrer\">
                                        ";
            } else {
                // line 229
                yield "                                            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["request"], "sender", [], "any", false, false, false, 229), "initials", [], "any", false, false, false, 229), "html", null, true);
                yield "
                                        ";
            }
            // line 231
            yield "                                    </span>
                                    <div>
                                        <strong>";
            // line 233
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["request"], "sender", [], "any", false, false, false, 233), "name", [], "any", false, false, false, 233), "html", null, true);
            yield "</strong>
                                        <span>";
            // line 234
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["request"], "sender", [], "any", false, false, false, 234), "handle", [], "any", false, false, false, 234), "html", null, true);
            yield "</span>
                                        <small>";
            // line 235
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["request"], "createdLabel", [], "any", false, false, false, 235), "html", null, true);
            yield "</small>
                                    </div>
                                </div>

                                <div class=\"social-contact-card__actions\">
                                    <form method=\"post\" action=\"";
            // line 240
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("friend_accept", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["request"], "request", [], "any", false, false, false, 240), "id", [], "any", false, false, false, 240)]), "html", null, true);
            yield "\">
                                        <input type=\"hidden\" name=\"_token\" value=\"";
            // line 241
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("accept_friend_request_" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["request"], "request", [], "any", false, false, false, 241), "id", [], "any", false, false, false, 241))), "html", null, true);
            yield "\">
                                        <button type=\"submit\" class=\"button-primary\">Accept</button>
                                    </form>
                                    <form method=\"post\" action=\"";
            // line 244
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("friend_decline", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["request"], "request", [], "any", false, false, false, 244), "id", [], "any", false, false, false, 244)]), "html", null, true);
            yield "\">
                                        <input type=\"hidden\" name=\"_token\" value=\"";
            // line 245
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("decline_friend_request_" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["request"], "request", [], "any", false, false, false, 245), "id", [], "any", false, false, false, 245))), "html", null, true);
            yield "\">
                                        <button type=\"submit\" class=\"button-secondary\">Decline</button>
                                    </form>
                                </div>
                            </article>
                        ";
            $context['_iterated'] = true;
        }
        // line 250
        if (!$context['_iterated']) {
            // line 251
            yield "                            <div class=\"empty-state\">
                                <strong>No pending requests.</strong>
                                <span>New invitations will appear here.</span>
                            </div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['request'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 256
        yield "                    </div>
                </section>

                <section class=\"social-card\">
                    <div class=\"social-card__header\">
                        <div>
                            <p class=\"social-kicker\">Notifications</p>
                            <h3>Your alerts</h3>
                        </div>
                        <span class=\"social-badge\">";
        // line 265
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["unreadNotificationCount"]) || array_key_exists("unreadNotificationCount", $context) ? $context["unreadNotificationCount"] : (function () { throw new RuntimeError('Variable "unreadNotificationCount" does not exist.', 265, $this->source); })()), "html", null, true);
        yield "</span>
                    </div>

                    ";
        // line 268
        if (((isset($context["unreadNotificationCount"]) || array_key_exists("unreadNotificationCount", $context) ? $context["unreadNotificationCount"] : (function () { throw new RuntimeError('Variable "unreadNotificationCount" does not exist.', 268, $this->source); })()) > 0)) {
            // line 269
            yield "                        <form method=\"post\" action=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("social_notification_read_all");
            yield "\" class=\"social-inline-actions\">
                            <input type=\"hidden\" name=\"_token\" value=\"";
            // line 270
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("read_all_notifications"), "html", null, true);
            yield "\">
                            <button type=\"submit\" class=\"button-secondary\">Mark all as read</button>
                        </form>
                    ";
        }
        // line 274
        yield "
                    <div class=\"social-card__body social-stack\">
                        ";
        // line 276
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["notificationCards"]) || array_key_exists("notificationCards", $context) ? $context["notificationCards"] : (function () { throw new RuntimeError('Variable "notificationCards" does not exist.', 276, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 277
            yield "                            <article class=\"social-notification-card ";
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "notification", [], "any", false, false, false, 277), "isRead", [], "any", false, false, false, 277)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("") : ("is-unread"));
            yield "\">
                                <span class=\"social-notification-card__icon social-notification-card__icon--";
            // line 278
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "icon", [], "any", false, false, false, 278), "html", null, true);
            yield "\"></span>
                                <div>
                                    <div class=\"social-notification-card__head\">
                                        <strong>";
            // line 281
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "actor", [], "any", false, false, false, 281), "name", [], "any", false, false, false, 281), "html", null, true);
            yield "</strong>
                                        <span title=\"";
            // line 282
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "createdLabel", [], "any", false, false, false, 282), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "createdRelative", [], "any", false, false, false, 282), "html", null, true);
            yield "</span>
                                    </div>
                                    <p>";
            // line 284
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "message", [], "any", false, false, false, 284), "html", null, true);
            yield "</p>
                                    <div class=\"social-inline-actions\">
                                        ";
            // line 286
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "notification", [], "any", false, false, false, 286), "postId", [], "any", false, false, false, 286)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 287
                yield "                                            <a class=\"social-inline-link\" href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "notification", [], "any", false, false, false, 287), "postId", [], "any", false, false, false, 287)]), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "cta", [], "any", false, false, false, 287), "html", null, true);
                yield "</a>
                                        ";
            }
            // line 289
            yield "                                        ";
            if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "notification", [], "any", false, false, false, 289), "isRead", [], "any", false, false, false, 289)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 290
                yield "                                            <form method=\"post\" action=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("social_notification_read", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "notification", [], "any", false, false, false, 290), "id", [], "any", false, false, false, 290)]), "html", null, true);
                yield "\">
                                                <input type=\"hidden\" name=\"_token\" value=\"";
                // line 291
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("read_notification_" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "notification", [], "any", false, false, false, 291), "id", [], "any", false, false, false, 291))), "html", null, true);
                yield "\">
                                                <button type=\"submit\" class=\"social-inline-link social-inline-link--button\">Mark read</button>
                                            </form>
                                        ";
            }
            // line 295
            yield "                                    </div>
                                </div>
                            </article>
                        ";
            $context['_iterated'] = true;
        }
        // line 298
        if (!$context['_iterated']) {
            // line 299
            yield "                            <div class=\"empty-state\">
                                <strong>No notifications yet.</strong>
                                <span>Likes, comments, and replies will appear here.</span>
                            </div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 304
        yield "                    </div>
                </section>
            </aside>
        </div>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 311
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 312
        yield "    <script>
        (() => {
            const form = document.querySelector('[data-social-search]');
            const input = document.querySelector('[data-social-search-input]');
            const results = document.querySelector('[data-social-search-results]');

            if (!form || !input || !results) {
                return;
            }

            let timeoutId = null;
            let controller = null;

            const loadResults = async (query) => {
                if (controller) {
                    controller.abort();
                }

                controller = new AbortController();

                try {
                    const response = await fetch(`";
        // line 333
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("feed_search_members");
        yield "?q=\${encodeURIComponent(query)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        signal: controller.signal
                    });

                    if (!response.ok) {
                        return;
                    }

                    results.innerHTML = await response.text();
                } catch (error) {
                    if (error.name !== 'AbortError') {
                        console.error(error);
                    }
                }
            };

            input.addEventListener('input', () => {
                clearTimeout(timeoutId);
                timeoutId = window.setTimeout(() => loadResults(input.value.trim()), 180);
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
        return "feed/index.html.twig";
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
        return array (  756 => 333,  733 => 312,  723 => 311,  710 => 304,  700 => 299,  698 => 298,  691 => 295,  684 => 291,  679 => 290,  676 => 289,  668 => 287,  666 => 286,  661 => 284,  654 => 282,  650 => 281,  644 => 278,  639 => 277,  634 => 276,  630 => 274,  623 => 270,  618 => 269,  616 => 268,  610 => 265,  599 => 256,  589 => 251,  587 => 250,  577 => 245,  573 => 244,  567 => 241,  563 => 240,  555 => 235,  551 => 234,  547 => 233,  543 => 231,  537 => 229,  529 => 227,  527 => 226,  522 => 223,  517 => 222,  510 => 218,  498 => 208,  488 => 203,  486 => 202,  471 => 201,  453 => 200,  446 => 196,  437 => 190,  430 => 186,  426 => 185,  422 => 184,  416 => 181,  412 => 180,  408 => 179,  399 => 173,  395 => 172,  391 => 171,  385 => 168,  381 => 167,  377 => 166,  369 => 161,  365 => 160,  361 => 159,  356 => 157,  350 => 154,  341 => 147,  336 => 144,  326 => 140,  322 => 139,  314 => 136,  309 => 135,  305 => 134,  294 => 125,  292 => 124,  284 => 119,  275 => 113,  266 => 107,  238 => 81,  236 => 80,  235 => 79,  234 => 78,  233 => 77,  219 => 66,  209 => 59,  203 => 56,  189 => 45,  185 => 44,  180 => 41,  171 => 38,  167 => 37,  164 => 36,  160 => 35,  152 => 30,  148 => 29,  144 => 28,  138 => 24,  132 => 22,  124 => 20,  122 => 19,  112 => 11,  102 => 10,  92 => 7,  87 => 6,  77 => 5,  60 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Social feed | FurHope{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <link rel=\"stylesheet\" href=\"{{ asset('styles/social-feed.css') }}\">
{% endblock %}

{% block body %}
    <div class=\"social-page\">
        <div class=\"social-shell\">
            <aside class=\"social-rail social-rail--left\">
                <section class=\"social-card social-card--profile\">
                    <div class=\"social-card__cover\"></div>
                    <div class=\"social-card__content\">
                        <div class=\"social-user-chip social-user-chip--profile\">
                            <span class=\"profile-avatar profile-avatar--large\">
                                {% if viewer.avatarUrl %}
                                    <img src=\"{{ viewer.avatarUrl }}\" alt=\"{{ viewer.name }}\" referrerpolicy=\"no-referrer\">
                                {% else %}
                                    {{ viewer.initials }}
                                {% endif %}
                            </span>

                            <div>
                                <p class=\"social-kicker\">Rescue profile</p>
                                <h2>{{ viewer.name }}</h2>
                                <p class=\"social-handle\">{{ viewer.handle }}</p>
                                <p class=\"social-muted\">{{ viewer.email }}</p>
                            </div>
                        </div>

                        <div class=\"social-stat-grid\">
                            {% for stat in stats %}
                                <article>
                                    <strong>{{ stat.value }}</strong>
                                    <span>{{ stat.label }}</span>
                                </article>
                            {% endfor %}
                        </div>

                        <div class=\"social-inline-actions\">
                            <a class=\"button-secondary\" href=\"{{ path('app_dashboard') }}\">Dashboard</a>
                            <a class=\"button-secondary\" href=\"{{ path('app_profile') }}\">Profile</a>
                        </div>
                    </div>
                </section>

                <section class=\"social-card\">
                    <div class=\"social-card__header\">
                        <div>
                            <p class=\"social-kicker\">Find friends</p>
                            <h3>Search members live</h3>
                        </div>
                        <span class=\"social-badge\">{{ friendIds|length }}</span>
                    </div>

                    <form method=\"get\" action=\"{{ path('feed_index') }}\" class=\"social-live-search\" data-social-search>
                        <label for=\"social-search-input\" class=\"social-visually-hidden\">Search by name or email</label>
                        <div class=\"social-live-search__row\">
                            <input
                                id=\"social-search-input\"
                                type=\"search\"
                                name=\"q\"
                                value=\"{{ searchTerm }}\"
                                placeholder=\"Type a name or email...\"
                                autocomplete=\"off\"
                                data-social-search-input
                            >
                            <button type=\"submit\" class=\"button-primary\">Find</button>
                        </div>
                        <p class=\"social-muted\">Results refresh as you type.</p>
                    </form>

                    <div class=\"social-card__body\" id=\"social-search-results\" data-social-search-results>
                        {{ include('feed/_connection_results.html.twig', {
                            searchTerm: searchTerm,
                            searchCards: searchCards,
                            friendPreview: friendPreview
                        }) }}
                    </div>
                </section>
            </aside>

            <main class=\"social-main\">
                <section class=\"social-hero-card\">
                    <div>
                        <p class=\"social-kicker\">Community social feed</p>
                        <h1>Animal stories, rescue moments, and friend updates.</h1>
                        <p>
                            Friends, requests, notifications, and posts each have their own breathing room now, so the feed feels
                            easier to scan and more natural to use.
                        </p>
                    </div>

                    <div class=\"social-chip-row\">
                        <span class=\"social-chip\">Animal-first</span>
                        <span class=\"social-chip\">Live search</span>
                        <span class=\"social-chip\">Nested threads</span>
                    </div>
                </section>

                <section class=\"social-overview-grid\">
                    <article class=\"social-overview-card\">
                        <small>Friends</small>
                        <strong>{{ friendIds|length }}</strong>
                        <span>Your rescue network inside FurHope.</span>
                    </article>

                    <article class=\"social-overview-card\">
                        <small>Pending requests</small>
                        <strong>{{ requestCards|length }}</strong>
                        <span>People waiting to connect with you.</span>
                    </article>

                    <article class=\"social-overview-card\">
                        <small>Unread notifications</small>
                        <strong>{{ unreadNotificationCount }}</strong>
                        <span>Likes, comments, and replies that need your attention.</span>
                    </article>
                </section>

                {% if storyCards is not empty %}
                    <section class=\"social-card\">
                        <div class=\"social-card__header\">
                            <div>
                                <p class=\"social-kicker\">Animal stories</p>
                                <h3>Photo moments from the feed</h3>
                            </div>
                        </div>

                        <div class=\"social-story-row\">
                            {% for story in storyCards %}
                                <a class=\"social-story-card\" href=\"{{ path('post_show', { id: story.postId }) }}\">
                                    <img src=\"{{ story.mediaUrl }}\" alt=\"{{ story.caption }}\" referrerpolicy=\"no-referrer\">
                                    <span class=\"social-story-card__shade\"></span>
                                    <div class=\"social-story-card__meta\">
                                        <strong>{{ story.author.name }}</strong>
                                        <span>{{ story.caption }}</span>
                                    </div>
                                </a>
                            {% endfor %}
                        </div>
                    </section>
                {% endif %}

                <section class=\"social-card social-card--composer\">
                    <div class=\"social-card__header\">
                        <div>
                            <p class=\"social-kicker\">Create</p>
                            <h2>Share a new animal update</h2>
                        </div>
                        <a class=\"social-inline-link\" href=\"{{ path('post_new') }}\">Open full composer</a>
                    </div>

                    {{ form_start(postForm, { action: path('post_new'), attr: { class: 'social-compose-form' } }) }}
                        <div class=\"social-compose-form__main\">
                            {{ form_label(postForm.caption) }}
                            {{ form_widget(postForm.caption, { attr: { class: 'social-compose-form__caption' } }) }}
                            {{ form_errors(postForm.caption) }}
                        </div>

                        <div class=\"social-form-grid\">
                            <div>
                                {{ form_label(postForm.mediaType) }}
                                {{ form_widget(postForm.mediaType) }}
                                {{ form_errors(postForm.mediaType) }}
                            </div>
                            <div>
                                {{ form_label(postForm.visibility) }}
                                {{ form_widget(postForm.visibility) }}
                                {{ form_errors(postForm.visibility) }}
                            </div>
                        </div>

                        <div class=\"social-form-grid\">
                            <div>
                                {{ form_label(postForm.mediaPath) }}
                                {{ form_widget(postForm.mediaPath) }}
                                {{ form_errors(postForm.mediaPath) }}
                            </div>
                            <div>
                                {{ form_label(postForm.mediaFile) }}
                                {{ form_widget(postForm.mediaFile) }}
                                {{ form_errors(postForm.mediaFile) }}
                            </div>
                        </div>

                        {{ form_rest(postForm) }}

                        <div class=\"social-inline-actions\">
                            <button type=\"submit\" class=\"button-primary\">Publish to feed</button>
                            <p class=\"social-muted\">Paste a URL, keep a Windows local path, or upload a file directly from your computer.</p>
                        </div>
                    {{ form_end(postForm, { render_rest: false }) }}
                </section>

                <section class=\"social-post-list\">
                    {% for postCard in feedPosts %}
                        {{ include('feed/_post_card.html.twig', { postCard: postCard, detailMode: false }) }}
                    {% else %}
                        <section class=\"social-card empty-state empty-state--large\">
                            <strong>No visible posts yet.</strong>
                            <span>Publish the first update and bring this animal community to life.</span>
                        </section>
                    {% endfor %}
                </section>
            </main>

            <aside class=\"social-rail social-rail--right\">
                <section class=\"social-card\">
                    <div class=\"social-card__header\">
                        <div>
                            <p class=\"social-kicker\">Friend requests</p>
                            <h3>Requests waiting for you</h3>
                        </div>
                        <span class=\"social-badge\">{{ requestCards|length }}</span>
                    </div>

                    <div class=\"social-card__body social-stack\">
                        {% for request in requestCards %}
                            <article class=\"social-request-card\">
                                <div class=\"social-contact-card__main\">
                                    <span class=\"profile-avatar profile-avatar--small\">
                                        {% if request.sender.avatarUrl %}
                                            <img src=\"{{ request.sender.avatarUrl }}\" alt=\"{{ request.sender.name }}\" referrerpolicy=\"no-referrer\">
                                        {% else %}
                                            {{ request.sender.initials }}
                                        {% endif %}
                                    </span>
                                    <div>
                                        <strong>{{ request.sender.name }}</strong>
                                        <span>{{ request.sender.handle }}</span>
                                        <small>{{ request.createdLabel }}</small>
                                    </div>
                                </div>

                                <div class=\"social-contact-card__actions\">
                                    <form method=\"post\" action=\"{{ path('friend_accept', { id: request.request.id }) }}\">
                                        <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('accept_friend_request_' ~ request.request.id) }}\">
                                        <button type=\"submit\" class=\"button-primary\">Accept</button>
                                    </form>
                                    <form method=\"post\" action=\"{{ path('friend_decline', { id: request.request.id }) }}\">
                                        <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('decline_friend_request_' ~ request.request.id) }}\">
                                        <button type=\"submit\" class=\"button-secondary\">Decline</button>
                                    </form>
                                </div>
                            </article>
                        {% else %}
                            <div class=\"empty-state\">
                                <strong>No pending requests.</strong>
                                <span>New invitations will appear here.</span>
                            </div>
                        {% endfor %}
                    </div>
                </section>

                <section class=\"social-card\">
                    <div class=\"social-card__header\">
                        <div>
                            <p class=\"social-kicker\">Notifications</p>
                            <h3>Your alerts</h3>
                        </div>
                        <span class=\"social-badge\">{{ unreadNotificationCount }}</span>
                    </div>

                    {% if unreadNotificationCount > 0 %}
                        <form method=\"post\" action=\"{{ path('social_notification_read_all') }}\" class=\"social-inline-actions\">
                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('read_all_notifications') }}\">
                            <button type=\"submit\" class=\"button-secondary\">Mark all as read</button>
                        </form>
                    {% endif %}

                    <div class=\"social-card__body social-stack\">
                        {% for item in notificationCards %}
                            <article class=\"social-notification-card {{ item.notification.isRead ? '' : 'is-unread' }}\">
                                <span class=\"social-notification-card__icon social-notification-card__icon--{{ item.icon }}\"></span>
                                <div>
                                    <div class=\"social-notification-card__head\">
                                        <strong>{{ item.actor.name }}</strong>
                                        <span title=\"{{ item.createdLabel }}\">{{ item.createdRelative }}</span>
                                    </div>
                                    <p>{{ item.message }}</p>
                                    <div class=\"social-inline-actions\">
                                        {% if item.notification.postId %}
                                            <a class=\"social-inline-link\" href=\"{{ path('post_show', { id: item.notification.postId }) }}\">{{ item.cta }}</a>
                                        {% endif %}
                                        {% if not item.notification.isRead %}
                                            <form method=\"post\" action=\"{{ path('social_notification_read', { id: item.notification.id }) }}\">
                                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('read_notification_' ~ item.notification.id) }}\">
                                                <button type=\"submit\" class=\"social-inline-link social-inline-link--button\">Mark read</button>
                                            </form>
                                        {% endif %}
                                    </div>
                                </div>
                            </article>
                        {% else %}
                            <div class=\"empty-state\">
                                <strong>No notifications yet.</strong>
                                <span>Likes, comments, and replies will appear here.</span>
                            </div>
                        {% endfor %}
                    </div>
                </section>
            </aside>
        </div>
    </div>
{% endblock %}

{% block javascripts %}
    <script>
        (() => {
            const form = document.querySelector('[data-social-search]');
            const input = document.querySelector('[data-social-search-input]');
            const results = document.querySelector('[data-social-search-results]');

            if (!form || !input || !results) {
                return;
            }

            let timeoutId = null;
            let controller = null;

            const loadResults = async (query) => {
                if (controller) {
                    controller.abort();
                }

                controller = new AbortController();

                try {
                    const response = await fetch(`{{ path('feed_search_members') }}?q=\${encodeURIComponent(query)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        signal: controller.signal
                    });

                    if (!response.ok) {
                        return;
                    }

                    results.innerHTML = await response.text();
                } catch (error) {
                    if (error.name !== 'AbortError') {
                        console.error(error);
                    }
                }
            };

            input.addEventListener('input', () => {
                clearTimeout(timeoutId);
                timeoutId = window.setTimeout(() => loadResults(input.value.trim()), 180);
            });
        })();
    </script>
{% endblock %}
", "feed/index.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\feed\\index.html.twig");
    }
}
