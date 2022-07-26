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

        $this->dispatchBrowserEvent('push_to_data_layer', $data);
    }
}
