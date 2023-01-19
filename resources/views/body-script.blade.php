@if(\Astrogoat\Gtm\Settings\GtmSettings::isEnabled())

    @php

        $server_side_url = settings(Astrogoat\Gtm\Settings\GtmSettings::class, 'server_side_url');

        if(blank($server_side_url)){

            $server_side_url = 'www.googletagmanager.com';

        }else{

            $server_side_url = Str::of($server_side_url,'https://')
                                ->replaceFirst(url('https://'), '');
        }

    @endphp

    <!-- [GTM] Body | Start -->
    <noscript><iframe src="https://{{ $server_side_url }}/ns.html?id={{ settings(Astrogoat\Gtm\Settings\GtmSettings::class, 'container_id') }}"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- [GTM] End | Start -->
@endif
