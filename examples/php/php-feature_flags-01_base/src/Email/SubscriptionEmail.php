<?php
namespace CodelyTv\Email;

use CodelyTv\FeatureFlags;

final class SubscriptionEmail{
    private FeatureFlags $featureFlags;

    public function __construct(FeatureFlags $featureFlags)
    {
        $this->featureFlags = $featureFlags;
    }

    public function __invoke()
    {
        echo "<p>Message for all subscribers</p>";
        
        if ($this->featureFlags->get(\CodelyTv\Flags::NEW_SUBSCRIPTION_PAGE_NAME)){
            echo "<p>Additional message for subscribers with active flag</p>";
        }
    }
}