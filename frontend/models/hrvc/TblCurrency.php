<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\TblCurrencyMaster;

/**
* This is the model class for table "tbl_currency".
*
* @property string $currencyId
* @property string $create_datetime
* @property string $currencyName
* @property string $currencyCode
* @property string $currencySymbol
* @property integer $countryId
* @property integer $default_status
*/

class TblCurrency extends \frontend\models\hrvc\master\TblCurrencyMaster{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }
}
