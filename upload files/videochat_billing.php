<?php
include("dbase.php");
include("settings.php");


class chatBilling{

	//declares vars
	public $type;
	public $ammount;
	//$ammount2=ceil($ammount/2);
	public $member;
	public $model;
	public $now;
	public $session;
	public $epercentage;	
	public $owner;
	public $cpm;

	public function __construct(){

		$this->type = $_POST['ptype'];
		$this->ammount = $_POST['amount'];
		$this->member = $_POST['member'];
		$this->model = $_POST['model'];
		$this->now = time();
		$this->session = $_POST['sessionstring'];
        
		//check if a session exists and generate hash
		if (empty($this->session)){
			$this->sessionid = md5($this->member.$this->model.$this->now);
		} else {
			$this->sessionid = $this->session;
		}

		//get model data from db
		$result=mysql_query("SELECT owner,epercentage,cpm,scpm from chatmodels WHERE user='{$this->model}' LIMIT 1");
		while($row = mysql_fetch_array($result)) 
		{	
			$this->epercentage=$row['epercentage'];	
			$this->owner=$row['owner'];
			$this->cpm=$row['cpm'];
			$this->scpm=$row['scpm'];
		}

		//get user data from db
		$result=mysql_query("SELECT money from chatusers WHERE user='{$this->member}' LIMIT 1");
		while($row = mysql_fetch_array($result)) 
		{	
			$this->money=$row['money'];
		}
	}

	public function updateDB(){
        //echo $this->ammount;$this->member;exit;
        //print_r($this);exit;
	//create or update video session
	if($this->type == 'show' || $this->type == 'spectator'){
	$result=mysql_query("SELECT sessionid from videosessions WHERE sessionid='{$this->sessionid}' LIMIT 1");
	if (mysql_num_rows($result)!=1){
		mysql_query("INSERT INTO videosessions ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('{$this->sessionid}','{$this->member}', '{$this->model}', '{$this->owner}', '{$this->ammount}','{$this->epercentage}', '{$this->now}', '60','0','0','{$this->type}')");
		mysql_query("INSERT INTO videosessions_copy ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('{$this->sessionid}','{$this->member}', '{$this->model}', '{$this->owner}', '{$this->ammount}','{$this->epercentage}', '{$this->now}', '60','0','0','{$this->type}')");
		}else{
		mysql_query("UPDATE videosessions SET duration=duration+'60' WHERE sessionid='{$this->sessionid}' LIMIT 1");
		mysql_query("UPDATE videosessions_copy SET duration=duration+'60' WHERE sessionid='{$this->sessionid}' LIMIT 1");
		}
	}else{
		mysql_query("INSERT INTO videosessions ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('{$this->sessionid}','{$this->member}', '{$this->model}', '{$this->owner}', '{$this->ammount}','{$this->epercentage}', '{$this->now}', '60','0','0','{$this->type}')");
		mysql_query("INSERT INTO videosessions_copy ( sessionid, member, model, sop, cpm, epercentage, date, duration,paid,soppaid,type ) VALUES ('{$this->sessionid}','{$this->member}', '{$this->model}', '{$this->owner}', '{$this->ammount}','{$this->epercentage}', '{$this->now}', '60','0','0','{$this->type}')");
	}

	//update user token balance in db
	if(mysql_query("UPDATE chatusers SET money=money-'{$this->ammount}' WHERE user = '{$this->member}' LIMIT 1")){

		$res=mysql_query("SELECT money, user from chatusers WHERE user='{$this->member}' LIMIT 1");
		//generate response message with current balance for ajax 
			if($row = mysql_fetch_array($res)){
				$bal = $row['money'];
				$array = array('msg' => 'db token balance updated!', 'bill_status' => 'success', 'cost' => $this->ammount, 'bal' => $bal, 'session' => $this->sessionid );
				echo json_encode($array);
		}
	}else{
		//default output, should be replaced if queries are successful
		$array = array('msg' => 'db error occurred!', 'bill_status' => 'error', 'bal' => 0 );
		echo json_encode($array);
	}
}
}


$billing = new chatBilling();

if($billing->money >= $billing->ammount){
	switch($billing->type){
		CASE 'show':
			$billing->ammount = $billing->cpm;
			$billing->updateDB();
			break;
		CASE 'tip':
			$billing->updateDB();
			break;
		CASE 'private':
			$billing->ammount = $billing->cpm;
			$billing->updateDB();
			break;
		CASE 'spectator':
			$billing->ammount = $billing->scpm;
			$billing->updateDB();
			break;
		DEFAULT:
			$billing->ammount = $billing->cpm;
			$billing->updateDB();
			break;
	}
}elseif($billing->type == 'tip'){
	//should only show if user balance is too low and js was bypassed
	$array = array('msg' => 'Not enough money in your account! Your tip was not sent.', 'bill_status' => 'acc_error', 'bal' => $billing->money );
	echo json_encode($array);
}else{
	//should only show if user balance is too low and js was bypassed
	$array = array('msg' => 'Not enough money in your account! Your private session will now end.', 'bill_status' => 'acc_error', 'bal' => $billing->money );
	echo json_encode($array);
}
?>