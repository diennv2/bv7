<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Datlichkham;

/**
 * DatlichkhamSearch represents the model behind the search form about `\common\models\Datlichkham`.
 */
class DatlichkhamSearch extends Datlichkham
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['hoten', 'dienthoai', 'noidung', 'email', 'time', 'tieude'], 'safe'],
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
        $query = Datlichkham::find();

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
            'status' => $this->status,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'hoten', $this->hoten])
            ->andFilterWhere(['like', 'dienthoai', $this->dienthoai])
            ->andFilterWhere(['like', 'noidung', $this->noidung])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'tieude', $this->tieude]);

        return $dataProvider;
    }
}
