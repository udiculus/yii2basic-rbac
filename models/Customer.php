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
    use \mootensai\relation\RelationTrait;

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

    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['countrySID' => 'customerAddressCountrySID']);
    }

    public function attributeLabels()
    {
        $parent = parent::attributeLabels();
        $labels = [];

        return array_merge($parent, $labels);
    }

    public function relatedModels()
    {
        return [
            Country::className(),
            Location::className()
        ];
    }

    public function getModelRelations()
    {
        $reflector = new \ReflectionClass($this->modelClass);
        $model = new $this->modelClass;
        $stack = array();
        $baseClassMethods = get_class_methods('yii\db\ActiveRecord');
        foreach ($reflector->getMethods() as $method) {
            if (in_array($method->name, $baseClassMethods)) {
                continue;
            }
            $relation = call_user_func(array($model, $method->name));
            if ($relation instanceof yii\db\ActiveRelation) {
                $stack[] = $relation;
            }
        }
        return $stack;
    }
}
