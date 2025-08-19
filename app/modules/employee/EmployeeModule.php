<?php

namespace app\modules\employee;

use yii\base\Module;

/**
 * Employee module definition class
 */
class EmployeeModule extends Module
{
    /**
     * {\@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\employee\controllers';

    /**
     * {\@inheritdoc}
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}