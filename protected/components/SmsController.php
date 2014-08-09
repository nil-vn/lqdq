<?php

class SmsController extends Controller
{

    public $mode;
    public $origine;
    public $date;
    public $time;
    public $user_login;
    public $user_pass;
    public $api_url;
    public $phone_number;
    public $messages;
    public $max_message_errors;
    public $max_message_length;
    public $start_send_message;
    public $end_send_message;
    public $fgc = true;
    var $return, $return_code, $return_messages, $id_messbox, $country_code, $current_time;

    public function filters()
    {
        return array(
            'rights', // perform access control for CRUD operations
        );
    }

    public function allowedActions()
    {
        return '*';
    }

//    function __construct()
//    {
//        global $wpdb;
//        $this->wpdb = $wpdb;
//        $this->table_sendSMSBox = $wpdb->prefix . "smsbox";
//        $this->init();
//    }
    function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->user_login = "immobilier"; //INTERNETSARL
        $this->user_pass = "boutiksms8"; //internet!!
        $this->mode = "expert";
        $this->origine = "immobilier";
        $this->api_url = "https://api.smsbox.fr/api.php";
        $this->max_message_errors = 5;
        $this->max_message_length = 459;
        $this->start_send_message = 8;
        $this->end_send_message = 21;
        $this->country_code = "336";
    }

    public function setUserLogin($user)
    {
        return $this->user_login = $user;
    }

    public function setUserPassword($password)
    {
        return $this->user_pass = $password;
    }

    public function setMode($mode)
    {
        $default = "expert";
        if (empty($mode))
        {
            return $this->mode;
        } else
        {
            $mode = strtolower($mode);
            switch ($mode)
            {
                case "expert":
                case "economique":
                case "multimedia":
                    $this->mode = $mode;
                    break;
                default:
                    $this->mode = $default;
            }
            return $this->mode;
        }
    }

    public function setOrigine($origine)
    {
        return $this->origine = substr($origine, 0, 11);
    }

    public function setCountryCode($country_code)
    {
        return $this->country_code = $country_code;
    }

    public function setPhoneNumber($number)
    {
        $number = str_replace(".", "", $number);
        $number = str_replace(" ", "", $number);
        $number = $this->country_code . substr($number, strlen($number) - 10, 10);
        $this->phone_number = $number;
        return $this->phone_number;
    }

    public function setMessages($messages)
    {
        return $this->messages = $messages;
    }

    public function createSocket($uri, $port = 80, $timeout = 3000)
    {
        $uri = parse_url($uri);
        $socket = fsockopen($uri['host'], $port, $errno, $errstr, $timeout);
        if ($socket)
        {
            fputs($socket, "POST {$uri['path']} HTTP/1.1\r\n");
            fputs($socket, "Host: {$uri['host']}\r\n");
            fputs($socket, "Content-Type: application/x-www-form-urlencoded\r\n");
            fputs($socket, "Content-Length: " . strlen($uri['query']) . "\r\n");
            fputs($socket, "Content-Encoding: ISO-8859-15\r\n");
            fputs($socket, "Connection: Close\r\n\r\n");
            fputs($socket, $uri['query']);
            $body = false;
            $buffer = null;
            while ($ligne = fgets($socket, 1024)) {
                if ($body)
                    $buffer .= $ligne;
                if (!$body && trim($ligne) === '')
                    $body = true;
                if (trim($ligne) == '0')
                    break;
            }
            return $buffer;
        }else
        {
            return false;
        }
    }

    public function createSendSMS($to, $messages, $from, $mode, $date = null, $time = null)
    {
        $udh = (strlen($messages) > 160) ? "&udh=1" : "";
        $from = str_replace(" ", "", $from);
        $request_url = $this->api_url . '?login=' . rawurlencode($this->user_login) . '&pass=' . rawurlencode($this->user_pass) . '&dest=' . rawurlencode($to) . '&mode=' . rawurlencode($mode) . '&origine=' . rawurlencode($from) . '&msg=' . rawurlencode($messages) . $udh . "&id=1";
        $request_url .= (!empty($date) && !empty($time)) ? '&date=' . rawurlencode($date) . '&heure=' . rawurlencode($time) : "";
        $this->fgc = (($this->fgc) && strlen($request_url) > 1024) ? false : true;
        $buffer = ($this->fgc) ? @file_get_contents($request_url) : $this->createSocket($request_url);
        return $buffer;
    }

    public function getCreditByAccount()
    {
        $request_url = $this->api_url . '?login=' . rawurlencode($this->user_login) . '&pass=' . rawurlencode($this->user_pass) . '&action=credit';
        $buffer = ($this->fgc) ? @file_get_contents($request_url) : $this->createSocket($request_url);
        return (substr($buffer, 0, 7) === 'CREDIT ') ? (float) substr($buffer, 7) : '(Erreur survenue)';
    }

    public function getHistoryMessagesById($id_smsbox)
    {
        if (strpos($id_smsbox, ",") !== false)
        {
            $getID = explode(",", $id_smsbox);
            $id_smsbox = $getID[0];
        }
        if (is_numeric($id_smsbox))
        {
            $request_url = $this->api_url . "?login=" . rawurlencode($this->user_login) . "&pass=" . rawurlencode($this->user_pass) . "&action=historique&id=" . $id_smsbox;
            $buffer = ($this->fgc) ? @file_get_contents($request_url) : $this->createSocket($request_url);
            if (!empty($buffer))
            {
                /* 	Return from page API : 20/10/2007 18:15:00;336XXXXXXXX;emetteur;0;1;0
                  Interpretation: Each column is separated by a semicolon :
                  - The date and time
                  - The phone number of the recipient
                  - The transmitter (empty if economic dispatch)
                  - The type of delivery (0 = 1 = Classic and Flash)
                  - The send method (0 = SMS waiting to be sent (delay) and 1 = SMS sent to the operator)
                  - Status "Delivery" SMS (-3 to 10) : */
                $returnList = explode(";", $buffer);
                if (count($returnList) > 0)
                {
                    $listItems = array(
                        'date' => $returnList[0],
                        'phone_number' => $returnList[1],
                        'origine' => $returnList[2],
                        'type' => $returnList[3],
                        'method' => $returnList[4]
                    );
                    $return_code_send = $returnList[count($returnList) - 1];
                    if (is_numeric($return_code_send))
                    {
                        $return_code_send = (int) $return_code_send;
                        switch ($return_code_send)
                        {
                            case 0 :
                                $listItems['status'] = '000';
                                $listItems['detail'] = 'Message reçu'; // Message received
                                break;
                            case 1 :
                                $listItems['status'] = $return_code_send;
                                $listItems['detail'] = 'Échec de la transmission'; // Transmission failure
                                break;
                            case 2 :
                                $listItems['status'] = $return_code_send;
                                $listItems['detail'] = 'Message rejeté'; // Message rejected
                                break;
                            case 3 :
                                $listItems['status'] = $return_code_send;
                                $listItems['detail'] = 'Mobile de destination inactif'; // Mobile inactive destination
                                break;
                            case 4 :
                                $listItems['status'] = $return_code_send;
                                $listItems['detail'] = 'Mobile de destination ne répond pas'; // Destination mobile does not respond
                                break;
                            case 5 :
                                $listItems['status'] = $return_code_send;
                                $listItems['detail'] = 'Erreur lors de la réception'; // Error reception
                            case 6 :
                                $listItems['status'] = $return_code_send;
                                $listItems['detail'] = 'Mobile de destination saturé'; // Destination mobile saturated
                                break;
                            case 7 :
                                $listItems['status'] = $return_code_send;
                                $listItems['detail'] = 'Numéro de destination inconnu'; // Destination number unknown
                                break;
                            case 8 :
                                $listItems['status'] = $return_code_send;
                                $listItems['detail'] = 'Message non-routable'; // Non-routable Message
                                break;
                            case 9 :
                                $listItems['status'] = '000';
                                $listItems['detail'] = 'Message transmis'; // Transmitted message
                                break;
                            case 10 :
                                $listItems['status'] = '000';
                                $listItems['detail'] = 'Message envoyé'; // Message Sent
                                break;
                            default :
                                $listItems['status'] = '007';
                                $listItems['detail'] = 'Code retour inconnu'; // Return code unknown
                                break;
                        }
                    } else
                    {
                        $listItems['status'] = '008';
                        $listItems['detail'] = 'Code retour non valide'; // Invalid return code
                    }
                } else
                {
                    $listItems['status'] = '009';
                    $listItems['detail'] = 'Donnée historique non conforme'; // Historical datadoes not comply
                }
            } else
            {
                $listItems['status'] = '009';
                $listItems['detail'] = 'Donnée historique indisponible'; // Unavailable historical data
            }
        } else
        {
            $listItems['status'] = '010';
            $listItems['detail'] = 'Id smsbox non numérique'; // Id SMSBOX nonnumeric
        }
        return $listItems;
    }

    public function checkSMS()
    {
        $sql = "SELECT id,return_detail,id_sendbox FROM wp_smsbox (return_code LIKE '-2%' OR return_code LIKE '-1%' OR return_code LIKE '3%' OR return_code LIKE '4%' OR return_code LIKE '6%') AND id_sendbox !='' ORDER BY id";
        $getSMS = Yii::app()->db->createCommand()->text($sql)->execute();
        foreach ($getSMS as $listSMS)
        {
            $history_sms = $this->getHistoryMessagesById($listSMS->id_sendbox);
            if ($history_sms['status'] == "009")
            {
//                $this->wpdb->update($this->table_sendSMSBox, array(
//                    'return_code' => $history_sms['status'],
//                    'return_detail' => $listSMS->return_detail
//                        ), array('id' => $listSMS->id, 'id_sendbox' => $listSMS->id_sendbox)
//                        , array('%s', '%s'), array('%d', '%s'));

                $query = Yii::app()->db->createCommand()->update('wp_smsbox', array(
                    'return_code' => $history_sms['status'], 'return_detail' => $listSMS->return_detail, 'id' => $listSMS->id, 'id_sendbox' => $listSMS->id_sendbox
                ));
            } else
            {
                $query = Yii::app()->db->createCommand()->update('wp_smsbox', array(
                    'return_code' => $history_sms['status'], 'return_detail' => $history_sms['detail'], 'id' => $listSMS->id, 'id_sendbox' => $listSMS->id_sendbox
                ));
//                $this->wpdb->update($this->table_sendSMSBox, array(
//                    'return_code' => $history_sms['status'],
//                    'return_detail' => $history_sms['detail']
//                        ), array('id' => $listSMS->id, 'id_sendbox' => $listSMS->id_sendbox)
//                        , array('%s', '%s'), array('%d', '%s'));
            }
        }
    }

    public function reSendingSMS($id, $sender, $receiver, $messages)
    {
        $this->return_code = "999";
        $this->return_messages = "Horaire dépassé";
        $udh = (strlen($messages) > 160) ? "&udh=1" : "";
        $sender = str_replace(" ", "", $sender);
        $this->current_time = round(gmdate("h", time() + 1 * 3600));
        if ($this->current_time >= $this->start_send_message && $this->current_time <= $this->end_send_message)
        {
            $request_url = $this->api_url . '?login=' . rawurlencode($this->user_login) . '&pass=' . rawurlencode($this->user_pass) . "&msg=" . rawurlencode($messages) . "&dest=" . rawurlencode($receiver) . '&origine=' . rawurlencode($sender) . "&mode=" . rawurlencode($this->mode) . $udh . "&id=1";
            $buffer = ($this->fgc) ? @file_get_contents($request_url) : $this->createSocket($request_url);
            if (!empty($buffer))
            {
                if (substr($buffer, 0, 2) === 'OK')
                {
                    $return = explode(" ", $buffer);
                    if (count($return) > 0)
                    {
                        $return_mes = $return[0];
                        $return_id = $return[1];
                        if (strpos($return_id, ",") !== false)
                        {
                            $getReturn = explode(",", $return_id);
                            $return_id = $getReturn[0];
                        }
                    } else
                    {
                        $return_mes = $buffer;
                    }
                } else
                {
                    $return_mes = $buffer;
                }
                if ($return_mes == "OK")
                {
                    if (strlen($return_id) > 0)
                    {
                        $history_sms = $this->getHistoryMessagesById($return_id);
                        $this->return_code = $history_sms['status'];
                        $this->return_messages = $history_sms['detail'];
                    } else
                    {
                        $this->return_code = "010";
                        $this->return_messages = "Id smsbox non renseigné";
                    }
                } else
                {
                    switch ($return_mes)
                    {
                        case "ERROR 01":
                            $this->return_code = "001";
                            $this->return_messages = "Des paramètres sont manquants";
                            break;
                        case "ERROR 02":
                            $this->return_code = "002";
                            $this->return_messages = "Identifiants incorrects ou compte banni";
                            break;
                        case "ERROR 03":
                            $this->return_code = "003";
                            $this->return_messages = "Crédit épuisé ou insuffisant";
                            break;
                        case "ERROR 04":
                            $this->return_code = "004";
                            $this->return_messages = "Numéro de destination invalide ou mal formaté";
                            break;
                        case "ERROR 05":
                            $this->return_code = "005";
                            $this->return_messages = "Erreur d'éxécution interne à notre application";
                            break;
                        default :
                            $this->return_code = "006";
                            $this->return_messages = "L'envoi a échoué pour une autre raison";
                    }
                }
            } else
            {
                $this->return_messages = "Service SMSBOX inaccessible";
            }
        }
        //$number_send = $this->wpdb->get_var("SELECT number_send FROM " . $this->table_sendSMSBox . " WHERE id=" . $id);
        $n_s = Yii::app()->db->createCommand()
                ->select('number_send')
                ->from('wp_smsbox')
                ->where('id=:id', array(':id' => $id))
                ->queryRow();
//        $this->wpdb->update($this->table_sendSMSBox, array(
//            'return_code' => $this->return_code,
//            'return_detail' => $this->return_messages,
//            'number_send' => $number_send + 1,
//            'date_resend' => date("Y-m-d H:i:s"),
//            'id_sendbox' => $return_id
//                ), array('id' => $id));
        $query1 = Yii::app()->db->createCommand()->update('wp_smsbox', array(
            'return_code' => $this->return_code,
            'return_detail' => $this->return_messages,
            'number_send' => $n_s['number_send'] + 1,
            'date_resend' => date("Y-m-d H:i:s"),
            'id_sendbox' => $return_id, 'id' => $id
        ));
    }

    public function updateSMSBox()
    {
        $this->checkSMS();
        $sql = "SELECT id,sender,receiver,content FROM wp_smsbox WHERE (return_code='999' OR return_code='003' OR return_code='005') AND number_send <" . $this->max_message_errors;
        $getReSends = Yii::app()->db->createCommand()->text($sql)->execute();
        foreach ($getReSends as $reSend)
        {
            $this->reSendingSMS($reSend->id, $reSend->sender, $reSend->receiver, $reSend->content);
        }
    }

    public function sendingSMS()
    {
        $this->return_code = "999";
        $this->return_messages = "Horaire dépassé"; // full times
        $return_id = "";
        if (empty($this->messages) || empty($this->phone_number))
        {
            return false;
        }
        if (strlen($this->messages) > $this->max_message_length)
        {
            return false;
        }
        $this->current_time = round(gmdate("h", time() + 1 * 3600));

        if ($this->current_time >= $this->start_send_message && $this->current_time <= $this->end_send_message)
        {
            $this->return = $this->createSendSMS($this->phone_number, $this->messages, $this->origine, $this->mode, $this->date, $this->time);

            if (!empty($this->return))
            {
                if (substr($this->return, 0, 2) === 'OK')
                {
                    $return = explode(" ", $this->return);
                    
                    if (count($return) > 0)
                    {
                        $return_mes = $return[0];
                        $return_id = $return[1];
                        if (strpos($return_id, ",") !== false)
                        {
                            $getReturn = explode(",", $return_id);
                            $return_id = $getReturn[0];
                        }
                    } else
                    {
                        $return_mes = $this->return;
                    }
                } else
                {
                    $return_mes = $this->return;
                }
                
                if ($return_mes == "OK")
                {
                    if (strlen($return_id) > 0)
                    {
                        $history_sms = $this->getHistoryMessagesById($return_id);
                        $this->return_code = $history_sms['status'];
                        $this->return_messages = $history_sms['detail'];
                    } else
                    {
                        $this->return_code = "010";
                        $this->return_messages = "Id smsbox non renseigné";
                    }
                } else
                {
                    switch ($return_mes)
                    {
                        case "ERROR 01":
                            $this->return_code = "001";
                            $this->return_messages = "Des paramètres sont manquants";
                            break;
                        case "ERROR 02":
                            $this->return_code = "002";
                            $this->return_messages = "Identifiants incorrects ou compte banni";
                            break;
                        case "ERROR 03":
                            $this->return_code = "003";
                            $this->return_messages = "Crédit épuisé ou insuffisant";
                            break;
                        case "ERROR 04":
                            $this->return_code = "004";
                            $this->return_messages = "Numéro de destination invalide ou mal formaté";
                            break;
                        case "ERROR 05":
                            $this->return_code = "005";
                            $this->return_messages = "Erreur d'éxécution interne à notre application";
                            break;
                        default :
                            $this->return_code = "006";
                            $this->return_messages = "L'envoi a échoué pour une autre raison";
                    }
                }
            } else
            {
                $this->return_messages = "Service SMSBOX aucun retour";
            }
        }
//        $this->wpdb->insert($this->table_sendSMSBox, array(
//            'sender' => !empty($history_sms['origine']) ? $history_sms['origine'] : $this->origine,
//            'receiver' => !empty($history_sms['phone_number']) ? $history_sms['phone_number'] : $this->phone_number,
//            'content' => $this->messages,
//            'return_code' => !empty($history_sms['status']) ? $history_sms['status'] : $this->return_code,
//            'return_detail' => !empty($history_sms['detail']) ? $history_sms['detail'] : $this->return_messages,
//            'number_send' => 1,
//            'date_send' => !empty($dateTimeSend) ? date("Y-m-d H:i:s", strtotime($dateTimeSend)) : date("Y-m-d H:i:s"),
//            'date_resend' => null,
//            'id_sendbox' => $return_id
//        ));
        $query = Yii::app()->db->createCommand()->insert('wp_smsbox', array(
            'sender' => !empty($history_sms['origine']) ? $history_sms['origine'] : $this->origine,
            'receiver' => !empty($history_sms['phone_number']) ? $history_sms['phone_number'] : $this->phone_number,
            'content' => $this->messages,
            'return_code' => !empty($history_sms['status']) ? $history_sms['status'] : $this->return_code,
            'return_detail' => !empty($history_sms['detail']) ? $history_sms['detail'] : $this->return_messages,
            'number_send' => 1,
            'date_send' => !empty($dateTimeSend) ? date("Y-m-d H:i:s", strtotime($dateTimeSend)) : date("Y-m-d H:i:s"),
            'date_resend' => null,
            'id_sendbox' => $return_id
        ));
//        CVarDumper::dump($query, 10, true);
//        exit;
    }

}
