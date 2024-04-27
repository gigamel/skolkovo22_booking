<?php

declare(strict_types=1);

namespace App\Common;

use App\Http\Response;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

abstract class AbstractModule
{
    /** @var string */
    protected string $dir;
    
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
        $view = $this->dir . '/view/' . $template;
        extract($vars);
        
        ob_start();
        require_once $view;
        $content = ob_get_contents();
        ob_end_clean();
        
        return new Response($content, $statusCode, $headers);
    }
    
    /**
     * @return ServerMessageInterface
     */
    abstract public function run(): ServerMessageInterface;
}
