<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Thuoctinhproduct;

/**
 * ThuoctinhproductSearch represents the model behind the search form about `\common\models\Thuoctinhproduct`.
 */
class ThuoctinhproductSearch extends Thuoctinhproduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'gia', 'giagoc'], 'integer'],
            [['thuoctinh_id'], 'safe'],
            [['conhang'], 'boolean'],
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
        $query = Thuoctinhproduct::find();

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
            'gia' => $this->gia,
            'conhang' => $this->conhang,
            'giagoc' => $this->giagoc,
        ]);

        $query->andFilterWhere(['like', 'thuoctinh_id', $this->thuoctinh_id]);

        return $dataProvider;
    }
}
