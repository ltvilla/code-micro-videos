<?php

namespace Tests\Stubs\Model;

use App\Models\Traits\UploadFiles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Schema\Blueprint;

class UploadFilesStub extends Model
{
    use UploadFiles;

    protected static $fileFields = ['file1', 'file2'];

    protected function uploadDir()
    {
        return "1";
    }
}

