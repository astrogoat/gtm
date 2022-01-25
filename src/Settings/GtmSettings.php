<?php

namespace Astrogoat\Gtm\Settings;

use Astrogoat\Gtm\Actions\GtmAction;
use Helix\Lego\Settings\AppSettings;

class GtmSettings extends AppSettings
{
    // public string $url;
    // public string $access_token;

    protected array $rules = [
        // 'url' => ['required', 'url'],
        // 'access_token' => ['required'],
    ];

    protected static array $actions = [
        // GtmAction::class,
    ];

    // public static function encrypted(): array
    // {
    //     return ['access_token'];
    // }

    public function description(): string
    {
        return 'Interact with Gtm.';
    }
}
