<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DinhNghiaBang;

/**
 * DinhnghiabangSearch represents the model behind the search form about `common\models\DinhNghiaBang`.
 */
class DinhnghiabangSearch extends DinhNghiaBang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'benh_id', 'nguoi_tao'], 'integer'],
            [['tieu_de', 'mo_ta', 'tao_luc'], 'safe'],
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
        $query = DinhNghiaBang::find();

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
            'benh_id' => $this->benh_id,
            'nguoi_tao' => $this->nguoi_tao,
            'tao_luc' => $this->tao_luc,
        ]);

        $query->andFilterWhere(['like', 'tieu_de', $this->tieu_de])
            ->andFilterWhere(['like', 'mo_ta', $this->mo_ta]);

        return $dataProvider;
    }
}
