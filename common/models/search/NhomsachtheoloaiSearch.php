<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Nhomsachtheoloai;

/**
 * NhomsachtheoloaiSearch represents the model behind the search form about `\common\models\Nhomsachtheoloai`.
 */
class NhomsachtheoloaiSearch extends Nhomsachtheoloai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nhomid', 'sachid'], 'integer'],
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
        $query = Nhomsachtheoloai::find();

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
            'nhomid' => $_GET['id'],
            'sachid' => $this->sachid,
        ]);

        return $dataProvider;
    }
}
