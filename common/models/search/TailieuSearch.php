<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaiLieu;

/**
 * TailieuSearch represents the model behind the search form about `common\models\TaiLieu`.
 */
class TailieuSearch extends TaiLieu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'benh_id', 'dinh_nghia_bang_id', 'nguoi_tai'], 'integer'],
            [['tieu_de', 'duong_dan', 'loai', 'tai_luc'], 'safe'],
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
        $query = TaiLieu::find();

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
            'dinh_nghia_bang_id' => $this->dinh_nghia_bang_id,
            'nguoi_tai' => $this->nguoi_tai,
            'tai_luc' => $this->tai_luc,
        ]);

        $query->andFilterWhere(['like', 'tieu_de', $this->tieu_de])
            ->andFilterWhere(['like', 'duong_dan', $this->duong_dan])
            ->andFilterWhere(['like', 'loai', $this->loai]);

        return $dataProvider;
    }
}
