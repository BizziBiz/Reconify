<?php

class email{
	public static function sendMail($vars){
		$headers = 'From: '.$vars['from'];
		
		$return = email::mail_attachment($vars['url'].'.pdf', 'files/', $vars['to'], $vars['from'], $cars['from'], $vars['from'], 'New Quick Report from Bizzibiz!', stripcslashes(rawurldecode($vars['msg'])));
		
		if($return){
			echo 'true';
		}else{
			echo 'false';
		}
	}
	
	function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
	    $file = $path.$filename;
	    $file_size = filesize($file);
	    
	    $handle = fopen($file, "r");
	    $content = fread($handle, $file_size);
	    fclose($handle);
	    
	    $content = chunk_split(base64_encode($content));
	    $uid = md5(uniqid(time()));
	    $name = basename($file);
	    
	    $header = "From: ".$from_name." <".$from_mail.">\r\n";
	    $header .= "Reply-To: ".$replyto."\r\n";
	    $header .= "MIME-Version: 1.0\r\n";
	    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
	    $header .= "This is a multi-part message in MIME format.\r\n";
	    $header .= "--".$uid."\r\n";
	    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
	    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
	    $header .= $message."\r\n\r\n";
	    $header .= "--".$uid."\r\n";
	    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
	    $header .= "Content-Transfer-Encoding: base64\r\n";
	    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
	    $header .= $content."\r\n\r\n";
	    $header .= "--".$uid."--";
	    
	    if (mail($mailto, $subject, "", $header)) {
	        return true;
	    } else {
	        return false;
	    }
	}

}

?>