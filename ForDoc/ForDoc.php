<?php
/**
 * ForDoc.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2016 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/symfony-blog
 */

namespace pers1307\fordoc;

/**
 * Class Doc
 * Тестовый класс для документации
 */
class Doc
{
    /**
     * Этот метод говорит "Hi Documentator!)"
     */
    function hiDoc()
    {

    }

    /**
     * @param int    $res Номер строки
     * @param string $red Комментарий
     */
    public function hello($res, $red)
    {

    }
}

/**
 * Class wer
 * наследник!
 * @author      Pereskokov Yurii
 */
class wer extends Doc
{
    /**
     * Метод очень нужен!
     * @return string
     */
    private function tuu()
    {
        $ret = '';

        if ($ret === '') {
            echo 'WOW!';
        }

        return 'aaaa';
    }
}

/**
 * @todo: Тут todo'шка стоит!!!
 */