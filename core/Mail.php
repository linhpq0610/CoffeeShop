<?php 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  class Mail extends Controller {
    private $mailInstance;

    public function __construct() {
      $this->mailInstance = new PHPMailer(true);
      $this->mailInstance->SMTPDebug = SMTP::DEBUG_SERVER;
      $this->mailInstance->isSMTP();
      $this->mailInstance->Host = SMTP_SERVER;
      $this->mailInstance->SMTPAuth = true;
      $this->mailInstance->Username = SMTP_USERNAME;
      $this->mailInstance->Password = SMTP_PASSWORD;
      $this->mailInstance->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $this->mailInstance->Port = 465;
    }

    public function setRecipients($emailAddresses) {
      [$mailSend, $mailReceive] = $emailAddresses;
      $this->mailInstance->setFrom($mailSend);
      $this->mailInstance->addAddress($mailReceive);
    }

    public function setContent($content) {
      [$subject, $body] = $content;
      $this->mailInstance->isHTML(true);
      $this->mailInstance->Subject = $subject;
      $this->mailInstance->Body = $body;
    }

    static public function send($emailAddresses, $content) {
      $mail = new self();
      $mail->setRecipients($emailAddresses);
      $mail->setContent($content);
      $mail->mailInstance->send();
    }
  }
?>
