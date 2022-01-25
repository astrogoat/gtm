<?php

namespace Astrogoat\Gtm\Actions;

use Helix\Lego\Apps\Actions\Action;

class GtmAction extends Action
{
    public static function actionName(): string
    {
        return 'Gtm action name';
    }

    public static function run(): mixed
    {
        return redirect()->back();
    }
}
