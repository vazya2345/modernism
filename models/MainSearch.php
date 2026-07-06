<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Main;

/**
 * MainSearch represents the model behind the search form of `app\models\Main`.
 */
class MainSearch extends Main
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'title_ru', 'title_en', 'photo_url', 'desc', 'desc_ru', 'desc_en', 'address', 'address_ru', 'address_en', 'geolocation', 'video_presentation_url', 'threed_model_url', 'build_period'], 'safe'],
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
        $query = Main::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_ru', $this->title_ru])
            ->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'photo_url', $this->photo_url])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'desc_ru', $this->desc_ru])
            ->andFilterWhere(['like', 'desc_en', $this->desc_en])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'address_ru', $this->address_ru])
            ->andFilterWhere(['like', 'address_en', $this->address_en])
            ->andFilterWhere(['like', 'geolocation', $this->geolocation])
            ->andFilterWhere(['like', 'video_presentation_url', $this->video_presentation_url])
            ->andFilterWhere(['like', 'threed_model_url', $this->threed_model_url])
            ->andFilterWhere(['like', 'build_period', $this->build_period]);

        return $dataProvider;
    }
}
