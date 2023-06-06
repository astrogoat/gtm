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
        ray([
            "Event " => [
                "Key" => $key,
                "Value" => $value,
            ],
        ]);
        $pushItem = new DataLayer();
        $pushItem->set($key, $value);
        $this->pushDataLayer->push($pushItem);
    }

    public function pushOnce(array|string $search, array|string $value = null, bool $overwrite = false): void
    {
        // We check if the search array has already been added to the pushDataLayer.
        // This will return either an interger index or false if it was not found
        // which we later will use to determine what happens to our key/value.
        $indexExists = $this->pushDataLayer->search(function (DataLayer $item) use ($search, $value) {
            if (is_array($search)) {
                return ! empty(array_intersect_assoc($search, $item->toArray()));
            }

            return $item->has($search);
        });

        // The search was not already added so we add it now and call it a day.
        if ($indexExists === false) {
            if (is_array($search)) {
                $key = array_merge($search, $value);
                $value = null;
            } else {
                $key = $search;
            }

            $this->push($key, $value);

            return;
        }

        // It was found but we want to keep the first one, so just move on.
        if ($overwrite === false) {
            return;
        }

        // We remove the already set key/value from the pushDataLayer.
        unset($this->pushDataLayer[$indexExists]);

        if (is_array($search)) {
            $key = array_merge($search, $value);
            $value = null;
        } else {
            $key = $search;
        }
        // And the add the new one.
        $this->push($key, $value);

        // Lastly, we reset the keys in the pushDataLayer.
        $this->pushDataLayer = $this->pushDataLayer->values();
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
