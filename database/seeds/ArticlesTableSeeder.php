<?php
use App\Http\Controllers\ServiceController;
use Illuminate\Database\Seeder;
use App\Http\Controllers\BlogController;

class ArticlesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\Models\Articles::class, 80)->create();
		$ch = curl_init('http://127.0.0.1:9200/myblogs/');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_exec($ch);
		BlogController::elastic();
	}
}