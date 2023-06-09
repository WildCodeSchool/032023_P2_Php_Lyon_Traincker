<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'timesheet/train-list' => ['TimesheetController', 'show', ['id']],
    'timesheet/train-delay' => ['TimesheetController', 'reportDelay'],
    'timesheet/add-bookmark' => ['TimesheetController', 'addBookmark'],
    'timesheet/remove-bookmark' => ['TimesheetController', 'removeBookmark'],
    'remove-bookmark' => ['HomeController', 'removeBookmark'],
    'login' => ['UserController', 'login'],

    'admin/station' => ['AdminController', 'showStation'],
    'adminstation/add' => ['AdminController', 'addStation',],
    'adminstation/delete' => ['AdminController', 'deleteStation',],


    'admin/train' => ['AdminTrainController', 'showTrain'],
    'admintrain/add' => ['AdminTrainController', 'addTrain',],
    'admintrain/delete' => ['AdminTrainController', 'deleteTrain',],

    'admin/transit' => ['AdminController', 'showTransit'],
    'admintransit/add' => ['AdminController', 'addTransit',],
    'admintransit/delete' => ['AdminController', 'deleteTransit',],


    'admin/users' => ['UserController', 'showUser'],
    'adminuser/delete' => ['AdminController', 'deleteUser',],


    'admin/dashboard' => ['AdminController', 'showDashboard'],



    'logout' => ['UserController', 'logout'],
    'register' => ['UserController', 'register']
];
