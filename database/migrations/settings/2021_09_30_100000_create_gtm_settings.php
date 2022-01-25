<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGtmSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('gtm.enabled', false);
        // $this->migrator->add('gtm.url', '');
        // $this->migrator->addEncrypted('gtm.access_token', '');
    }

    public function down()
    {
        $this->migrator->delete('gtm.enabled');
        // $this->migrator->delete('gtm.url');
        // $this->migrator->delete('gtm.access_token');
    }
}
