<?php

namespace app\models;

use Yii;
use \app\models\base\FieldAlias as BaseFieldAlias;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "field_alias".
 */
class FieldAlias extends BaseFieldAlias
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
