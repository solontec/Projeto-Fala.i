<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';


function enviarEmailRedefinicao($emailDestino, $rm, $linkRedefinicao, $linkSuporte) {
    $mail = new PHPMailer(true);

    try {
        // Configuração SMTP (Gmail)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'fala.i.contact@gmail.com';
        $mail->Password   = 'veitocpyuezkjcbe'; // senha de app do Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Cabeçalho
        $mail->setFrom('fala.i.contact@gmail.com', 'Fala.i Suporte');
        $mail->addAddress($emailDestino);

        // Corpo
        $mail->isHTML(true);
        $mail->Subject = '🔐 Redefinição de Senha - Fala.i';
        $banner_url = "https://i.postimg.cc/QNmfFJKx/banner.png";
        
        $mail->Body = "
    <html>
    <body style='font-family: Arial, sans-serif; background-color: #f3f0fa; padding: 30px;'>
        <div style='max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);'>
            
            <img src='cid:banner_cid' alt='Banner' style='width:100%; display:block;'>

            <div style='padding: 30px;'>
                <h2 style='color: #5e35b1; text-align:center;'>Olá, {$emailDestino}</h2>

                <p style='font-size: 16px; color: #333; line-height: 1.6;'>
                    Recebemos uma solicitação para redefinir a sua senha no <strong>Fala.i</strong>.
                    Clique no botão abaixo para criar uma nova senha:
                </p>

                <div style='text-align: center; margin: 30px 0;'>
                    <a href='{$linkRedefinicao}' 
                       style='background-color: #7e57c2; color: white; padding: 14px 30px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 16px; display:inline-block;'>
                       🔄 Redefinir Senha
                    </a>
                </div>

                <p style='font-size: 14px; color: #555;'>
                    Se você não solicitou essa alteração, pode simplesmente ignorar este e-mail.
                    Caso tenha dúvidas, entre em contato com nosso suporte:
                </p>

                <div style='text-align:center; margin: 20px 0;'>
                    <a href='{$linkSuporte}' 
                       style='background-color: #7e57c2; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: 500;'>
                       💬 Falar com o Suporte
                    </a>
                </div>

                <hr style='border:none; border-top:1px solid #eee; margin: 30px 0;'>

                <p style='font-size: 13px; color: #777; text-align:center;'>
                    ⚠️ Este link expira em <strong>1 hora</strong> por motivos de segurança.<br>
                    © " . date('Y') . " Fala.i — Todos os direitos reservados.
                </p>
            </div>
        </div>
    </body>
    </html>";

    // Envia o e-mail
    $mail->send();
    
        return true;
    } catch (Exception $e) {
        error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");
        return false;
    }
}
