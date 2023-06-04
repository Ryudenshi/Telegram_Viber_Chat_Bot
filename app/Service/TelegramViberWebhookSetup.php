<?php //disabled file !!!

$telegramBotToken = '6097503862:AAHdE6EKpMaXx_MDpo3-7Cz9P2PBLDc_XRs';
$webhookUrl = 'https://api.telegram.org/bot' . $telegramBotToken . '/setWebhook';
$secretToken = bin2hex(random_bytes(16));

$data = [
    'url' => 'http://localhost/Telegram_Viber_Chat_Bot/public/telegram/webhook', 
];

$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
            "X-Telegram-Bot-Api-Secret-Token: " . $secretToken . "\r\n",
        'method' => 'POST',
        'content' => http_build_query($data),
    ],
];

$context = stream_context_create($options);
$response = file_get_contents($webhookUrl, false, $context);

if ($response === false) {
    echo "Failed to set webhook URL.";
} else {
    $responseData = json_decode($response, true);
    if ($responseData['ok']) {
        echo "Webhook URL set successfully.";
    } else {
        echo "Failed to set webhook URL. Error: {$responseData['description']}";
    }
}
