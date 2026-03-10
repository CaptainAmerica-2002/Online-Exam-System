<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPercentageToExamAttemptsTable extends Migration
{
    public function up()
    {
        Schema::table('exam_attempts', function (Blueprint $table) {
            $table->float('percentage')->default(0)->after('score');
        });
    }

    public function down()
    {
        Schema::table('exam_attempts', function (Blueprint $table) {
            $table->dropColumn('percentage');
        });
    }
}
