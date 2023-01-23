<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddServerSideUrlToGtmSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('gtm.server_side_url', '');
    }

    public function down()
    {
        $this->migrator->delete('gtm.server_side_url');
    }
}
