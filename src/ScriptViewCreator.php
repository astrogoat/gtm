<?php

namespace Astrogoat\Gtm;

use Astrogoat\Gtm\Exceptions\ApiKeyNotSet;
use Illuminate\View\View;

class ScriptViewCreator
{
    protected GoogleTagManager $googleTagManager;

    public function __construct(GoogleTagManager $googleTagManager)
    {
        $this->googleTagManager = $googleTagManager;
    }

    public function create(View $view)
    {
        if ($this->googleTagManager->isEnabled() && empty($this->googleTagManager->id())) {
            throw new ApiKeyNotSet();
        }

        $view
            ->with('id', $this->googleTagManager->id())
            ->with('dataLayer', $this->googleTagManager->getDataLayer())
            ->with('pushData', $this->googleTagManager->getPushData());
    }
}
