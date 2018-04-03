<?php
/**
 * Created by PhpStorm.
 * User: Yudhi_G293
 * Date: 02/04/2018
 * Time: 10:54
 */

namespace app\controllers;

use app\models\FieldAlias;
use app\models\MdlReport;
use yii\web\Controller;

class ReportWizardController extends Controller
{

    public function actionIndex()
    {
        $customers = FieldAlias::find()
            ->where(['type' => 'CUSTOMER'])
            ->orderBy('id')
            ->all();

        $modelReport = new MdlReport();
        $className = \app\models\Customer::className();
        $classInstance = new $className;
        return $this->render('step1', [
            'customer' => $customers,
            'model' => $modelReport,
//            'relations' => $classInstance->getRelationData()
        ]);
    }

}