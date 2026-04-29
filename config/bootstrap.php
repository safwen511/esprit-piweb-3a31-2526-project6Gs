<?php

declare(strict_types=1);

$appTimezone = $_SERVER['APP_TIMEZONE'] ?? $_ENV['APP_TIMEZONE'] ?? 'Africa/Lagos';

if (is_string($appTimezone) && $appTimezone !== '') {
    date_default_timezone_set($appTimezone);
}
