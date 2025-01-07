<?php


namespace Nassiry\FileSizeUtility\Extensions\Exceptions;

use RuntimeException;

class S3Exceptions extends RuntimeException
{
    // Unable to determine file size for S3 object
    public static function fileSizeError($filePath): self
    {
        return new self("Unable to determine file size for S3 object: {$filePath}");
    }

    // Missing cloud dependencies.
    public static function missingDependency(): self
    {
        return new self("AWS SDK is not installed. Please run 'composer require aws/aws-sdk-php' to install it.");
    }
}