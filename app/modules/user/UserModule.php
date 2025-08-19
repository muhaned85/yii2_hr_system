<?php

namespace app\modules\user;

use yii\base\Module;

/**
 * User module definition class
 */
class UserModule extends Module
{
    /**
     * {\@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\user\controllers';

    /**
     * {\@inheritdoc}
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}