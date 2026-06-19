<?php

declare(strict_types=1);

namespace App\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Tempest\Http\Responses\NotFound;
use Tempest\Router\Get;

final readonly class LegalController
{
    #[Get('/privacy-policy')]
    public function privacyPolicy(): Response | NotFound
    {
        return $this->renderLegalPage(
            title: 'Privacy Policy',
            fileName: 'privacy-policy.md',
        );
    }

    #[Get('/terms-and-conditions')]
    public function termsAndConditions(): Response | NotFound
    {
        return $this->renderLegalPage(
            title: 'Terms and Conditions',
            fileName: 'terms-and-conditions.md',
        );
    }

    private function renderLegalPage(string $title, string $fileName): Response | NotFound
    {
        $content = $this->readLegalMarkdown($fileName);

        if ($content === null) {
            return new NotFound();
        }

        return Inertia::render('LegalPage', [
            'title' => $title,
            'content' => $content,
        ]);
    }

    private function readLegalMarkdown(string $fileName): ?string
    {
        $paths = [
            __DIR__ . '/../../data/legal/' . $fileName,
            __DIR__ . '/../../example-data/legal/' . $fileName,
        ];

        foreach ($paths as $path) {
            if (file_exists($path)) {
                return file_get_contents($path) ?: '';
            }
        }

        return null;
    }
}
