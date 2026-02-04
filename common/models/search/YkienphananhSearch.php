<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ykienphananh;

/**
 * YkienphananhSearch represents the model behind the search form about `\common\models\Ykienphananh`.
 */
class YkienphananhSearch extends Ykienphananh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'dathanhtoan'], 'integer'],
            [['ngaylap', 'ten', 'sdt', 'noidung', 'address', 'email'], 'safe'],
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
        $query = Ykienphananh::find();

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
            'ngaylap' => $this->ngaylap,
            'status' => $this->status,
            'dathanhtoan' => $this->dathanhtoan,
        ]);

        $query->andFilterWhere(['like', 'ten', $this->ten])
            ->andFilterWhere(['like', 'sdt', $this->sdt])
            ->andFilterWhere(['like', 'noidung', $this->noidung])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
