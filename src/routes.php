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
    'login' => ['UserController', 'login'],
    'logout' => ['UserController', 'logout'],
    'register' => ['UserController', 'login'],
];
