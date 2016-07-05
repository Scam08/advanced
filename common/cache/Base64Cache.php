<?

namespace common\cache;

use yii\caching\FileCache;

class Base64Cache extends FileCache{

    public $cacheFileSuffix = '.base64';

    protected function getValue($key)
    {
        $value = base64_decode(parent::getValue($key)); // Декодируем, а потом возр. знач
        return $value;
    }

    protected function setValue($key, $value, $duration){ // $duration - время жизни
        $value = base64_encode($value); // Сначала переопределяем $value,  а потом его отдаем
        parent::setValue($key,$value,$duration);
    }

}