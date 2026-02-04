<?php
/**
 * Created by IntelliJ IDEA.
 * User: cilis
 * Date: 09-Sep-17
 * Time: 4:51 PM
 */
echo \yii\helpers\Html::button('Checkout',['class'=>'btn btn-success']);


$ch = curl_init();
$clientId = "AdQZZR0pDMaFA4NoySdii2imLEbfkGSvqVi1deyisjOi50TFPJ0Rpo5vWMojBwAi0tEewi5P-D8ezSBG";
$secret = "EIuHvxhGriuTw36zlIZFKJtLRX-FQQihLUMco3flQnrFzAaI3_299jyDR95lmwWBN9xs4UDD_bsgNOgd";

curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$result = curl_exec($ch);

if(empty($result))die("Error: No response.");
else
{
    $json = json_decode($result);
    print_r($json->access_token);
}

curl_close($ch);

?>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<div id="paypal-button"></div>

<script>
    paypal.Button.render({

        env: 'production', // Or 'sandbox',

        commit: true, // Show a 'Pay Now' button

        payment: function() {
            // Set up the payment here
        },

        onAuthorize: function(data, actions) {
            // Execute the payment here
        }

    }, '#paypal-button');
</script>

