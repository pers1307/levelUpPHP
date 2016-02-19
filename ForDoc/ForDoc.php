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
     * Этот класс говорит "Hi Documentator!)"
     */
    function hiDoc()
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
     * tuu!!!
     */
    private function tuu()
    {
        $ret = '';

        if ($ret === '') {
            echo 'WOW!';
        }
    }
}

/**
 * @todo: Тут todo'шка стоит!!!
 */