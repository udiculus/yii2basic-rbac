<?php
/**
 * Created by PhpStorm.
 * User: Yudhi_G293
 * Date: 12/04/2018
 * Time: 15:50
 */

namespace app\models\search;


use app\models\Shipment;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ShipmentReportSearch extends Shipment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['report_name', 'report_description'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Shipment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'report_name', $this->report_name])
            ->andFilterWhere(['like', 'report_description', $this->report_description]);

        return $dataProvider;
    }
}