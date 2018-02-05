<?php
function xl_sendmail($to_email,$subject,$content)
{
    $message = "<p>Vui lòng bấm vào link bên dưới để kích hoạt tài khoản.</p>";
    $message .= '<p><a href="'.$content.'" target="_blank">'.$content.'</a></p>';
    $header = "From:php1608e@gmail.com \r\n";
    $header = "Cc:phpdemocntt@gmail.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    $retval = mail ($to_email,$subject,$message,$header);
    if($retval)
    {
      return TRUE;
    }
    return FALSE;
}
?>