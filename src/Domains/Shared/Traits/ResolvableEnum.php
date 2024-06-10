<?php

namespace Domains\Shared\Traits;

trait ResolvableEnum
{
    public static function resolve($input): self
    {
        if ($input instanceof self) {
            return $input;
        }

        if (is_string($input)) {
            return self::fromName($input) ?? self::default();
        }

        return self::default();
    }

    private static function fromName(string $name): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->name === $name) {
                return $case;
            }
        }

        throw new \ValueError("$name is not a valid backing value for enum ".self::class);
    }

    public static function types(): array
    {
        $types = [];
        foreach (self::cases() as $case) {
            $types[] = $case->name;
        }

        return $types;
    }

    abstract public static function default(): self;
}
