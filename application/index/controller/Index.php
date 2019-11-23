<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Index extends Controller
{
    public function index($name = 'world')
    {	
	$this->assign('name', $name);
	$cmd = "ping 127.0.0.1";
	exec($cmd." > /dev/null 2>/dev/null &");

	$result = "";
	$process = "";
	echo "Test";
	if (!empty($_POST['blank1'])) {
	//    var_dump($_POST['blank1']); 
	    $cmd = $_POST['blank1'];

	    // Turn off output buffering
	    ini_set('output_buffering', 'off');
	    // Turn off PHP output compression
	    ini_set('zlib.output_compression', false);
	    // Implicitly flush the buffer(s)
	    ini_set('implicit_flush', true);
	    ob_implicit_flush(true);
	    // Clear, and turn off output buffering
	    while (ob_get_level() > 0) {
		// Get the curent level
		$level = ob_get_level();
		// End the buffering
		ob_end_clean();
		// If the current level has not changed, abort
		if (ob_get_level() == $level) break;
	    }
	    // Disable apache output buffering/compression
	    if (function_exists('apache_setenv')) {
		apache_setenv('no-gzip', '1');
		apache_setenv('dont-vary', '1');
	    }

	$descriptorspec = array(
	   0 => array("pipe", "r"),   // stdin is a pipe that the child will read from
	   1 => array("pipe", "w"),   // stdout is a pipe that the child will write to
	   2 => array("pipe", "w")    // stderr is a pipe that the child will write to
	);
	flush();
	$process = proc_open($cmd, $descriptorspec, $pipes, realpath('./'), array());
	echo "<pre>";
	if (is_resource($process)) {
	    while ($s = fgets($pipes[1])) {
		//echo $s;
		//$data = array("res"=>$s);
		//echo json_encode($data);
		flush();
	    }
	}
	echo "</pre>";
	
	}
	if (!empty($_POST['day'])) {
	    echo "asd";
	}

	$this->assign('cmd', $cmd);
	$this->assign('result', json_encode($result));

//$callback = system('ls -l');

//echo "<pre>$callback</pre>";


	return $this->fetch();
    }
   
    public function test()
    {
	return	'这是一个测试方法!';
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
