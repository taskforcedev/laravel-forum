# Laravel Forum
A drop-in forum module for Laravel 5.

[![Build Status](https://travis-ci.org/taskforcedev/laravel-forum.svg?branch=master)](https://travis-ci.org/taskforcedev/laravel-forum) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/taskforcedev/laravel-forum/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/taskforcedev/laravel-forum/?branch=master)

## Requirements
This package requires jQuery and Bootstrap JS to be included in the head of your layout (or you can use the default layout provided) - you can publish this layout if you wish add your own css/code on top of the default.

As this package is aimed at Laravel 5 and above PHP 5.5+ is required.

## Installation

### Step 1: Add the package to your composer.json file in the require section.
<code>require {
"taskforcedev/laravel-forum": "1.0.*"
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

## Usage
Once you have done the installation steps above in order to setup the forums for public use you must first create at least one category and a forum, you do this by going to yoursite.com/admin/forums (this will also create the required tables).  Once you have done this you can add the link to /forum into your sites navigation as you please.

## Administration / Moderation
In order to provide administrators access to add/edit/manage the forums we use a "can" method on the user model which is our convention.

To provide basic addition functionality the following must return true.
<code>$user->can('forum-administrate');</code>

To grant users full moderation permissions we will implement checks based on the following.
<code>$user->can('forum-moderate');</code>

We will later add additional options to provide more comprehensive permissions.

## Events

The following events are fired within the package and can be listened for in your main application.

 - Taskforcedev\LaravelForum\Events\PostCreated
 - Taskforcedev\LaravelForum\Events\PostReply

## Feedback / Outstanding
We use Producteev for project management, eg: feature requests, bug reports, etc. If you would like to see what is currently planned or being worked on you can view our board on [Producteev](https://www.producteev.com/workspace/p/55803343b1fa09c213000002).

We also check github issues frequently so you can alternatively raise issues here.
