<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/8/31 0031
 * Time: 15:55
 */

namespace easywa\wapay;


use yii\base\Exception;

class PayException extends Exception
{
    /**
     * @var array the error info provided by a PDO exception. This is the same as returned
     * by [PDO::errorInfo](https://secure.php.net/manual/en/pdo.errorinfo.php).
     */
    public $errorInfo = [];


    /**
     * Constructor.
     * @param string $message PDO error message
     * @param array $errorInfo PDO error info
     * @param int $code PDO error code
     * @param \Exception $previous The previous exception used for the exception chaining.
     */
    public function __construct($message, $errorInfo = [], $code = 0, \Exception $previous = null)
    {
        $this->errorInfo = $errorInfo;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string the user-friendly name of this exception
     */
    public function getName()
    {
        return '微信接口异常';
    }
}