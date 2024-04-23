<?php

namespace Skolkovo22\Http\Protocol;

interface ServerMessageInterface
{
    public const
        STATUS_OK = 200,
        STATUS_FORBIDDEN = 403,
        STATUS_NOT_FOUND = 404
    ;
    
    public const MESSAGES = [
        self::STATUS_OK => 'OK',
        self::STATUS_FORBIDDEN => 'Forbidden',
        self::STATUS_NOT_FOUND => 'Not Found',
    ];
    
    /**
     * @return int
     */
    public function getStatusCode(): int;
    
    /**
     * @return string
     */
    public function getBody(): string;
    
    /**
     * @return array
     */
    public function getHeaders(): array;
    
    /**
     * @return void
     *
     * @throws ProtocolException
     */
    public function send(): void;
}
