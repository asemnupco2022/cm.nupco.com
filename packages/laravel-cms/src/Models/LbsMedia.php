<?php

namespace rifrocket\LaravelCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;

class LbsMedia extends Model
{
    use HasFactory;

    const MEDIA_PUBLISH_PUBLIC='public';    // public
    const MEDIA_PUBLISH_PRIVATE='private';  // private

    const MEDIA_RESIZE='true';  // media resize
    const MEDIA_ORIGINAL='app_original_media';  // original size
    const MEDIA_THUMBNAIL='app_thumbnail_image';   // 150x150
    const MEDIA_MINI='app_mini_image';   // 300x169
    const MEDIA_MEDIUM='app_medium_image';  // 768x432
    const MEDIA_LARGE='app_large_image';  // 1568x882

    const MEDIA_DEFAULT_IMAGE=LbsConstants::BASE_ADMIN_ASSETS.'defaults/default_img.jpg';
    const MEDIA_DEFAULT_PDF=LbsConstants::BASE_ADMIN_ASSETS.'defaults/default_pdf.jpg';
    const MEDIA_DEFAULT_DOC=LbsConstants::BASE_ADMIN_ASSETS.'defaults/default_doc.jpg';
    const MEDIA_DEFAULT_VIDEO=LbsConstants::BASE_ADMIN_ASSETS.'defaults/default_video.jpg';
}
