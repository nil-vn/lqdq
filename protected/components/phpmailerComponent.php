<?php

//require_once(FRONTEND_APP_DIR.'components/phpmailer/class.phpmailer.php');
Yii::import("application.components.phpmailer.*");

class phpmailerComponent extends PHPMailer
{

    public $db;
    public $table_email;

    function __construct()
    {
        parent::__construct();
        global $wpdb;
        $this->db = $wpdb;
        $this->table_email = "t_mails_tosend";
    }

    public function createPHPMailerServer($config = array())
    {
        if (SEND_MAIL)
        {
            if (!empty($config))
            {
                $this->isSMTP();
                $this->Host = $config['Host'];
                $this->Port = $config['Port'];
                $this->SMTPAuth = $config['SMTPAuth'];
                $this->Username = $config['Username'];
                $this->Password = $config['Password'];
                $this->SMTPSecure = $config['SMTPSecure'];
                $this->From = $config['From'];
                $this->FromName = $config['FromName'];
                $this->addAddress($config['Email'], $config['FullName']);
                $this->isHTML(true);
                $this->Subject = $config['Subject'];
                $this->Body = $config['Body'];
                $this->CharSet = "UTF-8";
                $this->send();
            }
        }
    }

    public function createTemplateEmail($content, $server)
    {
        $message_send = "<div align='center'><font size='-2'>";
        $message_send .= __("Pour être sûr de recevoir les mails de ", "immobilier");
        $message_send .= "<a target='_blank' href='" . home_url() . "'>www.immobilier.fr</a>,<br>";
        $message_send .= __("nous vous recommandons de rajouter", "immobilier") . " <a target='_blank' href='mailto:" . $server . "'>";
        $message_send .= $server . "</a> " . __("dans votre carnet d'adresses.", "immobilier") . "</font></div>";
        $message_send .= "<table width='600' cellspacing='0' cellpadding='0' border='0' align='center'>";
        $message_send .= "<tbody><tr>";
        $message_send .= "<td width='600' height='57' colspan='8'>";
        $message_send .= "<img width='600' height='57' border='0' alt='' src='" . FRONTEND_IMAGE_URL . "email/Mail_header.jpg'>";
        $message_send .= "</td></tr>";
        $message_send .= "<tr><td><img border='0' alt='' src='" . FRONTEND_IMAGE_URL . "email/Mail_02.jpg'></td>";
        $message_send .= "<td><a target='_blank' title='" . __("Vente immobilière", "immobilier") . "'";
        $message_send .= " href='" . PERMALINK_ISELL . "'>";
        $message_send .= "<img border='0' alt='' src='" . FRONTEND_IMAGE_URL . "email/Mail_03.jpg'></a></td>";
        $message_send .= "<td><a target='_blank' title='" . __("Achat immobilier", "immobilier") . "'";
        $message_send .= " href='" . PERMALINK_IBUY . "'>";
        $message_send .= "<img border='0' alt='' src='" . FRONTEND_IMAGE_URL . "email/Mail_04.jpg'></a></td>";
        $message_send .= "<td><a target='_blank' title='" . __("Location", "immobilier") . "' href='" . PERMALINK_RENT . "'>";
        $message_send .= "<img border='0' alt='' src='" . FRONTEND_IMAGE_URL . "email/Mail_05.jpg'></a></td>";
        $message_send .= "<td><a target='_blank' title='" . __("Credit immobilier", "immobilier") . "' href='" . PERMALINK_CREDIT_IMMOBILIER . "'>";
        $message_send .= "<img border='0' alt='' src='" . FRONTEND_IMAGE_URL . "email/Mail_06.jpg'></a></td>";
        $message_send .= "<td><a target='_blank' title='" . __("Nous contacter", "immobilier") . "' href='" . PERMALINK_CONTACT . "'>";
        $message_send .= "<img border='0' alt='' src='" . FRONTEND_IMAGE_URL . "email/Mail_07.jpg'></a></td>";
        $message_send .= "<td><a target='_blank' title='" . __("Espace client", "immobilier") . "' href='" . PERMALINK_LOGIN . "'>";
        $message_send .= "<img border='0' alt='' src='" . FRONTEND_IMAGE_URL . "email/Mail_08.jpg'></a></td>";
        $message_send .= "<td><img border='0' alt='' src='" . FRONTEND_IMAGE_URL . "email/Mail_09.jpg'></td></tr>";
        $message_send .= "<tr><td width='600' background='" . FRONTEND_IMAGE_URL . "email/Mail_content.jpg' colspan='8'>";
        $message_send .= "<table width='100%'' cellspacing='0' cellpadding='0' border='0'>";
        $message_send .= "<tbody><tr><td width='60'>&nbsp;</td><td width='480'><br>";
        $message_send .= $content;
        $message_send .= "</td><td width='60'>&nbsp;</td></tr></tbody></table></td></tr>";
        $message_send .= "<tr><td width='600' valign='bottom' height='54' colspan='8'>";
        $message_send .= "<img width='600' height='55' border='0' alt='' src='" . FRONTEND_IMAGE_URL . "email/Mail_footer.jpg'>";
        $message_send .= "<div align='center' valign='bottom'>";
        $message_send .= "<a target='_blank' style='text-decoration:none' href='" . home_url() . "'>";
        $message_send .= "<font size='-1' color='#EDB329'>" . __(" &copy; 2008 Copyright Immobilier.fr - Tous droits réservés", "immobilier") . " </font>";
        $message_send .= "</a></div></td></tr></tbody></table>";
        return $message_send;
    }

    public function testMail()
    {
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => "vietna@greenglobal.vn",
            'FullName' => '',
            'Subject' => "subject test",
            'Body' => $this->createTemplateEmail("test mail", 'serviceclients@immobilier.fr')
        ));
    }

    public function sendMailExcuenvoimail($attrVal)
    {
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'contact@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['user_email'],
            'FullName' => '',
            'Subject' => $attrVal['subject'],
            'Body' => $this->createTemplateEmail($attrVal['content'], 'contact@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'contact@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['user_email'],
                'subject' => $attrVal['subject'],
                'messageHtml' => $this->createTemplateEmail($attrVal['content'], 'contact@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['property_id']
            ]);
        }
    }

    public function sendMailEnvoiMailContentieux($attrVal)
    {
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'contact@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['user_email'],
            'FullName' => '',
            'Subject' => $attrVal['subject'],
            'Body' => $this->createTemplateEmail($attrVal['content'], 'contact@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'contact@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['user_email'],
                'subject' => $attrVal['subject'],
                'messageHtml' => $this->createTemplateEmail($attrVal['content'], 'contact@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['property_id']
            ]);
        }
    }

    public function sendMailDeactivePremium($attrVal)
    {
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['user_email'],
            'FullName' => '',
            'Subject' => $attrVal['subject'],
            'Body' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['user_email'],
                'subject' => $attrVal['subject'],
                'messageHtml' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr'),
                'messageText' => $attrVal['content_text'],
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['property_id']
            ]);
        }
    }

    public function sendMailPasserelleAgence($attrVal)
    {
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['user_email'],
            'FullName' => '',
            'Subject' => $attrVal['subject'],
            'Body' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['user_email'],
                'subject' => $attrVal['subject'],
                'messageHtml' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr'),
                'messageText' => $attrVal['content_text'],
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['property_id']
            ]);
        }
    }

    public function sendMailPasserelleAgencePro($attrVal)
    {
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'contact@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['user_email'],
            'FullName' => '',
            'Subject' => $attrVal['subject'],
            'Body' => $this->createTemplateEmail($attrVal['content'], 'contact@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'contact@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['user_email'],
                'subject' => $attrVal['subject'],
                'messageHtml' => $this->createTemplateEmail($attrVal['content'], 'contact@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['property_id']
            ]);
        }
    }

    public function sendMailPremiumResilier($attrVal)
    {
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['user_email'],
            'FullName' => '',
            'Subject' => $attrVal['subject'],
            'Body' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['user_email'],
                'subject' => $attrVal['subject'],
                'messageHtml' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr'),
                'messageText' => $attrVal['content_text'],
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['property_id']
            ]);
        }
    }

    public function sendMailDeactivePremiumManuel($attrVal)
    {
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['user_email'],
            'FullName' => '',
            'Subject' => $attrVal['subject'],
            'Body' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['user_email'],
                'subject' => $attrVal['subject'],
                'messageHtml' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr'),
                'messageText' => $attrVal['content_text'],
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['property_id']
            ]);
        }
    }

    public function sendMailChequePackage($attrVal)
    {
        global $current_user;
        // Create link auto login
        $message = "Ch&egrave;re/Cher " . $current_user->first_name . " " . $current_user->last_name . ",<br><br>";
        $message.="Vous avez souhait&eacute; souscrire par ch&egrave;que &agrave; notre formule d'abonnement pour une dur&eacute;e de " . $attrVal['nbs'] . " semaines" . $attrVal['nbmois'];
        $message.="concernant la diffusion de votre annonce de vente r&eacute;f&eacute;rence <font color=red><b>BTK" . $attrVal['id'] . "</b></font> sur <a href='" . home_url() . "'>Immobilier.fr</a> et sur ses sites partenaires (Trovit.fr ; Vente.fr ; OnVousLoge.com ; Logement.fr ; etc..).<br /><br />";
        $message.="Si vous souhaitez visualiser et imprimer votre bon de commande, merci de vous rendre &agrave; l'adresse : <br /><b><a href='" . home_url() . "' target='_blank'>" . home_url() . "</a></b> (espace client).<br>";
        $message.="Voici vos informations personnelles n&eacute;cessaires &agrave; votre connexion :<br>";
        $message.="Votre e-mail : <strong>" . $current_user->user_email . "</strong><br>";
        $message.="Votre mot de passe : <strong>" . $current_user->password_not_hash . "</strong>";
        $message.="<br><br>";
        $message.="<table width='84'  border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF' style='background-repeat:no-repeat;''><tr>";
        $message.="<td width='84' align='center' onMouseOver='this.style.backgroundImage=url(" . get_template_directory_uri() . "/images/espace_clients_on.jpg)'";
        $message.=" onMouseOut='this.style.backgroundImage='url(" . get_template_directory_uri() . "/images/espace_clients_off.jpg)'";
        $message.="style='background-image:url(" . get_template_directory_uri() . "/images/espace_clients_off.jpg);'><a href='" . PERMALINK_LOGIN . "' target='_blank'><img src='" . get_template_directory_uri() . "/images/espace_clients_on.jpg' width='84' height='128' border='0'></a></td>";
        $message.="</tr></table><br /><br />";
        $message.="Pour toute question vous pouvez contacter votre charg&eacute; de client&egrave;le par e-mail :<br />" . signatureHtml();
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $current_user->user_email,
            'FullName' => '',
            'Subject' => "Votre bon de commande",
            'Body' => $this->createTemplateEmail($message, 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $current_user->user_email,
                'subject' => "Votre bon de commande",
                'messageHtml' => $this->createTemplateEmail($message, 'serviceclients@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['id']
            ]);
        }
    }

    public function sendMailContactACQPro($attrVal = array())
    {
        
    }

    public function sendMailValidatePaymentError($attrVal = array())
    {
        $message = "<center><strong>" . $attrVal['title'] . "</strong></center><br/><br/>";
        $message.= $attrVal['text'] . ":<br/><br/>";
        $message.= "Id de paiement: " . $attrVal['id'] . "<br/>";
        if (isset($attrVal['id_annonce']))
        {
            $message.= "Référence de l'annonce: " . $attrVal['id_annonce'] . "<br>";
        }
        $message.= "Provenance: " . $attrVal['action'] . "<br/>";
        $message.= "Montant: " . $attrVal['amount'] . "<br/>";
        $message.= "FCB: " . $attrVal['fcb'] . "<br/>";
        $message.= "Devise: " . $attrVal['dev'] . "<br/>";
        $message.= "Langue: " . $attrVal['lang'] . "<br/>";
        $message.= "Résultat: " . $attrVal['result'] . "<br/>";
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'alexandre@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => "alexandre@immobilier.fr",
            'FullName' => '',
            'Subject' => $attrVal['subject'],
            'Body' => $this->createTemplateEmail($message, 'alexandre@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'alexandre@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => "alexandre@immobilier.fr",
                'subject' => $attrVal['subject'],
                'messageHtml' => $this->createTemplateEmail($message, 'alexandre@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['id']
            ]);
        }
    }

    public function sendMailDeactiveOffre($attrVal)
    {
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['user_email'],
            'FullName' => '',
            'Subject' => "Désactivation de votre annonce référence BTK" . $attrVal['id'],
            'Body' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['user_email'],
                'subject' => "Désactivation de votre annonce référence BTK" . $attrVal['id'],
                'messageHtml' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr'),
                'messageText' => $attrVal['content_text'],
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['id']
            ]);
        }
    }

    public function sendMailValiderPaiement($attrVal)
    {
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['email'],
            'FullName' => '',
            'Subject' => $attrVal['title'],
            'Body' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['email'],
                'subject' => $attrVal['title'],
                'messageHtml' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr'),
                'messageText' => $attrVal['content_text'],
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['property_id']
            ]);
        }
    }

    public function sendMailActivePrivilege($attrVal)
    {
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['email'],
            'FullName' => '',
            'Subject' => "Activation de votre annonce Privilège",
            'Body' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['email'],
                'subject' => "Activation de votre annonce Privilège",
                'messageHtml' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr'),
                'messageText' => $attrVal['content_text'],
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['property_id']
            ]);
        }
    }

    public function sendMailPrivilegeVeille($content, $text, $id)
    {
        global $current_user;
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $current_user->user_email,
            'FullName' => '',
            'Subject' => "Mise en veille de votre annonce Privilège",
            'Body' => $this->createTemplateEmail($content, 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $current_user->user_email,
                'subject' => "Mise en veille de votre annonce Privilège",
                'messageHtml' => $this->createTemplateEmail($attrVal['content'], 'serviceclients@immobilier.fr'),
                'messageText' => $text,
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $id
            ]);
        }
    }

    public function sendMailReactivePrivilege($attrVal)
    {
        $message_send = "Cher(e) client(e),<br><br>";
        $message_send.= "Votre annonce Privil&egrave;ge r&eacute;f&eacute;rence <strong>BTK" . $attrVal['id'] . "</strong> a &eacute;t&eacute; r&eacute;activ&eacute;e.<br /><br />";
        $message_send.= "Votre annonce est de nouveau diffus&eacute;e sur Immobilier.fr et sur ses sites partenaire.<br />";
        $message_send.= "Pour toutes modifications sur votre annonce veuillez vous rendre sur votre espace client disponible à l'adresse: <a href='" . home_url() . "' target='_blank'>" . home_url() . "</a>.<br />";
        $message_send.= "<br><a href='" . home_url() . "' style='text-decoration:none;'>Cliquez ici</a> pour accéder au site <a href='" . home_url() . "' style='text-decoration:none;''>Immobilier.fr</a><br>";
        $message_send.= "<table cellPadding='0' cellSpacing='0' width='195' align='left'>";
        $message_send.= "<tr><td height=10><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td height='3'></td><td height='3'></td></tr><tr><td><table width='68' border='0' cellspacing='0' cellpadding='0'><tr><td><img src='" . get_template_directory_uri() . "/images/signature.gif' width='73' height='64'></td></tr></table>";
        $message_send.= "</td><td width='100%' valign='bottom'>";
        $message_send.= "<strong><font color='#663333' size='3'>";
        $message_send.= $attrVal['first_name'] . " " . $attrVal['last_name'] . "</font></strong><br>";
        $message_send.= "<strong><font color='#CC6633' face='Arial' size='2'>Chargé de Clientèle</font></strong><br>";
        $message_send.= "<a href='" . home_url() . "' style='text-decoration:none;' title='Accéder à immobilier.fr'>";
        $message_send.= "<font face='Verdana' size='5' color='#CC6633'>&nbsp;<strong>Immobilier.fr</strong></font></a></td></tr></table></td></tr><tr><td>";
        $message_send.= "<font face='Verdana' color='#4804b8'>Email : <a href='mailto:'" . $attrVal['email'] . "style='text-decoration:none;''><font color='#000000'>" . $attrVal['email'] . "</font></a></font><br>";
        $message_send.= "<font face='Verdana' size='6' color='#4804b8'>Tél. &nbsp;: <font color='#000000'>" . $attrVal['my_landline'] . "</font></font><br></td></tr></table>";

        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['email'],
            'FullName' => '',
            'Subject' => "Réactivation de votre annonce Privilège",
            'Body' => $this->createTemplateEmail($message_send, 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['email'],
                'subject' => "Réactivation de votre annonce Privilège",
                'messageHtml' => $this->createTemplateEmail($message_send, 'serviceclients@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['id']
            ]);
        }
    }

    public function sendMailDeactivePrivilegeVendu($attrVal)
    {
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['email'],
            'FullName' => '',
            'Subject' => "Désactivation de votre annonce Privilège",
            'Body' => $this->createTemplateEmail($attrVal['messages'], 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['email'],
                'subject' => "Désactivation de votre annonce Privilège",
                'messageHtml' => $this->createTemplateEmail($attrVal['messages'], 'serviceclients@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['property_id']
            ]);
        }
    }

    public function sendMailDeactivePrivilege($attrVal)
    {
        $message_send = "Cher(e) client(e),<br><br>";
        $message_send.= "Nous avons bien pris en compte votre demande de d&eacute;sactivation.<br>";
        $message_send.= "Nous arrêtons donc la diffusion de votre annonce Privilège référence <strong>BTK" . $attrVal['id'] . "</strong>.<br/><br/>";
        $message_send.= "Nous vous souhaitons une bonne transaction et espérons vous retrouver prochainement sur le site Immobilier.fr<br />";
        $message_send.= "<br><a href='" . home_url() . "' style='text-decoration:none;'>Cliquez ici</a> pour accéder au site <a href='" . home_url() . "' style='text-decoration:none;''>Immobilier.fr</a><br>";
        $message_send.= "<table cellPadding='0' cellSpacing='0' width='195' align='left'>";
        $message_send.= "<tr><td height=10><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td height='3'></td><td height='3'></td></tr><tr><td><table width='68' border='0' cellspacing='0' cellpadding='0'><tr><td><img src='" . get_template_directory_uri() . "/images/signature.gif' width='73' height='64'></td></tr></table>";
        $message_send.= "</td><td width='100%' valign='bottom'>";
        $message_send.= "<strong><font color='#663333' size='3'>";
        $message_send.= $attrVal['first_name'] . " " . $attrVal['last_name'] . "</font></strong><br>";
        $message_send.= "<strong><font color='#CC6633' face='Arial' size='2'>Chargé de Clientèle</font></strong><br>";
        $message_send.= "<a href='" . home_url() . "' style='text-decoration:none;' title='Accéder à immobilier.fr'>";
        $message_send.= "<font face='Verdana' size='5' color='#CC6633'>&nbsp;<strong>Immobilier.fr</strong></font></a></td></tr></table></td></tr><tr><td>";
        $message_send.= "<font face='Verdana' color='#4804b8'>Email : <a href='mailto:'" . $attrVal['email'] . "style='text-decoration:none;''><font color='#000000'>" . $attrVal['email'] . "</font></a></font><br>";
        $message_send.= "<font face='Verdana' size='6' color='#4804b8'>Tél. &nbsp;: <font color='#000000'>" . $attrVal['my_landline'] . "</font></font><br></td></tr></table>";
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['email'],
            'FullName' => '',
            'Subject' => "Désactivation de votre annonce Privilège",
            'Body' => $this->createTemplateEmail($message_send, 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['email'],
                'subject' => "Désactivation de votre annonce Privilège",
                'messageHtml' => $this->createTemplateEmail($message_send, 'serviceclients@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => isset($attrVal['property_id']) ? $attrVal['property_id'] : ""
            ]);
        }
    }

    public function sendMailDecouverteClientsEnvoyer($attrVal)
    {
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'acquereur@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['email'],
            'FullName' => '',
            'Subject' => "Coordonnées client(s) acquéreur(s)",
            'Body' => $this->createTemplateEmail($attrVal['content'], 'acquereur@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'acquereur@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['email'],
                'subject' => "Coordonnées client(s) acquéreur(s)",
                'messageHtml' => $this->createTemplateEmail($message_send, 'acquereur@immobilier.fr'),
                'messageText' => $attrVal['content_text'],
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => isset($attrVal['property_id']) ? $attrVal['property_id'] : ""
            ]);
        }
    }

    public function sendMailProperty($attrVal)
    {
        $message_send = "<img width='122' height='92'";
        $message_send .= "style='border:1px solid #d4d4d4;padding:4px;background:#fff;margin-right:8px;float:left'";
        $message_send .= "src='" . $attrVal['photoThumbnail'] . "'>";
        $message_send .= "<div><ul><li style='font-family:Book Antiqua;text-align:justify;color:" . $attrVal['title_color'] . ";font-weight:bold;";
        $message_send .= "font-size:16px;min-height:20px'>" . $attrVal['title_property'] . "</li></ul><b style='font-size:12px'>" . $attrVal['pro_info'];
        $message_send .= "</b><br>" . $attrVal['villes_pro'] . "<br>";
        $message_send .= "Prix : <b style='font-size:18px'> " . $attrVal['prix_pro'] . "</b></div>";
        $message_send .= "<div style='clear:both'></div><br>";
        $message_send .= "<div style='color:#414141'>";
        $message_send .= "<em>" . $attrVal['description'] . "</em></div><br>";
        $message_send .= "<div style='clear:both'></div><br>&gt;&gt; " . __("Pour consulter le détail de cette annonce, cliquez", "immobilier");
        $message_send .= __("sur le lien suivant", "immobilier") . ":<br>";
        $message_send .= "<a target='_blank' href='" . PERMALINK_PROPERTY_DETAIL . "?action=detail&property_id=" . $attrVal['property_id'] . "'>" . PERMALINK_PROPERTY_DETAIL . "?action=detail&property_id=" . $attrVal['property_id'] . "</a><br><br><br>";
        if (!empty($attrVal['mail_friend']))
        {
            $message_send .= __("Expediteur du message", "immobilier") . " : " . $attrVal['name_friend'] . " &lt;<a target='_blank'";
            $message_send .= "href='mailto:" . $attrVal['mail_friend'] . "'>" . $attrVal['mail_friend'] . "</a>&gt;<br><br>";
        }
        $message_send .= "------------------------------<wbr></wbr>------------------------------";
        $message_send .= "<wbr></wbr>---------------------------<br>" . __("Ce message a été envoyé depuis le site ", "immobilier");
        $message_send .= "<a target='_blank' href='" . home_url() . "'>" . home_url() . "</a><br><br>";

        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['mail_send'],
            'FullName' => '',
            'Subject' => $attrVal['subject'],
            'Body' => $this->createTemplateEmail($message_send, 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['mail_send'],
                'subject' => $attrVal['subject'],
                'messageHtml' => $this->createTemplateEmail($message_send, 'serviceclients@immobilier.fr'),
                'messageText' => $attrVal['content_text'],
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => isset($attrVal['property_id']) ? $attrVal['property_id'] : ""
            ]);
        }
    }

    public function sendMailDefiscalisation()
    {
        // .de         = "defiscalisation.immobilier.fr"               
        // .adresse    = "jerome@guiffault.com"
        // .dest       = "jerome@guiffault.com"
        // '.dest      = "alexandre@immobilier.fr"
        // .objet      = "Immobilier.fr // Nouveau Prospect Defiscalisation..."
        // .sujet      = "Fiches defisc"
        // .message    = tmail
        // .format     = 1
        // 'SMTP.cc    = "jerome@immobilier.fr"
        // 'SMTP.bcc   = "herve@credit.fr"
        $subject = "Immobilier.fr // Nouveau Prospect Defiscalisation...";
        $content = "Pascal,";
        $content .= "<p>Un nouveau client vient de s'inscrire en D&eacute;fiscalisation [Cliquer sur - TRAITER].</p>";
        $content .= "<p>Fiche actuellement disponible &agrave; l'adresse:<br><a href='http://defiscalisation.immobilier.fr/christophe/default.asp?login=christophe@credit.fr&pass=christophe$'>http://defiscalisation.immobilier.fr/christophe/default.asp</a></p>";
        $content .= "<p>Si le lien ne fonctionne pas, Testez le Copier/Coller Dans la barre d'adresse de votre navigateur.</p>";
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'defiscalisation.immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => "jerome@guiffault.com",
            'FullName' => '',
            'Subject' => $subject,
            'Body' => $this->createTemplateEmail($content, 'defiscalisation.immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'defiscalisation.immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => "jerome@guiffault.com",
                'subject' => $subject,
                'messageHtml' => $this->createTemplateEmail($content, 'defiscalisation.immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => 0
            ]);
        }
    }

    public function sendMailAgences($attrVal = array())
    {
        // Smtp.de = "contact@immobilier.fr"
        // Smtp.dest = "jerome@guiffault.com"
        // Smtp.cc = "agathe.caf@hotmail.fr"
        // Smtp.bcc = "qvalcpsp1968@hotmail.fr"
        $subject = "Formulaire de contact passerelle";
        $content = "<p><strong>Objet: Nouveau contact agence</strong></p>";
        if ($attrVal['software'] != 'autre')
        {
            $content .= "<p>Logiciel utilisé : <strong>" . $attrVal['software'] . "</strong></p>";
        } else
        {
            $content .= "<p>Nom du logiciel utilisé : <strong>" . $attrVal['softwareName'] . "</strong></p>";
        }
        $content .= "<p>Nom de l'agence :  <strong>" . $attrVal['agence'] . "</strong></p>";
        if (!empty($attrVal['votre_nom']) && !empty($attrVal['votre_prenom']))
        {
            $content .= "<p>Contact agence : <strong>" . ucfirst($attrVal['votre_nom']) . " " . $attrVal['votre_prenom'] . "</strong></p>";
        }
        $content .=!empty($attrVal['telephone']) ? "<p>Tel : " . $attrVal['telephone'] . "<br />" : "";
        $content .=!empty($attrVal['phone_portable']) ? "Port : " . $attrVal['phone_portable'] . "<br />" : "";
        $content .= "Adresse e-mail: <a href='mailto:'" . $attrVal['address_mail'] . ">" . $attrVal['address_mail'] . "</a></p>";
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'contact@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => "jerome@guiffault.com",
            'FullName' => '',
            'Subject' => $subject,
            'Body' => $this->createTemplateEmail($content, 'contact@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'contact@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => "jerome@guiffault.com",
                'subject' => $subject,
                'messageHtml' => $this->createTemplateEmail($content, 'contact@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => 0
            ]);
        }
    }

    public function createNewMemberTemplate($attrVal = array())
    {
        $account_info = "<p>" . __("Bienvenue sur Immobilier.fr,", "immobilier") . "</p><br/>";
        $account_info .= "<p>" . __("Conservez ce message dans vos archives car il contient les informations de connexion à votre compte Immobilier.fr", "immobilier") . "</p><br/>";
        $account_info .= "<p>" . __("Votre adresse e-mail :", "immobilier") . "<a href='mailto:" . $attrVal['user_name'] . "'>" . $attrVal['user_name'] . "</a><br/>" . __("Votre mot de passe :", "immobilier") . $attrVal['user_password'] . "</p><br/>";
        $account_info .= "<p>" . __("Cordialement,", "immobilier") . "</p><br/>";
        $account_info .= "<p>" . __("l'équipe Immobilier.fr", "immobilier") . "</p>";
        $subject = __("Votre compte, " . $attrVal['user_name'] . ", a été créé", "immobilier");
        $email_user = "";
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['email_user'],
            'FullName' => '',
            'Subject' => $subject,
            'Body' => $this->createTemplateEmail($account_info, 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['email_user'],
                'subject' => $subject,
                'messageHtml' => $this->createTemplateEmail($account_info, 'serviceclients@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => 0
            ]);
        }
    }

    public function forgotPasswordTemplate($email_user, $new_password)
    {
        $userinfo = get_user_by('email', $email_user);
        $email_body = "<p>" . __("Chère/Cher, ", "immobilier") . $userinfo->first_name . " " . $userinfo->last_name . "</p>";
        $email_body .= "<p>" . __("Suite à votre demande, voici un rappel des identifiants nécessaires à la connexion sur votre espace client accessible à l'adresse", "immobilier") . " <a href='http://clients.immobilier.fr'>http://clients.immobilier.fr</a></p>";
        $email_body .= "<p><strong>" . __("Voici ci-dessous vos identifiants de connexion", "immobilier") . " :</strong></p>";
        $email_body .= "<p>" . __("Votre adresse e-mail: ", "immobilier") . "<a href='mailto:" . $userinfo->user_email . "'>" . $userinfo->user_email . "</a><br/>" . __("Votre mot de passe: ", "immobilier") . $new_password . "</p>";
        $email_body .= "<p>" . __("Cordialement,", "immobilier") . "</p>";
        $email_body .= "<p>" . __("l'équipe Immobilier.fr", "immobilier") . "</p>";
        $subject = __("Récupération de vos indentifiants de connexion", "immobilier");
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $userinfo->user_email,
            'FullName' => '',
            'Subject' => $subject,
            'Body' => $this->createTemplateEmail($email_body, 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $userinfo->user_email,
                'subject' => $subject,
                'messageHtml' => $this->createTemplateEmail($email_body, 'serviceclients@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => 0
            ]);
        }
    }

    public function contactParticulierTemplate($attrVal = array())
    {
        $message_send = "Le site <a target='_blank' href='" . home_url() . "'>";
        $message_send .= "www.immobilier.fr</a> " . __("vous remercie de l'interêt que vous portez à l'annonce référence", "immobilier") . " BKT" . $attrVal['property_id'];
        $message_send .= "<br><br><a target='_blank' href=''>";
        $message_send .= "<img width='122' height='92' style='border:1px solid #d4d4d4;padding:4px; background:#fff;margin-right:8px;float:left'";
        $message_send .= " src='" . $attrVal['photoThumnailURL'] . "'></a><div><ul>";
        $message_send .= "<li style='font-family:Book Antiqua;text-align:justify;color:" . $attrVal['title_color'] . ";";
        $message_send .= "font-weight:bold;font-size:16px;min-height:20px'>" . $attrVal['title_property'] . "</li></ul>";
        $message_send .= "<b style='font-size:12px'>" . $attrVal['pro_info'] . "</b><br>" . $attrVal['villes_pro'] . "<br>";
        $message_send .= "Prix : <b style='font-size:18px'>" . $attrVal['prix_pro'] . "</b>";
        $message_send .= "<div style='clear:both'></div><br>";
        $message_send .= "<div style='color:#414141'>";
        $message_send .= "<em>" . $attrVal['post_description'] . "</em></div><br><br>";
        $message_send .= "<a target='_blank' href='" . PERMALINK_PROPERTY_DETAIL . "?action=detail&property_id=" . $attrVal['property_id'] . "'><b>" . __("Détail de l'offre", "immobilier") . "</b></a>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;";
        $message_send .= "<a target='_blank' href='" . PERMALINK_PROPERTY_DETAIL . "?action=sendemail&property_id=" . $attrVal['property_id'] . "'><b>" . __("Envoyer à un ami", "immobilier") . "</b></a><div style='clear:both'></div><br><br>";
        $message_send .= __("L'ensemble de vos informations ont été transmises au vendeur de ce bien,", "immobilier");
        $message_send .= __(" voici le détail de vos coordonnées", "immobilier") . ":<br><br></div>" . $attrVal['post_name'];
        if (!empty($attrVal['post_tel']))
        {
            $message_send .= "<br>" . __("Téléphone fixe", "immobilier") . ": <strong>" . $attrVal['post_tel'] . "</strong><br>";
        }
        if (!empty($attrVal['post_phone']))
        {
            $message_send .= __("Téléphone portable", "immobilier") . ": <strong>" . $attrVal['post_phone'] . "</strong><br>";
        }
        $message_send .= __("E-mail", "immobilier") . ": <strong><a target='_blank' href='mailto:" . $attrVal['post_mail'] . "'>" . $attrVal['post_mail'] . "</a>";
        if (isset($attrVal['isLocation']))
        {
            if (!empty($attrVal['post_messages']))
            {
                $message_send.="<br />Commentaire:<br /><strong>" . nl2br($attrVal['post_messages']) . "</strong>";
            }
            $message_send.="<br /><br />Toute l'&eacute;quipe d'immobilier.fr vous souhaite une bonne transaction.";
        } else
        {
            $message_send .= "</strong><br><br><br>" . __("Nous espérons que le vendeur vous contactera rapidement", "immobilier") . ".<br><br>";
            $message_send .= __("Si vos coordonnées comportent une erreur, merci de nous le signaler en nous contactant", "immobilier");
            $message_send .= __(" par e-mail à l'adresse", "immobilier") . " <a target='_blank' href='mailto:florian@immobilier.fr'>";
            $message_send .= "florian@immobilier.fr</a>";
        }
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'annonces@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['post_mail'],
            'FullName' => '',
            'Subject' => $attrVal['subject'],
            'Body' => $this->createTemplateEmail($message_send, 'annonces@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'annonces@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['post_mail'],
                'subject' => $attrVal['subject'],
                'messageHtml' => $this->createTemplateEmail($message_send, 'annonces@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => isset($attrVal['property_id']) ? $attrVal['property_id'] : ""
            ]);
        }
    }

    public function alertTemplate($attrVal = array())
    {
        $email_alert_body = "<p>" . __("Bonjour", "immobilier") . ",</p>";
        $email_alert_body .= "<p>" . __("Suite à votre demande, nous avons créé pour vous l'alerte e-mail suivante:", "immobilier") . "</p>";
        $email_alert_body .= "<p>" . $attrVal['data_save'] . "</p>";
        $email_alert_body .= "<p>" . __("Vous recevrez désormais les nouvelles annonces correspondant à vos critères de recherche.", "immobilier") . "</p>";
        $email_alert_body .= "<ul><li>" . __("Vous pouvez à tout moment désactiver votre alerte en", "immobilier") . "<a href='" . PERMALINK_EMAIL_ALERT_DEACTIVE . "?email=" . $attrVal['email_alert'] . "&security_code=" . strtoupper($attrVal['security_code']) . "'>" . __(" cliquant ici", "immobilier") . "</a></li></ul>";
        $email_alert_body .= "<p><strong><i>N.B: " . __("Si vous souhaitez modifier votre alerte, vous devez la désactiver puis en recréer une autre.", "immobilier") . "</i></strong></p>";
        $email_alert_body .= "<p>" . __("Veuillez conserver le code", "immobilier") . ' "' . strtoupper($attrVal['security_code']) . '" ' . " " . __("nécessaire à la désactivation de votre alerte.", "immobilier") . "</p><br/>";
        $email_alert_body .= __("Toute l'équipe d'Immobilier.fr vous remercie de votre confiance.", "immobilier");
        $subject = __("Confirmation de création de votre alerte e-mail", "immobilier");
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['email_alert'],
            'FullName' => '',
            'Subject' => $subject,
            'Body' => $this->createTemplateEmail($email_alert_body, 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['email_alert'],
                'subject' => $subject,
                'messageHtml' => $this->createTemplateEmail($email_alert_body, 'serviceclients@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => 0
            ]);
        }
    }

    public function alertNewPropertyTemplate($attrVal = array())
    {
        $content_alert .= "Le site <a target='_blank' href='" . home_url() . "'>";
        $content_alert .= "www.immobilier.fr</a> " . __("vous remercie de l'interêt que vous portez à l'annonce référence", "immobilier") . " BKT" . $attrVal['id'];
        $content_alert .= "<br><br><a target='_blank' href=''>";
        $content_alert .= "<img width='122' height='92' style='border:1px solid #d4d4d4;padding:4px; background:#fff;margin-right:8px;float:left'";
        $content_alert .= " src='" . $attrVal['photoThumnailURL'] . "'></a><div><ul>";
        $content_alert .= "<li style='font-family:Book Antiqua;text-align:justify;color:" . $attrVal['title_color_alert'] . ";";
        $content_alert .= "font-weight:bold;font-size:16px;min-height:20px'>" . $attrVal['title_property_alert'] . "</li></ul>";
        $content_alert .= "<b style='font-size:12px'>" . $attrVal['property_alert_info'] . "</b><br>" . $attrVal['property_alert_villes'] . "<br>";
        $content_alert .= "Prix : <b style='font-size:18px'>" . $attrVal['property_alert_prix'] . "</b>";
        $content_alert .= "<div style='clear:both'></div><br>";
        $content_alert .= "<div style='color:#414141'>";
        $content_alert .= "<em>" . $attrVal['post_description'] . "</em></div><br><br>";
        $content_alert .= "<a target='_blank' href='" . PERMALINK_PROPERTY_DETAIL . "?action=detail&property_id=" . $attrVal['id'] . "'><b>" . __("Détail de l'offre", "immobilier") . "</b></a>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;";
        $content_alert .= "<a target='_blank' href='" . PERMALINK_PROPERTY_DETAIL . "?action=sendemail&property_id=" . $attrVal['id'] . "'><b>" . __("Envoyer à un ami", "immobilier") . "</b></a><div style='clear:both'></div><br><br>";
        $content_alert .= __("L'ensemble de vos informations ont été transmises au vendeur de ce bien,", "immobilier");
        $content_alert .= __(" voici le détail de vos coordonnées", "immobilier") . ":<br><br></div>" . $attrVal['user_display_name'];
        if (!empty($attrVal['user_landline']))
        {
            $content_alert .= "<br>" . __("Téléphone fixe", "immobilier") . ": <strong>" . $attrVal['user_landline'] . "</strong><br>";
        }
        if (!empty($attrVal['usermobile_phone']))
        {
            $content_alert .= __("Téléphone portable", "immobilier") . ": <strong>" . $attrVal['user_mobile_phone'] . "</strong><br>";
        }
        $content_alert .= __("E-mail", "immobilier") . ": <strong><a target='_blank' href='mailto:" . $attrVal['user_email'] . "'>" . $attrVal['user_email'] . "</a>";
        $content_alert .= "</strong><br><br><br>" . __("Nous espérons que le vendeur vous contactera rapidement", "immobilier") . ".<br><br>";
        $content_alert .= __("Si vos coordonnées comportent une erreur, merci de nous le signaler en nous contactant", "immobilier");
        $content_alert .= __(" par e-mail à l'adresse", "immobilier") . " <a target='_blank' href='mailto:florian@immobilier.fr'>";
        $content_alert .= "florian@immobilier.fr</a>";
        $subject = __("New Property", "immobilier");
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['email_alert'],
            'FullName' => '',
            'Subject' => $subject,
            'Body' => $this->createTemplateEmail($content_alert, 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['email_alert'],
                'subject' => $subject,
                'messageHtml' => $this->createTemplateEmail($content_alert, 'serviceclients@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => 0
            ]);
        }
    }

    public function activePropertyTemplate($attrVal = array())
    {
        $subject = __("Activation de votre annonce de location", "immobilier");
        $content = "<br/><p><strong>" . __("Madame, Monsieur,", "immobilier") . "</strong></p>";
        $content .= "<p>" . __("Vous avez deposé une annonce sous la référence " . $attrVal['post_id'] . " pour trouver un ou plusieurs locataire(s) sur le site Immobilier.fr", "immobilier") . "</p>";
        $content .= "<p style='color:red;'><strong>" . __("Votre annonce n'a pas encore été activée !", "immobilier") . "</strong></p>";
        $content .= "<a target='_blank' href=''>";
        $content .= "<img width='122' height='92' style='border:1px solid #d4d4d4;padding:4px; background:#fff;margin-right:8px;float:left'";
        $content .= " src='" . FRONTEND_PHOTO_URL . "thumbnail/deroulante.jpg'></a><div><ul>";
        $content .= "<li style='font-family:Book Antiqua;text-align:justify;color:" . $attrVal['m_title_color'] . ";";
        $content .= "font-weight:bold;font-size:16px;min-height:20px'>" . $attrVal['m_title_property'] . "</li></ul>";
        $content .= "<b style='font-size:12px'>" . $attrVal['postPropertyInfo'] . "</b><br>" . $attrVal['post_ville'] . "<br>";
        $content .= "Prix : <b style='font-size:18px'>" . $attrVal['post_prix'] . " €</b>";
        $content .= "<div style='clear:both'></div><br>";
        $content .= "<div style='color:#414141'>";
        $content .= "<em>" . $attrVal['post_description'] . "</em></div><br/><br/>";
        $content .= "<p><strong>" . __("Pour gérer et activer votre annonce de location, veuillez vous rendre sur votre espace client, en cliquant sur le bouton ci-dessous :", "immobilier") . "</strong></p>";
        $content .= "<div style='padding-left:150px;'><a href='" . PERMALINK_MEMBER . "?action=myClient&property_id=" . $attrVal['post_id'] . "' style='display:block; width:167px; height:128px; background: url(" . get_template_directory_uri() . "/images/espace_clients_off.jpg);position:relative;'><img style='position: absolute; left:42px;' src='" . get_template_directory_uri() . "/images/espace_clients_on.jpg'></a></div>";
        $content .= "<p>" . __("Vos coordonnées seront communiquées gratuitement aux clients interessés par votre annonce.", "immobilier") . "</p>";
        $content .= "<p><em>" . __("Attention ! en validant l'annonce en ligne vous êtes responsable du contenu de l'annonce !", "immobilier") . "<br/>" . __("Tout abus ou contenu hors sujet sera supprimé et votre responsabilité pourra être recherchée.", "immobilier") . "<br/>" . __("Vos informations d'identifications sur le reseau sont conservées à cet effet.", "immobilier") . "</em></p>";
        $content .= "<p>" . __("Cordialement,", "immobilier") . "</p>";
        $content .= "<p><strong>" . __("L'équipe Immobilier.fr", "immobilier") . "</strong></p>";
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'serviceclients@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['post_author'],
            'FullName' => '',
            'Subject' => $subject,
            'Body' => $this->createTemplateEmail($content, 'serviceclients@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'serviceclients@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['post_author'],
                'subject' => $subject,
                'messageHtml' => $this->createTemplateEmail($content, 'serviceclients@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['post_id']
            ]);
        }
    }

    public function newPropertyTemplate($attrVal = array())
    {
        $subjectProperty = __("Validation du dépôt de votre annonce référence ", "immobilier") . "BTK" . $attrVal['post_id'];
        $headersProperty = __("From: Immobilier.fr", "immobilier");
        $contentProperty = "<p>" . __("Madame, Monsieur,", "immobilier") . "</p>";
        $contentProperty .= "<p>" . __("Vous avez déposé une annonce sous la référence", "immobilier") . "BTK193001" . __("sur le site", "immobilier") . "</p>";
        $contentProperty .= "Immobilier.fr :";
        $contentProperty .= "<br><br><a target='_blank' href=''>";
        $contentProperty .= "<img width='122' height='92' style='border:1px solid #d4d4d4;padding:4px; background:#fff;margin-right:8px;float:left'";
        $contentProperty .= " src='" . FRONTEND_PHOTO_URL . "thumbnail/deroulante.jpg'></a><div><ul>";
        $contentProperty .= "<li style='font-family:Book Antiqua;text-align:justify;color:" . $attrVal['m_title_color'] . ";";
        $contentProperty .= "font-weight:bold;font-size:16px;min-height:20px'>" . $attrVal['m_title_property'] . "</li></ul>";
        $contentProperty .= "<b style='font-size:12px'>" . $attrVal['postPropertyInfo'] . "</b><br>" . $attrVal['post_ville'] . "<br>";
        $contentProperty .= "Prix : <b style='font-size:18px'>" . $attrVal['post_prix'] . " €</b>";
        $contentProperty .= "<div style='clear:both'></div><br>";
        $contentProperty .= "<div style='color:#414141'>";
        $contentProperty .= "<em>" . $attrVal['post_description'] . "</em></div>";
        $contentProperty .= "<p>" . __("Afin de vous faire bénéficier de toute notre audience Française et Européenne, nous vous proposons la solution de diffusion suivante :", "immobilier") . "</p>";
        $contentProperty .= "<p>" . __("Le service", "immobilier") . " <strong>" . __("PREMIUM", "immobilier") . "</strong>:</p>";
        $contentProperty .= "<p>" . __("Le service PREMIUM est un service de particuliers à particuliers, il est encadré comme cela :", "immobilier") . "</p>";
        $contentProperty .= "<p>" . __("- Votre annonce est diffusée sur Immobilier.fr et sur ses sites partenaires (Trovit.fr ; Vente.fr ; OnVousLoge.com ; Logement.fr ; Yakaz.fr ; etc...).", "immobilier") . "</p>";
        $contentProperty .= "<p>" . __("- Votre annonce est mise en ligne avec 12 photos de votre choix.", "immobilier") . "</p>";
        $contentProperty .= "<p>" . __("- Les coordonnées des clients acquéreurs potentiels vous sont transmises par le biais de mails et/ou S.M.S (sous 48h).", "immobilier") . "</p>";
        $contentProperty .= "<p>" . __("- La diffusion de votre annonce est déclenchée par un abonnement d'un montant de 46,80 euros mensuel ou 84 euros pour 3 mois ou de 134,40 euros pour 6 mois.", "immobilier") . "</p>";
        $contentProperty .= __("- A la fin de la période initiale d'engagement, votre abonnement sera renouvelé automatiquement mensuellement aux prix suivants :", "immobilier");
        $contentProperty .= "<br/>1) 46,80 € / " . __("mois dans le cadre d'un abonnement initial mensuel", "immobilier") . ".<br/>";
        $contentProperty .= "2) 28,00 € /" . __("mois dans le cadre d'un abonnement initial de 3 mois", "immobilier") . ".<br/>";
        $contentProperty .= "3) 22,40 € /" . __("mois dans le cadre d'un abonnement initial de 6 mois", "immobilier") . ".<br/>";
        $contentProperty .= "<p>" . __("L'abonnement 'PREMIUM' est renouvelé automatiquement chaque mois sauf résiliation de votre part.", "immobilier") . "</p>";
        $contentProperty .= "<p>" . __("Vous pouvez à tout moment annuler le renouvellement automatique de votre abonnement(résiliation) en quelques clics à partir de votre 'Espace client', la désactivation de votre annonce sera effectuée à la fin de la période de diffusion ou immédiatement selon votre choix.", "immobilier") . "</p>";
        $contentProperty .= "<img src='" . get_template_directory_uri() . "/images/diffusion_premium.jpg'/><br/>";
        $contentProperty .= "<p style='text-align:center;'>" . __("Si vous souhaitez bénéficier de cette option de diffusion, merci de cliquer sur l'image ci-dessus ou de vous connecter à votre espace client, puis de sélectionner l'option", "immobilier") . "<strong> PREMIUM </strong>" . __("de votre choix sur la page d'activation de votre annonce.", "immobilier") . "</p>";
        $contentProperty .= "<hr/>";
        $contentProperty .= "<p><strong>" . __("VOS IDENTIFIANTS", "immobilier") . "</strong></p>";
        $contentProperty .= "<p>" . __("Votre espace client est accessible à l'adresse", "immobilier") . " <a href='" . home_url() . "'>" . home_url() . "</a> :<br/>";
        $contentProperty .= __("Votre e-mail de connexion", "immobilier") . ": <a target='_blank' href='mailto:" . $attrVal['post_author'] . "'>" . $attrVal['post_author'] . "</a><br/>";
        $contentProperty .= __("Votre mot de passe : ", "immobilier") . $attrVal['post_authorPwd'] . "</p>";
        $contentProperty .= "<p>" . __("Toute l'équipe d'Immobilier.fr vous souhaite une bonne transaction.", "immobilier") . "</p>";
        $subject = __("Validation du dépôt de votre annonce référence ", "immobilier") . "BTK" . $attrVal['post_id'];
        $this->createPHPMailerServer(array(
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'SMTPAuth' => true,
            'Username' => 'hoaithuongth89@gmail.com',
            'Password' => 'hoaithuong89',
            'SMTPSecure' => 'ssl',
            'From' => 'florian@immobilier.fr',
            'FromName' => 'Immobilier.fr',
            'Email' => $attrVal['post_author'],
            'FullName' => '',
            'Subject' => $subject,
            'Body' => $this->createTemplateEmail($contentProperty, 'florian@immobilier.fr')
        ));
        if (!SEND_MAIL)
        {
            $this->db->insert($this->table_email, [
                'fromMail' => 'florian@immobilier.fr',
                'fromName' => 'Immobilier.fr',
                'toMail' => $attrVal['post_author'],
                'subject' => $subject,
                'messageHtml' => $this->createTemplateEmail($content, 'florian@immobilier.fr'),
                'dt' => date('Y-m-d H:i:s'),
                'priorite' => 5,
                'url' => currentPageURL(),
                'ip' => clientIP(),
                'isSend' => 0,
                'id_annonce' => $attrVal['post_id']
            ]);
        }
    }

}

?>