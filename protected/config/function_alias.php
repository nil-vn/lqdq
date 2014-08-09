<?php

require_once(dirname(__FILE__) . "/../extensions/pidebug/debug_methods.php");
/**
 * THANHVANVO::Ham ma hoa chong ky tu dac biet trong textField
 */
define('SALT', 'whateveryouwant');

function encrypt($text)
{
    return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, SALT, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
}

function decrypt($text)
{
    return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, SALT, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
}

function hashCrypte($id)
{
    $clepriv = 9270456321012741087;
    $cle_client = '7c6af11ed8d8fa7b9ae94d05b125a0fe35fff5c9';
    $ascii = 657;
    for ($i = 1; $i <= strlen($cle_client); $i++)
    {
        $ascii+=ord(substr($cle_client, $i, 1));
    }
    $tmp = $clepriv * ($ascii * strlen($cle_client));
    return round(($id * $tmp / 65198124489521632982) + 5746);
}

function hashDecrypte($id)
{
    $clepriv = 9270456321012741087;
    $cle_client = '7c6af11ed8d8fa7b9ae94d05b125a0fe35fff5c9';
    $ascii = 657;
    for ($i = 1; $i <= strlen($cle_client); $i++)
    {
        $ascii+=ord(substr($cle_client, $i, 1));
    }
    $tmp = $clepriv * ($ascii * strlen($cle_client));
    return round(($id - 5746) * 65198124489521632982 / $tmp);
}

/**
 * 
 */
/*check HTML*/
function isHtml($string)
{
    preg_match("/<\/?\w+((\s+\w+(\s*=\s*(?:\".*?\"|'.*?'|[^'\">\s]+))?)+\s*|\s*)\/?>/", $string, $matches);
    if (count($matches) == 0)
    {
        return FALSE;
    } else
    {
        return TRUE;
    }
}

function validate_variable($val, $type)
{
    if (!empty($val))
    {
        if ($type == 'string')
        {
            $string = filter_var($val, FILTER_SANITIZE_STRING);
            if ($string != '')
                return true;
        }
        if ($type == 'number')
        {
            if (is_numeric($val) && filter_var($val, FILTER_VALIDATE_INT, array('min_range' => 1)))
                return true;
        }
        if ($type == 'email')
        {
            $email = filter_var($val, FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL))
                return true;
        }
        if ($type == 'phone')
        {
            $phoneReg = '/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s.]{0,1}[0-9]{3}[-\s.]{0,1}[0-9]{4}$/';
            if (preg_match($phoneReg, $val))
            {
                return true;
            }
        }
    } else
    {
        return false;
    }
}

/**/

function get_date()
{
    $arr = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $arr1 = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai ', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    $today = getdate();
    $ngay = $arr[$today['wday']] . ', ' . $today['mday'] . ' ' . $arr1[$today['mon']] . ' ' . $today['year'] . ', ' . date('H:i:s', time());
    return $ngay;
}

function get_date_tin($time)
{
//$arr=array('Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy');
    $today = getdate($time);
    $ngay = date('d/m/Y', $time);

    return $ngay;
}

/**
 * this method's using to get Forcage color
 */
function getForcageColor($passerelles, $property_id)
{
    $res = array();
    foreach ($passerelles as $label => $passerelle)
    {
        $result = Yii::app()->db->createCommand()->select('*')
                        ->from('wp_export_forcage')
                        ->where('passerelle = "' . $passerelle . '" AND post_property_id = ' . $property_id)->queryRow();
        $res[$label]['FORCAGE'] = $result === false ? 2 : $result['forcage'];
        if ($res[$label]['FORCAGE'] == 1)
            $res[$label]['COLOR'] = "green";
        elseif ($res[$label]['FORCAGE'] == 0)
            $res[$label]['COLOR'] = "red";
        else
            $res[$label]['COLOR'] = "black";
    }

    return $res;
}

function getUserMeta($objMeta, $meta)
{
    if (empty($objMeta) || !isset($objMeta->$meta))
    {
        if ($meta == 'last_login_time')
        {
            return '0000-00-00 00:00:00';
        }
        return '';
    } else
    {
        return $objMeta->$meta;
    }
}

/**
 * this method is used to get current user
 */
function currentUser()
{

    if (isset(JLUser::$currentUser))
    {
        return JLUser::$currentUser;
    } else if (isset(Yii::app()->user->model))
    {
        $hexID = Yii::app()->user->model->hexID;
        $cookieName = "userInfoCache-{$hexID}";
        $cookies = Yii::app()->request->cookies;
        if (isset($cookies[$cookieName]))
        {
            $since = time() - $cookies[$cookieName]->value;
            if ($since > Yii::app()->params['cacheResetTime'])
            {
                $binUserID = IDHelper::uuidToBinary($hexID);
                $user = new JLUser();
                $user = $user->loadFromCache($binUserID);
                // is current user && not synch
                if (!empty($user))
                    $user->updateState(true, false);
            }
        }
        JLUser::$currentUser = Yii::app()->user->model;
        JLUser::$loadedUsers[$hexID] = JLUser::$currentUser;

        return JLUser::$currentUser;
    } else
    {
        $user = new JLUser();
        $user->id = -1;
        $user->username = "Guest";

        JLUser::$currentUser = $user;
        return JLUser::$currentUser;
    }
}

function jlOut($obj, $dataType = 'json', $exit = true)
{
    // dataType: json, text
    error_reporting(0);
    $category = "Slidelane";
    if (!empty(Yii::app()->name))
    {
        $category = Yii::app()->name;
    }

    if (!empty($obj['message']))
    {
        $obj['message'] = Yii::t($category, $obj['message']);
    }
    if (!empty($obj['msg']))
    {
        $obj['msg'] = Yii::t($category, $obj['msg']);
    }

    $obj = @CJSON::encode($obj);
    $gzContent = gzencode($obj, 5);

    header('Connection: close');

    switch ($dataType)
    {
        case 'json':
            header("Content-type: application/json");
            break;
        case 'text':
            //header("Content-type: application/json");
            break;
    }

    if ($gzContent)
    {
        header('Content-Encoding: gzip');
        header('Vary: Accept-Encoding');
        header("Content-Length: " . strlen($gzContent));
        echo $gzContent;
        @ob_end_flush();
    } else
    {
        if (stripos($_SERVER['HTTP_ACCEPT_ENCODING'], "gzip") !== false)
        {
            header('Content-Encoding: gzip');
            header('Vary: Accept-Encoding');
            ob_start("ob_gzhandler");
        } else
        {
            ob_start();
        }

        echo $obj;
        $size = ob_get_length();
        //ob_end_flush();

        header("Content-Length: {$size}");

        @ob_end_flush();
        @ob_flush();
    }

    @flush();

    if ($exit)
    {
        if (YII_DEBUG)
            exit();
        else
            Yii::app()->end();
    } else
    {
        $session_id = session_id();
        if (session_id())
            session_write_close();
        return $session_id;
    }
}

/**
 * This method is used to output a json string and terminate current process
 */
function jsonOut($obj, $exit = true)
{
    jlOut($obj, 'json', $exit);
}

function ajaxOut($out)
{
    if (!preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT']))
    {
        jsonOut($out);
    } else
    {
        jlOut($out, 'text');
    }
}

function dump($obj, $isExit = true)
{
    CVarDumper::dump($obj, 10, true);
    if ($isExit)
        exit();
}

/**
 * This is the shortcut to Yii::app()->createUrl()
 */
function url($route, $params = array(), $ampersand = '&')
{
    return Yii::app()->createUrl($route, $params, $ampersand);
}

function encrypt_decrypt($action, $string)
{
    $output = false;

    $key = 'My strong random secret key';

    // initialization vector 
    $iv = md5(md5($key));

    if ($action == 'encrypt')
    {
        $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt')
    {
        $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
        $output = rtrim($output, "");
    }
    return $output;
}

function _html_to_utf8($data)
{
    if ($data > 127)
    {
        $i = 5;
        while (($i--) > 0) {
            if ($data != ($a = $data % ($p = pow(64, $i))))
            {
                $ret = chr(base_convert(str_pad(str_repeat(1, $i + 1), 8, "0"), 2, 10) + (($data - $a) / $p));
                for ($i; $i > 0; $i--)
                    $ret .= chr(128 + ((($data % pow(64, $i)) - ($data % ($p = pow(64, $i - 1)))) / $p));
                break;
            }
        }
    } else
        $ret = "&#$data;";
    return $ret;
}

/**
 * This is the shortcut to CHtml::encode
 */
function h($text)
{
    return htmlspecialchars($text, ENT_QUOTES, Yii::app()->charset);
}

/**
 * This is the shortcut to CHtml::link()
 */
function l($text, $url = '#', $htmlOptions = array())
{
    return CHtml::link($text, $url, $htmlOptions);
}

function idStr($id = NULL)
{
    return IDHelper::uuidFromBinary($id, true);
}

function idBin($id = NULL)
{
    return IDHelper::uuidToBinary($id, true);
}

function urlProfile($username = NULL)
{
    return Yii::app()->createUrl('/' . $username);
}

function getConfig($key = null)
{
    $config = Settings::model()->findByAttributes(array('key' => $key));
    if (!empty($config))
    {
        if (unserialize($config->value) == 0)
            return true;
        else
            return false;
    } else
        return false;
}

function N2L($number)
{
    $result = array();
    $tens = floor($number / 10);
    $units = $number % 10;

    $words = array
        (
        'units' => array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eightteen', 'Nineteen'),
        'tens' => array('', '', 'Twenty', 'Thirty', 'Fourty', 'Fifty', 'Sixty', 'Seventy', 'Eigthy', 'Ninety')
    );

    if ($tens < 2)
    {
        $result[] = $words['units'][$tens * 10 + $units];
    } else
    {
        $result[] = $words['tens'][$tens];

        if ($units > 0)
        {
            $result[count($result) - 1] .= '-' . $words['units'][$units];
        }
    }

    if (empty($result[0]))
    {
        $result[0] = 'Zero';
    }

    return trim(implode(' ', $result));
}

/**
 * Phương thức dùng để bỏ dấu tiếng việt
 * */
function alias($str)
{
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd' => 'đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i' => 'í|ì|ỉ|ĩ|ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D' => 'Đ',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );

    foreach ($unicode as $nonUnicode => $uni)
    {
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    $str = strtolower(trim($str));
    return str_replace(' ', '-', $str);
}

/**
 * Phương thức dùng để cắt chuổi
 * */
function word_limiter($str, $limit = 100, $end_char = '&#8230;')
{
    if (trim($str) == '')
    {
        return $str;
    }

    preg_match('/^\s*+(?:\S++\s*+){1,' . (int) $limit . '}/', $str, $matches);

    if (strlen($str) == strlen($matches[0]))
    {
        $end_char = '';
    }

    return rtrim($matches[0]) . $end_char;
}

/**
 * Phương thức dùng để tạp chuổi randum
 */
function random_string($type = 'alnum', $len = 8)
{
    switch ($type)
    {
        case 'basic' : return mt_rand();
            break;
        case 'alnum' :
        case 'numeric' :
        case 'nozero' :
        case 'alpha' :

            switch ($type)
            {
                case 'alpha' : $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    break;
                case 'alnum' : $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    break;
                case 'numeric' : $pool = '0123456789';
                    break;
                case 'nozero' : $pool = '123456789';
                    break;
            }

            $str = '';
            for ($i = 0; $i < $len; $i++)
            {
                $str .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
            }
            return $str;
            break;
        case 'unique' :
        case 'md5' :

            return md5(uniqid(mt_rand()));
            break;
        case 'encrypt' :
        case 'sha1' :

            $CI = & get_instance();
            $CI->load->helper('security');

            return do_hash(uniqid(mt_rand(), TRUE), 'sha1');
            break;
    }
}

function quote_escape($str)
{
    return "'" . $str . "'";
}

function dateDiffMinute($time)
{
    $begin = new DateTime($time);
    $end = new DateTime(date('Y/m/d H:i:s'));
    $interval = new DateInterval('PT1M');
    $periods = new DatePeriod($begin, $interval, $end, DatePeriod::EXCLUDE_START_DATE);
    return count(iterator_to_array($periods));
}

function dateDiff($start, $end)
{
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    $date = round($diff / 86400);
    if ($date < 1 || $date == -0)
    {
        $date = 0;
    }
    return $date;
}

/* End file function_alias.php */
/* Location: aplication.protected.config.function_alias.php */