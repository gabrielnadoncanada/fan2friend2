<?php

declare(strict_types=1);

namespace App\Contracts;

/**
 * @property string $name
 */
interface DayLabelInterface
{
    public function getName(): string;

    public function getCharacter(): string;

    public function getCharacterSuffix(): string;
}
