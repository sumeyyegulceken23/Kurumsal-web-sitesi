<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini al
    $ad = $_POST["ad"];
    $email = $_POST["email"];
    $mesaj = $_POST["mesaj"];

    // Alıcı e-posta adresi
    $alici_email = "dinamikkisisel@gmail.com";

    // PHPMailer nesnesi oluştur
    $mail = new PHPMailer(true);

    try {
        // SMTP sunucusuna bağlan
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com'; // SMTP sunucusunun adresi
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your@example.com'; // SMTP hesabınızın kullanıcı adı
        $mail->Password   = 'your_password'; // SMTP hesabınızın şifresi
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587; // SMTP port numarası

        // Alıcı, konu ve içerik ayarları
        $mail->setFrom($email, $ad);
        $mail->addAddress($alici_email); // Alıcı e-posta adresi
        $mail->Subject = 'İletişim Formu - ' . $ad;
        $mail->Body    = "Ad: $ad\nE-posta: $email\nMesaj: $mesaj";

        // E-postayı gönder
        $mail->send();
        echo "E-posta başarıyla gönderildi.";
    } catch (Exception $e) {
        echo "E-posta gönderilirken bir hata oluştu: {$mail->ErrorInfo}";
    }
}
?>
