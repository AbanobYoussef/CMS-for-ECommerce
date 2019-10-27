<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');


            $table->string('title')->nullable();
            $table->string('photo')->nullable();
            $table->longtext('content')->nullable();



            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');



            $table->integer('trad_id')->unsigned()->nullable();
            $table->foreign('trad_id')->references('id')->on('tradmarks')->onDelete('cascade');


            $table->integer('mani_id')->unsigned()->nullable();
            $table->foreign('mani_id')->references('id')->on('manifactories')->onDelete('cascade');


            $table->integer('color_id')->unsigned()->nullable();
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');


            $table->integer('currency_id')->unsigned()->nullable();
            $table->foreign('currency_id')->references('id')->on('size')->onDelete('cascade');


            $table->string('size')->nullable();
            $table->integer('size_id')->unsigned()->nullable();
            $table->foreign('size_id')->references('id')->on('countries');


            $table->decimal('price', 5, 2)->nullable();
            $table->integer('stock')->default(0);


            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();

            $table->longtext('other_data')->nullable();

            $table->date('start_offer_at')->nullable();
            $table->date('end_offer_at')->nullable();
            $table->decimal('price_offer', 5, 2);




            $table->string('weight')->nullable();
            $table->integer('weight_id')->unsigned()->nullable();
            $table->foreign('weight_id')->references('id')->on('weights')->onDelete('cascade');



            $table->enum('status',['panding','refused','active'])->default('panding');
            $table->longtext('reason')->nullable();
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
        Schema::dropIfExists('products');
    }
}
