<?php

namespace Skolkovo22\Http\Protocol;

interface ClientMessageInterface
{
    public const
        METHOD_OPTIONS = 'OPTIONS',
        METHOD_GET = 'GET',
        METHOD_HEAD = 'HEAD',
        METHOD_POST = 'POST',
        METHOD_PUT = 'PUT',
        METHOD_PATCH = 'PATCH',
        METHOD_DELETE = 'DELETE',
        METHOD_TRACE = 'TRACE',
        METHOD_CONNEC = 'CONNECT'
    ;
    
    /**
     * @return string
     */
    public function getMethod(): string;
    
    /**
     * @return string
     */
    public function getPath(): string;
    
    /**
     * @return string
     */
    public function getProtocolVersion(): string;
}
