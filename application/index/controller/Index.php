<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Index extends Controller
{
    public function index(Request $request)
    {	
//---Module 1---
	if (!empty($request->post('RadioOptions11')) && !empty($request->post('RadioOptions12')) && !empty($request->post('RadioOptions13')) && !empty($request->post('RadioOptions14'))) {
	    $myfile = fopen("/home/siqiliu/config1.txt", "w") or die("Unable to open file!" . $myfile);

	    fwrite($myfile, "1. Log Level: ". $request->post('RadioOptions11') . "\n");
	    fwrite($myfile, "2. MI Log: " . $request->post('RadioOptions12') . "\n");
	    fwrite($myfile, "3. Band: " . $request->post('RadioOptions13') . "\n");
	    fwrite($myfile, "4. Bandwidth: " . $request->post('RadioOptions14') . "\n");

	    fclose($myfile);
	}

	if (!empty($request->post('runSign1'))) {
	    //TO DO: read cmd from config file.
	    $cmd = "ping 0.0.0.0 > /home/siqiliu/log1.txt";
	    exec($cmd);
	}

	if (!empty($request->post('stopSign1'))) {
	    exec("kill `ps | grep ping | awk '{ print $1 }'`");
	}
	
	if (!empty($request->post('readSign1'))) {
	    $myfile = fopen("/home/siqiliu/log1.txt", "r") or die("Unable to open file!" . $myfile);
	    $res = "";
	    while ($line = fgets($myfile)) {
		$res = $res . $line . '</br>';
	    }
	    //$res = fread($myfile,filesize("/home/siqiliu/log.txt"));
	    fclose($myfile);
	    return json($res);
	}

//---Module 2---
	if (!empty($request->post('RadioOptions21')) && !empty($request->post('RadioOptions22')) && !empty($request->post('RadioOptions23')) && !empty($request->post('RadioOptions24'))) {
	    $myfile = fopen("/home/siqiliu/config2.txt", "w") or die("Unable to open file!" . $myfile);

	    fwrite($myfile, "1. Log Level: ". $request->post('RadioOptions21') . "\n");
	    fwrite($myfile, "2. MI Log: " . $request->post('RadioOptions22') . "\n");
	    fwrite($myfile, "3. Band: " . $request->post('RadioOptions23') . "\n");
	    fwrite($myfile, "4. Bandwidth: " . $request->post('RadioOptions24') . "\n");

	    fclose($myfile);
	}

	if (!empty($request->post('runSign2'))) {
	    //TO DO: read cmd from config file.
	    $cmd = "ping 1.1.1.1 > /home/siqiliu/log2.txt";
	    exec($cmd);
	}

	if (!empty($request->post('stopSign2'))) {
	    exec("kill `ps | grep ping | awk '{ print $1 }'`");
	}
	
	if (!empty($request->post('readSign2'))) {
	    $myfile = fopen("/home/siqiliu/log2.txt", "r") or die("Unable to open file!" . $myfile);
	    $res = "";
	    while ($line = fgets($myfile)) {
		$res = $res . $line . '</br>';
	    }
	    //$res = fread($myfile,filesize("/home/siqiliu/log.txt"));
	    fclose($myfile);
	    return json($res);
	}

//	$process = "";
//	if (!empty($_POST['blank1'])) {
//	    var_dump($_POST['blank1']); 
//	    $cmd = $_POST['blank1'];
//
//	    // Turn off output buffering
//	    ini_set('output_buffering', 'off');
//	    // Turn off PHP output compression
//	    ini_set('zlib.output_compression', false);
//	    // Implicitly flush the buffer(s)
//	    ini_set('implicit_flush', true);
//	    ob_implicit_flush(true);
//	    // Clear, and turn off output buffering
//	    while (ob_get_level() > 0) {
//		// Get the curent level
//		$level = ob_get_level();
//		// End the buffering
//		ob_end_clean();
//		// If the current level has not changed, abort
//		if (ob_get_level() == $level) break;
//	    }
//	    // Disable apache output buffering/compression
//	    if (function_exists('apache_setenv')) {
//		apache_setenv('no-gzip', '1');
//		apache_setenv('dont-vary', '1');
//	    }
//
//	$descriptorspec = array(
//	   0 => array("pipe", "r"),   // stdin is a pipe that the child will read from
//	   1 => array("pipe", "w"),   // stdout is a pipe that the child will write to
//	   2 => array("pipe", "w")    // stderr is a pipe that the child will write to
//	);
//	flush();
//	$process = proc_open($cmd, $descriptorspec, $pipes, realpath('./'), array());
//	echo "<pre>";
//	if (is_resource($process)) {
//	    while ($s = fgets($pipes[1])) {
//		echo $s;
//		//$data = array("res"=>$s);
//		//echo json_encode($data);
//		flush();
//	    }
//	}
//	echo "</pre>";
//	
//	} 	
 	
	return $this->fetch();
    }
   
    public function test()
    {	
	echo json_encode(array('foo' => 'bar'));
	return $this->fetch();
    }

    public function hello($name = 'world')
    {	
	$this->assign('name', $name);
	$cmd = "";
	$result = "";
	if (isset($_POST['Analysis1btn'])) {
	    echo '<p>Analysis1 is chosen!</p>';
	    $cmd = 'ls -l /home';
            exec($cmd, $result, $status);
            echo "<pre>";
   	    if( $status ){
                //echo "shell命令/'{$cmd}/' 执行失败";
            } else {
                //echo "shell命令'{$cmd}' 成功执行, 结果如下<hr>";
                //print_r( $result );
            }
            echo "</pre>";
	} elseif (isset($_POST['Analysis2btn'])) {
	    echo '<p>Analysis2 is chosen!</p>';
	    $cmd = 'ls -l /home/siqiliu/liusiqi';
            exec($cmd, $result, $status);
            echo "<pre>";
   	    if( $status ){
                //echo "shell命令/'{$cmd}/' 执行失败";
            } else {
                //echo "shell命令'{$cmd}' 成功执行, 结果如下<hr>";
                //print_r( $result );
            }
            echo "</pre>";
        }
	$this->assign('cmd', $cmd);
	$this->assign('result', json_encode($result));
	return $this->fetch();
    }
}
