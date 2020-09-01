<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $birth_year;
    public $birth_month;
    public $birth_day;

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['username', 'password_hash', 'firstname', 'lastname'], 'required'],
            [['username', 'email'], 'unique'],
            [['username', 'email'], 'email'],
            [['r_id', 'is_subscribed', 'flow_id', 'site_id'], 'integer'],
            [['birth_date'], 'date'],
            [['firstname', 'lastname', 'channel', 'tag', 'sign'], 'string'],
            [['auth_key', 'verification_token', 'gender', 'country', 'marital'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('app', 'username'),
            'password_hash' => Yii::t('app', 'password'),
            'firstname' => Yii::t('app', 'firstname'),
            'lastname' => Yii::t('app', 'lastname'),
            'status' => Yii::t('app', 'status'),
            'head_pic' => Yii::t('app', 'head_pic'),
            'email' => Yii::t('app', 'email'),
            'r_id' => Yii::t('app', 'user_rank'),
            'is_subscribed' => Yii::t('app', 'is_subscribed'),
            'created_at' => Yii::t('app', 'created_at'),
            'created_ip' => Yii::t('app', 'created_ip'),
            'created_address' => Yii::t('app', 'created_address'),
            'last_login_ip' => Yii::t('app', 'last_login_ip'),
            'last_login_address' => Yii::t('app', 'last_login_address'),
            'last_login_date' => Yii::t('app', 'last_login_date'),
            'channel' => Yii::t('app', 'channel'),
            'tag' => Yii::t('app', 'tag'),
            'sign' => Yii::t('app', 'flag'),
        ];
    }

    public function afterFind()
    {
        if ($this->birth_date){
            $birth = explode('-', $this->birth_date);
            $this->birth_year = $birth[0]??null;
            $this->birth_month = $birth[1]??null;
            $this->birth_day = $birth[2]??null;
        }
        parent::afterFind();
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
