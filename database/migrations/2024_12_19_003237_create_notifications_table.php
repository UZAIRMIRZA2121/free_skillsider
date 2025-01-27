<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_notifications_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade'); // Package foreign key
            $table->text('message');
            $table->longText('long_message');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Admin who created the notification
            $table->timestamps();
        });

        // Create a pivot table for the relationship between users and notifications
        Schema::create('notification_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_read')->default(false); // Default as unread
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notification_user');
        Schema::dropIfExists('notifications');
    }
}
