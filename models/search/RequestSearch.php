<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\entity\Request;

/**
 * RequestSearch represents the model behind the search form of `app\models\entity\Request`.
 */
class RequestSearch extends Request
{
    public $status;
    public $created_at;
    public $id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id',], 'integer'],
            ['status', 'in', 'range' => array_keys(self::getAllowedStatuses())],
            [['name', 'email', 'message', 'comment', 'created_at', 'updated_at'], 'safe'],
            [['created_at', 'updated_at'], 'date', 'format' =>  'yyyy-M-d', 'message' => Yii::t('app', 'Please enter value in yyyy-M-d format')],
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
        $query = Request::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'comment', $this->comment]);
        if ($this->created_at) {
            $query->andFilterWhere(
                [
                    '=',
                    new \yii\db\Expression('DATE_FORMAT(created_at, "%d.%m.%Y")'),
                    date('d.m.Y', strtotime($this->created_at)),
                ]
            );
        }
        if ($this->updated_at) {
            $query->andFilterWhere(
                [
                    '=',
                    new \yii\db\Expression('DATE_FORMAT(update_at, "%d.%m.%Y")'),
                    date('d.m.Y', strtotime($this->updated_at)),
                ]
            );

        }

//echo $query->createCommand()->getRawSql(); die('test');
            return $dataProvider;
        }
    }
