<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DinhNghiaCot;

/**
 * DinhnghiacotSearch represents the model behind the search form about `common\models\DinhNghiaCot`.
 */
class DinhnghiacotSearch extends DinhNghiaCot
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dinh_nghia_bang_id', 'thu_tu'], 'integer'],
            [['ten_cot', 'khoa', 'loai', 'cong_thuc', 'tao_luc'], 'safe'],
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
        $query = DinhNghiaCot::find();

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
            'dinh_nghia_bang_id' => $this->dinh_nghia_bang_id,
            'thu_tu' => $this->thu_tu,
            'tao_luc' => $this->tao_luc,
        ]);

        $query->andFilterWhere(['like', 'ten_cot', $this->ten_cot])
            ->andFilterWhere(['like', 'khoa', $this->khoa])
            ->andFilterWhere(['like', 'loai', $this->loai])
            ->andFilterWhere(['like', 'cong_thuc', $this->cong_thuc]);

        return $dataProvider;
    }
}
