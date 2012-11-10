<?php

switch ($_GET['act'])
{
	case 'default':
		$TVAR['tasks'] = $Task->getUnsubmittedTasks($_SESSION['username']);
		$TVAR['title'] = "Assigned Tasks";

		require TEMPLATES_PATH . 'employee/assigned_tasks.html';
		exit;

	case 'submit_task':
		if ($Task->submit_task($_GET['task_id'])) 
			header("Location: index.php");
		exit;

	case 'submitted_tasks':
		$TVAR['title'] = "Submitted Tasks";
		$TVAR['tasks'] = $Task->getSubmittedTasks($_SESSION['username']);

		require TEMPLATES_PATH . 'employee/submitted_tasks.html';
		exit;
	/*
	case 'update_remarks':
		if ($Task->updateRemarks($_POST['remarks'], $_POST['task_id'])) {
			header("Location: index.php?act=submitted_tasks");
		} else {
			echo "Query Error";
		}
		exit;
	*/
}