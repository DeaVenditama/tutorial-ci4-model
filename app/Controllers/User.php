<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
	public function index()
	{
		
	}

	public function contoh_find_single()
	{
		$userModel = new \App\Models\UserModel();
		$user = $userModel->find(1);
		print_r($user);
	}

	public function contoh_find_multiple()
	{
		$userModel = new \App\Models\UserModel();
		$users = $userModel->find([1,2,4,11]);
		print_r($users);
	}

	public function contoh_find_column(){
		$userModel = new \App\Models\UserModel();
		$users = $userModel->findColumn('username');
		print_r($users);
	}

	public function contoh_find_all(){
		$userModel = new \App\Models\UserModel();
		$users = $userModel->findAll();
		print_r($users);
	}

	public function contoh_find_all_condition()
	{
		$userModel = new \App\Models\UserModel();
		$users = $userModel->where('is_active', 1)->findAll();
		print_r($users);		
	}

	public function contoh_find_all_limit_offset()
	{
		$userModel = new \App\Models\UserModel();
		$users = $userModel->where('is_active',0)->findAll(5,0);
		print_r($users);		
	}

	public function contoh_first()
	{
		$userModel = new \App\Models\UserModel();
		$users = $userModel->where('is_active',0)->first();
		print_r($users);
	}

	public function contoh_tanpa_with_deleted()
	{
		$userModel = new \App\Models\UserModel();
		$activeUsers = $userModel->findAll();
		print_r($activeUsers);
	}

	public function contoh_dengan_with_deleted()
	{
		$userModel = new \App\Models\UserModel();
		$users = $userModel->withDeleted()->findAll();
		print_r($users);
	}

	public function contoh_only_deleted()
	{
		$userModel = new \App\Models\UserModel();
		$deletedUsers = $userModel->onlyDeleted()->findAll();
		print_r($deletedUsers);
	}

	public function contoh_insert()
	{
		$userModel = new \App\Models\UserModel();

		$data = [
			'username' => 'nobita',
			'address' => 'nobita@theempire.com',
			'fullname' => 'Nobita Nobi'
		];

		$userModel->insert($data);
		/**
		 * INSERT INTO user (username, address, fullname) 
		 * 	VALUES ('nobita', 'nobita@theempire.com','Nobita Nobi)
		*/ 
	}

	public function contoh_update_1()
	{
		$userModel = new \App\Models\UserModel();

		$data = [
			'username' => 'suneo',
			'address' => 'suneo@theempire.com',
			'fullname' => 'Suneo Honekawa'
		];

		$userModel->update(1003, $data);
		//$userModel->update($id, $data);

		/**
		 * UPDATE user 
		 * 	SET username='suneo', 
		 * 		address='suneo@theempire.com', 
		 * 		fullname='Suneo Honekawa'
		 *	WHERE id = 1003
		 */
	}

	public function contoh_update_multiple()
	{
		$userModel = new \App\Models\UserModel();

		$data = [
			'is_active' => 1
		];

		$userModel->update([2, 3, 4], $data);

		/**
		 * UPDATE user
		 * 	SET is_active=1
		 * 	WHERE id IN (2,3,4)
		 */
	}

	public function contoh_update_query_builder()
	{
		$userModel = new \App\Models\UserModel();

		$userModel->whereIn('id', [2, 3, 4])
					->set(['is_active' => 1])
					->update();

		/**
		 * UPDATE user
		 * 	SET is_active=1
		 * 	WHERE id IN (2,3,4)
		 */
	}

	public function contoh_save()
	{
		$userModel = new \App\Models\UserModel();

		// Defined as a model property
		$primaryKey = 'id';

		// Does an insert()
		$data = [
			'username' => 'giant',
			'address' => 'giant@theempire.com',
			'fullname' => 'Takeshi Goda'
		];

		$userModel->save($data);

		// Performs an update, since the primary key, 'id', is found.
		$data = [
			'id' => 1,
			'username' => 'deavenditama',			
		];

		$userModel->save($data);
	}

	public function contoh_delete()
	{
		$userModel = new \App\Models\UserModel();

		$userModel->delete(12);
		//DELETE FROM user WHERE id=12

		$userModel->delete([13,14,15]);
		//DELETE FROM user WHERE id IN(13,14,15)
	}

	public function contoh_purge_delete()
	{
		$userModel = new \App\Models\UserModel();

		$userModel->purgeDeleted();
		//DELETE FROM user WHERE deleted_at IS NOT NULL
	}
}






