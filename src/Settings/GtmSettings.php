<?php

namespace Astrogoat\Gtm\Settings;

use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class GtmSettings extends AppSettings
{
    public string $container_id;
    public string $server_side_url;

    public function getRules(): array
    {
        return [
            'container_id' => Rule::requiredIf($this->enabled),
            'server_side_url' => ['nullable'],
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
                'properties' => ['container_id','server_side_url'],
            ],
        ];
    }

    public function labels(): array
    {
        return [
            'server_side_url' => 'Server side URL',
        ];
    }

    public function help(): array
    {
        return [
            'server_side_url' => '(Optional) Uses GTM default URL if left blank.',
        ];
    }
}
