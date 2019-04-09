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

use App\Annotations\Rule\Description;
use App\Handler\RulesHandler;
use App\Rst\RstParser;

/**
 * @Description("Make sure Composer `--dev` option for `require` command is not used at the end.")
 */
class ComposerDevOptionNotAtTheEnd extends AbstractRule implements Rule
{
    public static function getGroups(): array
    {
        return [RulesHandler::GROUP_SYMFONY];
    }

    public function check(\ArrayIterator $lines, int $number)
    {
        $lines->seek($number);
        $line = $lines->current();

        $line = RstParser::clean($line);
        if (preg_match('/composer require(.*)\-\-dev$/', $line)) {
            return 'Please move "--dev" option before the package';
        }
    }
}
