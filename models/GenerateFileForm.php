<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class GenerateFileForm extends Model
{
    /**
     * @var UploadedFile $originalFile
     */
    public $originalFile;

    /**
     * @var UploadedFile $watermark
     */
    public $watermark;

    public $width;
    public $height;

    public function rules(): array
    {
        return [
            [['originalFile'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
            [['watermark'], 'file', 'extensions' => 'png, jpg, jpeg'],
            [['width', 'height'], 'integer'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->originalFile->saveAs('uploads/' . $this->originalFile->baseName . '.' . $this->originalFile->extension);
            $this->watermark->saveAs('uploads/' . $this->watermark->baseName . '.' . $this->watermark->extension);
            return true;
        } else {
            return false;
        }
    }
}