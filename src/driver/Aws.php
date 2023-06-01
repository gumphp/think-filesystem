<?php
namespace gumphp\filesystem\driver;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\FilesystemAdapter;
use think\filesystem\Driver;

class Aws extends Driver
{
    protected $config = [
        'prefix' => '/',
    ];

    /**
     *
     * @return FilesystemAdapter
     */
    protected function createAdapter(): FilesystemAdapter
    {
        $client = $this->createAwsS3Client();
        return new AwsS3V3Adapter($client, $this->config['bucket'], $this->config['prefix']);
    }

    /**
     *
     * @return S3Client
     */
    protected function createAwsS3Client()
    {
        return new S3Client([
            'credentials' => $this->config['credentials'],
            'region' => $this->config['region'],
            'version' => $this->config['version'],
        ]);
    }

    /**
     * 获取文件访问地址
     *
     * @param string $path 文件路径
     * @return string
     */
    public function url(string $path): string
    {
        return $this->createAwsS3Client()->getObjectUrl($this->config['bucket'], $path);
    }
}
