# Laravel Search

## Installation

First, install the package through Composer.

```js
composer require theamasoud/laravel-search
```
or add this in your project's composer.json file .
````json
"require": {
  "theamasoud/laravel-search": "1.*",
}
````

-----

## Usage

### Traits

#### `TheAMasoud\LaravelSearch\Searchable`

Add the Searchable trait to your model:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TheAMasoud\LaravelSearch\Searchable;

class Message extends Model
{
    use Searchable;
    protected $fillable = ['name','email','subject','message'];
}
```

### Normal Search
first how to make a normel search or fillter, you should use ``search()`` method.</br>
and you should pass a two parameters `column you need to search or fillter in` and `the request key thet come from your request`
#### Request key:
<img src="https://i.imgur.com/HJ3F7Tg.jpeg" />

#### Normal Search Example:
```php
$messages = Message::search('name','search')->get();
```
* In this example I am trying to search or filter in `name` column in messages table and the data I will search about it's come from request key `search` like:`($request->search)` 

<hr width="50%">

### Search Multiple
By multiple search you can search in multiple columns and multiple values from request. </br>
how to make a multiple search or fillter, you should use ``searchMultiple()`` method.</br>
and you should pass a one array parameter `column you need to search or fillter in array key` and `the request key thet come from your request as a value of key` like:`['name'=>'search_name','bio'=>'search_bio']`
#### Request keys:
<img src="https://i.imgur.com/eWCFvqJ.jpeg" />

#### Search Multiple Example:
```php
$messages = Message::searchMultiple(['title'=>'search_title','description'=>'search_desc'])->get();
```
* In this example I am trying to search or filter in `title` column in messages table and the data I will search about it's come from request key `search_title` like:`($request->search)` etc... with `description`

<hr width="50%">

### Search In Multiple Columns
By search in multiple you can search in multiple columns and one value from request. </br>
how to make a search in multiple or fillter, you should use ``searchInMultiple()`` method.</br>
and you should pass a two parameters `columns you need to search or fillter in` and `the request key thet come from your request as a value of key`
#### Request keys:
<img src="https://i.imgur.com/HJ3F7Tg.jpeg" />

#### Search In Multiple Example:
```php
$messages = Message::searchInMultiple(['title','description','etc...'],'search')->get();
```
* In this example I am trying to search or filter in `title` and `description` column in messages table and the data I will search about it's come from request key `search` like:`($request->search)`

<hr width="50%">

### Search In Json Column
By search in json you can search in json column and value from request. </br>
how to make a search in multiple or fillter, you should use ``jsonSearch()`` method.</br>
and you should pass a two parameters `column you need to search or fillter in` and `the request key thet come from your request as a value of key`
#### Request keys:
<img src="https://i.imgur.com/HJ3F7Tg.jpeg" />

#### Search In Json Example:
##### My json colums has:
```json
{
    "ar":"نص عربي",
    "en":"English text"
}
```
```php
$messages = Message::jsonSearch('title->ar','search')->get();
```
* In this example I am trying to search or filter in `title` column in messages table and the data I will search about it's come from request key `search` like:`($request->search)`
