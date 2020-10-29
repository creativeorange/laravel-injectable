# Laravel Injectable

[![Total Downloads](https://poser.pugx.org/creativeorange/laravel-injectable/d/total.svg)](https://packagist.org/packages/creativeorange/laravel-injectable)
[![Latest Stable Version](https://poser.pugx.org/creativeorange/laravel-injectable/v/stable.svg)](https://packagist.org/packages/creativeorange/laravel-injectable)
[![License](https://poser.pugx.org/creativeorange/laravel-injectable/license.svg)](https://packagist.org/packages/creativeorange/laravel-injectable)

A package for injecting variables into models after they were retrieved from the database.

## Installation

You can install the package via composer:

```bash
composer require creativeorange/laravel-injectable
```

## Usage
In this example we make use of a `Question` model. This model has two attributes: `name` and `description`.

## How are variables stored
Under the hood, we use Laravel's translation system and helper method `__()`. Therefor we need variables to be stored as `:variable_name`. In this readme, we use the variable `:company_name`.


## Setup the model
First, make sure the `$casts` attribute on the model is filled:
```php
protected $casts = [
    'name'          => \Creativeorange\LaravelInjectable\Casts\InjectableCast::class,
    'description'   => \Creativeorange\LaravelInjectable\Casts\InjectableCast::class
];
```

After this, we can replace variables in the from the database retrieved attributes.

## Per attribute
```php
$question = \App\Models\Question::first();

$question->name->inject('company_name', 'Acme Inc.');

// or to use multiple:
$question->name->inject(['company_name', 'Acme Inc.', 'another_var' => 'Another val']);

echo $question->name; // will output the name with the variables replaced
echo $question->description; // will output the original text, without any replacements; for example: This is the description for company :company_name
```

As shown here, only the `name` attributes will contain replacements, the `description` still shows the original text from the database.

## Per model
For this, the model needs to use the `App\InjectableTrait` trait.
After this, a `inject` method is available on the model.

```php
$question = \App\Models\Question::first();

$question->inject('company_name', 'Acme Inc.');
// or to use multiple:
$question->inject(['company_name', 'Acme Inc.', 'another_var' => 'Another val']);

echo $question->name; // will output the name with the variables replaced
echo $question->description; // will output the description with the variables replaced
```

In this example, all variables will be replaced in the fields that were casted by the `App\Casts\InjectableCast`.

## Per request-cycle
Another use case is that you want to replace all the variables on request-level.

```php
// Use the alias
\LaravelInjectable::set('company_name', 'Acme Inc.');

// Or directly use the facade
\CreativeOrange\LaravelInjectable\Facades\LaravelInjectable::set('company_name', 'Acme Inc.');

// Or via the app method
app(\Creativeorange\LaravelInjectable\LaravelInjectable::class)->set('company_name', 'Acme Inc.');

// Or set multiple vars at once
\LaravelInjectable::set(['company_name', 'Acme Inc.', 'another_var' => 'Another val']);
\LaravelInjectable::set('company_name', 'Acme Inc.')->set('another_var', 'Another val');

$question = \App\Models\Question::first();
echo $question->name; // will output the name with the variables replaced
echo $question->description; // will output the description with the variables replaced
```

### Bonus: The Blade directive: Per request-cycle
Same as above, but then in blade
```blade
@inj('company_name', 'Acme Inc.')
//or to use multiple
@inj(['company_name', 'Acme Inc.', 'another_var' => 'Another val'])

@php($question = \App\Models\Question::first());
{{ $question->name }} {{-- will output the name with the variables replaced --}} 
{{ $question->description}} {{-- will output the description with the variables replaced --}}
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Credits

- [Jaco Tijssen](https://github.com/creativeorange)
- [Jonathan Hafkamp](https://github.com/creativeorange)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.