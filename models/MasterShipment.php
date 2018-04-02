<?php

namespace app\models;

use Yii;
use \app\models\base\MasterShipment as BaseMasterShipment;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tblMasterShipment".
 */
class MasterShipment extends BaseMasterShipment
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
}
