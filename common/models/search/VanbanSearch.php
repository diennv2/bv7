<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Vanban;

/**
 * VanbanSearch represents the model behind the search form about `\common\models\Vanban`.
 */
class VanbanSearch extends Vanban
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active', 'home', 'danhmuc'], 'integer'],
            [['mavanban', 'ngayvanban', 'trichyeu', 'filedinhkem'], 'safe'],
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
        $query = Vanban::find();

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
            'ngayvanban' => $this->ngayvanban,
            'active' => $this->active,
            'home' => $this->home,
            'danhmuc' => $this->danhmuc,
        ]);

        $query->andFilterWhere(['like', 'mavanban', $this->mavanban])
            ->andFilterWhere(['like', 'trichyeu', $this->trichyeu])
            ->andFilterWhere(['like', 'filedinhkem', $this->filedinhkem]);

        return $dataProvider;
    }
}
