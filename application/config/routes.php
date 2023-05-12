<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//Default Routes
$route['default_controller'] = 'users/index';
$route['404_override'] = 'Custom404';
$route['translate_uri_dashes'] = FALSE;

//Default Page
$route['login'] = 'users/index';
$route['logout'] = 'users/logout';
$route['dashboard'] = 'users/index';
$route['profile'] = 'users/profile';
$route['barchart'] = 'users/barchart';

//Admin | Semester
$route['semester'] = 'admin/semesters/index';
$route['semester/create'] = 'admin/semesters/create';
$route['semester/edit/(:any)'] = 'admin/semesters/edit/$1';
$route['semester/delete'] = 'admin/semesters/delete';

//Admin | Section
$route['section'] = 'admin/sections/index';
$route['section/create'] = 'admin/sections/create';
$route['section/edit/(:any)'] = 'admin/sections/edit/$1';
$route['section/delete'] = 'admin/sections/delete';

//Admin | Course
$route['course'] = 'admin/courses/index';
$route['course/create'] = 'admin/courses/create';
$route['course/edit/(:any)'] = 'admin/courses/edit/$1';
$route['course/delete'] = 'admin/courses/delete';

//Admin | Subject
$route['subject'] = 'admin/subjects/index';
$route['subject/create'] = 'admin/subjects/create';
$route['subject/edit/(:any)'] = 'admin/subjects/edit/$1';
$route['subject/delete'] = 'admin/subjects/delete';

//Admin | Faculties
$route['faculty'] = 'admin/faculties/index';
$route['faculty/create'] = 'admin/faculties/create';
$route['faculty/edit/(:any)'] = 'admin/faculties/edit/$1';
$route['faculty/delete'] = 'admin/faculties/delete';

//Admin | Faculty Subject
$route['faculty-subject'] = 'admin/facultysubjects/index';
$route['faculty-subject/(:any)'] = 'admin/facultysubjects/faculty/$1';
$route['faculty-subject/subject/(:any)/(:any)/(:num)'] = 'admin/facultysubjects/subject';
$route['faculty-subject/create/(:any)'] = 'admin/facultysubjects/create';
$route['faculty-subject/edit/(:any)/(:num)/(:any)/(:num)'] = 'admin/facultysubjects/edit';
$route['faculty-subject/delete/(:any)'] = 'admin/facultysubjects/delete';

//Admin | Students

$route['students'] = 'admin/students/index';
$route['students/section/(:any)'] = 'admin/students/section';
$route['students/create/(:any)'] = 'admin/students/create';
$route['students/subjects/(:any)/(:num)'] = 'admin/students/create_subjects';
$route['students/complete/(:any)'] = 'admin/students/complete';
$route['students/edit/(:any)/(:num)'] = 'admin/students/edit';
$route['students/delete/(:any)'] = 'admin/students/delete';

//Admin | Student Subject
$route['student-subject'] = 'admin/studentsubjects/index';
$route['student-subject/(:any)'] = 'admin/studentsubjects/student/$1';
$route['student-subject/subject/(:any)/(:any)/(:num)'] = 'admin/studentsubjects/subject';
$route['student-subject/create/(:any)/(:num)/(:any)/(:num)'] = 'admin/studentsubjects/create';
$route['student-subject/edit/(:any)/(:num)/(:any)/(:num)'] = 'admin/studentsubjects/edit';
$route['student-subject/delete/(:any)'] = 'admin/studentsubjects/delete';

//Faculty | Set Grade Criteria
$route['grade-criteria'] = 'faculty/gradecriterias/index';
$route['grade-criteria/(:any)/(:num)'] = 'faculty/gradecriterias/show_criteria';
$route['grade-criteria/create/(:any)/(:num)'] = 'faculty/gradecriterias/create';
$route['grade-criteria/edit/(:num)/(:any)/(:num)'] = 'faculty/gradecriterias/edit';
$route['grade-criteria/delete/(:any)/(:num)'] = 'faculty/gradecriterias/delete';

//Faculty | Set Grade
$route['grades'] = 'faculty/grades/index';
$route['grades/(:any)/(:num)'] = 'faculty/grades/show_grades';
$route['grades/input-grades/(:num)/(:any)/(:num)'] = 'faculty/grades/edit';

//Faculty | Student List
$route['student-list'] = 'faculty/studentlists/index';
$route['student-list/(:any)/(:num)'] = 'faculty/studentlists/index';
$route['student-list/print/(:any)/(:num)'] = 'faculty/studentlists/print';

//Faculty | Student Grade
$route['student-grade'] = 'faculty/studentgrades/index';
$route['student-grade/(:any)/(:num)'] = 'faculty/studentgrades/index';
$route['student-grade/print/(:any)/(:num)'] = 'faculty/studentgrades/print';

//Student | View Grades
$route['view-grades'] = 'student/viewgrades/index';
$route['view-grades/print'] = 'student/viewgrades/print';