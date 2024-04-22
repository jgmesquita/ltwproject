<?php 
require_once(__DIR__ . '/../templates/basic.tpl.php');

require_once(__DIR__ . '/../templates/items.tpl.php');

require_once(__DIR__ . '/../templates/user.tpl.php');

function convertCurrency($amount, $from_currency, $to_currency) {
    $api_url = "https://api.exchangerate-api.com/v4/latest/$from_currency";
    $exchange_rates = json_decode(file_get_contents($api_url), true);
    if (isset($exchange_rates['rates'][$to_currency])) {
        $converted_amount = $amount * $exchange_rates['rates'][$to_currency];
        return $converted_amount;
    } else {
        return "Currency not found in exchange rates data.";
    }
}

echo convertCurrency($_GET['cost'], 'EUR', $_GET['currency']);
