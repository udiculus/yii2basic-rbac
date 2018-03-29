<?php
/**
 * Created by PhpStorm.
 * User: Yudhi_G293
 * Date: 26/03/2018
 * Time: 9:16
 */
namespace app\models;

use Yii;
use yii\base\Model;


class EntryForm extends Model
{
    public $name;
    public $email;

    public function rules() {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email']
        ];
    }
}