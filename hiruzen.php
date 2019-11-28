<?php
/**
* @HijaIyh_App Framework 
* @author justalinko
** */

require_once(__DIR__.'/autoloader.php');

echo $hi->hiruzen();
$many = $hi->tanya('How much list perSend ?'); if(!filter_var($many,FILTER_VALIDATE_INT)){ exit('Wrong input'); }
$double = $hi->tanya('Double send ?',true);
$gen  = $hi->tanya('Generate SMTP Users ?',true);
if($gen == 'y')
{
    $genmany = $hi->tanya('How much generate SMTP users ?');
    if(!filter_var($genmany,FILTER_VALIDATE_INT)){ exit('Wrong input'); }
    @$hi->generate_user($genmany);
    $hi->alert('+','Generate users Successfull !');
    $hi->alert('!','Dont forget to upload .csv !');
    $hi->tanya('Press [ENTER] if you was uploaded .csv file ...');
}

if($hi->parse_hijaiyh('hiruzen','backup_list') == 'yes')
{
    $file = __DIR__.'/HijaIyh_App/list/'.$hi->parse_hijaiyh('sender','list');
    $copy = __DIR__.'/HijaIyh_App/list/backup-'.$hi->parse_hijaiyh('sender','list');
    @copy($file,$copy);
}

$n=1;
do{
$mailist = $hi->getList();
if($many >= count($mailist)){ $many = count($mailist);}
$sendmail = array_slice($mailist, 0, $many);
    
    /** smtp rotation users **/
    $users = explode("\n",str_replace("\r","",file_get_contents(__DIR__.'/hijaiyh_userlist.txt')));
    $rotate = file_get_contents(__DIR__.'/HijaIyh_App/config/rotation.txt');
    if ($rotate >= count($users)-1) {
        $file = __DIR__.'/HijaIyh_App/config/rotation.txt';
        $isi = @file_get_contents($file);
        $hi->save($file,0,'w');
    }
    if($hi->parse_hijaiyh('smtp','use_smtp_generate') =='yes'){
    $smtpuser = $users[$rotate];
    }else{
    $smtpuser = $hi->parse_hijaiyh('smtp','username');
    }
    /** end **/
    
  
    $hi->loading(count($mailist),substr($smtpuser,0,10).'..');
    
    $mail = new SwiftMailer($hi->parse_hijaiyh('smtp','hostname'),$hi->parse_hijaiyh('smtp','port'));
    if($hi->parse_hijaiyh('smtp','secure') == 'SSL'){
        $mail->setProtocol(SwiftMailer::SSL);
    }else{
        $mail->setProtocol(SwiftMailer::TLS);
    }
    
    $mail->setLogin($smtpuser,$hi->parse_hijaiyh('smtp','password'));
    
    $mail->setFrom($hi->replace($hi->parse_hijaiyh('sender','from_mail')),$hi->replace($hi->parse_hijaiyh('sender','from_name')));
    $mail->setSubject($hi->replace($hi->parse_hijaiyh('sender','subject')));
    
    
      /** letter & message **/
    if($hi->parse_hijaiyh('sender','message') == 'html')
    {
        $message = $hi->getLetter();
        $mail->setHtmlMessage($message);
    }elseif($hi->parse_hijaiyh('sender','message') == 'attachment')
    {
        $message = $hi->getLetter();
        $mail->setHtmlMessage($message);
        $attach = $hi->getAttach();
        $mail->addAttachment($attach,$hi->parse_hijaiyh('sender','attachment_msg'));
    }
    /** end**/
    
    /** type send **/
    if($hi->parse_hijaiyh('sender','type') == 'bcc')
    {
        $mail->addTo($hi->replace($hi->parse_hijaiyh('sender','add_to')), null);
        foreach($sendmail as $trgt) {
        $mail->addBcc($trgt);
        }
    }elseif($hi->parse_hijaiyh('sender','type') == 'cc')
    {
        $mail->addTo($hi->replace($hi->parse_hijaiyh('sender','add_to')), null);
        foreach($sendmail as $cc) {
            $mail->addCc($cc);
        }
    }elseif($hi->parse_hijaiyh('sender','type') == 'to')
    {
         foreach($sendmail as $to) {
        $mail->addTo($to, null);
         }
    }
    /** end **/
   // $mail->getResponse();
    if($mail->send())
    {
        $hi->sendstatus($many,true);
        $hi->updateList($many);
        $hi->rotation();
    }else{
           $error = $mail->getLogs();
       
        $hi->save('hiruzen_error_log.txt',$error,'w');
        $hi->sendstatus($many,false);
        $hi->rotation();
    }
    
}while(count($mailist) > $many);