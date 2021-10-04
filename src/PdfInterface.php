<?php

namespace Baldeweg\Bundle\PdfBundle;

interface PdfInterface
{
    public function create(string $path, string $filename, string $content, string $meta = '', string $template = 'letter'): string;
}
