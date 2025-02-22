<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class CalculadoraController extends Controller
{
    public function actionIndex()
    {
        $resultado = 0; // Valor inicial para JavaScript
        return $this->render('index', ['resultado' => $resultado]);
    }
}