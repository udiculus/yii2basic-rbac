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
        $customer = FieldAlias::find()
            ->where(['type' => 'CUSTOMER'])
            ->orderBy('id')
            ->all();

        $shipment = FieldAlias::find()
            ->where(['type' => 'SHIPMENT'])
            ->orderBy('id')
            ->all();

        $permanentClause = FieldAlias::find()
            ->where(['use_as_filter' => 1])
            ->orderBy('id')
            ->all();

        $sortingOrder = FieldAlias::find()
            ->where(['use_as_order' => 1])
            ->orderBy('id')
            ->all();

        $modelReport = new MdlReport();
        $className = \app\models\Customer::className();
        $classInstance = new $className;
        return $this->render('step1', [
            'customer' => $customer,
            'shipment' => $shipment,
            'permanentClause' => $permanentClause,
            'sortingOrder' => $sortingOrder,
            'model' => $modelReport,
//            'relations' => $classInstance->getRelationData()
        ]);
    }

}