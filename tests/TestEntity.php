<?php
namespace tests;

use extas\components\Item;
use extas\components\samples\THasSample;
use extas\components\THasAliases;
use extas\components\THasName;
use extas\interfaces\IHasAliases;
use extas\interfaces\IHasName;
use extas\interfaces\samples\IHasSample;

/**
 * Class TestEntity
 *
 * @package tests
 * @author jeyroik@gmail.com
 */
class TestEntity extends Item implements IHasName, IHasSample
{
    use THasSample;
    use THasName;

    protected function getSubjectForExtension(): string
    {
        return 'test';
    }
}
