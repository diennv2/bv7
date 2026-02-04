<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cauhoi;

/**
 * CauhoiSearch represents the model behind the search form about `\common\models\Cauhoi`.
 */
class CauhoiSearch extends Cauhoi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'dokho'], 'integer'],
            [['cauhoi', 'cautraloia', 'cautraloib', 'cautraloic', 'dapan'], 'safe'],
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
        $query = Cauhoi::find();

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
            'product_id' => $this->product_id,
            'dokho' => $this->dokho,
        ]);

        $query->andFilterWhere(['like', 'cauhoi', $this->cauhoi])
            ->andFilterWhere(['like', 'cautraloia', $this->cautraloia])
            ->andFilterWhere(['like', 'cautraloib', $this->cautraloib])
            ->andFilterWhere(['like', 'cautraloic', $this->cautraloic])
            ->andFilterWhere(['like', 'dapan', $this->dapan]);

        return $dataProvider;
    }
}
