# yii2-js-register
Yii2 widget to register JS into view

[![Github All Releases](https://img.shields.io/github/downloads/atom/atom/total.svg?maxAge=2592000)](https://github.com/richardfan1126/yii2-js-register)
[![Packagist](https://img.shields.io/packagist/dt/doctrine/orm.svg?maxAge=2592000)](https://packagist.org/packages/richardfan1126/yii2-js-register)

## Why do I need this?
### How to register JS script into view in Yii2?

In Yii2, the way to register JS script into view is using \yii\web\View::registerJS(), 

For example, if you want to initialize a jQuery plugin, you do:

```php
// in view file

<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p>Hello World!</p>
      </div>
    </div>
  </div>
</div>

<?php
$this->registerJS('$(".modal").modal({backdrop:"static",keyboard:"false"})');
?>
```

Obviously, this is a very bad way because:

1. Hard to read for human
2. Hard to read for you editor (Means no syntax coloring for the JS code)
3. You have to handle the single / double quote

This widget help you register JS script in Yii just as you write script block directly into HTML!

## Getting Started
### Installing
Install with Composer:

    composer require richardfan1126/yii2-js-register "*"

or

    php composer.phar require richardfan1126/yii2-js-register "*"

or add

    "richardfan1126/yii2-js-register":"*"
to the require section of your composer.json file.

## How to use

In your view file, wrap your JS script with &lt;script&gt; tag, and wrap all the things with this widget.

example:

```php
// in view file

use richardfan\widget\JSRegister;

<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p>Hello World!</p>
      </div>
    </div>
  </div>
</div>

<?php JSRegister::begin(); ?>
<script>
    $(".modal").modal({
        backdrop:"static",
        keyboard:"false"
    });
</script>
<?php JSRegister::end(); ?>
```

IMPORTANT Remember not to add anything out of the &lt;script&gt; block.

## Configurations
There are 2 configurations for this widget, which are the parameters passed into \yii\web\View::registerJS() method.
example:

```php
<?php JSRegister::begin([
    'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
    // JS script
</script>
<?php JSRegister::end(); ?>
```

* **key**  (optional)The key that identifies the JS code block. If null, it will use $js as the key. If two JS code blocks are registered with the same key, the latter will overwrite the former. Default to null
* **position**  (optional) The position at which the JS script tag should be inserted in a page. Default to \yii\web\View::POS_READY
