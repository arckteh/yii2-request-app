<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[Request]].
 *
 * @see Request
 */
class RequestQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Request[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Request|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
