Builder
=======

PHP package for constructing objects using configurations.

[![Codacy Badge](https://www.codacy.com/project/badge/4badc67af33446efac8258b8481912dd)](https://www.codacy.com/public/mail_2/Builder)
[![Code Climate](https://codeclimate.com/github/Nayjest/Builder/badges/gpa.svg)](https://codeclimate.com/github/Nayjest/Builder)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Nayjest/Builder/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Nayjest/Builder/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Nayjest/Builder/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Nayjest/Builder/?branch=master)
[![Build Status](https://travis-ci.org/Nayjest/Builder.svg?branch=master)](https://travis-ci.org/Nayjest/Builder)
[![Latest Stable Version](https://poser.pugx.org/nayjest/builder/v/stable.svg)](https://packagist.org/packages/nayjest/builder)
[![Dependency Status](https://www.versioneye.com/user/projects/54f98b904f3108e7800000e7/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54f98b904f3108e7800000e7)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/4ca474c2-d731-4cdf-ac93-9138f9f8907e/big.png)](https://insight.sensiolabs.com/projects/4ca474c2-d731-4cdf-ac93-9138f9f8907e)

## 1. Requirements

* php 5.4+  

This package is not tested with [outdated versions of PHP](http://php.net/supported-versions.php). 

If you need to use nayjest/builder in environments with php <= 5.3, test it on your own.

## 2. Installation

The recommended way of installing the component is through [Composer](https://getcomposer.org).

Run following command:

```bash
composer require nayjest/builder
```
## 3. Overview

#### 3.1 Purpose

Building complex objects from configurations in architecturally beutiful way.

#### 3.2 Explanation

If you are confident with [builder design pattern](https://en.wikipedia.org/wiki/Builder_pattern),
this package allows you to create builders for your classes in declarative style, based on build configuration.

#### 3.3 Usage

##### 3.3.1 Class Blueprints

When you need to construct objects of some type, first of all, you will create blueprint for that type.
In terminology of this package *blueprint* specifies *how to construct object of some specified type*.
It stores class name and set of build instructiuons.

```php
use Nayjest\Builder\Blueprint;
$blueprint = new Blueprint(
  '\My\ExamplePackage\Person',  # Constructed class name
  []                            # Array of build instructions
);
```

##### 3.3.2 Builders

Next, you will instantiate a builder with previously created blueprint as constructor argument.
In terminology of this package, *builder* is a instance of Nayjest\Builder\Builder class, initialized with a blueprint of constructed class. This object has public _build($input)_ method that accepts constructed class configurations, builds instance and returns it.

Builders are suitable for reusing. You can build multiple objects specified by same blueprint using same builder.

```php
use Nayjest\Builder\Builder;

$builder = new Builder($blueprint);

$john = $builder->build([
  'name' => 'John',
  'age' => 27
]);

var_dump($john instanceof \My\ExamplePackage\Person); // result: true
var_dump($john->getAge());  // result: 27
```

##### 3.3.3 Scaffold and Instructions

During taget object building, builder creates temporary object, called *scaffold*.
Scaffold contains all information needed to build object (input config, class name, constructor arguments, target instance when it's ready).

This class is importand since all build instructions works with scaffold, scaffold provides interface for accessing all required data to instructions.

And finally, instructions.
In terminology of this package, instruction is an instance of class that implements _Nayjest\Builder\Instructions\Base\InstructionInterface_ and can modify data inside scaffold.

There is a set of predefined instructions, but you can create your own (the dirty way is usage of _Nayjest\Builder\Instructions\Base\Instruction\CustomInstruction_ initialized by user function that will perform operations you want).

Also, instantiating target object and setting public properties or properties that has _setters_ with corresponding names in camel case (i.e. setSomeAttribute($val) for 'some_attribute' input field) does not requires specific instruction in class blueprint, it's operations, performed by default.

## 4. Build Instructions 

#### `Nayjest\Builder\Instructions\CustomInstruction` 
Applies user function to scaffold.

#### `Nayjest\Builder\Instructions\SetValue` 
Can be used to specify default values in build configuration or overwrite existing.

#### `Nayjest\Builder\Instructions\Remove` 
Removes value from input configuration if exists.

#### `Nayjest\Builder\Instructions\Mapping\Build` 
Replaces value by object builded using specified class blueprint.

#### `Nayjest\Builder\Instructions\Mapping\BuildChildren` 
Replaces array elements inside target field by objects builded using specified class blueprint.

#### `Nayjest\Builder\Instructions\Mapping\ClassName` 
Uses value in specified field as target class name.

#### `Nayjest\Builder\Instructions\Mapping\ConstructorArgument` 
Uses value in specified field as constructor argument.

#### `Nayjest\Builder\Instructions\Mapping\CustomMapping` 
Applies user function to specified field.

#### `Nayjest\Builder\Instructions\Mapping\Rename` 
Renames specified field inside input configuration.

## 5. Testing

Run following command:

```bash
phpunit
```

## 6. License

© 2014 — 2015 Vitalii Stepanenko

Licensed under the MIT License.

Please see [License File](LICENSE) for more information.
