<?php

namespace app\controllers;

use yii\rest\Controller;


class TestController extends Controller
{
    public function actionIndex()
    {
        dd(\Yii::$app->request->post());
    }
}