<?php
	error_reporting(0);
	loadconfig();
	function loadconfig()
	{
		$dir = 'config/';
		$files = scandir($dir);
		print_r($files);
		$lenght = sizeof($files);
		unset($files[0]);
		unset($files[1]);
		print("<br>");
		for($i = 2; $i < $lenght; $i++)
		{
			print($files[$i]."<br>");
			$prt = file_get_contents('config/'.$files[$i].'/.port');
			$hst = file_get_contents('config/'.$files[$i].'/.host');
			$status = ping($hst, $prt);
			if($status == TRUE)
			{
				print("online");
			}else if($status == FALSE)
			{
				print("offline");
			}
		}
	}
	
	function ping($host, $port){
	    $start = microtime(true);
	    try {
	    	$fp = fsockopen($host, $port, $errorCode, $errorCode, 5);
	    	$end = microtime(true);
	    	if($fp === false){
	        	return false;
    		}
    		fclose($fp);
    		$diff = $end - $start;
    		return sprintf('%.16f', $diff);
	    }catch(Exception $e)
	    {
	    	return false;
	    }
	}
?>