<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AdLink;

class AdLinkSearch extends AdLink
{
    public function rules()
    {
        return [
            [['link', 'channel'], 'string'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
}