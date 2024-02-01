@if(\Astrogoat\Gtm\Settings\GtmSettings::isEnabled())
    @php
        $serverSideUrl = blank(settings(Astrogoat\Gtm\Settings\GtmSettings::class, 'server_side_url'))
              ? 'https://www.googletagmanager.com'
              : settings(Astrogoat\Gtm\Settings\GtmSettings::class, 'server_side_url');
    @endphp
    <!-- -- [GTM] Header | Start -->
    <script>
        window.dataLayer = window.dataLayer || [];

        @php($elevarSettings = settings(Astrogoat\Elevar\Settings\ElevarSettings::class))

        @if($elevarSettings->isEnabled())
            window.ElevarDataLayer = window.ElevarDataLayer ?? [];

            @unless(empty($dataLayer->toArray()))
                window.ElevarDataLayer.push({!! $dataLayer->toJson() !!});
            @endunless

            @foreach($pushData as $item)
                window.ElevarDataLayer.push({!! $item->toJson() !!});
            @endforeach

            window.addEventListener('push_to_data_layer', (event) => window.ElevarDataLayer.push(event.detail))
        @else
            @unless(empty($dataLayer->toArray()))
                window.dataLayer.push({!! $dataLayer->toJson() !!});
            @endunless

            @foreach($pushData as $item)
                window.dataLayer.push({!! $item->toJson() !!});
            @endforeach

            window.addEventListener('push_to_data_layer', (event) => window.dataLayer.push(event.detail))
        @endif
    </script>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            '{{ $serverSideUrl }}/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{{ settings(Astrogoat\Gtm\Settings\GtmSettings::class, 'container_id') }}');
    </script>
    <!-- -- [GTM] Header | End -->
@endif
