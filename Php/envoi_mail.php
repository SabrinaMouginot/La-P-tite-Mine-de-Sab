<?php
require 'vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;


$dotenv = new Dotenv();
$dotenv->usePutenv();
$dotenv->loadEnv(__DIR__ . '\.env');

$phpmailer = new PHPMailer();
$phpmailer->SMTPDebug = 2;
$phpmailer->isSMTP();
$phpmailer->Host = getenv('MAIL_HOST') ?? 'localhost';
$phpmailer->SMTPAuth = true;
$phpmailer->Port = getenv('MAIL_PORT') ?? 25;
$phpmailer->Username = getenv('MAIL_USERNAME') ?? 'noreply';
$phpmailer->Password = getenv('MAIL_PASSWORD') ?? '';
$phpmailer->CharSet = 'UTF-8';

//$phpmailer->setFrom(getenv('MAIL_FROM'), getenv('MAIL_FROM_NAME'));

//$phpmailer->msgHTML(file_get_contents('message.html'), __DIR__);
//$mail->addAttachment('test.txt');

if (!validerFormulaire()) {
    return;
}


function validerFormulaire()
{

    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    if (empty($_POST))
        return false;


    if (!isset($_POST['nom']) || !isset($_POST['email']) || !isset($_POST['message']))
        return false;

    $email = filter_input(
        INPUT_POST,
        'email',
        FILTER_VALIDATE_EMAIL
    );

    if (!$email)
        return false;

    echo 'formulaire ok';

    $email = trim($email);
    $nom = trim(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    echo 'sendmail';

    sendmail($email, $nom, $message);

    return true;
}

function sendmail(
    string $userEmail,
    string $userName,
    string $message = "message",
    string $subject = '[LA P\'tite Mine De Sab]'
) {

    global $phpmailer;

    $sender = getenv('MAIL_FROM') ?? $phpmailer->Username . '@' . $phpmailer->Host;
    $from = getenv('MAIL_FROM') ?? $sender;
    $fromName = getenv('MAIL_FROM_NAME') ?? $sender;
    $to = $from;
    $toName = $fromName;

    $phpmailer->Sender = $sender;
    $phpmailer->SetFrom($from, $fromName);
    $phpmailer->addAddress($to, $toName);
    $phpmailer->Subject = $subject;
    $phpmailer->msgHTML('<p>' . $userEmail . ' ' . $userName . '<br></p>' . '<p>' . $message . '</p>');
    $phpmailer->Body = $userEmail . ' ' . $userName  . '   <br>   ' . $message;

    if (!$phpmailer->send()) {
        echo 'Erreur de Mailer : ' . $phpmailer->ErrorInfo;
        return false;
    } else {
        echo 'Le message a été envoyé.';
        echo '<div>
                <a href="./La P\'tite Mine de Sab.html">
                    <input class="Website styled"
                        type="button"
                        value="Retour vers le site">
                </a>
            </div>';
        return true;
    }
}
