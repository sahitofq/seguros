<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsFormsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ws_forms', function (Blueprint $table) {
			$table->id('form_id');

			$table->string('form_person_name', 250);
			$table->enum('form_person_doctype', array(
				'CD',
				'CC',
				'CE',
				'N',
				'PA',
				'RC',
				'TI',
			));

			$table->string('form_person_docnumber', 250);
			$table->enum('form_person_gender', array(
				'F',
				'M',
				'PJ',
			));

			$table->dateTime('form_person_birth')->nullable();
			$table->string('form_person_email', 250);
			$table->string('form_person_phone', 15);
			$table->string('form_vehi_placa', 6);
			$table->string('form_vehi_marca', 250);
			$table->string('form_vehi_model', 4);
			$table->string('form_vehi_code', 20);
			$table->enum('form_vehi_used', array(
				'Nuevo',
				'Usado',
			));

			$table->string('form_vehi_city', 20);

			$table->timestamp('form_created')->nullable();
			$table->timestamp('form_updated')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('ws_forms');
	}
}
