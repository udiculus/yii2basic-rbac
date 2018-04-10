<?php
/**
 * Created by PhpStorm.
 * User: Yudhi_G293
 * Date: 02/04/2018
 * Time: 10:54
 */

namespace app\controllers;

use app\models\JSONResponse;
use Yii;
use app\models\FieldAlias;
use app\models\form\ReportWizardForm;
use app\models\ReportTemplate;
use app\models\search\ReportTemplateSearch;
use yii\web\Controller;
use yii\web\Response;

class ReportController extends Controller
{

    public function actionIndex()
    {
        $report = ReportTemplate::find()->all();

        return $this->render('index', [
            'report' => $report
        ]);
    }

    public function actionView($id)
    {
        $report = ReportTemplate::findOne($id);

        $field_alias = array();
        $field_alias_res = FieldAlias::find()->asArray()->all();
        foreach ($field_alias_res as $rows):
            $field_alias['k' . $rows['id']] = $rows;
        endforeach;

        echo $selectedField = $this->translateSelect($report->field_order, $field_alias);

        return $this->render('view', [
            'report' => $report
        ]);
    }

    public function translateSelect($selected, $fields)
    {
        $selected_arr = json_decode($selected);
        $selected_str = "";
        $x = 1;
        foreach ($selected_arr as $id):
            $selected_str .= $fields['k'.$id]['field_name'];
            if ($x < count($selected_arr))
                $selected_str .= ", ";
            $x++;
        endforeach;

        return $selected_str;
    }

    public function actionNew()
    {
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
        return $this->render('create', [
            'customer' => $customer,
            'shipment' => $shipment,
            'advancedFilter' => $advancedFilter,
            'sortingOrder' => $sortingOrder,
            'clientFilter' => $clientFilter,
            'model' => $reportTemplate,
//            'relations' => $classInstance->getRelationData()
        ]);
    }

    public function actionSave()
    {
        $model = new ReportTemplate();
        $response = new JSONResponse();
        // validate any AJAX requests fired off by the form
        if (Yii::$app->request->isAjax) {
            $model->attributes = Yii::$app->request->post();
            if ($model->validate()) {
                $model->field_order = json_encode($model->field_order, JSON_NUMERIC_CHECK);
                $model->filter = json_encode($model->filter, JSON_NUMERIC_CHECK);
                $model->sorting_order = json_encode($model->sorting_order, JSON_NUMERIC_CHECK);
                $model->client_filter = json_encode($model->client_filter, JSON_NUMERIC_CHECK);
                $model->save(false);
                $response->message = "Successfully saved a new template";
            } else {
                $response->errorcode = 1000;
                $response->form_error = $model->errors;
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $response;
        }
    }

}