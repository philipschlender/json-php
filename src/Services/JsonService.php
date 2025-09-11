<?php

namespace Json\Services;

use Json\Exceptions\JsonException;

class JsonService implements JsonServiceInterface
{
    /**
     * @param array<int|string,mixed> $data
     *
     * @throws JsonException
     */
    public function arrayToJson(array $data): string
    {
        try {
            return json_encode($data, JSON_THROW_ON_ERROR, 512);
        } catch (\Throwable $throwable) {
            throw new JsonException($throwable->getMessage(), 0, $throwable);
        }
    }

    /**
     * @return array<int|string,mixed>
     *
     * @throws JsonException
     */
    public function jsonToArray(string $json): array
    {
        try {
            return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (\Throwable $throwable) {
            throw new JsonException($throwable->getMessage(), 0, $throwable);
        }
    }
}
