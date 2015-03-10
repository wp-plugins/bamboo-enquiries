<?php
/******************************************************************/

	$to_address    	= $_POST["bamboo_enquiry_form_to_address"];    	// ADDRESS TO SEND ENQUIRIES TO
	$from_address  	= $_POST["bamboo_enquiry_form_from_address"];	// ADDRESS TO SEND ENQUIRIES FROM
	$reply_address	= $from_address;                               	// DEFAULT REPLY ADDRESS IF ONE IS NOT SUPPLEID
	$subject       	= 'Website Enquiry';                           	// START OF THE EMAIL SUBJECT
	$intro         	= '<p>There has been an enquiry sent from your website, the details are below:</p>'; // INTRO TO THE EMAIL

	// ESTABLISH IF THE FORM IS BLANK
	$all_blank = true;
	foreach ( $_POST as $key => $value ) {
		if ( ( substr( $key, 0, 20) != "bamboo_enquiry_form_" && $key != "undefined" ) && ( $value != '' ) ) {
			$all_blank = false;
		}
	}

	// IF THE FORM ISN'T BLANK WE CAN SEND THE ENQUIRY
	if( ! $all_blank ) {

		// GENERATE A RANDOM MIME CONTENT BOUNDARY
		$mime_boundary = uniqid('noodle-enquiries');

		// CONSTRUCT THE HEADERS
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-Type: multipart/mixed;boundary=\"$mime_boundary\"\r\n";
		$headers .= "From: $from_address" . "\r\n";
		$headers .= "Reply-To: $reply_address" . "\r\n";

		// CONSTRUCT THE FORM CONTENT
		$content = "<html><head><title>$subject</title></head><body>$intro";
		foreach ( $_POST as $key => $value ) {
			if( substr( $key, 0, 20 ) != "bamboo_enquiry_form_" && $key != "undefined" ) {
				if( is_array( $value ) ) {
					$text = '';
					foreach( $value as $val ) {
						if( ''!=$text ) {
							$text.=', ';
						}
						$text.= $val;
					}
				} else {
					$text = $value;
				}
				$content .= "<p><strong>" . str_replace( "_", " ", $key ) . ":</strong>&nbsp;" . $text . "</p>";
			}
		}

		$file_attached = false;
		foreach ( $_FILES as $key => $value ) {
			if($_FILES[$key]["size"]>0) {
				$file_attached = true;
			}
		}
		if( true==$file_attached ) {
			$content .= "<p><strong>File Attached</strong></p>";
		}

		$content .= "</body></html>";

		// CONSTRUCT THE MESSAGE
		$message  = "This is a MIME encoded message.";
		$message .= "\r\n\r\n--" . $mime_boundary . "\r\n";
		$message .= "Content-Type: text/html;charset=utf-8\r\n\r\n";
		$message .= $content;
		$message .= "\r\n\r\n--" . $mime_boundary . "\r\n";

		// ADD ANY SUBMITTED FILES
		foreach ( $_FILES as $key => $value ) {
			if($_FILES[$key]["size"]>0) {
				$message .= "Content-Type: {" . $_FILES[$key]["type"] . "}; name=\"" . $_FILES[$key]["name"] . "\"\r\n";
				$message .= "Content-Transfer-Encoding: base64\r\n";
				$message .= "Content-Disposition: attachment;\r\n; filename=\"" . $_FILES[$key]["name"] . "\"\r\n\r\n";
				$message .= chunk_split(base64_encode(file_get_contents($_FILES[$key]["tmp_name"])));
				$message .= "\r\n\r\n--" . $mime_boundary . "\r\n";
			}
		}

		// SEND THE MESSAGE
		mail( $to_address, $subject, $message, $headers );

	}

	// REDIRECT BACK TO CALLING PAGE
    header("Location: ".$_SERVER['HTTP_REFERER']."?sent");

/******************************************************************/
?>
