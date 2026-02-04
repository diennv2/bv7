<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Traloicauhoi;

/**
 * TraloicauhoiSearch represents the model behind the search form about `\common\models\Traloicauhoi`.
 */
class TraloicauhoiSearch extends Traloicauhoi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'listnhanquaid', 'cauhoi', 'status'], 'integer'],
            [['cautraloi', 'dapancuakhach'], 'safe'],
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
        $query = Traloicauhoi::find();

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
            'listnhanquaid' => $this->listnhanquaid,
            'cauhoi' => $this->cauhoi,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'cautraloi', $this->cautraloi])
            ->andFilterWhere(['like', 'dapancuakhach', $this->dapancuakhach]);

        return $dataProvider;
    }
}
