<?php

namespace app\models;

use Yii;
use \app\models\base\MdlReport as BaseMdlReport;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "module_report".
 */
class MdlReport extends BaseMdlReport
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
