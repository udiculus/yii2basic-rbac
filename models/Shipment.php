<?php

namespace app\models;

use Yii;
use \app\models\base\Shipment as BaseShipment;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tblShipment".
 */
class Shipment extends BaseShipment
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

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customerSID' => 'ShipmentCustomerSID']);
    }
}
