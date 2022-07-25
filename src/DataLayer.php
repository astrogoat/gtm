<?php

namespace Astrogoat\Gtm;

use Illuminate\Support\Arr;

class DataLayer
{
    protected array $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * Add data to the data layer. Supports dot notation.
     * Inspired by Laravel's config repository class.
     */
    public function set(array|string $key, mixed $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $innerKey => $innerValue) {
                Arr::set($this->data, $innerKey, $innerValue);
            }

            return;
        }

        Arr::set($this->data, $key, $value);
    }

    /**
     * Empty the data layer.
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * Return an array representation of the data layer.
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * Return a json representation of the data layer.
     */
    public function toJson(): string
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }
}
