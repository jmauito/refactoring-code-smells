<?php

declare(strict_types=1);

namespace CodelyTv\Application;

use CodelyTv\Debug;
use CodelyTv\Email\EmailNotifier;
use CodelyTv\FeatureFlags;
use CodelyTv\Flags;
use CodelyTv\Persistence\MySqlConnection;

final class Subscribe
{
    
    private FeatureFlags $featureFlags;

    public function __construct(FeatureFlags $featureFlags)
    {
        $this->featureFlags = $featureFlags;
    }

    public function __invoke(string $email, ?string $name = null): void
    {
        $mySqlConnection = new MySqlConnection($this->featureFlags);
        
        $flag = $this->featureFlags->get(Flags::NEW_SUBSCRIPTION_PAGE_NAME);
        if ($flag and !Debug::instance()->isDebugModeEnabled()) {
            // The new subscription added a "name" field
            $mySqlConnection->persist($email, $name);
        } else {
            $mySqlConnection->persist($email);
        }

        $emailNotifier = new EmailNotifier($this->featureFlags);
        $emailNotifier->sendSubscriptionEmail($email);
    }
}
