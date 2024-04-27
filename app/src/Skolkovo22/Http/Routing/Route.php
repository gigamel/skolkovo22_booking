<?php

declare(strict_types=1);

namespace Skolkovo22\Http\Routing;

class Route implements RouteInterface
{
    /**
     * @param string $name
     * @param array $methods
     * @param string $rule
     * @param string $action
     */
    public function __construct(
        protected string $name,
        protected array $methods,
        protected string $rule,
        protected string $action
    ) {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getRule(): string
    {
        return $this->rule;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }
}
