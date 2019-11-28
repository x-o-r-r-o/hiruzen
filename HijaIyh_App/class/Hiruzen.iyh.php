<?php
/***
*
* @HijaIyh_App Framework 
* @author justalinko
* HiruZen Class.
** 
** Raimu asu.
***/
Class Hiruzen{
    public $browserlist;
    public $countrylist;
    public $platformlist;
    public function __construct()
    {
        $this->browserlist =  array('Internet Explorer', 'Firefox', 'Safari', 'Chrome', 'Edge', 'Opera', 'Netscape');
        $this->platformlist = array('Windows 10', 'Windows 8.1', 'Windows 8', 'Windows 7', 'Windows Vista', 'Windows Server 2003/XP x64', 'Windows XP', 'Windows XP', 'Mac OS X', 'Mac OS 9', 'Linux', 'Ubuntu', 'iPhone', 'iPod', 'iPad', 'Android', 'BlackBerry', 'Mobile');
        $this->countrylist = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        
    }
    public function hiruzen()
    {
        return "
  +=========================================+
  ||  _   _ _                              ||
  || | | | (_)_ __ _   _ _______ _ __      ||
  || | |_| | | '__| | | |_  / _ \ '_ \    /||^^^^^^^^^^^^/|
  || |  _  | | |  | |_| |/ /  __/ | | |  +--------------+ |
  || |_| |_|_|_|   \__,_/___\___|_| |_|  | Email Sender | |
  ||                                     +-><-----------+/
  +=====[ powered By : HijaIyh Project ]====+
  
";
    }
    public function random($jenis = 'str',$max = null)
	{
		if($jenis == 'str')
		{
			$char = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM";
			for ($i=0; $i <= $max; $i++) { 
				$get = rand(0,strlen($char)-1);
				@$ret.=$char[$get];
			}
		}elseif($jenis == 'num')
		{
			$char = "1234567890";
			for ($i=0; $i <= $max ; $i++) { 
				$get = rand(0,strlen($char)-1);
				@$ret.=$char[$get];
			}
		}elseif($jenis == 'mix'){
			$char = "1234567890poiuytrewqazxsdcvfgbnhjmklQAZXSWEDCVFRTGBNHYUJMKIOLP";
			for ($i=0; $i <= $max; $i++) { 
				$get = rand(0,strlen($char)-1);
				@$ret.=$char[$get];
			}
		}elseif($jenis == 'ip'){
			$ret = rand(10,255).".".rand(10,255).".".rand(10,255).".".rand(10,255);
		}elseif($jenis == 'browser')
        {
            $key = rand(0,count($this->browserlist)-1);
            $ret = $this->browserlist[$key];
        }elseif($jenis == 'country')
        {
            $key = rand(0,count($this->countrylist)-1);
            $ret = $this->countrylist[$key];
        }elseif($jenis == 'platform')
        {
             $key = rand(0,count($this->platformlist)-1);
            $ret = $this->platformlist[$key];
        }
        elseif($jenis == 'text_custom')
        {
            $f = explode("\n",str_replace("\r","",file_get_contents(dirname(__DIR__).'/config/text_custom.txt')));
            $key = rand(0,count($f)-1);
            $ret = $f[$key];
        }elseif($jenis == 'shortlink')
        {
            $f = explode("\n",str_replace("\r","",file_get_contents(dirname(__DIR__).'/config/shortlink.txt')));
            $key = rand(0,count($f)-1);
            $ret = $f[$key];
        }
		return $ret;
	}
    public function parse_hijaiyh($class,$method)
    {
        $ini = parse_ini_file(dirname(__DIR__).'/config/hiruzen.ini',true);
        return @$ini[$class][$method];
    }
    public function tanya($wow,$yn=false)
    {
        if($yn == true)
        {
            $ny = "[y/n] ";
        }else{
            $ny = "";
        }
        return readline("[Hiruzen] [?] $wow $ny");
    }
    public function generate_user($much)
    {
        $hiu = new Hiuser;
        $user = $this->random('str',5);
        $domainx = explode("@",$this->parse_hijaiyh('smtp','username'));
        $domain = $domainx[1];
        $password = $this->parse_hijaiyh('smtp','password');
            
        $fp = fopen('hijaiyh_users.csv','w');
        $fp1 = fopen('hijaiyh_userlist.txt','w');
        $content = "First Name [Required],Last Name [Required],Email Address [Required],Password [Required]\n";
        fputs($fp,$content);
        for($i=0;$i<$much;$i++)
        {
            $userx=strtolower($hiu->random_name('username').".".$this->random('str',4))."@".$domain;
            $xcontent = $hiu->random_name('firstname').",".$hiu->random_name('lastname').",".$userx.",".$password;
            fputs($fp,$xcontent."\n");
            fputs($fp1,$userx."\n");
        }
    }
    public function replace($sumber,$max =8)
    {
        $func = ['#rand_ip#',
                 '#rand_str#',
                 '#rand_mix#',
                 '#rand_num#',
                 '#browser#',
                 '#country#','#platform#', '#date#' ,'#text_custom#' , '#shortlink#'];
        $gantinya = [$this->random('ip'),
                     $this->random('str',$max),
                     $this->random('mix',$max),
                    $this->random('num',$max),
                    $this->random('browser'),
                    $this->random('country'),
                    $this->random('platform'),
                    date('D,d M Y H:i'),
                    $this->random('text_custom'),
                    $this->random('shortlink')];
        return str_replace($func,$gantinya,$sumber);
    }
    public function save($filename,$xx,$mode = 'w')
    {
        $fp = fopen($filename,$mode);
        fwrite($fp,$xx);
        fclose($fp);
    }
    public function alert($tanda = '+' , $alert)
    {
        echo "[Hiruzen] [$tanda] $alert \n";
    }
    public function getList()
    {
        $listfile = dirname(__DIR__).'/list/'.$this->parse_hijaiyh('sender','list');
        if(file_exists($listfile)){
        $x = file_get_contents($listfile);
        return explode("\n",$x);
        }else{
            $this->alert('!','File list : HijaIyh_App/list/'.$this->parse_hijaiyh('sender','list').' Not exist !!!!');
            exit;
        }
    }
     public function getLetter()
    {
        $listfile = dirname(__DIR__).'/letter/'.$this->parse_hijaiyh('sender','letter_filename');
        if(file_exists($listfile)){
        $x = $this->replace(file_get_contents($listfile),8);
        return $x;
        }else{
            $this->alert('!','File list : HijaIyh_App/letter/'.$this->parse_hijaiyh('sender','letter_filename').' Not exist !!!!');
            exit;
        }
    }
     public function getAttach()
    {
        $listfile = dirname(__DIR__).'/attachment/'.$this->parse_hijaiyh('sender','attachment_filename');
        if(file_exists($listfile)){
        
        return $listfile;
        }else{
            $this->alert('!','File list : HijaIyh_App/attachment/'.$this->parse_hijaiyh('sender','attachment_filename').' Not exist !!!!');
            exit;
        }
    }
    public function runlineII()
	{
		$kata = array(' ','S','E','N','D','I','N','G',' ');
		foreach($kata as $load)
		{
			echo $load;
			usleep(60000);
		}
	}
    public function sendstatus($max,$success=true)
	{
		$date = date('H:i:s');
		echo "[Hiruzen][$date][$max]";
		$this->runlineII();
        if($success == true){
		echo "SUCCESS \n";
        }else{
        echo "ERROR : CHECK ERROR LOG => hiruzen_error_log.txt \n";
            exit;
        }
	}
    public function updateList($n)
    {
        $listfile = dirname(__DIR__).'/list/'.$this->parse_hijaiyh('sender','list');
        $text = implode("\n", array_slice(explode("\n", $listfile), $n));
        $myfile = fopen($listfile, "w");
        fwrite($myfile, $text);
        fclose($myfile);
    }
    public function rotation()
    {
        $file2 = dirname(__DIR__).'/config/rotation.txt';
        $isi = @file_get_contents($file2);
        $buka = fopen($file2, "w");
        fwrite($buka, $isi + 1);
    }
    
    
    
}