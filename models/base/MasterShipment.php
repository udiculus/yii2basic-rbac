<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "tblMasterShipment".
 *
 * @property integer $MasterSID
 * @property string $MasterCode
 * @property string $MasterDate
 * @property integer $MasterFromLocationSID
 * @property integer $MasterToLocationSID
 * @property string $aliasModel
 */
abstract class MasterShipment extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblMasterShipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MasterCode', 'MasterDate', 'MasterFromLocationSID', 'MasterToLocationSID'], 'required'],
            [['MasterCode'], 'string'],
            [['MasterDate'], 'safe'],
            [['MasterFromLocationSID', 'MasterToLocationSID'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MasterSID' => 'Master Sid',
            'MasterCode' => 'Master Code',
            'MasterDate' => 'Master Date',
            'MasterFromLocationSID' => 'Master From Location Sid',
            'MasterToLocationSID' => 'Master To Location Sid',
        ];
    }




}