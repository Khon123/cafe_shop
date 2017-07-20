<?php

use App\Helpers\FieldConstant;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array(
                FieldConstant::NAME     => 'admin',
                FieldConstant::USERNAME => 'admin',
                FieldConstant::EMAIL    => 'example@gmail.com',
                FieldConstant::PASSWORD => bcrypt(123),
                FieldConstant::AVATAR   => 'avatar.png'
            )
        );
        foreach ($users as $user){
            DB::table('users')->insert([
                FieldConstant::NAME       => $user[FieldConstant::NAME],
                FieldConstant::USERNAME   => $user[FieldConstant::USERNAME],
                FieldConstant::EMAIL      => $user[FieldConstant::EMAIL],
                FieldConstant::PASSWORD   => $user[FieldConstant::PASSWORD],
                FieldConstant::AVATAR     => $user[FieldConstant::AVATAR],
                FieldConstant::CREATED_AT => Carbon::now(),
                FieldConstant::UPDATED_AT => Carbon::now()
            ]);
        }
    }

}
