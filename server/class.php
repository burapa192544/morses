<?php



class ChatHandler {
	function send($message) {
		global $clientSocketArray;
		$messageLength = strlen($message);
		foreach($clientSocketArray as $clientSocket)
		{
			@socket_write($clientSocket,$message,$messageLength);
		}
		return true;
	}

	function unseal($socketData) {
		$length = ord($socketData[1]) & 127;
		if($length == 126) {
			$masks = substr($socketData, 4, 4);
			$data = substr($socketData, 8);
		}
		elseif($length == 127) {
			$masks = substr($socketData, 10, 4);
			$data = substr($socketData, 14);
		}
		else {
			$masks = substr($socketData, 2, 4);
			$data = substr($socketData, 6);
		}
		$socketData = "";
		for ($i = 0; $i < strlen($data); ++$i) {
			$socketData .= $data[$i] ^ $masks[$i%4];
		}
		return $socketData;
	}

	function seal($socketData) {
		$b1 = 0x80 | (0x1 & 0x0f);
		$length = strlen($socketData);
		
		if($length <= 125)
			$header = pack('CC', $b1, $length);
		elseif($length > 125 && $length < 65536)
			$header = pack('CCn', $b1, 126, $length);
		elseif($length >= 65536)
			$header = pack('CCNN', $b1, 127, $length);
		return $header.$socketData;
	}

	function doHandshake($received_header,$client_socket_resource, $host_name, $port) {
		$headers = array();
		$lines = preg_split("/\r\n/", $received_header);
		foreach($lines as $line)
		{
			$line = chop($line);
			if(preg_match('/\A(\S+): (.*)\z/', $line, $matches))
			{
				$headers[$matches[1]] = $matches[2];
			}
		}

		$secKey = $headers['Sec-WebSocket-Key'];
		$secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
		$buffer  = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
		"Upgrade: websocket\r\n" .
		"Connection: Upgrade\r\n" .
		"WebSocket-Origin: $host_name\r\n" .
		"WebSocket-Location: ws://$host_name:$port/demo/shout.php\r\n".
		"Sec-WebSocket-Accept:$secAccept\r\n\r\n";
		socket_write($client_socket_resource,$buffer,strlen($buffer));
	}
	
	function newConnectionACK($client_ip_address) {
		$message = 'user ip ' . $client_ip_address.' connect';
		$messageArray = array('message'=>$message,'message_type'=>'chat-connection-ack');
		$ACK = $this->seal(json_encode($messageArray));
		return $ACK;
	}
	
	function connectionDisconnectACK($client_ip_address) {
		$message = 'user ' . $client_ip_address.' out';
		$messageArray = array('message'=>$message,'message_type'=>'chat-connection-ack');
		$ACK = $this->seal(json_encode($messageArray));
		return $ACK;
	}

	/*
	แก้ไขตรงนี้่ 
	*/
	
	function createChatBoxMessage($chat_user,$chat_box_message) {

		$a = '01';
		$b = '1000';
		$c = '1010';
		$d = '100';
		$e = '0';
		$f = '0010';
		$g = '110';
		$h = '0000';
		$ii = '00';
		$j = '0111';
		$k = '101';
		$l = '0100';
		$m = '11';
		$n = '10';
		$o = '111';
		$p = '010';
		$q = '1101';
		$r = '010';
		$s = '000';
		$t = '11';
		$u = '001';
		$v = '0001';
		$w = '001';
		$x = '1001';
		$y = '1011';
		$z = '1100';
	
		$zero = '11111';
		$one = '01111' ;
		$two = '00111' ;
		$three = '00011' ;
		$four = '00001' ;
		$five = '00000' ;
		$six = '10000' ;
		$seven = '11000' ;
		$eight = '11100' ;
		$nine = '11110' ;

		

		$chat_box_message = strtolower($chat_box_message);
		$num = strlen($chat_box_message) ;
		$i = 0 ;
		$keep = '' ;
    	$code = '' ;

		while($i < $num){
			if($chat_box_message[$i]=='a'){
				$keep = $keep . $a . " ";
			}else if($chat_box_message[$i]=='b'){
				$keep = $keep . $b. " ";
			}else if($chat_box_message[$i]=='c'){+
				$keep = $keep . $c. " ";
			}else if($chat_box_message[$i]=='d'){
				$keep = $keep . $d. " ";
			}else if($chat_box_message[$i]=='e'){
				$keep = $keep . $e. " ";
			}else if($chat_box_message[$i]=='f'){
				$keep = $keep . $f. " ";
			}else if($chat_box_message[$i]=='g'){
				$keep = $keep . $g. " ";
			}else if($chat_box_message[$i]=='h'){
				$keep = $keep . $h. " ";
			}else if($chat_box_message[$i]=='i'){
				$keep = $keep . $ii. " ";
			}else if($chat_box_message[$i]=='j'){
				$keep = $keep . $j. " ";
			}else if($chat_box_message[$i]=='k'){
				$keep = $keep . $k. " ";
			}else if($chat_box_message[$i]=='l'){
				$keep = $keep . $l. " ";
			}else if($chat_box_message[$i]=='m'){
				$keep = $keep . $m. " ";
			}else if($chat_box_message[$i]=='n'){
				$keep = $keep . $n. " ";
			}else if($chat_box_message[$i]=='o'){
				$keep = $keep . $o. " ";
			}else if($chat_box_message[$i]=='p'){
				$keep = $keep . $p. " ";
			}else if($chat_box_message[$i]=='q'){
				$keep = $keep . $q. " ";
			}else if($chat_box_message[$i]=='r'){
				$keep = $keep . $r. " ";
			}else if($chat_box_message[$i]=='s'){
				$keep = $keep . $s. " ";
			}else if($chat_box_message[$i]=='t'){
				$keep = $keep . $t. " ";
			}else if($chat_box_message[$i]=='u'){
				$keep = $keep . $u. " ";
			}else if($chat_box_message[$i]=='v'){
				$keep = $keep . $v. " ";
			}else if($chat_box_message[$i]=='w'){
				$keep = $keep . $w. " ";
			}else if($chat_box_message[$i]=='x'){
				$keep = $keep . $x. " ";
			}else if($chat_box_message[$i]=='y'){
				$keep = $keep . $y. " ";
			}else if($chat_box_message[$i]=='z'){
				$keep = $keep . $z. " ";
			}else if($chat_box_message[$i]=='1'){
				$keep = $keep . $one. " ";
			}else if($chat_box_message[$i]=='2'){
				$keep = $keep . $two. " ";
			}else if($chat_box_message[$i]=='3'){
				$keep = $keep . $three. " ";
			}else if($chat_box_message[$i]=='4'){
				$keep = $keep . $four. " ";
			}else if($chat_box_message[$i]=='5'){
				$keep = $keep . $five. " ";
			}else if($chat_box_message[$i]=='6'){
				$keep = $keep . $six. " ";
			}else if($chat_box_message[$i]=='7'){
				$keep = $keep . $seven. " ";
			}else if($chat_box_message[$i]=='8'){
				$keep = $keep . $eight. " ";
			}else if($chat_box_message[$i]=='9'){
				$keep = $keep . $nine. " ";
			}else if($chat_box_message[$i]=='0'){
				$keep = $keep . $zero. " ";
			}
			$i++;

		}

		$num = strlen($keep);
		$mose = '';
		$index = 0 ;
		while($index < $num){
			if(($keep[$index])=='0'){
				$mose = $mose . '.';
			}else if(($keep[$index])=='1'){
				$mose = $mose . '-';
			}else{
				$mose = $mose . ' ';
			}
			$index++;
		}

		$message = $chat_user . ": <div class='chat-box-message'>" . ($mose) . "</div>";
		$messageArray = array('message'=>$message,'message_type'=>'chat-box-html');
		$chatMessage = ($this->seal(json_encode($messageArray)));
		return ($chatMessage);
	}
}
?>