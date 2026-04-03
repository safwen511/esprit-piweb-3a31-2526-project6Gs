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

/* profile/show.html.twig */
class __TwigTemplate_a21169c7b11d760e766d4f80ee747290 extends Template
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
            'body' => [$this, 'block_body'],
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "profile/show.html.twig"));

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

        yield "My Profile | FurHope";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "    <section class=\"profile-page\">
        <div class=\"panel profile-cover\">
            <div class=\"profile-cover__backdrop\"></div>
            <div class=\"profile-cover__content\">
                <div class=\"profile-cover__avatar-wrap\">
                    <a class=\"profile-photo-action\" href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile_edit");
        yield "\" aria-label=\"Change profile photo\">
                        <div class=\"profile-avatar profile-avatar--large profile-avatar--cover\">
                            ";
        // line 13
        $context["memberAvatarUrl"] = $this->extensions['App\Twig\SocialExtension']->socialAvatarUrl((isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 13, $this->source); })()));
        // line 14
        yield "                            ";
        if ((($tmp = (isset($context["memberAvatarUrl"]) || array_key_exists("memberAvatarUrl", $context) ? $context["memberAvatarUrl"] : (function () { throw new RuntimeError('Variable "memberAvatarUrl" does not exist.', 14, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 15
            yield "                                <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["memberAvatarUrl"]) || array_key_exists("memberAvatarUrl", $context) ? $context["memberAvatarUrl"] : (function () { throw new RuntimeError('Variable "memberAvatarUrl" does not exist.', 15, $this->source); })()), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 15, $this->source); })()), "fullName", [], "any", false, false, false, 15), "html", null, true);
            yield "\" referrerpolicy=\"no-referrer\">
                            ";
        } else {
            // line 17
            yield "                                <span>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 17, $this->source); })()), "initials", [], "any", false, false, false, 17), "html", null, true);
            yield "</span>
                            ";
        }
        // line 19
        yield "                        </div>
                        <span class=\"profile-photo-action__badge\">
                            <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                                <path d=\"M12 20h9\"></path>
                                <path d=\"M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4Z\"></path>
                            </svg>
                        </span>
                    </a>
                </div>

                <div class=\"profile-cover__main\">
                    <div class=\"eyebrow\">FurHope member profile</div>
                    <div class=\"profile-title-stack\">
                        <h1>";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 32, $this->source); })()), "fullName", [], "any", false, false, false, 32), "html", null, true);
        yield "</h1>
                        <a class=\"profile-edit-inline\" href=\"";
        // line 33
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile_edit");
        yield "\" aria-label=\"Edit profile\">
                            <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                                <path d=\"M12 20h9\"></path>
                                <path d=\"M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4Z\"></path>
                            </svg>
                        </a>
                    </div>
                    <p class=\"profile-cover__bio\">
                        ";
        // line 41
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 41, $this->source); })()), "isVeteranApplicant", [], "any", false, false, false, 41)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Part of the FurHope care network and available for specialized support review.") : ("Part of the FurHope community helping animals through care, support, and shelter activity."));
        yield "
                    </p>
                </div>
            </div>
        </div>

        <div class=\"profile-layout\">
            <aside class=\"profile-sidebar\">
                <article class=\"card profile-side-card\">
                    <h3>About</h3>
                    <div class=\"profile-info-list\">
                        <div>
                            <strong>Email</strong>
                            <span>";
        // line 54
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 54, $this->source); })()), "email", [], "any", false, false, false, 54), "html", null, true);
        yield "</span>
                        </div>
                        <div>
                            <strong>Phone</strong>
                            <span>";
        // line 58
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 58, $this->source); })()), "phoneNumber", [], "any", false, false, false, 58)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 58, $this->source); })()), "phoneNumber", [], "any", false, false, false, 58), "html", null, true)) : ("Not shared yet"));
        yield "</span>
                        </div>
                        <div>
                            <strong>Member since</strong>
                            <span>";
        // line 62
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 62, $this->source); })()), "createdAt", [], "any", false, false, false, 62)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 62, $this->source); })()), "createdAt", [], "any", false, false, false, 62), "F Y"), "html", null, true)) : ("Recently joined"));
        yield "</span>
                        </div>
                        <div>
                            <strong>Contact</strong>
                            <span>";
        // line 66
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 66, $this->source); })()), "email", [], "any", false, false, false, 66), "html", null, true);
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 66, $this->source); })()), "phoneNumber", [], "any", false, false, false, 66)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " | ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 66, $this->source); })()), "phoneNumber", [], "any", false, false, false, 66), "html", null, true);
        }
        yield "</span>
                        </div>
                    </div>
                </article>

                <article class=\"card profile-side-card\">
                    <h3>Shelter connection</h3>
                    <div class=\"profile-info-list\">
                        <div>
                            <strong>Veterinary request</strong>
                            <span>
                                ";
        // line 77
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 77, $this->source); })()), "isVeteranApproved", [], "any", false, false, false, 77)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 78
            yield "                                    Approved
                                ";
        } elseif ((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 79
(isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 79, $this->source); })()), "isVeteranApplicant", [], "any", false, false, false, 79)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 80
            yield "                                    Pending review
                                ";
        } else {
            // line 82
            yield "                                    Not requested
                                ";
        }
        // line 84
        yield "                            </span>
                        </div>
                        <div>
                            <strong>Profile photo</strong>
                            <span>";
        // line 88
        yield (((($tmp = (isset($context["memberAvatarUrl"]) || array_key_exists("memberAvatarUrl", $context) ? $context["memberAvatarUrl"] : (function () { throw new RuntimeError('Variable "memberAvatarUrl" does not exist.', 88, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Added and visible") : ("Click the photo above to add one"));
        yield "</span>
                        </div>
                    </div>
                </article>
            </aside>

            <div class=\"profile-feed\">
                <article class=\"card profile-feed-card\">
                    <div class=\"profile-feed-card__header\">
                        <div>
                            <div class=\"eyebrow\">Contact details</div>
                            <h3>Profile information</h3>
                        </div>
                        <a class=\"profile-inline-action\" href=\"";
        // line 101
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile_edit");
        yield "\">Update details</a>
                    </div>

                    <div class=\"profile-detail-grid\">
                        <div class=\"profile-detail-item\">
                            <small>First name</small>
                            <strong>";
        // line 107
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 107, $this->source); })()), "firstName", [], "any", false, false, false, 107), "html", null, true);
        yield "</strong>
                        </div>
                        <div class=\"profile-detail-item\">
                            <small>Last name</small>
                            <strong>";
        // line 111
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 111, $this->source); })()), "lastName", [], "any", false, false, false, 111), "html", null, true);
        yield "</strong>
                        </div>
                        <div class=\"profile-detail-item\">
                            <small>Email address</small>
                            <strong>";
        // line 115
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 115, $this->source); })()), "email", [], "any", false, false, false, 115), "html", null, true);
        yield "</strong>
                        </div>
                        <div class=\"profile-detail-item\">
                            <small>Phone number</small>
                            <strong>";
        // line 119
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 119, $this->source); })()), "phoneNumber", [], "any", false, false, false, 119)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 119, $this->source); })()), "phoneNumber", [], "any", false, false, false, 119), "html", null, true)) : ("Not provided"));
        yield "</strong>
                        </div>
                    </div>
                </article>

                <article class=\"card profile-feed-card\">
                    <div class=\"profile-feed-card__header\">
                        <div>
                            <div class=\"eyebrow\">Account overview</div>
                            <h3>Status and access</h3>
                        </div>
                    </div>

                    <div class=\"profile-status-grid\">
                        <div class=\"profile-status-box\">
                            <small>Photo</small>
                            <strong>";
        // line 135
        yield (((($tmp = (isset($context["memberAvatarUrl"]) || array_key_exists("memberAvatarUrl", $context) ? $context["memberAvatarUrl"] : (function () { throw new RuntimeError('Variable "memberAvatarUrl" does not exist.', 135, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Added") : ("Missing"));
        yield "</strong>
                            <span>";
        // line 136
        yield (((($tmp = (isset($context["memberAvatarUrl"]) || array_key_exists("memberAvatarUrl", $context) ? $context["memberAvatarUrl"] : (function () { throw new RuntimeError('Variable "memberAvatarUrl" does not exist.', 136, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Your profile photo is visible across the app.") : ("Add a photo to personalize your profile."));
        yield "</span>
                        </div>
                        <div class=\"profile-status-box\">
                            <small>Shelter status</small>
                            <strong>
                                ";
        // line 141
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 141, $this->source); })()), "isVeteranApproved", [], "any", false, false, false, 141)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 142
            yield "                                    Veterinary approved
                                ";
        } elseif ((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 143
(isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 143, $this->source); })()), "isVeteranApplicant", [], "any", false, false, false, 143)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 144
            yield "                                    Review pending
                                ";
        } else {
            // line 146
            yield "                                    Member profile
                                ";
        }
        // line 148
        yield "                            </strong>
                            <span>Keep your details current so the shelter team can reach you when needed.</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "profile/show.html.twig";
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
        return array (  314 => 148,  310 => 146,  306 => 144,  304 => 143,  301 => 142,  299 => 141,  291 => 136,  287 => 135,  268 => 119,  261 => 115,  254 => 111,  247 => 107,  238 => 101,  222 => 88,  216 => 84,  212 => 82,  208 => 80,  206 => 79,  203 => 78,  201 => 77,  183 => 66,  176 => 62,  169 => 58,  162 => 54,  146 => 41,  135 => 33,  131 => 32,  116 => 19,  110 => 17,  102 => 15,  99 => 14,  97 => 13,  92 => 11,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}My Profile | FurHope{% endblock %}

{% block body %}
    <section class=\"profile-page\">
        <div class=\"panel profile-cover\">
            <div class=\"profile-cover__backdrop\"></div>
            <div class=\"profile-cover__content\">
                <div class=\"profile-cover__avatar-wrap\">
                    <a class=\"profile-photo-action\" href=\"{{ path('app_profile_edit') }}\" aria-label=\"Change profile photo\">
                        <div class=\"profile-avatar profile-avatar--large profile-avatar--cover\">
                            {% set memberAvatarUrl = social_avatar_url(member) %}
                            {% if memberAvatarUrl %}
                                <img src=\"{{ memberAvatarUrl }}\" alt=\"{{ member.fullName }}\" referrerpolicy=\"no-referrer\">
                            {% else %}
                                <span>{{ member.initials }}</span>
                            {% endif %}
                        </div>
                        <span class=\"profile-photo-action__badge\">
                            <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                                <path d=\"M12 20h9\"></path>
                                <path d=\"M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4Z\"></path>
                            </svg>
                        </span>
                    </a>
                </div>

                <div class=\"profile-cover__main\">
                    <div class=\"eyebrow\">FurHope member profile</div>
                    <div class=\"profile-title-stack\">
                        <h1>{{ member.fullName }}</h1>
                        <a class=\"profile-edit-inline\" href=\"{{ path('app_profile_edit') }}\" aria-label=\"Edit profile\">
                            <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                                <path d=\"M12 20h9\"></path>
                                <path d=\"M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4Z\"></path>
                            </svg>
                        </a>
                    </div>
                    <p class=\"profile-cover__bio\">
                        {{ member.isVeteranApplicant ? 'Part of the FurHope care network and available for specialized support review.' : 'Part of the FurHope community helping animals through care, support, and shelter activity.' }}
                    </p>
                </div>
            </div>
        </div>

        <div class=\"profile-layout\">
            <aside class=\"profile-sidebar\">
                <article class=\"card profile-side-card\">
                    <h3>About</h3>
                    <div class=\"profile-info-list\">
                        <div>
                            <strong>Email</strong>
                            <span>{{ member.email }}</span>
                        </div>
                        <div>
                            <strong>Phone</strong>
                            <span>{{ member.phoneNumber ?: 'Not shared yet' }}</span>
                        </div>
                        <div>
                            <strong>Member since</strong>
                            <span>{{ member.createdAt ? member.createdAt|date('F Y') : 'Recently joined' }}</span>
                        </div>
                        <div>
                            <strong>Contact</strong>
                            <span>{{ member.email }}{% if member.phoneNumber %} | {{ member.phoneNumber }}{% endif %}</span>
                        </div>
                    </div>
                </article>

                <article class=\"card profile-side-card\">
                    <h3>Shelter connection</h3>
                    <div class=\"profile-info-list\">
                        <div>
                            <strong>Veterinary request</strong>
                            <span>
                                {% if member.isVeteranApproved %}
                                    Approved
                                {% elseif member.isVeteranApplicant %}
                                    Pending review
                                {% else %}
                                    Not requested
                                {% endif %}
                            </span>
                        </div>
                        <div>
                            <strong>Profile photo</strong>
                            <span>{{ memberAvatarUrl ? 'Added and visible' : 'Click the photo above to add one' }}</span>
                        </div>
                    </div>
                </article>
            </aside>

            <div class=\"profile-feed\">
                <article class=\"card profile-feed-card\">
                    <div class=\"profile-feed-card__header\">
                        <div>
                            <div class=\"eyebrow\">Contact details</div>
                            <h3>Profile information</h3>
                        </div>
                        <a class=\"profile-inline-action\" href=\"{{ path('app_profile_edit') }}\">Update details</a>
                    </div>

                    <div class=\"profile-detail-grid\">
                        <div class=\"profile-detail-item\">
                            <small>First name</small>
                            <strong>{{ member.firstName }}</strong>
                        </div>
                        <div class=\"profile-detail-item\">
                            <small>Last name</small>
                            <strong>{{ member.lastName }}</strong>
                        </div>
                        <div class=\"profile-detail-item\">
                            <small>Email address</small>
                            <strong>{{ member.email }}</strong>
                        </div>
                        <div class=\"profile-detail-item\">
                            <small>Phone number</small>
                            <strong>{{ member.phoneNumber ?: 'Not provided' }}</strong>
                        </div>
                    </div>
                </article>

                <article class=\"card profile-feed-card\">
                    <div class=\"profile-feed-card__header\">
                        <div>
                            <div class=\"eyebrow\">Account overview</div>
                            <h3>Status and access</h3>
                        </div>
                    </div>

                    <div class=\"profile-status-grid\">
                        <div class=\"profile-status-box\">
                            <small>Photo</small>
                            <strong>{{ memberAvatarUrl ? 'Added' : 'Missing' }}</strong>
                            <span>{{ memberAvatarUrl ? 'Your profile photo is visible across the app.' : 'Add a photo to personalize your profile.' }}</span>
                        </div>
                        <div class=\"profile-status-box\">
                            <small>Shelter status</small>
                            <strong>
                                {% if member.isVeteranApproved %}
                                    Veterinary approved
                                {% elseif member.isVeteranApplicant %}
                                    Review pending
                                {% else %}
                                    Member profile
                                {% endif %}
                            </strong>
                            <span>Keep your details current so the shelter team can reach you when needed.</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
{% endblock %}
", "profile/show.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\profile\\show.html.twig");
    }
}
