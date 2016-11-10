<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Produto;

/**
 * ProdutoSearch represents the model behind the search form about `app\models\Produto`.
 */
class ProdutoSearch extends Produto
{
    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['categoria']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'categoria_id'], 'integer'],
            [['nome', 'categoria'], 'safe'],
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
        $query = Produto::find();

        // add conditions that should always apply here

        $query->joinWith(['categoria']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->sort->attributes['categoria'] = [
            'asc' => ['categoria.nome' => SORT_ASC],
            'desc' => ['categoria.nome' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'produto.id' => $this->id,
            'produto.categoria_id' => $this->categoria_id,
        ]);

        $query->andFilterWhere(['LIKE', 'produto.nome', $this->nome]);
        $query->andFilterWhere(['LIKE', 'categoria.nome', $this->getAttribute('categoria')]);

        return $dataProvider;
    }
}
