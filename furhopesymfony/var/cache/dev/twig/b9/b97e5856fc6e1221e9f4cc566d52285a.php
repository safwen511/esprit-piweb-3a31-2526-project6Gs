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

/* feed/_post_card.html.twig */
class __TwigTemplate_502955e2d627ea2cfdfb67a55a154d5c extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "feed/_post_card.html.twig"));

        // line 1
        yield "<article class=\"social-post-card\">
    <header class=\"social-post-card__header\">
        <div class=\"social-post-card__author\">
            <span class=\"profile-avatar profile-avatar--small\">
                ";
        // line 5
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 5, $this->source); })()), "author", [], "any", false, false, false, 5), "avatarUrl", [], "any", false, false, false, 5)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 6
            yield "                    <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 6, $this->source); })()), "author", [], "any", false, false, false, 6), "avatarUrl", [], "any", false, false, false, 6), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 6, $this->source); })()), "author", [], "any", false, false, false, 6), "name", [], "any", false, false, false, 6), "html", null, true);
            yield "\" referrerpolicy=\"no-referrer\">
                ";
        } else {
            // line 8
            yield "                    ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 8, $this->source); })()), "author", [], "any", false, false, false, 8), "initials", [], "any", false, false, false, 8), "html", null, true);
            yield "
                ";
        }
        // line 10
        yield "            </span>

            <div class=\"social-post-card__author-meta\">
                <strong>";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 13, $this->source); })()), "author", [], "any", false, false, false, 13), "name", [], "any", false, false, false, 13), "html", null, true);
        yield "</strong>
                <div class=\"social-post-card__subline\">
                    <span>";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 15, $this->source); })()), "author", [], "any", false, false, false, 15), "handle", [], "any", false, false, false, 15), "html", null, true);
        yield "</span>
                    <span class=\"social-dot\"></span>
                    <span title=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 17, $this->source); })()), "createdLabel", [], "any", false, false, false, 17), "html", null, true);
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 17, $this->source); })()), "createdRelative", [], "any", false, false, false, 17), "html", null, true);
        yield "</span>
                    <span class=\"social-dot\"></span>
                    <span>";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 19, $this->source); })()), "visibilityLabel", [], "any", false, false, false, 19), "html", null, true);
        yield "</span>
                </div>
            </div>
        </div>

        <div class=\"social-post-card__badges\">
            ";
        // line 25
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 25, $this->source); })()), "isOwner", [], "any", false, false, false, 25)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 26
            yield "                <span class=\"social-pill social-pill--owner\">Your post</span>
            ";
        }
        // line 28
        yield "            ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 28, $this->source); })()), "mediaUrl", [], "any", false, false, false, 28)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 29
            yield "                <span class=\"social-pill\">";
            yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 29, $this->source); })()), "mediaType", [], "any", false, false, false, 29) == "video")) ? ("Video") : ("Photo"));
            yield "</span>
            ";
        }
        // line 31
        yield "        </div>
    </header>

    ";
        // line 34
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 34, $this->source); })()), "caption", [], "any", false, false, false, 34)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 35
            yield "        <div class=\"social-post-card__caption\">";
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 35, $this->source); })()), "caption", [], "any", false, false, false, 35), "html", null, true));
            yield "</div>
    ";
        }
        // line 37
        yield "
    ";
        // line 38
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 38, $this->source); })()), "mediaUrl", [], "any", false, false, false, 38)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 39
            yield "        <div class=\"social-post-card__media social-post-card__media--";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 39, $this->source); })()), "mediaType", [], "any", false, false, false, 39), "html", null, true);
            yield "\">
            ";
            // line 40
            if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 40, $this->source); })()), "mediaType", [], "any", false, false, false, 40) == "video")) {
                // line 41
                yield "                <video controls preload=\"metadata\" src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 41, $this->source); })()), "mediaUrl", [], "any", false, false, false, 41), "html", null, true);
                yield "\"></video>
            ";
            } else {
                // line 43
                yield "                <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 43, $this->source); })()), "mediaUrl", [], "any", false, false, false, 43), "html", null, true);
                yield "\" alt=\"Animal feed media\" referrerpolicy=\"no-referrer\">
            ";
            }
            // line 45
            yield "        </div>
    ";
        }
        // line 47
        yield "
    <div class=\"social-post-card__insights\">
        <div class=\"social-reaction-burst\">
            ";
        // line 50
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 50, $this->source); })()), "reactionIcons", [], "any", false, false, false, 50));
        foreach ($context['_seq'] as $context["_key"] => $context["icon"]) {
            // line 51
            yield "                <span class=\"social-reaction-burst__icon social-reaction-burst__icon--";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["icon"], "html", null, true);
            yield "\"></span>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['icon'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 53
        yield "        </div>

        <div class=\"social-post-card__counters\">
            <span><strong>";
        // line 56
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 56, $this->source); })()), "likeCount", [], "any", false, false, false, 56), "html", null, true);
        yield "</strong> likes</span>
            <span><strong>";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 57, $this->source); })()), "commentCount", [], "any", false, false, false, 57), "html", null, true);
        yield "</strong> comments</span>
            <span><strong>";
        // line 58
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 58, $this->source); })()), "shareCount", [], "any", false, false, false, 58), "html", null, true);
        yield "</strong> shares</span>
            ";
        // line 59
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 59, $this->source); })()), "dislikeCount", [], "any", false, false, false, 59) > 0)) {
            // line 60
            yield "                <span><strong>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 60, $this->source); })()), "dislikeCount", [], "any", false, false, false, 60), "html", null, true);
            yield "</strong> dislikes</span>
            ";
        }
        // line 62
        yield "        </div>
    </div>

    <div class=\"social-post-card__actions\">
        <form method=\"post\" action=\"";
        // line 66
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_reaction_toggle", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 66, $this->source); })()), "id", [], "any", false, false, false, 66), "reaction" => "like"]), "html", null, true);
        yield "\">
            <input type=\"hidden\" name=\"_token\" value=\"";
        // line 67
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken((("react_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 67, $this->source); })()), "id", [], "any", false, false, false, 67)) . "_like")), "html", null, true);
        yield "\">
            <button type=\"submit\" class=\"social-action ";
        // line 68
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 68, $this->source); })()), "reaction", [], "any", false, false, false, 68) == "LIKE")) ? ("is-active") : (""));
        yield "\">
                <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path d=\"m7 11 4-7 1 1v4h5a2 2 0 0 1 2 2l-1 6a2 2 0 0 1-2 2H7Z\"></path>
                    <path d=\"M7 11H4v8h3\"></path>
                </svg>
                <span>Like</span>
            </button>
        </form>

        <form method=\"post\" action=\"";
        // line 77
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_reaction_toggle", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 77, $this->source); })()), "id", [], "any", false, false, false, 77), "reaction" => "dislike"]), "html", null, true);
        yield "\">
            <input type=\"hidden\" name=\"_token\" value=\"";
        // line 78
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken((("react_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 78, $this->source); })()), "id", [], "any", false, false, false, 78)) . "_dislike")), "html", null, true);
        yield "\">
            <button type=\"submit\" class=\"social-action ";
        // line 79
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 79, $this->source); })()), "reaction", [], "any", false, false, false, 79) == "DISLIKE")) ? ("is-active is-negative") : (""));
        yield "\">
                <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path d=\"m17 13-4 7-1-1v-4H7a2 2 0 0 1-2-2l1-6a2 2 0 0 1 2-2h9Z\"></path>
                    <path d=\"M17 13h3V5h-3\"></path>
                </svg>
                <span>Dislike</span>
            </button>
        </form>

        ";
        // line 88
        if ((($tmp = ((array_key_exists("detailMode", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["detailMode"]) || array_key_exists("detailMode", $context) ? $context["detailMode"] : (function () { throw new RuntimeError('Variable "detailMode" does not exist.', 88, $this->source); })()), false)) : (false))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 89
            yield "            <a class=\"social-action\" href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("feed_index");
            yield "\">
                <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path d=\"M19 12H5\"></path>
                    <path d=\"m12 19-7-7 7-7\"></path>
                </svg>
                <span>Back to feed</span>
            </a>
        ";
        } else {
            // line 97
            yield "            <a class=\"social-action\" href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 97, $this->source); })()), "id", [], "any", false, false, false, 97)]), "html", null, true);
            yield "\">
                <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path d=\"M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z\"></path>
                </svg>
                <span>Open discussion</span>
            </a>
        ";
        }
        // line 104
        yield "
        ";
        // line 105
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 105, $this->source); })()), "isOwner", [], "any", false, false, false, 105)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 106
            yield "            <a class=\"social-action\" href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 106, $this->source); })()), "id", [], "any", false, false, false, 106)]), "html", null, true);
            yield "\">
                <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path d=\"M12 20h9\"></path>
                    <path d=\"M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4Z\"></path>
                </svg>
                <span>Edit</span>
            </a>

            <form method=\"post\" action=\"";
            // line 114
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 114, $this->source); })()), "id", [], "any", false, false, false, 114)]), "html", null, true);
            yield "\" onsubmit=\"return confirm('Delete this post?');\">
                <input type=\"hidden\" name=\"_token\" value=\"";
            // line 115
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_post_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 115, $this->source); })()), "id", [], "any", false, false, false, 115))), "html", null, true);
            yield "\">
                <button type=\"submit\" class=\"social-action social-action--danger\">
                    <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                        <path d=\"M3 6h18\"></path>
                        <path d=\"M8 6V4h8v2\"></path>
                        <path d=\"M19 6l-1 14H6L5 6\"></path>
                    </svg>
                    <span>Delete</span>
                </button>
            </form>
        ";
        } elseif ((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 125
(isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 125, $this->source); })()), "isReported", [], "any", false, false, false, 125)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 126
            yield "            <span class=\"social-pill social-pill--reported\">Reported</span>
        ";
        } else {
            // line 128
            yield "            <details class=\"report-box\">
                <summary>Report</summary>
                <form method=\"post\" action=\"";
            // line 130
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_report", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 130, $this->source); })()), "id", [], "any", false, false, false, 130)]), "html", null, true);
            yield "\" class=\"report-box__form\">
                    <input type=\"hidden\" name=\"_token\" value=\"";
            // line 131
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("report_post_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 131, $this->source); })()), "id", [], "any", false, false, false, 131))), "html", null, true);
            yield "\">
                    <textarea name=\"reason\" rows=\"3\" placeholder=\"Tell the moderators what should be reviewed.\"></textarea>
                    <button type=\"submit\" class=\"button-secondary\">Send report</button>
                </form>
            </details>
        ";
        }
        // line 137
        yield "    </div>

    ";
        // line 139
        if (( !((array_key_exists("detailMode", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["detailMode"]) || array_key_exists("detailMode", $context) ? $context["detailMode"] : (function () { throw new RuntimeError('Variable "detailMode" does not exist.', 139, $this->source); })()), false)) : (false)) &&  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 139, $this->source); })()), "previewComments", [], "any", false, false, false, 139)))) {
            // line 140
            yield "        <div class=\"social-post-card__preview-comments\">
            ";
            // line 141
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 141, $this->source); })()), "previewComments", [], "any", false, false, false, 141));
            foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
                // line 142
                yield "                <article class=\"social-comment-preview\">
                    <div class=\"social-comment-preview__head\">
                        <strong>";
                // line 144
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "author", [], "any", false, false, false, 144), "name", [], "any", false, false, false, 144), "html", null, true);
                yield "</strong>
                        <span>";
                // line 145
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "createdRelative", [], "any", false, false, false, 145), "html", null, true);
                yield "</span>
                    </div>
                    <p>";
                // line 147
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "body", [], "any", false, false, false, 147), "html", null, true);
                yield "</p>
                </article>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['comment'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 150
            yield "            <a class=\"social-inline-link\" href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["postCard"]) || array_key_exists("postCard", $context) ? $context["postCard"] : (function () { throw new RuntimeError('Variable "postCard" does not exist.', 150, $this->source); })()), "id", [], "any", false, false, false, 150)]), "html", null, true);
            yield "\">View full thread</a>
        </div>
    ";
        }
        // line 153
        yield "</article>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "feed/_post_card.html.twig";
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
        return array (  367 => 153,  360 => 150,  351 => 147,  346 => 145,  342 => 144,  338 => 142,  334 => 141,  331 => 140,  329 => 139,  325 => 137,  316 => 131,  312 => 130,  308 => 128,  304 => 126,  302 => 125,  289 => 115,  285 => 114,  273 => 106,  271 => 105,  268 => 104,  257 => 97,  245 => 89,  243 => 88,  231 => 79,  227 => 78,  223 => 77,  211 => 68,  207 => 67,  203 => 66,  197 => 62,  191 => 60,  189 => 59,  185 => 58,  181 => 57,  177 => 56,  172 => 53,  163 => 51,  159 => 50,  154 => 47,  150 => 45,  144 => 43,  138 => 41,  136 => 40,  131 => 39,  129 => 38,  126 => 37,  120 => 35,  118 => 34,  113 => 31,  107 => 29,  104 => 28,  100 => 26,  98 => 25,  89 => 19,  82 => 17,  77 => 15,  72 => 13,  67 => 10,  61 => 8,  53 => 6,  51 => 5,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<article class=\"social-post-card\">
    <header class=\"social-post-card__header\">
        <div class=\"social-post-card__author\">
            <span class=\"profile-avatar profile-avatar--small\">
                {% if postCard.author.avatarUrl %}
                    <img src=\"{{ postCard.author.avatarUrl }}\" alt=\"{{ postCard.author.name }}\" referrerpolicy=\"no-referrer\">
                {% else %}
                    {{ postCard.author.initials }}
                {% endif %}
            </span>

            <div class=\"social-post-card__author-meta\">
                <strong>{{ postCard.author.name }}</strong>
                <div class=\"social-post-card__subline\">
                    <span>{{ postCard.author.handle }}</span>
                    <span class=\"social-dot\"></span>
                    <span title=\"{{ postCard.createdLabel }}\">{{ postCard.createdRelative }}</span>
                    <span class=\"social-dot\"></span>
                    <span>{{ postCard.visibilityLabel }}</span>
                </div>
            </div>
        </div>

        <div class=\"social-post-card__badges\">
            {% if postCard.isOwner %}
                <span class=\"social-pill social-pill--owner\">Your post</span>
            {% endif %}
            {% if postCard.mediaUrl %}
                <span class=\"social-pill\">{{ postCard.mediaType == 'video' ? 'Video' : 'Photo' }}</span>
            {% endif %}
        </div>
    </header>

    {% if postCard.caption %}
        <div class=\"social-post-card__caption\">{{ postCard.caption|nl2br }}</div>
    {% endif %}

    {% if postCard.mediaUrl %}
        <div class=\"social-post-card__media social-post-card__media--{{ postCard.mediaType }}\">
            {% if postCard.mediaType == 'video' %}
                <video controls preload=\"metadata\" src=\"{{ postCard.mediaUrl }}\"></video>
            {% else %}
                <img src=\"{{ postCard.mediaUrl }}\" alt=\"Animal feed media\" referrerpolicy=\"no-referrer\">
            {% endif %}
        </div>
    {% endif %}

    <div class=\"social-post-card__insights\">
        <div class=\"social-reaction-burst\">
            {% for icon in postCard.reactionIcons %}
                <span class=\"social-reaction-burst__icon social-reaction-burst__icon--{{ icon }}\"></span>
            {% endfor %}
        </div>

        <div class=\"social-post-card__counters\">
            <span><strong>{{ postCard.likeCount }}</strong> likes</span>
            <span><strong>{{ postCard.commentCount }}</strong> comments</span>
            <span><strong>{{ postCard.shareCount }}</strong> shares</span>
            {% if postCard.dislikeCount > 0 %}
                <span><strong>{{ postCard.dislikeCount }}</strong> dislikes</span>
            {% endif %}
        </div>
    </div>

    <div class=\"social-post-card__actions\">
        <form method=\"post\" action=\"{{ path('post_reaction_toggle', { id: postCard.id, reaction: 'like' }) }}\">
            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('react_' ~ postCard.id ~ '_like') }}\">
            <button type=\"submit\" class=\"social-action {{ postCard.reaction == 'LIKE' ? 'is-active' : '' }}\">
                <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path d=\"m7 11 4-7 1 1v4h5a2 2 0 0 1 2 2l-1 6a2 2 0 0 1-2 2H7Z\"></path>
                    <path d=\"M7 11H4v8h3\"></path>
                </svg>
                <span>Like</span>
            </button>
        </form>

        <form method=\"post\" action=\"{{ path('post_reaction_toggle', { id: postCard.id, reaction: 'dislike' }) }}\">
            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('react_' ~ postCard.id ~ '_dislike') }}\">
            <button type=\"submit\" class=\"social-action {{ postCard.reaction == 'DISLIKE' ? 'is-active is-negative' : '' }}\">
                <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path d=\"m17 13-4 7-1-1v-4H7a2 2 0 0 1-2-2l1-6a2 2 0 0 1 2-2h9Z\"></path>
                    <path d=\"M17 13h3V5h-3\"></path>
                </svg>
                <span>Dislike</span>
            </button>
        </form>

        {% if detailMode|default(false) %}
            <a class=\"social-action\" href=\"{{ path('feed_index') }}\">
                <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path d=\"M19 12H5\"></path>
                    <path d=\"m12 19-7-7 7-7\"></path>
                </svg>
                <span>Back to feed</span>
            </a>
        {% else %}
            <a class=\"social-action\" href=\"{{ path('post_show', { id: postCard.id }) }}\">
                <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path d=\"M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z\"></path>
                </svg>
                <span>Open discussion</span>
            </a>
        {% endif %}

        {% if postCard.isOwner %}
            <a class=\"social-action\" href=\"{{ path('post_edit', { id: postCard.id }) }}\">
                <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path d=\"M12 20h9\"></path>
                    <path d=\"M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4Z\"></path>
                </svg>
                <span>Edit</span>
            </a>

            <form method=\"post\" action=\"{{ path('post_delete', { id: postCard.id }) }}\" onsubmit=\"return confirm('Delete this post?');\">
                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_post_' ~ postCard.id) }}\">
                <button type=\"submit\" class=\"social-action social-action--danger\">
                    <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                        <path d=\"M3 6h18\"></path>
                        <path d=\"M8 6V4h8v2\"></path>
                        <path d=\"M19 6l-1 14H6L5 6\"></path>
                    </svg>
                    <span>Delete</span>
                </button>
            </form>
        {% elseif postCard.isReported %}
            <span class=\"social-pill social-pill--reported\">Reported</span>
        {% else %}
            <details class=\"report-box\">
                <summary>Report</summary>
                <form method=\"post\" action=\"{{ path('post_report', { id: postCard.id }) }}\" class=\"report-box__form\">
                    <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('report_post_' ~ postCard.id) }}\">
                    <textarea name=\"reason\" rows=\"3\" placeholder=\"Tell the moderators what should be reviewed.\"></textarea>
                    <button type=\"submit\" class=\"button-secondary\">Send report</button>
                </form>
            </details>
        {% endif %}
    </div>

    {% if not detailMode|default(false) and postCard.previewComments is not empty %}
        <div class=\"social-post-card__preview-comments\">
            {% for comment in postCard.previewComments %}
                <article class=\"social-comment-preview\">
                    <div class=\"social-comment-preview__head\">
                        <strong>{{ comment.author.name }}</strong>
                        <span>{{ comment.createdRelative }}</span>
                    </div>
                    <p>{{ comment.body }}</p>
                </article>
            {% endfor %}
            <a class=\"social-inline-link\" href=\"{{ path('post_show', { id: postCard.id }) }}\">View full thread</a>
        </div>
    {% endif %}
</article>
", "feed/_post_card.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\feed\\_post_card.html.twig");
    }
}
