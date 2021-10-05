<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use rifrocket\LaravelCms\Models\LbsMedia;

class CreateLbsMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lbs_media', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('alternative_title')->nullable();
            $table->string('caption')->nullable();
            $table->string('description')->nullable();
            $table->string('categories')->nullable();
            $table->string('slug')->unique();
            $table->bigInteger('media_sibling')->nullable();
            $table->enum('media_type',[LbsMedia::MEDIA_ORIGINAL,LbsMedia::MEDIA_THUMBNAIL,LbsMedia::MEDIA_MINI,LbsMedia::MEDIA_MEDIUM,LbsMedia::MEDIA_LARGE])->default(LbsMedia::MEDIA_ORIGINAL);
            $table->text('media_thumbnail')->nullable();
            $table->text('media_thumbnail_default')->nullable();
            $table->enum('media_publish_type',[LbsMedia::MEDIA_PUBLISH_PUBLIC,LbsMedia::MEDIA_PUBLISH_PRIVATE])->default(LbsMedia::MEDIA_PUBLISH_PUBLIC);
            $table->text('media_owners');
            $table->string('media_extension');
            $table->text('media_owner_model')->nullable();
            $table->bigInteger('media_year');
            $table->string('media_month');
            $table->bigInteger('media_date');
            $table->text('media_path');
            $table->text('json_data')->nullable();
            $table->enum('status',['new','active', 'deactivated', 'suspended'])->default('active');
            $table->text('suspendReason')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lbs_media');
    }
}
