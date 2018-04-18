<?php
/**
 * Created by PhpStorm.
 * User: Yudhi_G293
 * Date: 18/04/2018
 * Time: 14:21
 */

namespace app\models\form;


use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $newName;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx, csv'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function uploadAsTemp() {
        if ($this->validate()) {
            //Format the name
            $this->newName = md5(date('Y-m-d H-i-s') . rand(0, 999999));
            $this->newName = strtr($this->newName, 'Ã€ÃÃ‚ÃƒÃ„Ã…Ã‡ÃˆÃ‰ÃŠÃ‹ÃŒÃÃŽÃÃ’Ã“Ã”Ã•Ã–Ã™ÃšÃ›ÃœÃÃ Ã¡Ã¢Ã£Ã¤Ã¥Ã§Ã¨Ã©ÃªÃ«Ã¬Ã­Ã®Ã¯Ã°Ã²Ã³Ã´ÃµÃ¶Ã¹ÃºÃ»Ã¼Ã½Ã¿', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            // replace characters other than letters, numbers and . by _
            $this->newName = preg_replace('/([^.a-z0-9]+)/i', '_', $this->newName) . '.' . $this->imageFile->extension;

            $this->imageFile->saveAs('uploads/tmp/' . $this->newName);
            return true;
        } else {
            return false;
        }
    }
}