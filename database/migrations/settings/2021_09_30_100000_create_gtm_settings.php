<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGtmSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('gtm.enabled', false);
        $this->migrator->add('gtm.container_id', '');
    }

    public function down()
    {
        $this->migrator->delete('gtm.enabled');
        $this->migrator->delete('gtm.container_id');
    }
}
