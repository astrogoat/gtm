@if(\Astrogoat\Gtm\Settings\GtmSettings::isEnabled())
    @php
        $serverSideUrl = blank(settings(Astrogoat\Gtm\Settings\GtmSettings::class, 'server_side_url'))
            ? 'https://www.googletagmanager.com'
            : settings(Astrogoat\Gtm\Settings\GtmSettings::class, 'server_side_url');
    @endphp
    <!-- [GTM] Body | Start -->
    <noscript><iframe src="{{ $server_side_url }}/ns.html?id={{ settings(Astrogoat\Gtm\Settings\GtmSettings::class, 'container_id') }}"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- [GTM] End | Start -->
@endif
