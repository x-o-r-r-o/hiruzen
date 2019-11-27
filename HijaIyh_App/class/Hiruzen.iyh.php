<?php

Class Hiruzen{
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
        $x = file_get_contents($listfile);
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
    
    
    
}