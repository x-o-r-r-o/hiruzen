<?php
/**
* @HijaIyh_App Framework 
* @author justalinko
** 
*/



spl_autoload_register(function($class){
   require_once(__DIR__.'/HijaIyh_App/class/'.$class.'.iyh.php'); 
});
$hi = new Hiruzen;
$hiu =new Hiuser;