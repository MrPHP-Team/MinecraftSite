<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<?php
#подключаем файлы
require __DIR__ . './src/MinecraftPing.php';
require __DIR__ . './src/MinecraftPingException.php';

#используем нужные
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

try {
    define( 'MQ_SERVER_ADDR', 'localhost' );
    define( 'MQ_SERVER_PORT', 25565 );
    define( 'MQ_TIMEOUT', 1 );

    $ip = MQ_SERVER_ADDR;
    $port = MQ_SERVER_PORT;
    $text = "Aerolite";
    $textError = "Тех неполадки";

    $Query = new MinecraftPing( $ip, $port);

    $infoServer = $Query->Query(); //получим информацию о сервере

    $mPlayers = $infoServer['players']['max']; //максимум игроков

    $oPlayers = $infoServer['players']['online']; //сейчас онлайн

    $percent = $oPlayers*100/$mPlayers; //узнаем процент

    print sprintf("
            <div  style=\"padding:5px; \">%s
                <div class=\"progress\">
                    <div class=\"progress-bar progress-bar-striped progress-bar-animated bg-success\" role=\"progressbar\" style=\"width: $percent \" aria-valuenow=\"$percent\" aria-valuemin=\"0\" aria-valuemax=\"$mPlayers\">
                    </div>
                </div>
    ", $text);
    print $oPlayers.'/'.$mPlayers.' ('.$percent.'%)</div>';
}
catch( MinecraftPingException $e ) //в случае проблем с подключением
{
    print ''.
        $text.' <br><progress value="0" max="0" width="220px"></progress>';
    print '<br>'.$textError.'</div>';
}
?>
</html>
