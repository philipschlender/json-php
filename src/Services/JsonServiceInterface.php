<?php

namespace Json\Services;

use Json\Exceptions\JsonException;

interface JsonServiceInterface
{
    /**
     * @param array<int|string,mixed> $data
     *
     * @throws JsonException
     */
    public function arrayToJson(array $data): string;

    /**
     * @return array<int|string,mixed>
     *
     * @throws JsonException
     */
    public function jsonToArray(string $json): array;
}
