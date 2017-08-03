<?php
namespace app\controllers;

use Yii;
 
class ApiController extends \yii\rest\Controller
{
  public function behaviors()
  {
    $behaviors = parent::behaviors();
    $behaviors['verbs'] = [
      'class' => \yii\filters\VerbFilter::className(),
      'actions' => [
        'userData'  => ['get'],
      ],
    ];
    $behaviors['authenticator'] = [
      'class' => \yii\filters\auth\HttpBearerAuth::className(),
    ];
    return $behaviors;
  }

  public function actionUserData()
  {
    Yii::$app->response->format = Response::FORMAT_JSON;
    $response = [];
    $dataWp = \app\models\TDaftar::find()->where(['npwpd' => Yii::$app->user->identity->username])->one();
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