<?php

require_once "../controllers/users.controller.php";
require_once "../models/users.model.php";


class AjaxUsers{
  // Edit user
  public $idUser;
  public function ajaxEditUser(){
    $item = "id";
    $value = $this->idUser;
    $answer = ControllerUsers::ctrShowUsers($item, $value);
    echo json_encode($answer);
  }

  //activate user
  public $activateUser;
	public $activateId;	

  public function ajaxActivateUser(){
    $table = "users";
		$item1 = "status";
		$value1 = $this->activateUser;

    $item2 = "id";
		$value2 = $this->activateId;

		$answer = UsersModel::mdlUpdateUser($table, $item1, $value1, $item2, $value2);
  }

  //validate if user already exists
  public $validateUser;
	public function ajaxValidateUser(){
		$item = "user";
		$value = $this->validateUser;
		$answer = ControllerUsers::ctrShowUsers($item, $value);
		echo json_encode($answer);
	}
}


// Edit user
if (isset($_POST["idUser"])) {
  $edit = new AjaxUsers();
  $edit -> idUser = $_POST["idUser"];
  $edit -> ajaxEditUser();
}

// Activate User
if (isset($_POST["activateUser"])) {
	$activateUser = new AjaxUsers();
	$activateUser -> activateUser = $_POST["activateUser"];
	$activateUser -> activateId = $_POST["activateId"];
	$activateUser -> ajaxActivateUser();
}

//validate if user already exists
if (isset($_POST["validateUser"])) {
	$valUser = new AjaxUsers();
	$valUser -> validateUser = $_POST["validateUser"];
	$valUser -> ajaxValidateUser();
}