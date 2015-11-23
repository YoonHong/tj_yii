<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property integer $id
 * @property string $full_name
 * @property string $school
 * @property string $etc
 *
 * @property User $id0
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name'], 'required'],
            [['full_name', 'school'], 'string', 'max' => 100],
            [['etc'], 'string', 'max' => 2000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'school' => 'School',
            'etc' => 'Etc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }
}
