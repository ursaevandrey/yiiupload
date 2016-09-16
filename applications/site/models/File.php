<?php

namespace site\models;

use \yii\base\Model;
use \yii\web\UploadedFile;

/**
 * Class FileUload
 */
class File extends Model{

    const UPLOAD_DIR = '/upload/';

    /** @var UploadedFile[] */
    public $files = [];
    public $file_prefix;

    /**
     * @return array
     */
    public function rules(){
        return [
            [['file_prefix'], 'required'],
            [['file_prefix'], 'string', 'max' => 10],

            [['files'], 'file', 'mimeTypes' => ['image/png', 'image/jpeg'], 'maxFiles' => 5, 'skipOnEmpty' => false],
        ];
    }

    public function upload(){
        foreach($this->files as $file){
            if($file instanceof UploadedFile){
                $file_path = self::UPLOAD_DIR . $this->file_prefix . '_' . $this->_getRandomName() . '.' . $file->getExtension();
                $save = $file->saveAs(\Yii::getAlias('@site') . "/www/$file_path");
            }
        }

        $this->files = [];
    }

    /**
     * @param int $length
     * @return string
     */
    private function _getRandomName($length = 10){
        $chars = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
        $name = '';

        for($i = 0; $i < $length; $i++) {
            $name .= $chars[mt_rand(0, count($chars) - 1)];
        }

        return $name;
    }

    public function attributeLabels(){
        return [
            'files' => 'Files',
            'file_prefix' => 'File prefix',
        ];
    }

}