<?php

namespace frontend\models\hrvc\master;

use Yii;

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
class TblCurrencyMaster extends \common\models\ModelMaster
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currencyId', 'currencyName', 'currencyCode', 'currencySymbol', 'countryId'], 'required'],
            [['create_datetime'], 'safe'],
            [['countryId', 'default_status'], 'integer'],
            [['currencyId'], 'string', 'max' => 10],
            [['currencyName'], 'string', 'max' => 100],
            [['currencyCode', 'currencySymbol'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'currencyId' => 'Currency ID',
            'create_datetime' => 'Create Datetime',
            'currencyName' => 'Currency Name',
            'currencyCode' => 'Currency Code',
            'currencySymbol' => 'Currency Symbol',
            'countryId' => 'Country ID',
            'default_status' => 'Default Status',
        ];
    }
}
