<?php

namespace Astrogoat\Gtm;

use Astrogoat\Gtm\Settings\GtmSettings;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;

class GoogleTagManager
{
    use Macroable;

    protected ?string $id;

    protected bool $enabled;

    protected DataLayer $dataLayer;

    protected DataLayer $flashDataLayer;

    protected Collection $pushDataLayer;

    public function __construct(string $id = null)
    {
        $this->id = $id;
        $this->dataLayer = new DataLayer();
        $this->flashDataLayer = new DataLayer();
        $this->pushDataLayer = new Collection();
        $this->enabled = GtmSettings::isEnabled() && ! blank($this->id);
    }

    /**
     * Return the Google Tag Manager id.
     *
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Check whether script rendering is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Add data to the data layer.
     */
    public function set(array|string $key, mixed $value = null)
    {
        $this->dataLayer->set($key, $value);
    }

    /**
     * Retrieve the data layer.
     */
    public function getDataLayer(): DataLayer
    {
        return $this->dataLayer;
    }

    /**
     * Add data to the data layer for the next request.
     */
    public function flash(array|string $key, mixed $value = null)
    {
        $this->flashDataLayer->set($key, $value);
    }

    /**
     * Retrieve the data layer's data for the next request.
     */
    public function getFlashData(): array
    {
        return $this->flashDataLayer->toArray();
    }

    /**
     * Add data to be pushed to the data layer.
     */
    public function push(array|string $key, mixed $value = null)
    {
        $pushItem = new DataLayer();
        $pushItem->set($key, $value);
        $this->pushDataLayer->push($pushItem);
    }

    /**
     * Retrieve the data layer's data for the next request.
     */
    public function getPushData(): Collection
    {
        return $this->pushDataLayer;
    }

    /**
     * Clear the data layer.
     */
    public function clear()
    {
        $this->dataLayer = new DataLayer();
        $this->pushDataLayer = new Collection();
    }

    /**
     * Utility function to dump an array as json.
     */
    public function dump(array $data): string
    {
        return (new DataLayer($data))->toJson();
    }
}
