<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('display_name')->nullable(false);
            $table->integer('parent_id');
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
        Schema::dropIfExists('permissions');

    }
}

//INSERT INTO `permissions` (`name`, `display_name`, `parent_id`, `created_at`, `updated_at`) VALUES
//( 'menu', 'Menu', 0, NULL, NULL),
//('add_menu', 'Add Menu', 1, NULL, NULL),
//( 'list_menu', 'List Menu', 1, NULL, NULL),
//('edit_menu', 'Edit Menu', 1, NULL, NULL),
//( 'delete_menu', 'Delete Menu', 1, NULL, NULL);
