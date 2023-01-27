<?php

namespace Astrogoat\Gtm;

use Astrogoat\Gtm\Settings\GtmSettings;
use Closure;
use Illuminate\Config\Repository as Config;
use Illuminate\Session\Store as Session;

class GoogleTagManagerMiddleware
{
    protected GoogleTagManager $googleTagManager;

    protected Session $session;

    protected string $sessionKey;

    public function __construct(GoogleTagManager $googleTagManager, Session $session, Config $config)
    {
        $this->googleTagManager = $googleTagManager;
        $this->session = $session;

        $this->sessionKey = $config->get('gtm.sessionKey');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! GtmSettings::isEnabled()) {
            return $next($request);
        }

        if ($this->session->has($this->sessionKey) && ! blank($this->session->get($this->sessionKey))) {
            $this->googleTagManager->push($this->session->get($this->sessionKey));
        }

        $response = $next($request);

        $this->session->flash($this->sessionKey, $this->googleTagManager->getFlashData());

        return $response;
    }
}
