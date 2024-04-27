<?php

declare(strict_types=1);

namespace App\Template;

use App\Common\AbstractTemplateRenderer;

final class RendererEngine extends AbstractTemplateRenderer
{
    /** @var string */
    protected $baseDirectory;
    
    /**
     * @param string $baseDirectory
     *
     * @return void
     */
    public function setBaseDirectory(string $baseDirectory): void
    {
        $this->baseDirectory = $baseDirectory;
    }
    
    /**
     * @param string $template
     * @param array $vars
     *
     * @return string
     */
    public function render(string $template, array $vars = []): string
    {
        extract($vars);
        unset($vars);
        
        ob_start();
        require_once $this->baseDirectory . '/' . $template;
        $content = ob_get_contents();
        ob_end_clean();
        
        return $content;
    }
}
