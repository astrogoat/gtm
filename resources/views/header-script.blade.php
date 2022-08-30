@if(\Astrogoat\Gtm\Settings\GtmSettings::isEnabled())
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
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{{ settings(Astrogoat\Gtm\Settings\GtmSettings::class, 'container_id') }}');
    </script>
    <!-- [GTM] Header | End -->
@endif
