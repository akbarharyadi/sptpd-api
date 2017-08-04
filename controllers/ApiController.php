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
    if($dataWp == null){
      $response = [
        'status' => 'error',
        'dataWp' => null,
        'msg' => 'data wajib pajak tidak ditemukan.',
      ];
    } else {
      $response = [
        'status' => 'success',
        'dataWp' => $dataWp,
        'msg' => 'data wajib pajak ditemukan.',
      ];
    }
    return $response;
  } 
}