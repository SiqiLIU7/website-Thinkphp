<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Ajax extends Controller
{
    public function index(Request $request)
    {	
	if($request->isAjax()) {
	    $myfile = fopen("/home/siqiliu/log1.txt", "r") or die("Unable to open file!" . $myfile);
	    $res = "";
	    while ($line = fgets($myfile)) {
		$res = $res . $line . '</br>';
	    }
	    //$res = fread($myfile,filesize("/home/siqiliu/log.txt"));
	    fclose($myfile);
	    return json($res);
	}
    }

    public function read1(Request $request)
    {	
	if($request->isAjax()) {
	    $myfile = fopen("/home/siqiliu/log1.txt", "r") or die("Unable to open file!" . $myfile);
	    $res = "";
	    while ($line = fgets($myfile)) {
		$res = $res . $line . '</br>';
	    }
	    //$res = fread($myfile,filesize("/home/siqiliu/log.txt"));
	    fclose($myfile);
	    return json($res);
	}
    }

    public function read2(Request $request)
    {	
	if($request->isAjax()) {
	    $myfile = fopen("/home/siqiliu/log2.txt", "r") or die("Unable to open file!" . $myfile);
	    $res = "";
	    while ($line = fgets($myfile)) {
		$res = $res . $line . '</br>';
	    }
	    //$res = fread($myfile,filesize("/home/siqiliu/log.txt"));
	    fclose($myfile);
	    return json($res);
	}
    }
}
