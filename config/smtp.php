<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

function enviarEmailRedefinicao($emailDestino, $rm, $linkRedefinicao, $linkSuporte) {
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'fala.i.contact@gmail.com';
        $mail->Password   = 'veitocpyuezkjcbe'; // App password do Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remetente e destinatário
        $mail->setFrom('fala.i.contact@gmail.com', 'Fala.i Suporte');
        $mail->addAddress($emailDestino);

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Redefinição de Senha Fala.i';

        $banner_url = "https://i.postimg.cc/QNmfFJKx/banner.png";

        $mail->Body = "
        <html>
          <body style='font-family: Arial, sans-serif; background-color: #f3f0fa; padding: 20px;'>
            <div style='max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 10px; padding: 25px; box-shadow: 0px 4px 8px rgba(0,0,0,0.1);'>

              <img src='{$banner_url}' alt='Banner' style='width: 100%; max-height: 200px; object-fit: cover; border-radius: 8px 8px 0 0;'>

              <h2 style='color: #5e35b1;'>🔐 Redefinição de Senha</h2>

              <p>Olá,</p>

              <p>Recebemos uma solicitação para redefinir sua senha. Se foi você quem solicitou, clique abaixo:</p>

              <p style='text-align: center; margin: 30px 0;'>
                <a href='{$linkRedefinicao}' style='background-color: #7e57c2; color: white; padding: 14px 28px; border-radius: 6px; text-decoration: none; font-size: 16px; font-weight: bold;'>
                   Redefinir Senha
                </a>
              </p>

              <p>Se não reconhece esta solicitação, fale com o suporte:</p>

              <p style='text-align: center; margin: 25px 0;'>
                <a href='{$linkSuporte}' style='background-color: #7e57c2; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-size: 15px; font-weight: bold;'>
                   Falar com o Suporte
                </a>
              </p>

              <p style='font-size: 14px; color: #666;'>💡 Nunca compartilhe sua senha com ninguém.</p>
            </div>
          </body>
        </html>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");
        return false;
    }
}
