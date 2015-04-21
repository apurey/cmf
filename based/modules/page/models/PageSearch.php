<?php

namespace app\modules\page\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\page\models\Page;
use app\modules\language\models\Language;

/**
 * PageSearch represents the model behind the search form about `app\modules\page\models\Page`.
 */
class PageSearch extends Page
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'title', 'layout', 'template', 'active'], 'safe'],
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
        $query = Page::find()->where(['language' => Language::getCurrent()]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(
            [
                'id' => $this->id,
            ]
        );

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'layout', $this->layout])
            ->andFilterWhere(['like', 'template', $this->template])
            ->andFilterWhere(['like', 'active', $this->active]);

        return $dataProvider;
    }
}
