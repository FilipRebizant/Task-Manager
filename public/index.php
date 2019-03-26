<?php

require_once '../vendor/autoload.php';

use Model\Status;
use Model\Task;
use Model\User;

$user = new User();
$user->setEmail('email@email.com');
$user->setUserName('username');

$status = new Status();
$status->setId(1);
$status->setName('Pending');

$task = new Task();
$task->setId(1);
$task->setDescription('description');
$task->setPriority(1);
$task->setUser($user);
$task->setStatus($status);


echo $task->getUser()->getUserName();
//phpinfo();