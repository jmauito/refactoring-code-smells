<?php

declare(strict_types=1);

namespace CodelyTv;

final class FeatureFlags
{
    private array $flags = [];

    public function __construct($flags = [])
    {
        $this->flags = $flags;
    }

    public function get(string $flagName): bool
    {
        if (!array_key_exists($flagName, $this->flags)) {
            return false;
        }

        return $this->flags[$flagName];
    }

}
