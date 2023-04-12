<?php

use App\Rules\IsValidEmailAddress;

uses()->group('email');

it('can validate an email', function () {

    $rule = new IsValidEmailAddress();

    expect($rule->passes('email', 'me@you.com'))->toBeTrue();

})->skip(getenv('SKIP_TESTS') ?? false, 'Skip tests');


it('throws an exception if the value is not a string', function () {

        $rule = new IsValidEmailAddress();

        $rule->passes('email', 123);

})->throws('InvalidArgumentException', 'The value must be a string!');
