<?php

declare(strict_types=1);

namespace App\Common;

abstract class AbstractTemplateRenderer
{
    /**
     * @param string $baseDirectory
     *
     * @return void
     */
    abstract public function setBaseDirectory(string $baseDirectory): void;
    
    /**
     * @param string $template
     * @param array $vars
     *
     * @return string
     */
    abstract public function render(string $template, array $vars = []): string;
}
