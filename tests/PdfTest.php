<?php

namespace Baldeweg\Bundle\PdfBundle\Tests;

use Baldeweg\Bundle\PdfBundle\Pdf;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class PdfTest extends TestCase
{
    public function testPdf()
    {
        $twig = $this->getMockBuilder(\Twig\Environment::class)
            ->disableOriginalConstructor()
            ->getMock();

        vfsStream::setup('root');
        $path = vfsStream::url('root');

        $pdf = new Pdf($twig);
        $pdf->create($path, 'test', '', 'key: value', 'letter');

        $this->assertTrue(\is_file($path . '/test.pdf'));
    }
}
