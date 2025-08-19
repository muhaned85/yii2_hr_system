<?php

namespace app\modules\payroll;

use yii\base\Module;

/**
 * Payroll module definition class
 */
class PayrollModule extends Module
{
    /**
     * {\@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\payroll\controllers';

    /**
     * {\@inheritdoc}
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}