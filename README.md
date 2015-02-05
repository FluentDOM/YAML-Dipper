FluentDOM-YAML-Dipper
=====================

[![License](https://poser.pugx.org/fluentdom/yaml-dipper/license.svg)](http://www.opensource.org/licenses/mit-license.php)
[![Build Status](https://travis-ci.org/FluentDOM/YAML-Dipper.svg?branch=master)](https://travis-ci.org/FluentDOM/YAML-Dipper)
[![Total Downloads](https://poser.pugx.org/fluentdom/yaml-dipper/downloads.svg)](https://packagist.org/packages/fluentdom/yaml-dipper)
[![Latest Stable Version](https://poser.pugx.org/fluentdom/yaml-dipper/v/stable.svg)](https://packagist.org/packages/fluentdom/yaml-dipper)
[![Latest Unstable Version](https://poser.pugx.org/fluentdom/yaml-dipper/v/unstable.svg)](https://packagist.org/packages/fluentdom/yaml-dipper)


Adds support for YAML to FluentDOM. It adds a loader and a serializer. It uses the
[Dipper](https://github.com/secondparty/dipper) library.

NOTE: At the moment a [fork of Dipper](https://github.com/FluentDOM/dipper) is used.

This plugin needs FluentDOM 5.2.1 aka the current development version.

Installation
------------

```text
composer require fluentdom/yaml-dipper
```

Loader
------

The loader registers automatically. You can trigger it with the types `yaml` and `text/yaml`.

```php
$document = FluentDOM::load($yaml, 'text/yaml');
$query = FluentDOM($yaml, 'text/yaml');
```

Serializer
----------

The serializer needs to be created with for document and can be casted into a string.

```php
echo new FluentDOM\YAML\Dipper\Serializer($document);
```



