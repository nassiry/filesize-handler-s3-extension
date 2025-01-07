<div align="center">

# PHP FileSizeHandler - S3 Extension

![Packagist Downloads](https://img.shields.io/packagist/dt/nassiry/filesize-handler-s3-extension)
![Packagist Version](https://img.shields.io/packagist/v/nassiry/filesize-handler-s3-extension)
![PHP](https://img.shields.io/badge/PHP-%5E8.0-blue)
![License](https://img.shields.io/github/license/nassiry/filesize-handler-s3-extension)

</div>


The **S3 Extension** for `FileSizeHandler` enables support for retrieving file sizes from Amazon S3.

## Installation

Install the extension via Composer:

```bash
composer require nassiry/filesize-handler-s3-extension
```
## Usage
```php
use Nassiry\FileSizeUtility\FileSizeHandler;
use Nassiry\FileSizeUtility\Extensions\S3Files;
use Aws\S3\S3Client;

$s3Client = new S3Client([
    'region' => 'us-east-1',
    'version' => 'latest',
    'credentials' => [
        'key' => 'AWS_ACCESS_KEY',
        'secret' => 'AWS_SECRET_KEY',
    ],
]);

$handler = FileSizeHandler::create()
    ->from(new S3Files(
        $s3Client,           // AWS S3 Client
        'my-bucket',         // S3 bucket name
        'path/to/file.txt'   // File path in S3 bucket
    ))
    ->formattedSize();

echo $handler; // Output: "9.87 MiB"
```
### Features
- Fetch file sizes from Amazon S3.
- Seamlessly integrates with the main `FileSizeHandler` library.

### Contributing
Feel free to submit issues or pull requests to improve the package. Contributions are welcome!

### License
This package is open-source software licensed under the [MIT license](LICENSE).
