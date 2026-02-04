<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Billmobile;

/**
 * BillmobileSearch represents the model behind the search form about `\common\models\Billmobile`.
 */
class BillmobileSearch extends Billmobile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'chuyendanhba', 'status'], 'integer'],
            [['ngaylap', 'gioitinh', 'ten', 'sdt','email', 'yeucaukhac', 'type', 'address', 'tinhthanh', 'quanhuyen', 'phuongxa', 'nguoinhanhang', 'nguoinhanhangsdt', 'mangdtkhac', 'xuathoadontencty', 'xuathoadondiachi', 'xuathoadonmst', 'product', 'typethanhtoan'], 'safe'],
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
        $query = Billmobile::find();

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
            'chuyendanhba' => $this->chuyendanhba,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'gioitinh', $this->gioitinh])
            ->andFilterWhere(['like', 'ten', $this->ten])
            ->andFilterWhere(['like', 'sdt', $this->sdt])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'yeucaukhac', $this->yeucaukhac])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'tinhthanh', $this->tinhthanh])
            ->andFilterWhere(['like', 'quanhuyen', $this->quanhuyen])
            ->andFilterWhere(['like', 'phuongxa', $this->phuongxa])
            ->andFilterWhere(['like', 'nguoinhanhang', $this->nguoinhanhang])
            ->andFilterWhere(['like', 'nguoinhanhangsdt', $this->nguoinhanhangsdt])
            ->andFilterWhere(['like', 'mangdtkhac', $this->mangdtkhac])
            ->andFilterWhere(['like', 'xuathoadontencty', $this->xuathoadontencty])
            ->andFilterWhere(['like', 'xuathoadondiachi', $this->xuathoadondiachi])
            ->andFilterWhere(['like', 'xuathoadonmst', $this->xuathoadonmst])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'typethanhtoan', $this->typethanhtoan]);
        $query->orderBy("id desc");
        return $dataProvider;
    }
}
