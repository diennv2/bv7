<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Datcauhoi;

/**
 * DatcauhoiSearch represents the model behind the search form about `\common\models\Datcauhoi`.
 */
class DatcauhoiSearch extends Datcauhoi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['hotenhoten', 'email', 'noidung', 'filedinhkem'], 'safe'],
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
        $query = Datcauhoi::find();

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
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'hoten', $this->hoten])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'noidung', $this->noidung])
            ->andFilterWhere(['like', 'filedinhkem', $this->filedinhkem]);
        if(strtolower(Yii::$app->user->identity->username)!='superadmin'){
            if (strtolower(Yii::$app->user->identity->username)!='admin'){
                $query->andFilterWhere(['user_id'=>Yii::$app->user->identity->id]);
            }
        }
        return $dataProvider;
    }
}
