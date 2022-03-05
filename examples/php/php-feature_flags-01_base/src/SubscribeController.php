<?php

declare(strict_types=1);

namespace CodelyTv;

use CodelyTv\Application\Subscribe;
use Symfony\Component\HttpFoundation\Request;

final class SubscribeController
{
    public function __invoke(Request $request)
    {
        $flagHeader = $request->headers->get('X-FLAG');
        $flags = [];
        if ($flagHeader === Flags::NEW_SUBSCRIPTION_PAGE_TOKEN) {
            $flags = ['new_subscription_page' => true];
        }
        $featureFlags = new FeatureFlags($flags);
        
        $subscribeUseCase = new Subscribe($featureFlags);
        $subscribeUseCase->__invoke(
            $request->request->get('email'),
            $request->request->get('name'),
        );
    }
}
