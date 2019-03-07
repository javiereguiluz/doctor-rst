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

namespace app\tests\Rule;

use App\Rule\VersionaddedDirectiveMinVersion;
use PHPUnit\Framework\TestCase;

class VersionaddedDirectiveMinVersionTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider checkProvider
     */
    public function check($expected, $line)
    {
        $this->assertSame(
            $expected,
            (new VersionaddedDirectiveMinVersion())->check(new \ArrayIterator([$line]), 0)
        );
    }

    public function checkProvider()
    {
        return [
            [
                null,
                '.. versionadded:: 3.4',
            ],
            [
                null,
                '.. versionadded:: 4.2',
            ],
            [
                'Please only provide ".. versionadded::" if the version is greater/equal "3.4"',
                '.. versionadded:: 2.8',
            ],
        ];
    }
}
