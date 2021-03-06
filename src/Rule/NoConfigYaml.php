<?php

declare(strict_types=1);

/*
 * This file is part of DOCtor-RST.
 *
 * (c) Oskar Stark <oskarstark@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Rule;

use App\Value\Lines;
use App\Value\RuleGroup;

class NoConfigYaml extends AbstractRule implements Rule
{
    public static function getGroups(): array
    {
        return [
            RuleGroup::Sonata(),
            RuleGroup::Symfony(),
        ];
    }

    public function check(Lines $lines, int $number): ?string
    {
        $lines->seek($number);

        if ($lines->current()->raw()->match('/app\/config\/config\.yml/')) {
            return 'Please use specific config class in "config/packages/..." instead of "app/config/config.yml"';
        }

        return null;
    }
}
