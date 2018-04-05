<?php
/**
 * Created by PhpStorm.
 * User: Yudhi_G293
 * Date: 02/04/2018
 * Time: 10:54
 */

namespace app\controllers;

use Yii;
use app\models\FieldAlias;
use app\models\form\ReportWizardForm;
use app\models\ReportTemplate;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;
use yii\web\Response;

class ReportWizardController extends Controller
{

    public function actionIndex()
    {

        $model = new ReportTemplate();
        // validate any AJAX requests fired off by the form
        if (Yii::$app->request->isAjax) {
            $model->attributes = Yii::$app->request->post();
            if ($model->validate()){
                echo "good";
            } else
                print_r($model->errors);
            print_r($model->validate());
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        $customer = FieldAlias::find()
            ->where(['type' => 'CUSTOMER'])
            ->orderBy('id')
            ->all();

        $shipment = FieldAlias::find()
            ->where(['type' => 'SHIPMENT'])
            ->orderBy('id')
            ->all();

        $advancedFilter = FieldAlias::find()
            ->where(['use_as_filter' => 1])
            ->orderBy('id')
            ->all();

        $sortingOrder = FieldAlias::find()
            ->where(['use_as_order' => 1])
            ->orderBy('id')
            ->all();

        $clientFilter = FieldAlias::find()
            ->where(['use_as_client_filter' => 1])
            ->orderBy('id')
            ->all();

        $reportTemplate = new ReportWizardForm();
//        $className = \app\models\Customer::className();
//        $classInstance = new $className;
        return $this->render('step1', [
            'customer' => $customer,
            'shipment' => $shipment,
            'advancedFilter' => $advancedFilter,
            'sortingOrder' => $sortingOrder,
            'clientFilter' => $clientFilter,
            'model' => $reportTemplate,
//            'relations' => $classInstance->getRelationData()
        ]);
    }

}