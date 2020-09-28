<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date');
            $table->integer('invoice_id')->unsigned();
            $table->date('end_date');
            $table->string('credit_term');
            $table->boolean('is_active');
            $table->integer('support_item_no');
            $table->text('description');
            $table->integer('units');
            $table->integer('price');
            $table->integer('gst_code');
            $table->string('amount');
            $table->timestamps();
            $table->foreign('invoice_id')
                ->references('id')->on('invoices')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_lists');
    }
}
