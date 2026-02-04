<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Landingpageoptions;

/**
 * LandingpageoptionsSearch represents the model behind the search form about `\common\models\Landingpageoptions`.
 */
class LandingpageoptionsSearch extends Landingpageoptions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'landing_id'], 'integer'],
            [['type', 'value', 'target'], 'safe'],
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
        $query = Landingpageoptions::find();

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

        ]);
        if(isset($_GET['landing'])) {
            $query->andFilterWhere([
                'landing_id' => $_GET['landing'],
            ]);
        }else{
            $query->andFilterWhere([
                'landing_id' => -1,
            ]);
        }
        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'target', $this->target]);

        return $dataProvider;
    }
}
