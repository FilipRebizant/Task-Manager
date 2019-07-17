<?php

namespace App\Services\DataFixtures;

use Faker\Factory;
use Faker\Generator;

abstract class BaseFixture
{
    /** @var Generator */
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }
}
