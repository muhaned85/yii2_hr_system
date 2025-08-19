<?php

namespace app\modules\bank;

use yii\base\Module;

/**
 * Bank module definition class
 */
class BankModule extends Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\bank\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}