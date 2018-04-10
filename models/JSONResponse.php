<?php
/**
 * Created by PhpStorm.
 * User: Yudhi_G293
 * Date: 10/04/2018
 * Time: 13:46
 */

namespace app\models;


use yii\base\Model;

class JSONResponse extends Model
{
    public $errorcode = null;
    public $message = null;
    public $data = null;
    public $form_error = null;

}