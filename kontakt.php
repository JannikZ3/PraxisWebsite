<?php
/**
 * Kontaktformular – Versand per E-Mail (läuft auf IONOS-Webhosting mit PHP).
 *
 * EINSTELLEN:
 *   $empfaenger  = Ihre Adresse, an die Anfragen gehen sollen.
 *   $absender    = eine Adresse IHRER Domain (z. B. formular@ihre-domain.de),
 *                  sonst landen die Mails bei IONOS oft im Spam oder werden abgewiesen.
 */
$empfaenger = 'kontakt@example.de';
$absender   = 'formular@example.de';
$betreff    = 'Neue Anfrage über die Praxis-Website';

function zurueck($status) {
    header('Location: kontakt.html?status=' . $status . '#inhalt', true, 303);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    zurueck('fehler');
}

// Spam-Falle: Dieses Feld ist für Menschen unsichtbar und muss leer bleiben.
if (!empty($_POST['website'])) {
    zurueck('ok');
}

function feld($name, $max = 200) {
    $wert = isset($_POST[$name]) ? trim((string) $_POST[$name]) : '';
    $wert = str_replace(["\r", "\0"], '', $wert);
    return mb_substr($wert, 0, $max);
}

$name         = str_replace("\n", ' ', feld('name', 120));
$email        = str_replace("\n", '', feld('email', 200));
$telefon      = str_replace("\n", ' ', feld('telefon', 60));
$versicherung = str_replace("\n", ' ', feld('versicherung', 60));
$nachricht    = feld('nachricht', 5000);
$einwilligung = feld('einwilligung', 5);

if ($name === '' || $nachricht === '' || $einwilligung !== 'ja'
    || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    zurueck('fehler');
}

$text  = "Neue Anfrage über das Kontaktformular\n";
$text .= "======================================\n\n";
$text .= "Name:          $name\n";
$text .= "E-Mail:        $email\n";
$text .= "Telefon:       " . ($telefon !== '' ? $telefon : '-') . "\n";
$text .= "Versicherung:  " . ($versicherung !== '' ? $versicherung : '-') . "\n\n";
$text .= "Nachricht:\n$nachricht\n";

$kopfzeilen  = 'From: =?UTF-8?B?' . base64_encode('Praxis-Website') . "?= <$absender>\r\n";
$kopfzeilen .= "Reply-To: $email\r\n";
$kopfzeilen .= "MIME-Version: 1.0\r\n";
$kopfzeilen .= "Content-Type: text/plain; charset=UTF-8\r\n";
$kopfzeilen .= "Content-Transfer-Encoding: 8bit\r\n";

$ok = mail(
    $empfaenger,
    '=?UTF-8?B?' . base64_encode($betreff) . '?=',
    $text,
    $kopfzeilen,
    '-f' . $absender
);

zurueck($ok ? 'ok' : 'fehler');
