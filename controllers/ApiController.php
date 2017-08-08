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
    $Ayat = \app\models\TAyat::find()->select('tahun')->distinct(true)->orderBy(['tahun' => SORT_DESC])->all();
    $yarray = [];
    foreach ($Ayat as $key):
      $yarray = $key->tahun;
    endforeach;
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
        'dataYear' => $yarray,
        'msg' => 'Tahun pajak ditemukan.',
      ];
    }
    return $response;
  }
}