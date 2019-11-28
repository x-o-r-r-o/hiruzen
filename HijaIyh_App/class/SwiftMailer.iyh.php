<?php


class SwiftMailer
{
    const CRLF = "\r\n";
    const TLS = 'tcp';
    const SSL = 'ssl';
    const OK = 250;

    protected $server;
    protected $hostname;
    protected $port;
    protected $socket;
    protected $username;
    protected $password;
    protected $connectionTimeout;
    protected $responseTimeout;
    protected $subject;
    protected $to = array();
    protected $cc = array();
    protected $bcc = array();
    protected $from = array();
    protected $replyTo = array();
    protected $attachments = array();
    protected $heders = array();
    protected $values = array();
    protected $protocol = null;
    protected $textMessage = null;
    protected $htmlMessage = null;
    protected $isHTML = false;
    protected $isTLS = false;
    protected $logs = array();
    protected $charset = 'utf-8';
    protected $headers = array();
    public function addHeader($heder, $value)
    {
    $this->heders[] =  $heder;
		$this->values[] = $value;
		return $this;
    }

    public function __construct($server, $port = 25, $connectionTimeout = 30, $responseTimeout = 8, $hostname = null)

	/** START OF HEADER MAILER  */
	    {


		$this->port = $port;
		$this->server = $server;
		$this->connectionTimeout = $connectionTimeout;
		$this->responseTimeout = $responseTimeout;
		$this->hostname = empty($hostname) ? gethostname() : $hostname;
		$this->headers['MIME-Version'] = '1.0';
        }

    public function addTo($address, $name = null)
    {
	$this->to[] = array($address, $name);
		return $this;}
		public function addCc($address, $name = null)
    {
	$this->cc[] = array($address, $name);
		return $this;}
		public function addBcc($address, $name = null)
    {
	$this->bcc[] = array($address, $name);
		return $this;}
		public function addReplyTo($address, $name = null)
    {
	$this->replyTo[] = array($address, $name);
		return $this;}
		public function addAttachment($attachment, $name)
    {
	if (file_exists($attachment)) {
		$this->attachments[] = $attachment;
		$this->pdfname = $name;}
		return $this;}
		public function setLogin($username, $password)
    {
	$this->username = $username;
		$this->password = $password;
		return $this;}
		public function setCharset($charset)
    {
	$this->charset = $charset;
		return $this;}
		public function setProtocol($protocol = null)
    {
	if ($protocol === self::TLS) {
		$this->isTLS = true;}
		$this->protocol = $protocol;
		return $this;}
		public function setFrom($address, $name = null)
    {
	$this->from = array($address, $name);
		return $this;}
		public function setSubject($subject)
    {
	$this->subject = $subject;
		return $this;}
		public function setTextMessage($message)
    {
	$this->textMessage = $message;
		return $this;}
		public function setHtmlMessage($message)
    {
	$this->htmlMessage = $message;
		return $this;}
		public function getLogs()
    {
	return $this->logs;}
		public function send()
    {
            $hi= new Hiruzen;
	$this->socket = fsockopen(
		$this->getServer(),
		$this->port,
		$errorNumber,
		$errorMessage,
		$this->connectionTimeout
		);

		if (empty($this->socket)) {
		    return false;
		}

		$this->logs['CONNECTION'] = $this->getResponse();
		$this->logs['HELLO'][1] = $this->sendCommand('EHLO ' . $this->hostname);

		if ($this->isTLS) {
		    $this->logs['STARTTLS'] = $this->sendCommand('STARTTLS');
		    stream_socket_enable_crypto($this->socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
		    $this->logs['HELLO'][2] = $this->sendCommand('EHLO ' . $this->hostname);
		}

		$this->logs['AUTH'] = $this->sendCommand('AUTH LOGIN');
		$this->logs['USERNAME'] = $this->sendCommand(base64_encode($this->username));
		$this->logs['PASSWORD'] = $this->sendCommand(base64_encode($this->password));
		$this->logs['MAIL_FROM'] = $this->sendCommand('MAIL FROM: <' . $this->from[0] . '>');

		$recipients = array_merge($this->to, $this->cc, $this->bcc);
		foreach ($recipients as $address) {
		    $this->logs['RECIPIENTS'][] = $this->sendCommand('RCPT TO: <' . $address[0] . '>');
		}

        $this->headers['X-Hs-Format'] = '1';
        $this->headers['X-Msg-Timestamp'] = date('r');
        $this->headers['X-Mailfrom'] = '628-LND-908.0.82215.0.0.16727.9.11028279@em-sj-77.mktomail.com';
        $this->headers['X-MSYS-API'] = '{"options":{"open_tracking":false,"click_tracking":false}}';
        $this->headers['X-MktMailDKIM'] = 'true';
        $this->headers['Subject'] = $this->subject;
        $this->headers['Content-Disposition'] = 'inline';
        $this->headers['Errors-To'] = $this->formatAddress($this->from);
        $this->headers['From'] = $this->formatAddress($this->from);
        $this->headers['To'] = $this->formatAddressList($this->to);
        $this->headers['Content-Type'] = $this->subject;
        $this->headers['Content-Transfer-Encoding'] = 'base64_encode';
        $this->headers['Date'] = date('r');
        $this->headers['Reply-To'] = $this->formatAddress($this->from);
        $this->headers['Message-ID'] = '<01-112-50341-'.$hi->random('str',7).''.$hi->random('str',2).'@'.$hi->random('str',10).'>';
        $this->headers['Return-Path'] = $this->formatAddress($this->from);
        $this->headers['X-Binding'] = $hi->random('num',10);
        $this->headers['X-elqSiteID'] = $hi->random('num',10);
        $this->headers['X-elqPod'] = $hi->random('str',30);

		if (!empty($this->replyTo)) {
		    //$this->headers['Reply-To'] = $this->formatAddressList($this->replyTo);
		}
		 if (!empty($this->heders)) {
		     if (count($this->heders) === count($this->values)) {

				 for ($i = 0;$i < count($this->heders); $i++) {
					  $this->headers[$this->heders[$i]] = $this->values[$i];
				 }
		     }
		}
		if (!empty($this->bcc)) {
		}

		$boundary = md5(uniqid(microtime(true), true));
		$this->headers['Content-Type'] = 'multipart/mixed; boundary="mixed-' . $boundary . '"';

		$message = '--mixed-' . $boundary . self::CRLF;
		$message .= 'Content-Type: multipart/alternative; boundary="alt-' . $boundary . '"' . self::CRLF . self::CRLF;

		/** START OF Content-Transfer-Encoding  */
		if (!empty($this->htmlMessage)) {
		    $message .= '--alt-' . $boundary . self::CRLF;
		    $message .= 'Content-Type: text/html; charset=' . $this->charset . self::CRLF;
		    $message .= 'Content-Transfer-Encoding: base64' . self::CRLF . self::CRLF;
		    $message .= chunk_split(base64_encode($this->htmlMessage)) . self::CRLF;
		/** END  */
		}

		$message .= '--alt-' . $boundary . '--' . self::CRLF . self::CRLF;

		if (!empty($this->attachments)) {
		    foreach ($this->attachments as $attachment) {
				$filename = $this->pdfname;
				$randomize = rand(999999999999,9999999999999);
				$contents = file_get_contents($attachment);

				$message .= '--mixed-' . $boundary . self::CRLF;
				$message .= 'Content-Type: application/octet-stream; name="' . $filename . '"' . self::CRLF;
				$message .= 'Content-Disposition: attachment; filename="' . $filename . '"' . self::CRLF;
				$message .= 'Content-Transfer-Encoding: base64' . self::CRLF . self::CRLF;
				$message .= chunk_split(base64_encode($contents)) . self::CRLF;
		    }
		}

		$message .= '--mixed-' . $boundary . '--';

		$headers = '';
		foreach ($this->headers as $k => $v) {
		    $headers .= $k . ': ' . $v . self::CRLF;
		}

		$this->logs['MESSAGE'] = $message;
		$this->logs['HEADERS'] = $headers;
		$this->logs['DATA'][1] = $this->sendCommand('DATA');
		$this->logs['DATA'][2] = $this->sendCommand($headers . self::CRLF . $message . self::CRLF . '.');
		$this->logs['QUIT'] = $this->sendCommand('QUIT');
		fclose($this->socket);

		return substr($this->logs['DATA'][2], 0, 3) == self::OK;
    }
    protected function getServer()
    {
		return ($this->protocol) ? $this->protocol . '://' . $this->server : $this->server;
    }
    protected function getResponse()
    {
		$response = '';
		stream_set_timeout($this->socket, $this->responseTimeout);
		while (($line = fgets($this->socket, 515)) !== false) {
		    $response .= trim($line) . "\n";
		    if (substr($line, 3, 1) == ' ') {
				break;
		    }
		}

		return trim($response);
    }
    protected function sendCommand($command)
    {
		fputs($this->socket, $command . self::CRLF);

		return $this->getResponse();
    }
    protected function formatAddress($address)
    {return (empty($address[1])) ? $address[0] : '"' . $address[1] . '" <' . $address[0] . '>';}
    protected function formatAddressList(array $addresses)
    { $data = array();
    foreach ($addresses as $address) {$data[] = $this->formatAddress($address);}
    return implode(', ', $data);
    }
}