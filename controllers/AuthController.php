<?php
namespace app\controllers;

use Yii;
 
class AuthController extends \yii\rest\Controller
{
    protected function verbs()
    {
        return [
            'login' => ['POST'],
        ];
    }
    public function actionLogin()
    {
        // return $_POST;die;
        // Tangkap data login dari client (username & password)
        $username = !empty($_POST['username'])?$_POST['username']:'';
        $password = !empty($_POST['password'])?$_POST['password']:'';
        $response = [];
        // validasi jika kosong
        // return $_POST;
        if (empty($username) || empty($password)) {
            $response = [
                'status' => 'error',
                'message' => 'username & password tidak boleh kosong!',
                'data' => '',
            ];
        } else {
            // cari di database, ada nggak username dimaksud
            $user = \app\models\User::findByUsername($username);
            // jika username ada maka
            if (!empty($user)) {
              // check, valid nggak passwordnya, jika valid maka bikin response success
                if ($user->validatePassword($password)) {
                    $response = [
                    'status' => 'success',
                    'message' => 'login berhasil!',
                    'token' => $user->auth_key,
                    ];
                } // Jika password salah maka bikin response seperti ini
                else {
                    $response = [
                    'status' => 'error',
                    'message' => 'password salah!',
                    'data' => '',
                    ];
                }
            } // Jika username tidak ditemukan bikin response kek gini
            else {
                $response = [
                'status' => 'error',
                'message' => 'username tidak ditemukan!',
                'data' => '',
                ];
            }
        }
 
        return $response;
    }
}
