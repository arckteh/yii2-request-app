<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\entity\User]].
 *
 * @see \app\models\entity\User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\entity\User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\entity\User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
