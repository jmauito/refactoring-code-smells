<?php

declare(strict_types=1);

namespace CodelyTv\Persistence;

use CodelyTv\FeatureFlags;
use CodelyTv\Flags;

final class MySqlConnection
{

    private FeatureFlags $featureFlags;

    public function __construct(FeatureFlags $featureFlags)
    {
        $this->featureFlags = $featureFlags;
    }

    public function persist(string $email, ?string $name = null): void
    {
        $subscription = ['email' => $email];

        $flag = $this->featureFlags->get(Flags::NEW_SUBSCRIPTION_PAGE_NAME);
        if ($flag) {
            $subscription['name'] = $name;
        }

        echo json_encode($subscription) . PHP_EOL;
    }
}
