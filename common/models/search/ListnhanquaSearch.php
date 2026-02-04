<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Listnhanqua;

/**
 * ListnhanquaSearch represents the model behind the search form about `\common\models\Listnhanqua`.
 */
class ListnhanquaSearch extends Listnhanqua
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'billid', 'productid'], 'integer'],
            [['ngaynhan'], 'safe'],
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
        $query = Listnhanqua::find();

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
            'billid' => $this->billid,
            'productid' => $this->productid,
            'ngaynhan' => $this->ngaynhan,
        ]);
        $query->orderBy("isdanhanqua asc, id desc");
        return $dataProvider;
    }
}
