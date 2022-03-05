<?php

declare(strict_types=1);

namespace CodelyTv\Email;

use CodelyTv\Email\SubscriptionEmail as EmailSubscriptionEmail;
use CodelyTv\FeatureFlags;

final class EmailNotifier
{
    private FeatureFlags $featureFlags;

    public function __construct(FeatureFlags $featureFlags)
    {
        $this->featureFlags = $featureFlags;
    }
    
    public function sendSubscriptionEmail(string $to)
    {
        echo "Email sent to $to";
        $subscriptionEmail = new EmailSubscriptionEmail($this->featureFlags);
        $subscriptionEmail->__invoke();
    }
}
