<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.09.2020
 * Time: 9:19
 */

namespace App\Helper;


class RandHelper
{

    /** Generate random string
     *
     * @param int $strength
     * @return string
     */

    public static function generateRandomString($strength = 12){
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($permitted_chars);
        $random_string = '';

        for($i = 0; $i < $strength; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    /** Return random image from directory
     *
     * @param string $directory
     * @return string
     */
    public static function getRandomPicture($directory = "imgs"){

        $imgsArray = [] ;

        if (is_dir($directory)){  // Проверяем действительно ли переменная содержит путь к папке
            if($openDirectory = opendir($directory)){ // Открываем папку
                while(($file = readdir($openDirectory)) !== false){ // Проверяем все файлы что находятся в папке
                    if(strtolower(strstr($file, "."))===".jpg" || strtolower(strstr($file, "."))===".gif" || strtolower(strstr($file, "."))===".png"){ // Выделяем с всех файлов только изображения. Как правило это файлы с расширением: .jpg, .gif, .png
                        array_push($imgsArray, $file); // Если файл действительно имеет расширение изображения добавляем его в массив
                    }
                }
                closedir($openDirectory); // Закрываем папку
            }
        }

        $randomImg = $imgsArray[rand(0, count($imgsArray)-1)];

        return $directory.'/'.$randomImg;
    }
}
