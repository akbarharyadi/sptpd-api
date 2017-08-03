<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pad.t_daftar".
 *
 * @property string $no_pokok
 * @property string $npwpd
 * @property string $nm_wp
 * @property string $alm_wp
 * @property string $nm_pemilik
 * @property string $alm_pemilik
 * @property string $kel_pemilik
 * @property string $kec_pemilik
 * @property string $kota_pemilik
 * @property string $tgl_daftar
 * @property string $no_daftar
 * @property string $kd_usaha
 * @property string $tgl_kirim
 * @property string $tgl_kembali
 * @property string $st
 * @property string $telp1
 * @property string $telp2
 * @property string $kel_wp
 * @property string $kec_wp
 * @property int $active_inactive
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 */
class TDaftar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pad.t_daftar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_pokok', 'npwpd'], 'required'],
            [['tgl_daftar', 'tgl_kirim', 'tgl_kembali', 'createdtime', 'updatedtime'], 'safe'],
            [['active_inactive', 'createdby', 'updatedby'], 'default', 'value' => null],
            [['active_inactive', 'createdby', 'updatedby'], 'integer'],
            [['no_pokok'], 'string', 'max' => 8],
            [['npwpd'], 'string', 'max' => 14],
            [['nm_wp', 'alm_wp', 'nm_pemilik', 'alm_pemilik'], 'string', 'max' => 255],
            [['kel_pemilik', 'kec_pemilik', 'kota_pemilik'], 'string', 'max' => 30],
            [['no_daftar'], 'string', 'max' => 20],
            [['kd_usaha', 'kec_wp'], 'string', 'max' => 2],
            [['st'], 'string', 'max' => 1],
            [['telp1', 'telp2'], 'string', 'max' => 15],
            [['kel_wp'], 'string', 'max' => 3],
            [['npwpd'], 'unique'],
            [['npwpd'], 'exist', 'skipOnError' => true, 'targetClass' => TDaftar::className(), 'targetAttribute' => ['npwpd' => 'npwpd']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'no_pokok' => 'No Pokok',
            'npwpd' => 'Npwpd',
            'nm_wp' => 'Nm Wp',
            'alm_wp' => 'Alm Wp',
            'nm_pemilik' => 'Nm Pemilik',
            'alm_pemilik' => 'Alm Pemilik',
            'kel_pemilik' => 'Kel Pemilik',
            'kec_pemilik' => 'Kec Pemilik',
            'kota_pemilik' => 'Kota Pemilik',
            'tgl_daftar' => 'Tgl Daftar',
            'no_daftar' => 'No Daftar',
            'kd_usaha' => 'Kd Usaha',
            'tgl_kirim' => 'Tgl Kirim',
            'tgl_kembali' => 'Tgl Kembali',
            'st' => 'St',
            'telp1' => 'Telp1',
            'telp2' => 'Telp2',
            'kel_wp' => 'Kel Wp',
            'kec_wp' => 'Kec Wp',
            'active_inactive' => 'Active Inactive',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }
}
