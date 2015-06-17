# Laravel Forum
A drop-in forum module for Laravel 5.

[![Dependencies Status](https://depending.in/taskforcedev/laravel-forum.png)](http://depending.in/taskforcedev/laravel-forum) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/0c79cbbe-c7e6-4223-8379-a0f445cfdf66/big.png)](https://insight.sensiolabs.com/projects/0c79cbbe-c7e6-4223-8379-a0f445cfdf66) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/taskforcedev/laravel-forum/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/taskforcedev/laravel-forum/?branch=master)

## Requirements
This package requires jQuery and Bootstrap JS to be included in the head of your layout (or you can use the default layout provided) - you can publish this layout if you wish add your own css/code on top of the default. 

## Installation

### Step 1: Add the package to your composer.json file in the require section.
<code>require {
"taskforcedev/laravel-forum": "dev-master"
}</code>

(make sure you have the correct comma's after each line but the last to ensure valid json).

### Step 2: Then run composer update.
<code>composer update</code>

### Step 3: Add service provider to config/app.php.

'providers' => [
    ...
    <code>'Taskforcedev\LaravelForum\ServiceProvider',</code>
]

### Step 4: Publish Config.
<code>php artisan vendor:publish --provider="Taskforcedev\LaravelForum\ServiceProvider" --tag="config"</code>

### Step 5: Edit config.
edit config/laravel-forum to include your apps view layout (unless you really wish to use the packages default).

## Feedback / Outstanding
We use github issues for feature requests, bug reports, etc. If you would like to see what is currently being worked on or outstanding you can view our board on [Waffle.io](https://waffle.io/taskforcedev/laravel-forum)

## Usage
In order to provide administrators access to add/edit/manage the forums we use a "can" method on the user model which is our convention.

To provide basic addition functionality the following must return true.
<code>$user->can('forum-administrate');</code>

To grant users full moderation permissions we will implement checks based on the following.
<code>$user->can('forum-moderate');</code>

We will later add additional options to provide more comprehensive permissions.
