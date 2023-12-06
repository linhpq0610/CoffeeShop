<?php
  return
    "<meta charset='UTF-8'>
    <style>
      .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
      }
      .thank-you {
        font-style: italic;
        margin-top: 20px;
      }
    </style>
    <div class='container'>
      <p>Xin chào,</p>
      <p>Cảm ơn vì đã tin tưởng chúng tôi. Đây là mật khẩu đăng nhập của bạn: <strong>" . $_SESSION['default-password'] . "</strong>.</p>
      <p>Cảm ơn và chúc bạn một ngày tốt lành!</p>
      <p class='thank-you'>Trân trọng,</p>
      <p class='thank-you'><a style='text-decoration: none; color: unset' href='" . (ROOT_URL . HOME_ROUTE) . "'><strong>" . WEB_NAME . "</strong></a></p>
    </div>";
?>
