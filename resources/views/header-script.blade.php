@if(\Astrogoat\Gtm\Settings\GtmSettings::isEnabled())
    @php

        $server_side_url = settings(Astrogoat\Gtm\Settings\GtmSettings::class, 'server_side_url');

        if(blank($server_side_url)){

            $server_side_url = 'https://www.googletagmanager.com';

        }else{

          if(! Str::startsWith($server_side_url,'https://')){
                $server_side_url = Str::start($server_side_url,'https://');
            }
        }

    @endphp
    <!-- [GTM] Header | Start -->
    <script>
        window.dataLayer = window.dataLayer || [];

        @unless(empty($dataLayer->toArray()))
            window.dataLayer.push({!! $dataLayer->toJson() !!});
        @endunless

        @foreach($pushData as $item)
            window.dataLayer.push({!! $item->toJson() !!});
        @endforeach

        window.addEventListener('push_to_data_layer', (event) => window.dataLayer.push(event.detail))
    </script>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            '{{ $server_side_url }}/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{{ settings(Astrogoat\Gtm\Settings\GtmSettings::class, 'container_id') }}');
    </script>
    <!-- [GTM] Header | End -->
@endif
