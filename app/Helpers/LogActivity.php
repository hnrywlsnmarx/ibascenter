<?php


namespace App\Helpers;
use Illuminate\Http\Request;
use App\Helpers\LogActivity as LogActivityModel;


class LogActivity
{


    public function addToLog($subject)
    {
    	$log = [];
    	$log['subject'] = $subject;
    	$log['url'] = Request::fullUrl();
    	$log['method'] = Request::method();
    	$log['ip'] = Request::ip();
    	$log['agent'] = Request::header('user-agent');
    	$log['user_id'] = auth()->check() ? auth()->user()->id : 1;
    	// LogActivityModel::create($log);
    }


    public function logActivityLists()
    {
    	// return LogActivityModel::latest()->get();
    }


}