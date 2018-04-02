<?php
/**
 * Created by PhpStorm.
 * User: Yudhi_G293
 * Date: 02/04/2018
 * Time: 10:54
 */

namespace app\controllers;

use Yii;
use app\models\CustomerSearch;
use yii\web\Controller;

class ReportWizardController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('step1',[
            'dataProvider' => $dataProvider
        ]);
    }

}