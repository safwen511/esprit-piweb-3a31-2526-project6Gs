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

/* profile/edit.html.twig */
class __TwigTemplate_f7c17c56e18a116187283f524c563706 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "profile/edit.html.twig"));

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

        yield "Edit Profile | FurHope";
        
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
        yield "    <section class=\"profile-edit-page\">
        <div class=\"panel profile-edit-panel\">
            <div class=\"profile-edit-panel__intro\">
                <label class=\"profile-upload-trigger\" for=\"";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 9, $this->source); })()), "profileImage", [], "any", false, false, false, 9), "vars", [], "any", false, false, false, 9), "id", [], "any", false, false, false, 9), "html", null, true);
        yield "\">
                    <div class=\"profile-avatar profile-avatar--large\">
                        ";
        // line 11
        $context["memberAvatarUrl"] = $this->extensions['App\Twig\SocialExtension']->socialAvatarUrl((isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 11, $this->source); })()));
        // line 12
        yield "                        ";
        if ((($tmp = (isset($context["memberAvatarUrl"]) || array_key_exists("memberAvatarUrl", $context) ? $context["memberAvatarUrl"] : (function () { throw new RuntimeError('Variable "memberAvatarUrl" does not exist.', 12, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 13
            yield "                            <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["memberAvatarUrl"]) || array_key_exists("memberAvatarUrl", $context) ? $context["memberAvatarUrl"] : (function () { throw new RuntimeError('Variable "memberAvatarUrl" does not exist.', 13, $this->source); })()), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 13, $this->source); })()), "fullName", [], "any", false, false, false, 13), "html", null, true);
            yield "\" referrerpolicy=\"no-referrer\">
                        ";
        } else {
            // line 15
            yield "                            <span>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new RuntimeError('Variable "member" does not exist.', 15, $this->source); })()), "initials", [], "any", false, false, false, 15), "html", null, true);
            yield "</span>
                        ";
        }
        // line 17
        yield "                    </div>
                    <span class=\"profile-upload-trigger__badge\">
                        <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                            <path d=\"M12 20h9\"></path>
                            <path d=\"M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4Z\"></path>
                        </svg>
                    </span>
                </label>
                <div>
                    <div class=\"eyebrow\">Profile settings</div>
                    <div class=\"profile-title-row\">
                        <h1>Edit your profile</h1>
                        <a class=\"profile-edit-link\" href=\"";
        // line 29
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile");
        yield "\" aria-label=\"Back to profile\">
                            <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                                <path d=\"M19 12H5\"></path>
                                <path d=\"m12 19-7-7 7-7\"></path>
                            </svg>
                        </a>
                    </div>
                    <p class=\"muted\">Click the photo to choose a new image from your computer, then save your changes.</p>
                </div>
            </div>

            ";
        // line 40
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 40, $this->source); })()), 'form_start', ["attr" => ["class" => "profile-form", "novalidate" => "novalidate"]]);
        yield "
                <div class=\"profile-upload-field\">
                    ";
        // line 42
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 42, $this->source); })()), "profileImage", [], "any", false, false, false, 42), 'widget', ["attr" => ["class" => "profile-upload-input", "accept" => "image/*"]]);
        yield "
                    <p class=\"form-help\">";
        // line 43
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 43, $this->source); })()), "profileImage", [], "any", false, false, false, 43), 'help');
        yield "</p>
                    ";
        // line 44
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 44, $this->source); })()), "profileImage", [], "any", false, false, false, 44), 'errors');
        yield "
                </div>

                <div class=\"profile-form-grid\">
                    <div class=\"form-group\">
                        ";
        // line 49
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 49, $this->source); })()), "firstName", [], "any", false, false, false, 49), 'label');
        yield "
                        ";
        // line 50
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 50, $this->source); })()), "firstName", [], "any", false, false, false, 50), 'widget', ["attr" => ["placeholder" => "First name"]]);
        yield "
                        ";
        // line 51
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 51, $this->source); })()), "firstName", [], "any", false, false, false, 51), 'errors');
        yield "
                    </div>

                    <div class=\"form-group\">
                        ";
        // line 55
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 55, $this->source); })()), "lastName", [], "any", false, false, false, 55), 'label');
        yield "
                        ";
        // line 56
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 56, $this->source); })()), "lastName", [], "any", false, false, false, 56), 'widget', ["attr" => ["placeholder" => "Last name"]]);
        yield "
                        ";
        // line 57
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 57, $this->source); })()), "lastName", [], "any", false, false, false, 57), 'errors');
        yield "
                    </div>

                    <div class=\"form-group\">
                        ";
        // line 61
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 61, $this->source); })()), "email", [], "any", false, false, false, 61), 'label');
        yield "
                        ";
        // line 62
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 62, $this->source); })()), "email", [], "any", false, false, false, 62), 'widget', ["attr" => ["placeholder" => "name@example.com"]]);
        yield "
                        ";
        // line 63
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 63, $this->source); })()), "email", [], "any", false, false, false, 63), 'errors');
        yield "
                    </div>

                    <div class=\"form-group\">
                        ";
        // line 67
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 67, $this->source); })()), "phoneNumber", [], "any", false, false, false, 67), 'label');
        yield "
                        ";
        // line 68
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 68, $this->source); })()), "phoneNumber", [], "any", false, false, false, 68), 'widget', ["attr" => ["placeholder" => "+216 00 000 000"]]);
        yield "
                        ";
        // line 69
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 69, $this->source); })()), "phoneNumber", [], "any", false, false, false, 69), 'errors');
        yield "
                    </div>
                </div>

                <div class=\"profile-form-actions\">
                    <a class=\"button-secondary\" href=\"";
        // line 74
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile");
        yield "\">Cancel</a>
                    <button class=\"button-primary\" type=\"submit\">Save changes</button>
                </div>
                ";
        // line 77
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 77, $this->source); })()), 'rest');
        yield "
            ";
        // line 78
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["profileForm"]) || array_key_exists("profileForm", $context) ? $context["profileForm"] : (function () { throw new RuntimeError('Variable "profileForm" does not exist.', 78, $this->source); })()), 'form_end');
        yield "
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
        return "profile/edit.html.twig";
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
        return array (  234 => 78,  230 => 77,  224 => 74,  216 => 69,  212 => 68,  208 => 67,  201 => 63,  197 => 62,  193 => 61,  186 => 57,  182 => 56,  178 => 55,  171 => 51,  167 => 50,  163 => 49,  155 => 44,  151 => 43,  147 => 42,  142 => 40,  128 => 29,  114 => 17,  108 => 15,  100 => 13,  97 => 12,  95 => 11,  90 => 9,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Edit Profile | FurHope{% endblock %}

{% block body %}
    <section class=\"profile-edit-page\">
        <div class=\"panel profile-edit-panel\">
            <div class=\"profile-edit-panel__intro\">
                <label class=\"profile-upload-trigger\" for=\"{{ profileForm.profileImage.vars.id }}\">
                    <div class=\"profile-avatar profile-avatar--large\">
                        {% set memberAvatarUrl = social_avatar_url(member) %}
                        {% if memberAvatarUrl %}
                            <img src=\"{{ memberAvatarUrl }}\" alt=\"{{ member.fullName }}\" referrerpolicy=\"no-referrer\">
                        {% else %}
                            <span>{{ member.initials }}</span>
                        {% endif %}
                    </div>
                    <span class=\"profile-upload-trigger__badge\">
                        <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                            <path d=\"M12 20h9\"></path>
                            <path d=\"M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4Z\"></path>
                        </svg>
                    </span>
                </label>
                <div>
                    <div class=\"eyebrow\">Profile settings</div>
                    <div class=\"profile-title-row\">
                        <h1>Edit your profile</h1>
                        <a class=\"profile-edit-link\" href=\"{{ path('app_profile') }}\" aria-label=\"Back to profile\">
                            <svg viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                                <path d=\"M19 12H5\"></path>
                                <path d=\"m12 19-7-7 7-7\"></path>
                            </svg>
                        </a>
                    </div>
                    <p class=\"muted\">Click the photo to choose a new image from your computer, then save your changes.</p>
                </div>
            </div>

            {{ form_start(profileForm, { attr: { class: 'profile-form', novalidate: 'novalidate' } }) }}
                <div class=\"profile-upload-field\">
                    {{ form_widget(profileForm.profileImage, { attr: { class: 'profile-upload-input', accept: 'image/*' } }) }}
                    <p class=\"form-help\">{{ form_help(profileForm.profileImage) }}</p>
                    {{ form_errors(profileForm.profileImage) }}
                </div>

                <div class=\"profile-form-grid\">
                    <div class=\"form-group\">
                        {{ form_label(profileForm.firstName) }}
                        {{ form_widget(profileForm.firstName, { attr: { placeholder: 'First name' } }) }}
                        {{ form_errors(profileForm.firstName) }}
                    </div>

                    <div class=\"form-group\">
                        {{ form_label(profileForm.lastName) }}
                        {{ form_widget(profileForm.lastName, { attr: { placeholder: 'Last name' } }) }}
                        {{ form_errors(profileForm.lastName) }}
                    </div>

                    <div class=\"form-group\">
                        {{ form_label(profileForm.email) }}
                        {{ form_widget(profileForm.email, { attr: { placeholder: 'name@example.com' } }) }}
                        {{ form_errors(profileForm.email) }}
                    </div>

                    <div class=\"form-group\">
                        {{ form_label(profileForm.phoneNumber) }}
                        {{ form_widget(profileForm.phoneNumber, { attr: { placeholder: '+216 00 000 000' } }) }}
                        {{ form_errors(profileForm.phoneNumber) }}
                    </div>
                </div>

                <div class=\"profile-form-actions\">
                    <a class=\"button-secondary\" href=\"{{ path('app_profile') }}\">Cancel</a>
                    <button class=\"button-primary\" type=\"submit\">Save changes</button>
                </div>
                {{ form_rest(profileForm) }}
            {{ form_end(profileForm) }}
        </div>
    </section>
{% endblock %}
", "profile/edit.html.twig", "C:\\Users\\safwe\\Desktop\\symfony integ\\furhopesymfony\\templates\\profile\\edit.html.twig");
    }
}
