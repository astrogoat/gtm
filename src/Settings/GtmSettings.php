<?php

namespace Astrogoat\Gtm\Settings;

use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class GtmSettings extends AppSettings
{
    public string $container_id;

    public function getRules(): array
    {
        return [
            'container_id' => Rule::requiredIf($this->enabled),
        ];
    }

    public function description(): string
    {
        return 'Interact with Google Tag Manager (GTM).';
    }

    public function sections(): array
    {
        return [
            [
                'title' => 'Keys',
                'properties' => ['container_id'],
            ],
        ];
    }
}
