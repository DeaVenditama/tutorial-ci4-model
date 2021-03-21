<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		for($i=0;$i<1000;$i++)
		{
			$data = [
				'username' => static::faker()->email,
				'address' => static::faker()->address,
				'fullname' => static::faker()->name,
			];

			$this->db->table('user')->insert($data);
		}
		
	}
}
