<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\BusinessProfile;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Views;
use App\Models\Favourite;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\Chat;
use App\Models\Message;
use App\Http\Requests\SignupRequest;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Stripe;
use Exception;
use App\Http\Requests\UploadFileRequest;

class SettingController extends Controller
{
    use ResponseTrait;

    // Upload File and Get Link 
    public function uploadFile(UploadFileRequest $request)
    {
        $fileNames = [];
        if ($request->hasFile('files')) {
            try {
                foreach ($request->file('files') as $file) {
                    $name = time() . $file->getClientOriginalName();
                    $path = public_path('/files');
                    if (!is_dir($path)) {
                        mkdir($path, 777, true);
                    }
                    $file->move($path, $name);
                    // $fileNames = $name;
                    $fileNames[] = url('public/files') . '/' .  $name;
                }
            } catch (Exception $e) {
                $message = $e->getMessage();
                return $this->failure($message);
            }
            return $this->sendResponse($fileNames, 'Image Links');
        }
    }
}
