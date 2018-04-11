<?php
/**
 * Created by PhpStorm.
 * User: Yudhi_G293
 * Date: 02/04/2018
 * Time: 10:54
 */

namespace app\controllers;

use app\models\JSONResponse;
use app\models\Shipment;
use Yii;
use app\models\FieldAlias;
use app\models\form\ReportWizardForm;
use app\models\ReportTemplate;
use app\models\search\ReportTemplateSearch;
use yii\data\ActiveDataProvider;
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
        // 2 => k2

        $selectedField = $this->translateSelect($report->field_order, $field_alias);
        $filteredField = $this->translateFilter($report->filter, $field_alias);
        $orderedField = $this->translateOrder($report->sorting_order, $field_alias);

        print_r($orderedField);

        exit(0);

        $query = Shipment::find()
            ->select($selectedField)
            ->joinWith('customer')
            ->orderBy($orderedField);

        foreach ($filteredField as $ff_temp):
            $query->andWhere($ff_temp);
        endforeach;

//        if ($report->limit_per_page)
//            $query = $query->limit($report->limit_per_page);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $report->limit_per_page ? $report->limit_per_page : null,
            ],
        ]);

        return $this->render('view', [
            'report' => $report,
            'gridColumn' => $selectedField,
            'dataProvider' => $dataProvider
        ]);
    }

    public function translateSelect($selected, $fields)
    {
        $selected_arr = json_decode($selected);
        $translated_column = array();
        foreach ($selected_arr as $id):
            $translated_column[] = $fields['k' . $id]['field_name'];
        endforeach;

        return $translated_column;
    }

    public function translateFilter($filtered, $fields)
    {
        $filtered_arr = json_decode($filtered);
        $translated_filter = array();
        foreach ($filtered_arr as $filter_temp):
            $translated_filter[] = $this->translateWhere($fields['k' . $filter_temp->id]['field_name'], $filter_temp->op, $filter_temp->value);
        endforeach;

        return $translated_filter;
    }

    public function translateOrder($ordered, $fields)
    {
        $ordered_arr = json_decode($ordered);
        $translated_order = array();
        foreach ($ordered_arr as $order_temp):
            $translated_order[] = [$fields['k' . $order_temp->id]['field_name'], ($order_temp->type == "desc" ? SORT_DESC : SORT_ASC)];
        endforeach;

        return $translated_order;
    }

    public function translateWhere($field, $op, $value)
    {
        switch ($op) {
            case "eq":
                return ['=', $field, $value];
                break;
            case "nq":
                return ['!=', $field, $value];
                break;
            case "lt":
                return ['<', $field, $value];
                break;
            case "gt":
                return ['>', $field, $value];
                break;
            case "le":
                return ['<=', $field, $value];
                break;
            case "ge":
                return ['>=', $field, $value];
                break;
            case "sw":
                return ['LIKE', $field, $value . "%"];
                break;
            case "ns":
                return ['LIKE', $field, "%" . $value];
                break;
            case "in":
                return ['IN', $field, $value];
                break;
            case "ex":
                return ['NOT IN', $field, $value];
                break;
            default:
                return ['=', $field, $value];
        }
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