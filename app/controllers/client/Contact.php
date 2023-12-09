<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Contact extends Controller
{
  private $__client;
  public function index()
  {
    $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/contact/contact';
    $this->_data['pageTitle'] = 'Liên hệ';
    $this->_data["contentOfPage"] = [];
    $this->renderClientLayout($this->_data);
  }
  public function SendMail()
  {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host = SMTP_SERVER;
      ;
      $mail->SMTPAuth = true;
      $mail->Username = SMTP_USERNAME;
      $mail->Password = SMTP_PASSWORD;
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->setFrom($email, $name, $message);
      $mail->addAddress('tranchinguyen1307@gmail.com', 'Chí Nguyên 2');

      $subject = "Thông báo mới!";
      $mail->Subject = utf8_encode($subject);
      $mail->Body = $message;

      $mail->send();
      $this->sendMailSuccess();
      exit;
    } catch (Exception $e) {
      $messageAlert = $mail->ErrorInfo;
      $this->sendMailFailure($messageAlert);
    }
  }
  public function setDefaultData($data)
  {
    $defaultData = [
      'messageSuccess' => '',
      'messageAlert' => '',
      'name' => '',
      'email' => '',
    ];
    $defaultData = $this->mergeDataIntoDefault($defaultData, $data);
    return $defaultData;
  }
  public function showFormContact($formData = [])
  {
    $formData = $this->setDefaultData($formData);
    $this->_data['pathToPage'] = CLIENT_VIEW_DIR . '/contact/contact';
    $this->_data['pageTitle'] = 'Đăng ký';
    $this->_data['contentOfPage'] = $formData;
    $this->renderClientLayout($this->_data);
  }
  public function sendMailSuccess()
  {
    $messageSuccess =
      '<p class="p-3">
            Gửi mail thành công.
          </p>';
    $formData = [
      'messageSuccess' => $messageSuccess,
    ];
    $this->showFormContact($formData);
  }
  public function sendMailFailure($messageAlert)
  {
    $messageFailure =
      '<p class="p-3">
      Có lỗi xảy ra trong quá trình gửi email: ' . $messageAlert . '</p>';
    $formData = [
      'messageAlert' => $messageFailure,
    ];
    $this->showFormContact($formData);
  }
}
?>