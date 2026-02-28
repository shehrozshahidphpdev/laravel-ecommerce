<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MyHelper
{
  public static function customerCheck(): bool
  {
    return Auth::guard('customer')->check();
  }

  public static function customerName()
  {
    return Auth::guard('customer')->user();
  }

  public static function customerId()
  {
    return Auth::guard('customer')->id();
  }

  public static function uploadFile($file)
  {
    $destination = "uploads";

    $getFileName = time() . '_' . Str::random(10) . '.'  . $file->getClientOriginalExtension();

    $path =  $file->storeAs($destination, $getFileName, 'public');

    return $path;
  }

  public static function removeFile($file)
  {

    $filePath = storage_path('app/public/' . $file);

    if (file_exists($filePath)) {
      @unlink($filePath);
    }
    Log::info("File Removed Successfully", [
      "file_path" => $filePath
    ]);
  }
}
