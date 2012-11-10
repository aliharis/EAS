<?php

switch ($_GET['act'])
{
	case 'default':
		$TVAR['departments'] = $Department->getAll();
		$TVAR['employees']   = $Employee->getAll();
		$TVAR['title'] = "Assign Task";
 
		require TEMPLATES_PATH . 'supervisor/assign.html';
		exit;

	case 'view_employee':
		$TVAR['departments'] = $Department->getAll();
		$TVAR['employees']   = $Employee->getAll();
		$TVAR['title'] = "Assign Task";
		
		if (isset($_POST['emp_id'])) {
			$TVAR['employee'] = $Employee->view($_POST['emp_id']);
			$TVAR['tasks'] = $Task->getAll($_POST['emp_id']);

			require TEMPLATES_PATH . 'supervisor/view_employee.html';
		} else {
			// If employee ID is not provided redirect back to index page
			header("Location: index.php");
		}
		exit;

	case 'add_task':
		if (empty($_POST))
			header("Location: index.php");

		$Task->newTask($_POST);
		header("Location: index.php");
		exit;

	case 'edit_task':
		if ($Task->edit($_POST)) {
			header("Location: ".HOST."index.php?msg=Edited%20successfully!");
		} else {
			echo "Error: Query Error.";
		}
		exit;

	case 'performance':
		$TVAR['departments'] = $Department->getAll();
		$TVAR['employees']   = $Employee->getAll();
		$TVAR['title'] = "Performance";

		require TEMPLATES_PATH . 'supervisor/performance.html';
		exit;

	case 'set_performance':
		if (empty($_POST)) 
			header("Location: index.php");

		$TVAR['employee'] = $Employee->view($_POST['emp_id']);

		// Get category A subcategories averages
		$TVAR['CAT_A_SUB_AVG'] = $Category->subCatAvg($_POST['emp_id']);

		$TVAR['CAT_A'] = $Category->getSubCategories('CAT A');
		$TVAR['CAT_B'] = $Category->getSubCategories('CAT B');
		$TVAR['CAT_C'] = $Category->getSubCategories('CAT C');
		$TVAR['CAT_D'] = $Category->getSubCategories('CAT D');
		$TVAR['CAT_E'] = $Category->getSubCategories('CAT E');

		$TVAR['title'] = "Performance";

		require TEMPLATES_PATH . 'supervisor/set_performance.html';
		exit;

}