<?php
/**
 * Copyright (c) A.S Nassiry
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/nassiry/filesize-handler
 */

namespace Nassiry\FileSizeUtility\Extensions;

use Aws\S3\S3Client;
use Nassiry\FileSizeUtility\Extensions\Exceptions\S3Exceptions;
use Nassiry\FileSizeUtility\Sources\FileSourceInterface;

class S3Files implements FileSourceInterface
{
    /**
     * The AWS S3 client instance.
     *
     * @var S3Client
     */
    private S3Client $client;

    /**
     * The name of the S3 bucket.
     *
     * @var string
     */
    private string $bucketName;

    /**
     * The file path in the S3 bucket.
     *
     * @var string
     */
    private string $filePath;

    /**
     * S3Files constructor.
     *
     * Initializes the S3 client, bucket name, and file path. Throws an exception if the AWS SDK is not installed.
     *
     * @param S3Client $client The S3 client.
     * @param string $bucketName The name of the S3 bucket.
     * @param string $filePath The path of the file in the S3 bucket.
     *
     * @throws S3Exceptions If the AWS SDK is not installed.
     */
    public function __construct(S3Client $client, string $bucketName, string $filePath)
    {
        if (!class_exists(S3Client::class)) {
            throw S3Exceptions::missingDependency();
        }

        $this->client = $client;
        $this->bucketName = $bucketName;
        $this->filePath = $filePath;
    }

    /**
     * Gets the size of the file in bytes from the S3 bucket.
     *
     * Uses the AWS S3 client to get the file metadata and retrieves the file size.
     *
     * @return int The size of the file in bytes.
     *
     * @throws S3Exceptions If the file size cannot be retrieved.
     */
    public function getSizeInBytes(): int
    {
        $result = $this->client->headObject([
            'Bucket' => $this->bucketName,
            'Key'    => $this->filePath,
        ]);

        if (!isset($result['ContentLength'])) {
            throw S3Exceptions::fileSizeError($this->filePath);
        }

        return $result['ContentLength'];
    }
}