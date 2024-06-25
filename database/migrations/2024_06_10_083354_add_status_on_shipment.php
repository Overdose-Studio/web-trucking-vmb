<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipments', function (Blueprint $table) {
            // Add `status` column
            $table->enum('status', [
                    'Waiting DTP',
                    'Approving DTP',
                    'Rejected DTP',
                    'Waiting DTA',
                    'Approving DTA',
                    'Waiting Bill',
                    'Completed',
                ])
                ->default('Waiting DTP')
                ->after('party');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipments', function (Blueprint $table) {
            // Drop `status` column
            $table->dropColumn('status');
        });
    }
};
