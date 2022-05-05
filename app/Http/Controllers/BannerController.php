<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Banner;

class BannerController extends BaseController
{
    public function index(){
        try {
            $banner = Banner::where('banners.status', '=', 1)->get();
            if ($banner->count()) {
                foreach($banner as $row) {
                    $data[$row->id]['id'] = $row->id;
                    $data[$row->id]['title'] = $row->title;
                    $data[$row->id]['image'] = $row->banner_img;
                    $data[$row->id]['orderby'] = $row->orderby;

                }
                return $this->normalResponse(array_values($data));
            }
            $message = app_lang('No Data Available!', 'មិនមានទិន្នន័យ!');
            return $this->noDataAvailable($message);
        } catch (\Throwable $throwable) {
            return $this->errorsResponse($throwable);
        }
    }
}
