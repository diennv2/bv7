<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Poll;

/**
 * PollSearch represents the model behind the search form about `\common\models\Poll`.
 */
class PollSearch extends Poll
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pollid', 'poll_date', 'poll_timeout', 'last_vote_date'], 'number'],
            [['question', 'options', 'votes'], 'safe'],
            [['close', 'number_options', 'voters', 'public'], 'integer'],
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
        $query = Poll::find();

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
            'pollid' => $this->pollid,
            'poll_date' => $this->poll_date,
            'close' => $this->close,
            'number_options' => $this->number_options,
            'poll_timeout' => $this->poll_timeout,
            'voters' => $this->voters,
            'public' => $this->public,
            'last_vote_date' => $this->last_vote_date,
        ]);

        $query->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'options', $this->options])
            ->andFilterWhere(['like', 'votes', $this->votes]);

        return $dataProvider;
    }
}
