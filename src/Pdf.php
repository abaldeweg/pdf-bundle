<?php

namespace Baldeweg\Bundle\PdfBundle;

use Symfony\Component\Yaml\Yaml;
use Twig\Environment;

class Pdf implements PdfInterface
{
    public function __construct(private Environment $twig)
    {
    }

    public function create(string $path, string $filename, string $content, string $meta = '', string $template = 'letter'): string
    {
        return $this->writePdf(
            $path . '/' . $filename,
            $filename,
            $this->renderTemplate(
                $template,
                $this->toMarkdown($content),
                $this->toYaml($meta)
            )
        );
    }

    protected function renderTemplate(string $template, string $content, array $meta): string
    {
        return $this->twig->render(
            '@BaldewegPdf/' . $template . '.html.twig',
            [
                'content' => $content,
                'meta' => $meta,
            ]
        );
    }

    protected function toYaml(string $meta): array
    {
        return Yaml::parse($meta);
    }

    protected function toMarkdown(string $content): string
    {
        $markdown = new \Parsedown();

        return $markdown->text($content);
    }

    protected function writePdf(string $filename, string $title, string $content): string
    {
        $pdf = new TcpdfUtility();
        $pdf->SetCreator('baldeweg/pdf-bundle');
        $pdf->SetTitle($title);
        $pdf->SetMargins(24, 10, 24, true);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('helvetica', '', 12);
        $pdf->AddPage();
        $pdf->writeHTML($content, true, false, true, false, '');
        $pdf->lastPage();

        return $pdf->Output($filename . '.pdf', 'F');
    }
}
