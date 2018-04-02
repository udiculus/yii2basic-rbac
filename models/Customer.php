<?php

namespace app\models;

use Yii;
use \app\models\base\Customer as BaseCustomer;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tblCustomer".
 */
class Customer extends BaseCustomer
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }

    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['locationSID' => 'customerLocationSID']);
    }
}
