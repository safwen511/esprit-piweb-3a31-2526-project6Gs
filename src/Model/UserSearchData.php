<?php

namespace App\Model;

class UserSearchData
{
    public const STATUS_ALL = 'all';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_VERIFIED = 'verified';
    public const STATUS_UNVERIFIED = 'unverified';
    public const STATUS_VETERAN_PENDING = 'veteran_pending';

    public ?string $term = null;

    public string $status = self::STATUS_ALL;
}
