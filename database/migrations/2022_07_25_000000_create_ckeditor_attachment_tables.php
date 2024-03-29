<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('nova_pending_ckeditor_attachments')) {
            Schema::create('nova_pending_ckeditor_attachments', function (Blueprint $table) {
                $table->increments('id');
                $table->string('draft_id')->index();
                $table->string('attachment');
                $table->string('disk');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('nova_ckeditor_attachments')) {
            Schema::create('nova_ckeditor_attachments', function (Blueprint $table) {
                $table->increments('id');
                $table->string('attachable_type');
                $table->unsignedInteger('attachable_id');
                $table->string('attachment');
                $table->string('disk');
                $table->string('url')->index();
                $table->timestamps();

                $table->index(['attachable_type', 'attachable_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nova_pending_ckeditor_attachments');
        Schema::drop('nova_ckeditor_attachments');
    }
};
