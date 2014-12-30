<?php

/*
|--------------------------------------------------------------------------
|   Oculus XMS
|--------------------------------------------------------------------------
|
|   This file is part of the Oculus XMS Framework package.
|	
|	(c) Vince Kronlein <vince@ocx.io>
|	
|	For the full copyright and license information, please view the LICENSE
|	file that was distributed with this source code.
|	
*/

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;
use Oculus\Mailer\PHPMailer;

class Mail extends LibraryService {
    protected $to;
    protected $from;
    protected $sender;
    protected $debugMode = true;
    protected $replyTo;
    protected $replyToName;
    protected $subject;
    protected $text;
    protected $html;
    protected $attachments = array();
    public $protocol = 'mail';
    public $hostname;
    public $username;
    public $password;
    public $port = 25;
    public $timeout = 5;
    public $newline = "\n";
    public $verp = false;
    public $parameter = '';
    
    public function __construct($config = array()) {
        foreach ($config as $key => $value):
            $this->$key = $value;
        endforeach;
    }
    
    public function setTo($to) {
        $this->to = html_entity_decode($to, ENT_QUOTES, 'UTF-8');
    }
    
    public function setFrom($from) {
        $this->from = html_entity_decode($from, ENT_QUOTES, 'UTF-8');
    }
    
    public function setSender($sender) {
        $this->sender = html_entity_decode($sender, ENT_QUOTES, 'UTF-8');
    }
    
    public function setReadReceipt($readreceipt) {
        $this->readreceipt = $readreceipt;
    }
    
    public function setSubject($subject) {
        $this->subject = html_entity_decode($subject, ENT_QUOTES, 'UTF-8');
    }
    
    public function setText($text) {
        $this->text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    }
    
    public function setHtml($html) {
        $this->html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
    }
    
    public function addAttachment($filename) {
        $this->attachments[] = $filename;
    }
    
    /** Set ReplyTo address if different from sender
     *
     * @param string email address
     * @param string sender name
     */
    public function setReplyTo($address, $name = '') {
        $this->replyTo = $address;
        $this->replyToName = ($name != '') ? $name : $address;
    }
    
    public function send() {
        if (!$this->to) {
            trigger_error('Error: E-Mail to required!');
        }
        
        if (!$this->from) {
            trigger_error('Error: E-Mail from required!');
        }
        
        if (!$this->sender) {
            trigger_error('Error: E-Mail sender required!');
        }
        
        if (!$this->subject) {
            trigger_error('Error: E-Mail subject required!');
        }
        
        if ((!$this->text) && (!$this->html)) {
            trigger_error('Error: E-Mail message required!');
        }
        
        $mail = new PHPMailer($this->debugMode);
        $mail->CharSet = "UTF-8";
        $mail->SMTPDebug = ($this->debugMode) ? 1 : 0;
         // 1 = errors/messages, 2 = messages only, 0 = off
        
        if (is_array($this->to)) {
            foreach ($this->to as $toTmp) {
                $mail->AddAddress($toTmp);
            }
        } else {
            $mail->AddAddress($this->to);
        }
        
        if (!empty($this->readreceipt)) {
            $mail->ConfirmReadingTo = $this->readreceipt;
        }
        
        $mail->Subject = $this->subject;
        
        $mail->SetFrom($this->from, $this->sender);
        
        $this->setReplyTo($this->from, $this->sender);
        
        if ($this->replyTo) {
            if ($this->replyToName) {
                $mail->AddReplyTo($this->replyTo, $this->replyToName);
            } else {
                $mail->AddReplyTo($this->replyTo, $this->sender);
            }
        } else {
            $mail->AddReplyTo($this->from, $this->sender);
        }
        
        if (!$this->html) {
            $mail->Body = $this->text;
        } else {
            $mail->MsgHTML($this->html);
            if ($this->text) {
                $mail->AltBody = $this->text;
            } else {
                $mail->AltBody = 'This is a HTML email and your email client software does not support HTML email!';
            }
        }
        
        foreach ($this->attachments as $attachment) {
            if (file_exists($attachment)) {
                $mail->AddAttachment($attachment);
            }
        }
        
        if ($this->protocol == 'smtp') {
            $mail->IsSMTP();
            $mail->Host = $this->hostname;
            $mail->Port = $this->port;
            if ($this->port == '587') {
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "tls";
            } elseif ($this->port == '465') {
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "ssl";
            }
            if (!empty($this->username) && !empty($this->password)) {
                $mail->SMTPAuth = true;
                $mail->Username = $this->username;
                $mail->Password = $this->password;
            }
        }
        
        if ($this->debugMode) {
            try {
                $mail->Send();
            }
            catch(phpmailerException $e) {
                trigger_error($e->errorMessage());
            }
            catch(Exception $e) {
                trigger_error($e->getMessage());
            }
        } else {
            $mail->Send();
        }
    }
    
    public function old_send() {
        if (!$this->to):
            trigger_error('Error: E-Mail to required!');
        endif;
        
        if (!$this->from):
            trigger_error('Error: E-Mail from required!');
        endif;
        
        if (!$this->sender):
            trigger_error('Error: E-Mail sender required!');
        endif;
        
        if (!$this->subject):
            trigger_error('Error: E-Mail subject required!');
        endif;
        
        if ((!$this->text) && (!$this->html)):
            trigger_error('Error: E-Mail message required!');
        endif;
        
        if (is_array($this->to)):
            $to = implode(',', $this->to);
        else:
            $to = $this->to;
        endif;
        
        $boundary = '----=_NextPart_' . md5(time());
        
        $header = 'MIME-Version: 1.0' . $this->newline;
        
        if ($this->protocol != 'mail'):
            $header.= 'To: ' . $to . $this->newline;
            $header.= 'Subject: ' . '=?UTF-8?B?' . base64_encode($this->subject) . '?=' . $this->newline;
        endif;
        
        $header.= 'Date: ' . date('D, d M Y H:i:s O') . $this->newline;
        $header.= 'From: =?UTF-8?B?' . base64_encode($this->sender) . '?=' . ' <' . $this->from . '>' . $this->newline;
        $header.= 'Reply-To: =?UTF-8?B?' . base64_encode($this->sender) . '?=' . ' <' . $this->from . '>' . $this->newline;
        $header.= 'Return-Path: ' . $this->from . $this->newline;
        $header.= 'X-Mailer: PHP/' . phpversion() . $this->newline;
        $header.= 'Content-Type: multipart/related; boundary="' . $boundary . '"' . $this->newline . $this->newline;
        
        if (!$this->html):
            $message = '--' . $boundary . $this->newline;
            $message.= 'Content-Type: text/plain; charset="utf-8"' . $this->newline;
            $message.= 'Content-Transfer-Encoding: 8bit' . $this->newline . $this->newline;
            $message.= $this->text . $this->newline;
        else:
            $message = '--' . $boundary . $this->newline;
            $message.= 'Content-Type: multipart/alternative; boundary="' . $boundary . '_alt"' . $this->newline . $this->newline;
            $message.= '--' . $boundary . '_alt' . $this->newline;
            $message.= 'Content-Type: text/plain; charset="utf-8"' . $this->newline;
            $message.= 'Content-Transfer-Encoding: 8bit' . $this->newline . $this->newline;
            
            if ($this->text):
                $message.= $this->text . $this->newline;
            else:
                $message.= 'This is a HTML email and your email client software does not support HTML email!' . $this->newline;
            endif;
            
            $message.= '--' . $boundary . '_alt' . $this->newline;
            $message.= 'Content-Type: text/html; charset="utf-8"' . $this->newline;
            $message.= 'Content-Transfer-Encoding: 8bit' . $this->newline . $this->newline;
            $message.= $this->html . $this->newline;
            $message.= '--' . $boundary . '_alt--' . $this->newline;
        endif;
        
        foreach ($this->attachments as $attachment):
            if (file_exists($attachment)):
                $handle = fopen($attachment, 'r');
                
                $content = fread($handle, filesize($attachment));
                
                fclose($handle);
                
                $message.= '--' . $boundary . $this->newline;
                $message.= 'Content-Type: application/octet-stream; name="' . basename($attachment) . '"' . $this->newline;
                $message.= 'Content-Transfer-Encoding: base64' . $this->newline;
                $message.= 'Content-Disposition: attachment; filename="' . basename($attachment) . '"' . $this->newline;
                $message.= 'Content-ID: <' . basename(urlencode($attachment)) . '>' . $this->newline;
                $message.= 'X-Attachment-Id: ' . basename(urlencode($attachment)) . $this->newline . $this->newline;
                $message.= chunk_split(base64_encode($content));
            endif;
        endforeach;
        
        $message.= '--' . $boundary . '--' . $this->newline;
        
        if ($this->protocol == 'mail'):
            ini_set('sendmail_from', $this->from);
            
            if ($this->parameter):
                mail($to, '=?UTF-8?B?' . base64_encode($this->subject) . '?=', $message, $header, $this->parameter);
            else:
                mail($to, '=?UTF-8?B?' . base64_encode($this->subject) . '?=', $message, $header);
            endif;
        elseif ($this->protocol == 'smtp'):
            $is_tls = substr($this->smtp_hostname, 0, 3) == 'tls';
            $hostname = $is_tls ? substr($this->smtp_hostname, 6) : $this->smtp_hostname;
            $handle = fsockopen($hostname, $this->smtp_port, $errno, $errstr, $this->smtp_timeout);
            
            if (!$handle):
                trigger_error('Error: ' . $errstr . ' (' . $errno . ')');
            else:
                if (substr(PHP_OS, 0, 3) != 'WIN'):
                    socket_set_timeout($handle, $this->smtp_timeout, 0);
                endif;
                
                while ($line = fgets($handle, 515)):
                    if (substr($line, 3, 1) == ' '):
                        break;
                    endif;
                endwhile;
                
                fputs($handle, 'EHLO ' . getenv('SERVER_NAME') . "\r\n");
                
                $reply = '';
                
                while ($line = fgets($handle, 515)):
                    $reply.= $line;
                    
                    if (substr($line, 3, 1) == ' '):
                        break;
                    endif;
                endwhile;
                
                if (substr($reply, 0, 3) != 250):
                    trigger_error('Error: EHLO not accepted from server!');
                endif;
                
                if ($is_tls):
                    fputs($handle, 'STARTTLS' . "\r\n");
                    
                    $reply = '';
                    
                    while ($line = fgets($handle, 515)):
                        $reply.= $line;
                        
                        if (substr($line, 3, 1) == ' '):
                            break;
                        endif;
                    endwhile;
                    
                    if (substr($reply, 0, 3) != 220):
                        trigger_error('Error: STARTTLS not accepted from server!');
                    endif;
                    
                    stream_socket_enable_crypto($handle, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
                endif;
                
                if (!empty($this->smtp_username) && !empty($this->smtp_password)):
                    fputs($handle, 'EHLO ' . getenv('SERVER_NAME') . "\r\n");
                    
                    $reply = '';
                    
                    while ($line = fgets($handle, 515)):
                        $reply.= $line;
                        
                        if (substr($line, 3, 1) == ' '):
                            break;
                        endif;
                    endwhile;
                    
                    if (substr($reply, 0, 3) != 250):
                        trigger_error('Error: EHLO not accepted from server!');
                    endif;
                    
                    fputs($handle, 'AUTH LOGIN' . "\r\n");
                    
                    $reply = '';
                    
                    while ($line = fgets($handle, 515)):
                        $reply.= $line;
                        
                        if (substr($line, 3, 1) == ' '):
                            break;
                        endif;
                    endwhile;
                    
                    if (substr($reply, 0, 3) != 334):
                        trigger_error('Error: AUTH LOGIN not accepted from server!');
                    endif;
                    
                    fputs($handle, base64_encode($this->smtp_username) . "\r\n");
                    
                    $reply = '';
                    
                    while ($line = fgets($handle, 515)):
                        $reply.= $line;
                        
                        if (substr($line, 3, 1) == ' '):
                            break;
                        endif;
                    endwhile;
                    
                    if (substr($reply, 0, 3) != 334):
                        trigger_error('Error: Username not accepted from server!');
                    endif;
                    
                    fputs($handle, base64_encode($this->smtp_password) . "\r\n");
                    
                    $reply = '';
                    
                    while ($line = fgets($handle, 515)):
                        $reply.= $line;
                        
                        if (substr($line, 3, 1) == ' '):
                            break;
                        endif;
                    endwhile;
                    
                    if (substr($reply, 0, 3) != 235):
                        trigger_error('Error: Password not accepted from server!');
                    endif;
                else:
                    fputs($handle, 'HELO ' . getenv('SERVER_NAME') . "\r\n");
                    
                    $reply = '';
                    
                    while ($line = fgets($handle, 515)):
                        $reply.= $line;
                        
                        if (substr($line, 3, 1) == ' '):
                            break;
                        endif;
                    endwhile;
                    
                    if (substr($reply, 0, 3) != 250):
                        trigger_error('Error: HELO not accepted from server!');
                    endif;
                endif;
                
                if ($this->verp):
                    fputs($handle, 'MAIL FROM: <' . $this->from . '>XVERP' . "\r\n");
                else:
                    fputs($handle, 'MAIL FROM: <' . $this->from . '>' . "\r\n");
                endif;
                
                $reply = '';
                
                while ($line = fgets($handle, 515)):
                    $reply.= $line;
                    
                    if (substr($line, 3, 1) == ' '):
                        break;
                    endif;
                endwhile;
                
                if (substr($reply, 0, 3) != 250):
                    trigger_error('Error: MAIL FROM not accepted from server!');
                endif;
                
                if (!is_array($this->to)):
                    fputs($handle, 'RCPT TO: <' . $this->to . '>' . "\r\n");
                    
                    $reply = '';
                    
                    while ($line = fgets($handle, 515)):
                        $reply.= $line;
                        
                        if (substr($line, 3, 1) == ' '):
                            break;
                        endif;
                    endwhile;
                    
                    if ((substr($reply, 0, 3) != 250) && (substr($reply, 0, 3) != 251)):
                        trigger_error('Error: RCPT TO not accepted from server!');
                    endif;
                else:
                    foreach ($this->to as $recipient):
                        fputs($handle, 'RCPT TO: <' . $recipient . '>' . "\r\n");
                        
                        $reply = '';
                        
                        while ($line = fgets($handle, 515)):
                            $reply.= $line;
                            
                            if (substr($line, 3, 1) == ' '):
                                break;
                            endif;
                        endwhile;
                        
                        if ((substr($reply, 0, 3) != 250) && (substr($reply, 0, 3) != 251)):
                            trigger_error('Error: RCPT TO not accepted from server!');
                        endif;
                    endforeach;
                endif;
                
                fputs($handle, 'DATA' . "\r\n");
                
                $reply = '';
                
                while ($line = fgets($handle, 515)):
                    $reply.= $line;
                    
                    if (substr($line, 3, 1) == ' '):
                        break;
                    endif;
                endwhile;
                
                if (substr($reply, 0, 3) != 354):
                    trigger_error('Error: DATA not accepted from server!');
                endif;
                
                // According to rfc 821 we should not send more than 1000 including the CRLF
                $message = str_replace("\r\n", "\n", $header . $message);
                $message = str_replace("\r", "\n", $message);
                
                $lines = explode("\n", $message);
                
                foreach ($lines as $line):
                    $results = str_split($line, 998);
                    
                    foreach ($results as $result):
                        if (substr(PHP_OS, 0, 3) != 'WIN'):
                            fputs($handle, $result . "\r\n");
                        else:
                            fputs($handle, str_replace("\n", "\r\n", $result) . "\r\n");
                        endif;
                    endforeach;
                endforeach;
                
                fputs($handle, '.' . "\r\n");
                
                $reply = '';
                
                while ($line = fgets($handle, 515)):
                    $reply.= $line;
                    
                    if (substr($line, 3, 1) == ' '):
                        break;
                    endif;
                endwhile;
                
                if (substr($reply, 0, 3) != 250):
                    trigger_error('Error: DATA not accepted from server!');
                endif;
                
                fputs($handle, 'QUIT' . "\r\n");
                
                $reply = '';
                
                while ($line = fgets($handle, 515)):
                    $reply.= $line;
                    
                    if (substr($line, 3, 1) == ' '):
                        break;
                    endif;
                endwhile;
                
                if (substr($reply, 0, 3) != 221):
                    trigger_error('Error: QUIT not accepted from server!');
                endif;
                
                fclose($handle);
            endif;
        endif;
    }
}
