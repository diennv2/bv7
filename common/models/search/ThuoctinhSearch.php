<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Thuoctinh;

/**
 * ThuoctinhSearch represents the model behind the search form about `\common\models\Thuoctinh`.
 */
class ThuoctinhSearch extends Thuoctinh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'loaithuoctinh_id'], 'integer'],
            [['tenthuoctinh'], 'safe'],
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
        $query = Thuoctinh::find();

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
            'loaithuoctinh_id' => $this->loaithuoctinh_id,
        ]);
        $query->orderBy('loaithuoctinh_id asc');
        $query->andFilterWhere(['like', 'tenthuoctinh', $this->tenthuoctinh]);

        return $dataProvider;
    }
}
