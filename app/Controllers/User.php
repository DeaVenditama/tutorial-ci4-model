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

	public function contoh_update_1()
	{
		$userModel = new \App\Models\UserModel();

		$data = [
			'username' => 'suneo new ',			
		];

		$userModel->update(1007, $data);
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
			'is_active' => 0
		];

		$userModel->update([2, 3, 4], $data);

		/**
		 * UPDATE user
		 * 	SET is_active=0
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
		//$primaryKey = 'id';

		// Does an insert()
		$data = [
			'username' => 'giant baru',
			'address' => 'giant@theempire.com',
			'fullname' => 'Takeshi Goda'
		];

		$userModel->save($data);

		// Performs an update, since the primary key, 'id', is found.
		$data = [
			'id' => 1007,
			'username' => 'deavenditama',			
		];

		$userModel->save($data);
	}

	public function contoh_delete()
	{
		$userModel = new \App\Models\UserModel();

		$userModel->delete(1005);
		//DELETE FROM user WHERE id=1007

		//$userModel->delete([1006,1008]);
		//DELETE FROM user WHERE id IN(1006,1008)
	}

	public function contoh_purge_delete()
	{
		$userModel = new \App\Models\UserModel();

		$userModel->purgeDeleted();
		//DELETE FROM user WHERE deleted_at IS NOT NULL
	}

	public function contoh_validation_1()
	{
		$userModel = new \App\Models\UserModel();

		$data = [
			'username' => 'nobita@tss.com',
			'address' => 'indonesia',
			'fullname' => 'Nobita Nobi',
			'is_active' => 1,
		];

		if($userModel->insert($data) === false)
		{
			print_r($userModel->errors());
		}else{
			echo "Sukses";
		}
	}

	public function contoh_set_validation_rule()
	{
		$userModel = new \App\Models\UserModel();

		$data = [
			'username' => 'nobita@tss.com',
			'address' => 'indonesia',
			'fullname' => 'nobita nobi',
			'is_active' => 1,
		];

		$fieldName = 'fullname';
		$fieldRules = 'required|min_length[8]';

		$userModel->setValidationRule($fieldName, $fieldRules);

		if($userModel->insert($data) === false)
		{
			print_r($userModel->errors());
		}else{
			echo "Sukses";
		}
	}

	public function contoh_set_validation_rules()
	{
		$userModel = new \App\Models\UserModel();

		$data = [
			'username' => 'nobita',
			//'address' => 'indonesia',
			'fullanme' => 'Nobita Nobi',
			'is_active' => 1,
		];

		$validationRules = [
			'username' => 'required|valid_email|min_length[3]|is_unique[user.username]',
			'address' => [
				'rules' => 'required|min_length[8]',
				'errors' => [
					'required' => 'Address Harus Diisi',
				],
			],
		];

		$userModel->setValidationRules($validationRules);

		if($userModel->insert($data) === false)
		{
			print_r($userModel->errors());
		}else{
			echo "Sukses";
		}
	}

	public function contoh_set_validation_message()
	{
		$userModel = new \App\Models\UserModel();

		$data = [
			'address' => 'indonesia',
			'is_active' => 1,
		];

		$fieldName = 'username';
		$fieldValidationMessage = [
			'required' => 'Username Harus diisi'
		];

		$userModel->setValidationMessage($fieldName, $fieldValidationMessage);

		if($userModel->insert($data) === false)
		{
			print_r($userModel->errors());
		}else{
			echo "Sukses";
		}
	}

	public function contoh_set_validation_messages()
	{
		$userModel = new \App\Models\UserModel();

		$data = [
			'address' => 'indonesia',
			'is_active' => 1,
		];

		$fieldValidationMessage = [
			'username' => [
				'required' => 'Username Harus Diisi'
			],
			'fullname' => [
				'required' => 'Fullname Harus Diisi'
			]
		];

		$userModel->setValidationMessages($fieldValidationMessage);

		if($userModel->insert($data) === false)
		{
			print_r($userModel->errors());
		}else{
			echo "Sukses";
		}
	}

	public function retrieving_validation_rules()
	{
		$userModel = new \App\Models\UserModel();
		
		$rules = $userModel->validationRules;

		print_r($rules);
		echo '<br><br>';

		$rules = $userModel->getValidationRules(['except'=>['username']]);
		print_r($rules);
		echo '<br><br>';

		$rules = $userModel->getValidationRules(['only'=>['username','fullname']]);
		print_r($rules);
	}

	public function validation_placeholders()
	{
		$userModel = new \App\Models\UserModel();

		$data = [
			'id' => 1,
			'username' => 'nobita@tss.com',
			'address' => 'jakarta pusat',
			'is_active' => 1,
		];

		if($userModel->save($data) === false)
		{
			print_r($userModel->errors());
		}else{
			echo "Sukses";
		}
	}
	//'username' => 'required|valid_email|is_unique[user.username,id,{id}]|min_length[3]',
}






