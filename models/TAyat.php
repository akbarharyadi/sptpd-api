<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pad.t_ayat".
 *
 * @property int $id_ayt
 * @property string $kd_ayt
 * @property string $jn_ayt
 * @property string $kl_ayt
 * @property string $nm_ayt
 * @property double $tarifpr
 * @property double $tarifrp
 * @property string $ket_ayt
 * @property string $tanggal_ayt
 * @property int $tahun
 * @property int $th
 * @property int $bl
 * @property double $id1
 * @property double $id2
 * @property int $id_ayt_lama
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 */
class TAyat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pad.t_ayat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarifpr', 'tarifrp', 'id1', 'id2'], 'number'],
            [['tanggal_ayt', 'createdtime', 'updatedtime'], 'safe'],
            [['tahun', 'th', 'bl', 'id_ayt_lama', 'createdby', 'updatedby'], 'default', 'value' => null],
            [['tahun', 'th', 'bl', 'id_ayt_lama', 'createdby', 'updatedby'], 'integer'],
            [['kd_ayt'], 'string', 'max' => 10],
            [['jn_ayt', 'kl_ayt'], 'string', 'max' => 4],
            [['nm_ayt'], 'string', 'max' => 100],
            [['ket_ayt'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ayt' => 'Id Ayt',
            'kd_ayt' => 'Kd Ayt',
            'jn_ayt' => 'Jn Ayt',
            'kl_ayt' => 'Kl Ayt',
            'nm_ayt' => 'Nm Ayt',
            'tarifpr' => 'Tarifpr',
            'tarifrp' => 'Tarifrp',
            'ket_ayt' => 'Ket Ayt',
            'tanggal_ayt' => 'Tanggal Ayt',
            'tahun' => 'Tahun',
            'th' => 'Th',
            'bl' => 'Bl',
            'id1' => 'Id1',
            'id2' => 'Id2',
            'id_ayt_lama' => 'Id Ayt Lama',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }
}
