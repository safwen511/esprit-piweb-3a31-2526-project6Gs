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

/* feed/_connection_results.html.twig */
class __TwigTemplate_7319c7bfbcdc2b32ac94eb0646191198 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "feed/_connection_results.html.twig"));

        // line 1
        yield "<div class=\"social-search-results\">
    ";
        // line 2
        if ((($tmp = (isset($context["searchTerm"]) || array_key_exists("searchTerm", $context) ? $context["searchTerm"] : (function () { throw new RuntimeError('Variable "searchTerm" does not exist.', 2, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 3
            yield "        ";
            if (Twig\Extension\CoreExtension::testEmpty((isset($context["searchCards"]) || array_key_exists("searchCards", $context) ? $context["searchCards"] : (function () { throw new RuntimeError('Variable "searchCards" does not exist.', 3, $this->source); })()))) {
                // line 4
                yield "            <div class=\"empty-state\">
                <strong>No members matched \"";
                // line 5
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["searchTerm"]) || array_key_exists("searchTerm", $context) ? $context["searchTerm"] : (function () { throw new RuntimeError('Variable "searchTerm" does not exist.', 5, $this->source); })()), "html", null, true);
                yield "\".</strong>
                <span>Try another name or email address.</span>
            </div>
        ";
            } else {
                // line 9
                yield "            ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable((isset($context["searchCards"]) || array_key_exists("searchCards", $context) ? $context["searchCards"] : (function () { throw new RuntimeError('Variable "searchCards" does not exist.', 9, $this->source); })()));
                foreach ($context['_seq'] as $context["_key"] => $context["card"]) {
                    // line 10
                    yield "                <article class=\"social-contact-card\">
                    <div class=\"social-contact-card__main\">
                        <span class=\"profile-avatar profile-avatar--small\">
                            ";
                    // line 13
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["card"], "user", [], "any", false, false, false, 13), "avatarUrl", [], "any", false, false, false, 13)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 14
                        yield "                                <img src=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["card"], "user", [], "any", false, false, false, 14), "avatarUrl", [], "any", false, false, false, 14), "html", null, true);
                        yield "\" alt=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["card"], "user", [], "any", false, false, false, 14), "name", [], "any", false, false, false, 14), "html", null, true);
                        yield "\" referrerpolicy=\"no-referrer\">
                            ";
                    } else {
                        // line 16
                        yield "                                ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["card"], "user", [], "any", false, false, false, 16), "initials", [], "any", false, false, false, 16), "html", null, true);
                        yield "
                            ";
                    }
                    // line 18
                    yield "                        </span>

                        <div>
                            <strong>";
                    // line 21
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["card"], "user", [], "any", false, false, false, 21), "name", [], "any", false, false, false, 21), "html", null, true);
                    yield "</strong>
                            <span>";
                    // line 22
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["card"], "user", [], "any", false, false, false, 22), "handle", [], "any", false, false, false, 22), "html", null, true);
                    yield "</span>
                            <small>";
                    // line 23
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["card"], "user", [], "any", false, false, false, 23), "email", [], "any", false, false, false, 23), "html", null, true);
                    yield "</small>
                        </div>
                    </div>

                    <div class=\"social-contact-card__actions\">
                        ";
                    // line 28
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["card"], "state", [], "any", false, false, false, 28) == "friend")) {
                        // line 29
                        yield "                            <span class=\"social-pill social-pill--friend\">Already friends</span>
                        ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 30
$context["card"], "state", [], "any", false, false, false, 30) == "incoming")) {
                        // line 31
                        yield "                            <form method=\"post\" action=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("friend_accept", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["card"], "incomingRequest", [], "any", false, false, false, 31), "id", [], "any", false, false, false, 31)]), "html", null, true);
                        yield "\">
                                <input type=\"hidden\" name=\"_token\" value=\"";
                        // line 32
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("accept_friend_request_" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["card"], "incomingRequest", [], "any", false, false, false, 32), "id", [], "any", false, false, false, 32))), "html", null, true);
                        yield "\">
                                <button type=\"submit\" class=\"button-primary\">Accept</button>
                            </form>
                            <form method=\"post\" action=\"";
                        // line 35
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("friend_decline", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["card"], "incomingRequest", [], "any", false, false, false, 35), "id", [], "any", false, false, false, 35)]), "html", null, true);
                        yield "\">
                                <input type=\"hidden\" name=\"_token\" value=\"";
                        // line 36
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("decline_friend_request_" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["card"], "incomingRequest", [], "any", false, false, false, 36), "id", [], "any", false, false, false, 36))), "html", null, true);
                        yield "\">
                                <button type=\"submit\" class=\"button-secondary\">Decline</button>
                            </form>
                        ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 39
$context["card"], "state", [], "any", false, false, false, 39) == "sent")) {
                        // line 40
                        yield "                            <span class=\"social-pill\">Request sent</span>
                        ";
                    } else {
                        // line 42
                        yield "                            <form method=\"post\" action=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("friend_send", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["card"], "user", [], "any", false, false, false, 42), "id", [], "any", false, false, false, 42)]), "html", null, true);
                        yield "\">
                                <input type=\"hidden\" name=\"_token\" value=\"";
                        // line 43
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("send_friend_request_" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["card"], "user", [], "any", false, false, false, 43), "id", [], "any", false, false, false, 43))), "html", null, true);
                        yield "\">
                                <button type=\"submit\" class=\"button-primary\">Add friend</button>
                            </form>
                        ";
                    }
                    // line 47
                    yield "                    </div>
                </article>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['card'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 50
                yield "        ";
            }
            // line 51
            yield "    ";
        } elseif ((($tmp =  !Twig\Extension\CoreExtension::testEmpty((isset($context["friendPreview"]) || array_key_exists("friendPreview", $context) ? $context["friendPreview"] : (function () { throw new RuntimeError('Variable "friendPreview" does not exist.', 51, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 52
            yield "        <div class=\"social-people-stack\">
            ";
            // line 53
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["friendPreview"]) || array_key_exists("friendPreview", $context) ? $context["friendPreview"] : (function () { throw new RuntimeError('Variable "friendPreview" does not exist.', 53, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["friend"]) {
                // line 54
                yield "                <article class=\"social-contact-card social-contact-card--friend\">
                    <div class=\"social-contact-card__main\">
                        <span class=\"profile-avatar profile-avatar--small\">
                            ";
                // line 57
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["friend"], "avatarUrl", [], "any", false, false, false, 57)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 58
                    yield "                                <img src=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["friend"], "avatarUrl", [], "any", false, false, false, 58), "html", null, true);
                    yield "\" alt=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["friend"], "name", [], "any", false, false, false, 58), "html", null, true);
                    yield "\" referrerpolicy=\"no-referrer\">
                            ";
                } else {
                    // line 60
                    yield "                                ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["friend"], "initials", [], "any", false, false, false, 60), "html", null, true);
                    yield "
                            ";
                }
                // line 62
                yield "                        </span>

                        <div>
                            <strong>";
                // line 65
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["friend"], "name", [], "any", false, false, false, 65), "html", null, true);
                yield "</strong>
                            <span>";
                // line 66
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["friend"], "handle", [], "any", false, false, false, 66), "html", null, true);
                yield "</span>
                        </div>
                    </div>

                    <span class=\"social-pill social-pill--friend\">Friend</span>
                </article>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['friend'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 73
            yield "        </div>
    ";
        } else {
            // line 75
            yield "        <div class=\"empty-state\">
            <strong>Start your circle.</strong>
            <span>Search for people and start building the FurHope network.</span>
        </div>
    ";
        }
        // line 80
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
        return "feed/_connection_results.html.twig";
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
        return array (  231 => 80,  224 => 75,  220 => 73,  207 => 66,  203 => 65,  198 => 62,  192 => 60,  184 => 58,  182 => 57,  177 => 54,  173 => 53,  170 => 52,  167 => 51,  164 => 50,  156 => 47,  149 => 43,  144 => 42,  140 => 40,  138 => 39,  132 => 36,  128 => 35,  122 => 32,  117 => 31,  115 => 30,  112 => 29,  110 => 28,  102 => 23,  98 => 22,  94 => 21,  89 => 18,  83 => 16,  75 => 14,  73 => 13,  68 => 10,  63 => 9,  56 => 5,  53 => 4,  50 => 3,  48 => 2,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"social-search-results\">
    {% if searchTerm %}
        {% if searchCards is empty %}
            <div class=\"empty-state\">
                <strong>No members matched \"{{ searchTerm }}\".</strong>
                <span>Try another name or email address.</span>
            </div>
        {% else %}
            {% for card in searchCards %}
                <article class=\"social-contact-card\">
                    <div class=\"social-contact-card__main\">
                        <span class=\"profile-avatar profile-avatar--small\">
                            {% if card.user.avatarUrl %}
                                <img src=\"{{ card.user.avatarUrl }}\" alt=\"{{ card.user.name }}\" referrerpolicy=\"no-referrer\">
                            {% else %}
                                {{ card.user.initials }}
                            {% endif %}
                        </span>

                        <div>
                            <strong>{{ card.user.name }}</strong>
                            <span>{{ card.user.handle }}</span>
                            <small>{{ card.user.email }}</small>
                        </div>
                    </div>

                    <div class=\"social-contact-card__actions\">
                        {% if card.state == 'friend' %}
                            <span class=\"social-pill social-pill--friend\">Already friends</span>
                        {% elseif card.state == 'incoming' %}
                            <form method=\"post\" action=\"{{ path('friend_accept', { id: card.incomingRequest.id }) }}\">
                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('accept_friend_request_' ~ card.incomingRequest.id) }}\">
                                <button type=\"submit\" class=\"button-primary\">Accept</button>
                            </form>
                            <form method=\"post\" action=\"{{ path('friend_decline', { id: card.incomingRequest.id }) }}\">
                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('decline_friend_request_' ~ card.incomingRequest.id) }}\">
                                <button type=\"submit\" class=\"button-secondary\">Decline</button>
                            </form>
                        {% elseif card.state == 'sent' %}
                            <span class=\"social-pill\">Request sent</span>
                        {% else %}
                            <form method=\"post\" action=\"{{ path('friend_send', { id: card.user.id }) }}\">
                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('send_friend_request_' ~ card.user.id) }}\">
                                <button type=\"submit\" class=\"button-primary\">Add friend</button>
                            </form>
                        {% endif %}
                    </div>
                </article>
            {% endfor %}
        {% endif %}
    {% elseif friendPreview is not empty %}
        <div class=\"social-people-stack\">
            {% for friend in friendPreview %}
                <article class=\"social-contact-card social-contact-card--friend\">
                    <div class=\"social-contact-card__main\">
                        <span class=\"profile-avatar profile-avatar--small\">
                            {% if friend.avatarUrl %}
                                <img src=\"{{ friend.avatarUrl }}\" alt=\"{{ friend.name }}\" referrerpolicy=\"no-referrer\">
                            {% else %}
                                {{ friend.initials }}
                            {% endif %}
                        </span>

                        <div>
                            <strong>{{ friend.name }}</strong>
                            <span>{{ friend.handle }}</span>
                        </div>
                    </div>

                    <span class=\"social-pill social-pill--friend\">Friend</span>
                </article>
            {% endfor %}
        </div>
    {% else %}
        <div class=\"empty-state\">
            <strong>Start your circle.</strong>
            <span>Search for people and start building the FurHope network.</span>
        </div>
    {% endif %}
</div>
", "feed/_connection_results.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\feed\\_connection_results.html.twig");
    }
}
