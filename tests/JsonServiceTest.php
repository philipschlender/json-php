<?php

namespace Tests;

use Json\Exceptions\JsonException;
use Json\Services\JsonService;
use Json\Services\JsonServiceInterface;
use PHPUnit\Framework\Attributes\DataProvider;

class JsonServiceTest extends TestCase
{
    protected JsonServiceInterface $jsonService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->jsonService = new JsonService();
    }

    /**
     * @param array<int|string,mixed> $data
     */
    #[DataProvider('dataProviderArrayToJson')]
    public function testArrayToJson(array $data, string $expectedJson): void
    {
        $json = $this->jsonService->arrayToJson($data);

        $this->assertEquals($expectedJson, $json);
    }

    /**
     * @return array<int,array<string,mixed>>
     */
    public static function dataProviderArrayToJson(): array
    {
        return [
            [
                'data' => [
                    [
                        'A' => '1',
                        'B' => '2',
                        'C' => '3',
                    ],
                    [
                        'A' => '4',
                        'B' => '5',
                        'C' => '6',
                    ],
                ],
                'expectedJson' => '[{"A":"1","B":"2","C":"3"},{"A":"4","B":"5","C":"6"}]',
            ],
            [
                'data' => [],
                'expectedJson' => '[]',
            ],
        ];
    }

    /**
     * @param array<int|string,mixed> $expectedData
     */
    #[DataProvider('dataProviderJsonToArray')]
    public function testJsonToArray(string $json, array $expectedData): void
    {
        $data = $this->jsonService->jsonToArray($json);

        $this->assertEquals($expectedData, $data);
    }

    /**
     * @return array<int,array<string,mixed>>
     */
    public static function dataProviderJsonToArray(): array
    {
        return [
            [
                'json' => '[{"A":"1","B":"2","C":"3"},{"A":"4","B":"5","C":"6"}]',
                'expectedData' => [
                    [
                        'A' => '1',
                        'B' => '2',
                        'C' => '3',
                    ],
                    [
                        'A' => '4',
                        'B' => '5',
                        'C' => '6',
                    ],
                ],
            ],
            [
                'json' => '[]',
                'expectedData' => [],
            ],
        ];
    }

    public function testJsonToArraySyntaxError(): void
    {
        $this->expectException(JsonException::class);
        $this->expectExceptionMessage('Syntax error');

        $this->jsonService->jsonToArray('');
    }
}
