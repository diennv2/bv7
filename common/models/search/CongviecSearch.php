<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Congviec;
use yii\helpers\Json;

/**
 * CongviecSearch represents the model behind the search form about `\common\models\Congviec`.
 */
class CongviecSearch extends Congviec
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','donvi','hot','douutien'], 'integer'],
            [['ten', 'mota', 'yeucauchung', 'chinhsachphucloi', 'lienhe', 'vitriungtuyen', 'capbac', 'thoigianlamviec','nganhnghe', 'mucluong', 'noilamviec', 'tuvanvien'], 'safe'],
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
        $query = Congviec::find();

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
            'donvi' => $this->donvi,
        ]);

        $query->andFilterWhere(['like', 'ten', $this->ten])
            ->andFilterWhere(['like', 'mota', $this->mota])
            ->andFilterWhere(['like', 'yeucauchung', $this->yeucauchung])
            ->andFilterWhere(['like', 'chinhsachphucloi', $this->chinhsachphucloi])
            ->andFilterWhere(['like', 'lienhe', $this->lienhe])
            ->andFilterWhere(['like', 'vitriungtuyen', $this->vitriungtuyen])
            ->andFilterWhere(['like', 'capbac', $this->capbac])
            ->andFilterWhere(['like', 'thoigianlamviec', $this->thoigianlamviec])
            ->andFilterWhere(['like', 'mucluong', $this->mucluong])
            ->andFilterWhere(['like', 'hot', $this->hot])
            ->andFilterWhere(['like', 'douutien', $this->douutien])
            ->andFilterWhere(['like', 'tuvanvien', $this->tuvanvien]);
        $arrayFilterNganhnghe = ['or'];
        $arrayFilterDiadiem = ['or'];

        if(is_array($this->nganhnghe )){
            foreach ($this->nganhnghe as $index=> $value){
                $arrayFilterNganhnghe[]=['like','nganhnghe',$value];
            }
            $query->andFilterWhere($arrayFilterNganhnghe);
        }
        if(is_array($this->noilamviec )) {
            foreach ($this->noilamviec as $index => $value) {
                $arrayFilterDiadiem[] = ['like', 'noilamviec', $value];
            }
            $query->andFilterWhere($arrayFilterDiadiem);
        }

        return $dataProvider;
    }
}
