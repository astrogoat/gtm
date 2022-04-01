<?php

namespace Astrogoat\Gtm\Settings;

use Helix\Lego\Settings\AppSettings;

class GtmSettings extends AppSettings
{
    public string $container_id;

    protected array $rules = [
        'container_id' => ['required_unless:enabled,false'],
    ];

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
