<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reviewtable as ReviewtableModel;

/**
 * Reviewtable represents the model behind the search form about `\common\models\Reviewtable`.
 */
class Reviewtable extends ReviewtableModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['review_id', 'user_rating', 'datetime'], 'integer'],
            [['user_name', 'user_review'], 'safe'],
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
        $query = ReviewtableModel::find();

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
            'review_id' => $this->review_id,
            'user_rating' => $this->user_rating,
            'datetime' => $this->datetime,
        ]);

        $query->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'user_review', $this->user_review]);

        return $dataProvider;
    }
}
