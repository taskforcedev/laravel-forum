# Laravel Forum
A drop-in forum module for Laravel 5.

[![Dependencies Status](https://depending.in/taskforcedev/laravel-forum.png)](http://depending.in/taskforcedev/laravel-forum) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/0c79cbbe-c7e6-4223-8379-a0f445cfdf66/big.png)](https://insight.sensiolabs.com/projects/0c79cbbe-c7e6-4223-8379-a0f445cfdf66) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/taskforcedev/laravel-forum/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/taskforcedev/laravel-forum/?branch=master)

## Installation

Add the package to your composer.json file in the require section

<code>require {
"taskforcedev/laravel-forum": "dev-master"
}</code>

(make sure you have the correct comma's after each line but the last to ensure valid json).
Then run

<code>composer install</code>

add service provider to config/app.php
<code>'providers' => [
    ...
    'Taskforcedev\LaravelForum\ServiceProvider',
]</code>

publish config/views
php artisan vendor:publish

edit config/laravel-forum to include view layout.

## Feedback / Outstanding
We use github issues for feature requests, bug reports, etc. If you would like to see what is currently being worked on or outstanding you can view our board on [Waffle.io](https://waffle.io/taskforcedev/laravel-forum)
