# baldeweg/pdf-bundle

Offers tools for creating pdf files.

## Getting Started

```shell
composer req baldeweg/pdf-bundle
```

Activate the bundle in your `config/bundles.php`, if not done automatically.

```php
Baldeweg\Bundle\PdfBundle\BaldewegPdfBundle::class => ['all' => true],
```

### Usage

```php
use Baldeweg\Bundle\PdfBundle\Pdf;

$pdf = new Pdf();
$pdf->create($path, $filename, $content, $meta);
```

## Template

With the default template the `meta` field should look like the following. You are free to overwrite this template (with `@BaldewegPdf` prefix) as documented at <https://symfony.com/doc/current/bundles/override.html#override-templates>. When using a base64 encoded image remove `data:image/png;base64,`, instead the string must start with an `@`.

```yaml
sender:
- name
- street
- zip
- city
receiver:
- name
- street
- zip, city
details:
- name: date
  value: 01.01.2021
subject:
- subject 1
- subject 2
salutation: Dear Jane,
valediction: Greetings
signee:
- John
logo: url
```
