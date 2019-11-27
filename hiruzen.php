<?php
/**
* @HijaIyh_App Framework 
* @author justalinko
** */

require_once(__DIR__.'/autoloader.php');

echo $hi->hiruzen();
$many = $hi->tanya('How much list perSend ?');
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

$mailist = $hi->getList();
$n=1;
do{
    foreach($mailist as $mail)
    {
        echo $n++." || ".$mail."\n";
    }
}while(count($mailist) > $many);
