<?php

declare(strict_types=1);

namespace App\Common;

use App\Http\Response;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

abstract class AbstractModule
{
    /** @var string */
    protected string $dir;
    
    /** @var AbstractTemplateRenderer */
    protected $templateRenderer;

    /**
     * @param string $dir
     *
     * @return void
     */
    public function setDir(string $dir): void
    {
        $this->dir = $dir;
    }
    
    /**
     * @param AbstractTemplateRenderer $templateRenderer
     *
     * @return void
     */
    public function setTemplateRenderer(AbstractTemplateRenderer $templateRenderer): void
    {
        $this->templateRenderer = $templateRenderer;
        $this->templateRenderer->setBaseDirectory($this->dir . '/view');
    }

    /**
     * @param string $template
     * @param array $vars
     * @param int $statusCode
     * @param array $headers
     *
     * @return ServerMessageInterface
     */
    public function render(
        string $template,
        array $vars = [],
        int $statusCode = ServerMessageInterface::STATUS_OK,
        array $headers = []
    ): ServerMessageInterface {
        return new Response(
            $this->templateRenderer->render($template, $vars),
            $statusCode,
            $headers
        );
    }
    
    /**
     * @return ServerMessageInterface
     */
    abstract public function run(): ServerMessageInterface;
}
