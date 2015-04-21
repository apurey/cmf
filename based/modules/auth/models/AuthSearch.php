<?php

namespace app\modules\auth\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\auth\models\Auth;

/**
 * AuthSearch represents the model behind the search form about `app\modules\auth\models\Auth`.
 */
class AuthSearch extends Auth
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'blocked'], 'integer'],
            [['login', 'email'], 'safe'],
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
        $query = Auth::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(
            [
                'id' => $this->id,
                'blocked' => $this->blocked,
            ]
        );

        $query
            ->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
