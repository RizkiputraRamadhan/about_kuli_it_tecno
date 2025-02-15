<?php

namespace App\Services;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;

class FirebaseStorage
{
    protected $storage;
    protected $bucket;

    public function __construct()
    {
        $this->storage = new StorageClient([
            'keyFilePath' => config('services.firebase.credentials'),
        ]);

        $this->bucket = $this->storage->bucket(config('services.firebase.storage_bucket'));
    }

    public function uploadFile($file, $path)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $firebasePath = $path . '/' . $fileName;

        $this->bucket->upload(
            file_get_contents($file->getRealPath()),
            ['name' => $firebasePath]
        );

        return $firebasePath;
    }
}
