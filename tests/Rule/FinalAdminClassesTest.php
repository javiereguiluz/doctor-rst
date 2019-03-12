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

namespace App\Tests\Rule;

use App\Rule\FinalAdminClasses;
use App\Tests\RstSample;
use PHPUnit\Framework\TestCase;

class FinalAdminClassesTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider checkProvider
     */
    public function check($expected, RstSample $sample)
    {
        $this->assertSame(
            $expected,
            (new FinalAdminClasses())->check($sample->getContent(), $sample->getLineNumber())
        );
    }

    public function checkProvider()
    {
        return [
            [
                'Please use "final" for Admin class',
                new RstSample('class TestAdmin extends AbstractAdmin'),
            ],

            [
                'Please use "final" for Admin class',
                new RstSample('    class TestAdmin extends AbstractAdmin'),
            ],
            [
                null,
                new RstSample('final class TestAdmin extends AbstractAdmin'),
            ],
        ];
    }
}