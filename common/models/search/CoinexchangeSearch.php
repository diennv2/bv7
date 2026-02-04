<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Coinexchange;

/**
 * CoinexchangeSearch represents the model behind the search form about `\common\models\Coinexchange`.
 */
class CoinexchangeSearch extends Coinexchange
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userid', 'sodiem', 'status', 'sotienthanhcong'], 'integer'],
            [['phonenumber', 'brand', 'type', 'transaction_id', 'service', 'mess', 'time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Coinexchange::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'userid' => $this->userid,
            'sodiem' => $this->sodiem,
            'status' => $this->status,
            'sotienthanhcong' => $this->sotienthanhcong,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'phonenumber', $this->phonenumber])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'transaction_id', $this->transaction_id])
            ->andFilterWhere(['like', 'service', $this->service])
            ->andFilterWhere(['like', 'mess', $this->mess]);

        return $dataProvider;
    }
}
