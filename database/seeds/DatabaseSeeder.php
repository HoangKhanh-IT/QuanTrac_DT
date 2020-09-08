<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$data = [
            'email' => 'ductm@gmail.com',
            'name' => 'Trần Minh Đức',
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'level' => '1',
        ];
        DB::table('user')->insert($data);
		
        //Lệnh import dữ liệu: php artisan db:seed --class=DatabaseSeeder
        // $this->call(UserSeeder::class);
    }
}
