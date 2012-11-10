<?php

switch ($_GET['act'])
{
	case 'default':
		// Template Variables
		$TVAR['jobs'] = $Job->getAll();
		$TVAR['departments'] = $Department->getAll();
		$TVAR['supervisors'] = $Supervisor->getAll();
		$TVAR['title'] = "Employee";

		require TEMPLATES_PATH . 'admin_dashboard.html';
		exit;

	case 'add_employee':
		if ($Employee->add($_POST['data']))
			header("Location: ".HOST."index.php?act=view_employee&msg=Employee%20added%20successfully!");
		exit;

	case 'manage':
		if ($_POST['cmd'] == 'delete') {
			// delete all the ids provided
			foreach ($_POST['id'] as $id) {
				$Employee->remove($id);
			}

			header("Location: ".HOST."index.php?act=view_employee&msg=Employee%20removed%20successfully!");
		} else if ($_POST['cmd'] == "edit") {
			// set the template variables
			$TVAR['data'] = $Employee->view(array_pop($_POST['id']));
			$TVAR['jobs'] = $Job->getAll();
			$TVAR['departments'] = $Department->getAll();
			$TVAR['supervisors'] = $Supervisor->getAll();

			// display the template for editing the user details
			require TEMPLATES_PATH . 'admin/employee_edit.html';

		} else {
			header("Location: ".HOST."index.php");
		}
		
		exit;

	case 'edit':
		if ($Employee->edit(array_pop($_POST))) {
			header("Location: ".HOST."index.php?act=view_employee&msg=Employee%20edited%20successfully!");
		}

		exit;

	case 'view_employee':
		$TVAR['employees'] = $Employee->getAll();
		$TVAR['title'] = "Employee";

		// render the template
		require TEMPLATES_PATH . 'employee_view.html';
		exit;

	case 'view_departments':
		$TVAR['departments'] = $Department->getAll();
		$TVAR['title'] = "Department";

		// render the template
		require TEMPLATES_PATH . 'admin/view_departments.html';
		exit;

	case 'insert':
		if ($_POST['table'] == "department") {
			$Department->add($_POST['value']);
		}

	case 'update':
		print_r($_POST);
		if ($_POST['table'] == "department") {
			$Department->update($_POST);
		} else if ($_POST['table'] == "subcategories") {
			$Category->updateSubCategory($_POST);
		}
		exit;

	case 'delete':
		if ($_GET['cmd'] == "department") {
			if ($Department->delete($_GET['id']))
				header("Location: ".HOST."index.php?act=view_departments&msg=Department%20deleted%20successfully!");
		}

	case 'view_jobs':
		$TVAR['jobs'] = $Job->getAll();
		$TVAR['title'] = "Job";

		// display the template
		require TEMPLATES_PATH . 'admin/view_jobs.html';
		exit;

	case 'manage_job':
		// redirect back if post values are empty
		if (empty($_POST)) header("Location: ".HOST."index.php?act=view_jobs");

		if ($_POST['cmd'] == "add"){
			if ($Job->add($_POST)) {
				header("Location: ".HOST."index.php?act=view_jobs&msg=Job%20added%20successfully!");
			}
		} else if ($_POST['cmd'] == "delete") {
			foreach ($_POST['id'] as $id) {
				$Job->remove($id);
			}

			header("Location: ".HOST."index.php?act=view_jobs&msg=Job%20removed%20successfully!");
		}
		exit;

	case 'manage_categories':
		// redirect back if post values are empty
		if (empty($_POST)) header("Location: ".HOST."index.php?act=view_categories");

		if ($_POST['cmd'] == "delete") {
			foreach ($_POST['id'] as $id) {
				$Category->remove($id);
			}

			header("Location: ".HOST."index.php?act=view_categories&msg=Job%20removed%20successfully!");
		}
		exit;

	case 'view_categories':
		$TVAR['title'] = "Category";

		// set template variable
		$TVAR['CAT_A'] = $Category->get("CAT A");
		$TVAR['CAT_B'] = $Category->get("CAT B");
		$TVAR['CAT_C'] = $Category->get("CAT C");
		$TVAR['CAT_D'] = $Category->get("CAT D");
		$TVAR['CAT_E'] = $Category->get("CAT E");

		$TVAR['SUB_CAT_A'] = $Category->getSubCategories("CAT A");
		$TVAR['SUB_CAT_B'] = $Category->getSubCategories("CAT B");
		$TVAR['SUB_CAT_C'] = $Category->getSubCategories("CAT C");
		$TVAR['SUB_CAT_D'] = $Category->getSubCategories("CAT D");
		$TVAR['SUB_CAT_E'] = $Category->getSubCategories("CAT E");

		// display the template
		require TEMPLATES_PATH . 'admin/view_categories.html';
		exit;

	case 'set_category_percentages':
		$TVAR['categories'] = $Category->getAll();
		$TVAR['title'] = "Category";

		if ($_POST) {
			$Category->updateCategoryPercentage($_POST);
			header("Location: index.php?act=set_category_percentages");
		}

		require TEMPLATES_PATH . 'admin/set_category_percentages.html';
		exit;

	case 'add_subcategory':
		$Category->addSubCat($_POST);
		exit;

	case 'view_supervisors':
		$TVAR['title'] = "Supervisor";
		$TVAR['supervisors'] = $Supervisor->getAll();
		
		require TEMPLATES_PATH . 'admin/view_supervisors.html';
		exit;

	case 'assign_supervisor':
		$TVAR['title'] = "Supervisor";
		$TVAR['employees']   = $Employee->getAll();
 
		require TEMPLATES_PATH . 'admin/assign_supervisor.html';
		exit;

	case 'view_assign_supervisor':
		$TVAR['title'] = "Supervisor";
		if (isset($_POST['emp_id'])) {
			$TVAR['employee'] = $Employee->view($_POST['emp_id']);

			require TEMPLATES_PATH . 'admin/view_assign_supervisor.html';
		} else {
			// If employee ID is not provided redirect back to index page
			header("Location: index.php");
		}
		exit;

	case 'assign_supervision':
		if (empty($_POST)) {
			header("Location: index.php");
		}

		if ($Supervisor->setSupervision($_POST)) 
			header("Location: index.php?act=view_jobs&msg=Supervisor%20assigned%20successfully!");
		exit;
}