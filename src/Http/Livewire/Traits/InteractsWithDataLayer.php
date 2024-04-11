<?php

namespace Astrogoat\Gtm\Http\Livewire\Traits;

use Astrogoat\Gtm\Settings\GtmSettings;

trait InteractsWithDataLayer
{
    public function pushToDataLayer($data)
    {
        if (! GtmSettings::isEnabled()) {
            return;
        }

        $this->dispatchBrowserEvent('push-to-data-layer', $data);
    }
}
