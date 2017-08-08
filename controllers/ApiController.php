<?php
namespace app\controllers;

use Yii;
use yii\filters\auth\HttpBearerAuth;

class ApiController extends \yii\rest\Controller
{
  public function behaviors()
  {
    return array_merge(parent::behaviors(), [
      'bearerAuth' => [
        'class' => HttpBearerAuth::className()
      ]
    ]);
  }

  public function actionUserData()
  {
    // \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $response = [];
    $dataWp = \app\models\TDaftar::find()->where(['npwpd' => Yii::$app->user->identity->username])->asArray()->one();
    if ($dataWp == null) {
      $response = [
        'status' => 'error',
        'dataWp' => null,
        'msg' => 'data wajib pajak tidak ditemukan.',
      ];
    }
    else {
      $response = [
        'status' => 'success',
        'dataWp' => $dataWp,
        'msg' => 'data wajib pajak ditemukan.',
      ];
    }
    return $response;
  }

  public function actionGetYear()
  {
    $response = [];
    $npwpd = Yii::$app->user->identity->username;
    $Ayat = \app\models\TAyat::find()->select('tahun')->orderBy(['tahun' => SORT_DESC])->distinct(true)->asArray()->all();
    if (empty($Ayat)) {
      $response = [
        'status' => 'error',
        'dataYear' => null,
        'msg' => 'Tahun pajak tidak ditemukan.',
      ];
    }
    else {
      $response = [
        'status' => 'success',
        'dataYear' => (array)$Ayat,
        'msg' => 'Tahun pajak ditemukan.',
      ];
    }
    return $response;
  }

  public function actionGetTaxes()
  {
    $response = [];
    $year = $_POST['year'];
    if (empty($year)) {
      $response = [
        'status' => 'error',
        'dataTaxes' => (array)$Ayat,
        'msg' => 'Tahun tidak ada.',
      ];
    }
    else {
      $Ayat = \app\models\TAyat::find()
        ->select('kd_ayt, nm_ayt')
        ->where(['tahun' => $year, 'kl_ayt' => '00', 'jn_ayt' => '00'])
        ->andWhere("substring(kd_ayt, 1, 2) = '11'")
        ->andWhere(['not in','kd_ayt',['1113', '1114']])
        ->orderBy(['kd_ayt' => \SORT_ASC])
        ->asArray()
        ->all();
      if (empty($Ayat)) {
        $response = [
          'status' => 'error',
          'dataTaxes' => null,
          'msg' => 'Rekening pajak tidak ditemukan.',
        ];
      }
      else {
        $response = [
          'status' => 'success',
          'dataTaxes' => (array)$Ayat,
          'msg' => 'Rekening pajak ditemukan.',
        ];
      }
    }
    return $response;
  }
}