<?php
require_once '../../template.php';
$page = $_GET['page'] ?? '';

$template = new Template('');
echo $template->render('navbar_admin', []);

switch ($page) {
    case 'admin-timekeeping':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/timekeeping/timekeeping', []);
        break;
    case 'admin-account':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/account/account', []);
        break;
    case 'admin-department':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/department/department', []);
        break;
    case 'admin-department-add':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/department/add_department', []);
        break;    
    case 'admin-department-edit':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/department/edit_department', []);
        break;
    case 'admin-department-delete':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/department/delete_department', []);
        break;    
    case 'admin-overtime':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/overtime/overtime', []);
        break;
    case 'admin-salary-slip':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/salary-slip/salary-slip', []);
        break;
    case 'admin-position':
        echo $template->render('header_admin', ['css' => 'position/position.css']);
        echo $template->render('pages/admin/position/position', []);
        break;
    case 'admin-position-add-position':
        echo $template->render('header_admin', ['css' => 'position/position.css']);
        echo $template->render('pages/admin/position/add-position', []);
        break;
    case 'admin-position-edit-position':
        echo $template->render('header_admin', ['css' => 'position/position.css']);
        echo $template->render('pages/admin/position/edit-position', []);
        break;
        case 'admin-position-delete-position':
            echo $template->render('header_admin', ['css' => 'position/position.css']);
            echo $template->render('pages/admin/position/delete-position', []);
            break;
    case 'admin-staff':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/staff/staff', []);
        break;
    case 'add-staff':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/staff/add_staff', []);
        break;
    case 'edit-staff':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/staff/edit_staff', []);
        break;
    case 'detail-staff':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/staff/detail_staff', []);
        break;
    case 'delete-staff':
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/staff/delete_staff', []);
        break;
    default:
        echo $template->render('header_admin', []);
        echo $template->render('pages/admin/paycheck/paycheck', []);
        break;
}
