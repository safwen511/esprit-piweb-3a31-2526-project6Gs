<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/admin' => [[['_route' => 'admin', '_controller' => 'App\\Controller\\Admin\\DashboardController::index', 'routeCreatedByEasyAdmin' => true, 'dashboardControllerFqcn' => 'App\\Controller\\Admin\\DashboardController', 'crudControllerFqcn' => null, 'crudAction' => null], null, null, null, false, false, null]],
        '/admin/user' => [[['_route' => 'admin_user_index', '_controller' => 'App\\Controller\\Admin\\UserCrudController::index', 'routeCreatedByEasyAdmin' => true, 'dashboardControllerFqcn' => 'App\\Controller\\Admin\\DashboardController', 'crudControllerFqcn' => 'App\\Controller\\Admin\\UserCrudController', 'crudAction' => 'index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/user/new' => [[['_route' => 'admin_user_new', '_controller' => 'App\\Controller\\Admin\\UserCrudController::new', 'routeCreatedByEasyAdmin' => true, 'dashboardControllerFqcn' => 'App\\Controller\\Admin\\DashboardController', 'crudControllerFqcn' => 'App\\Controller\\Admin\\UserCrudController', 'crudAction' => 'new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/user/batch-delete' => [[['_route' => 'admin_user_batch_delete', '_controller' => 'App\\Controller\\Admin\\UserCrudController::batchDelete', 'routeCreatedByEasyAdmin' => true, 'dashboardControllerFqcn' => 'App\\Controller\\Admin\\DashboardController', 'crudControllerFqcn' => 'App\\Controller\\Admin\\UserCrudController', 'crudAction' => 'batchDelete'], null, ['POST' => 0], null, false, false, null]],
        '/admin/user/autocomplete' => [[['_route' => 'admin_user_autocomplete', '_controller' => 'App\\Controller\\Admin\\UserCrudController::autocomplete', 'routeCreatedByEasyAdmin' => true, 'dashboardControllerFqcn' => 'App\\Controller\\Admin\\DashboardController', 'crudControllerFqcn' => 'App\\Controller\\Admin\\UserCrudController', 'crudAction' => 'autocomplete'], null, ['GET' => 0], null, false, false, null]],
        '/admin/user/render-filters' => [[['_route' => 'admin_user_render_filters', '_controller' => 'App\\Controller\\Admin\\UserCrudController::renderFilters', 'routeCreatedByEasyAdmin' => true, 'dashboardControllerFqcn' => 'App\\Controller\\Admin\\DashboardController', 'crudControllerFqcn' => 'App\\Controller\\Admin\\UserCrudController', 'crudAction' => 'renderFilters'], null, ['GET' => 0], null, false, false, null]],
        '/api/login_check' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
        '/api/me' => [[['_route' => 'api_me', '_controller' => 'App\\Controller\\Api\\MeController'], null, ['GET' => 0], null, false, false, null]],
        '/dashboard' => [[['_route' => 'app_dashboard', '_controller' => 'App\\Controller\\DashboardController::index'], null, null, null, false, false, null]],
        '/social' => [[['_route' => 'feed_index', '_controller' => 'App\\Controller\\FeedController::index'], null, ['GET' => 0], null, false, false, null]],
        '/social/feed' => [[['_route' => 'feed_list', '_controller' => 'App\\Controller\\FeedController::index'], null, ['GET' => 0], null, false, false, null]],
        '/social/search/members' => [[['_route' => 'feed_search_members', '_controller' => 'App\\Controller\\FeedController::searchMembers'], null, ['GET' => 0], null, false, false, null]],
        '/' => [[['_route' => 'app_home', '_controller' => 'App\\Controller\\HomeController::index'], null, null, null, false, false, null]],
        '/social/notifications/read-all' => [[['_route' => 'social_notification_read_all', '_controller' => 'App\\Controller\\NotificationController::readAll'], null, ['POST' => 0], null, false, false, null]],
        '/social/posts/new' => [[['_route' => 'post_new', '_controller' => 'App\\Controller\\PostController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/profile' => [[['_route' => 'app_profile', '_controller' => 'App\\Controller\\ProfileController::show'], null, null, null, false, false, null]],
        '/profile/edit' => [[['_route' => 'app_profile_edit', '_controller' => 'App\\Controller\\ProfileController::edit'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\RegistrationController::register'], null, null, null, false, false, null]],
        '/verify/email' => [[['_route' => 'app_verify_email', '_controller' => 'App\\Controller\\RegistrationController::verifyUserEmail'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
        '/dashboard/users' => [[['_route' => 'app_user_directory', '_controller' => 'App\\Controller\\UserDirectoryController::index'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/admin/user/([^/]++)(?'
                    .'|/(?'
                        .'|edit(*:38)'
                        .'|delete(*:51)'
                    .')'
                    .'|(*:59)'
                .')'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:95)'
                .'|/social/(?'
                    .'|posts/(?'
                        .'|(\\d+)/comments(*:136)'
                        .'|(\\d+)(*:149)'
                        .'|(\\d+)/edit(*:167)'
                        .'|(\\d+)/delete(*:187)'
                        .'|(\\d+)/report(*:207)'
                        .'|(\\d+)/react/(like|dislike)(*:241)'
                    .')'
                    .'|comments/(\\d+)/delete(*:271)'
                    .'|friends/request/(?'
                        .'|(\\d+)(*:303)'
                        .'|(\\d+)/accept(*:323)'
                        .'|(\\d+)/decline(*:344)'
                    .')'
                    .'|notifications/(\\d+)/read(*:377)'
                    .'|assets/local/([A-Za-z0-9\\-_]+)/([A-Fa-f0-9]{64})(*:433)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => 'admin_user_edit', '_controller' => 'App\\Controller\\Admin\\UserCrudController::edit', 'routeCreatedByEasyAdmin' => true, 'dashboardControllerFqcn' => 'App\\Controller\\Admin\\DashboardController', 'crudControllerFqcn' => 'App\\Controller\\Admin\\UserCrudController', 'crudAction' => 'edit'], ['entityId'], ['GET' => 0, 'POST' => 1, 'PATCH' => 2], null, false, false, null]],
        51 => [[['_route' => 'admin_user_delete', '_controller' => 'App\\Controller\\Admin\\UserCrudController::delete', 'routeCreatedByEasyAdmin' => true, 'dashboardControllerFqcn' => 'App\\Controller\\Admin\\DashboardController', 'crudControllerFqcn' => 'App\\Controller\\Admin\\UserCrudController', 'crudAction' => 'delete'], ['entityId'], ['POST' => 0], null, false, false, null]],
        59 => [[['_route' => 'admin_user_detail', '_controller' => 'App\\Controller\\Admin\\UserCrudController::detail', 'routeCreatedByEasyAdmin' => true, 'dashboardControllerFqcn' => 'App\\Controller\\Admin\\DashboardController', 'crudControllerFqcn' => 'App\\Controller\\Admin\\UserCrudController', 'crudAction' => 'detail'], ['entityId'], ['GET' => 0], null, false, true, null]],
        95 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        136 => [[['_route' => 'comment_create', '_controller' => 'App\\Controller\\CommentController::create'], ['id'], ['POST' => 0], null, false, false, null]],
        149 => [[['_route' => 'post_show', '_controller' => 'App\\Controller\\PostController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        167 => [[['_route' => 'post_edit', '_controller' => 'App\\Controller\\PostController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        187 => [[['_route' => 'post_delete', '_controller' => 'App\\Controller\\PostController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        207 => [[['_route' => 'post_report', '_controller' => 'App\\Controller\\PostReportController::report'], ['id'], ['POST' => 0], null, false, false, null]],
        241 => [[['_route' => 'post_reaction_toggle', '_controller' => 'App\\Controller\\ReactionController::toggle'], ['id', 'reaction'], ['POST' => 0], null, false, true, null]],
        271 => [[['_route' => 'comment_delete', '_controller' => 'App\\Controller\\CommentController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        303 => [[['_route' => 'friend_send', '_controller' => 'App\\Controller\\FriendRequestController::send'], ['id'], ['POST' => 0], null, false, true, null]],
        323 => [[['_route' => 'friend_accept', '_controller' => 'App\\Controller\\FriendRequestController::accept'], ['id'], ['POST' => 0], null, false, false, null]],
        344 => [[['_route' => 'friend_decline', '_controller' => 'App\\Controller\\FriendRequestController::decline'], ['id'], ['POST' => 0], null, false, false, null]],
        377 => [[['_route' => 'social_notification_read', '_controller' => 'App\\Controller\\NotificationController::read'], ['id'], ['POST' => 0], null, false, false, null]],
        433 => [
            [['_route' => 'social_asset_show', '_controller' => 'App\\Controller\\SocialMediaController::show'], ['token', 'signature'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
