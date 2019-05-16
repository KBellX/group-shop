<?php

namespace app\libs\crypto;

use think\facade\Config;

class Hash
{
    public static function generatePassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    /**
     * 生产token
     * @param string    $type   需生成的token类型
     */
    public static function generateToken($type = 'token')
    {
        // 获取固定盐
        $salt = Config::get('security' . $type . '_salt');
        // 获取32位随机字符串
        $randChars = static::getRandChar(32);
        // 获取当前时间戳
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        return md5($salt . $randChars . $timestamp);
    }
    /**
     * 生成指定长度随机值
     * @param int   $length     指定长度
     */
    public static function getRandChar($length)
    {
        // 基于rand生产随机值
        $str = null;
        $strPol = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $max = strlen($strPol) - 1;
        for ($i = 0; $i < $length; $i++) {
            $str .= $strPol[mt_rand(0, $max)];
        }
        return $str;
    }
}
