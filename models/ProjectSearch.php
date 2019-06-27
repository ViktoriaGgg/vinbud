<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Project;

/**
 * ProjectSearch represents the model behind the search form of `app\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'viewed', 'status'], 'integer'],
            [['date', 'title', 'number', 'client', 'designer', 'general', 'exp', 'engineer'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Project::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
           // 'date' => $this->date,
            'viewed' => $this->viewed,
            'status' => $this->status,

        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'client', $this->client])
            ->andFilterWhere(['like', 'designer', $this->designer])
            ->andFilterWhere(['like', 'general', $this->general])
            ->andFilterWhere(['like', 'exp', $this->exp])
            ->andFilterWhere(['like', 'engineer', $this->engineer]);

        return $dataProvider;
    }
}
