@if(\Astrogoat\Gtm\Settings\GtmSettings::isEnabled())
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ settings(Astrogoat\Gtm\Settings\GtmSettings::class, 'container_id') }}"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
@endif
