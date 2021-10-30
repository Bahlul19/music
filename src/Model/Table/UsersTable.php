<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Users Model
 *
 * @property \App\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\CountriesTable|\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\UserRolesTable|\Cake\ORM\Association\HasMany $UserRoles
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('UserRoles', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasOne('Profiles', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Medias', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Polls', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Feedbacks', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {   $validator  =   new Validator();
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 50)
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name', 'Please enter first name')
            ->allowEmptyString('first_name', false);

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name', 'Please enter last name')
            ->allowEmptyString('last_name', false);

        // $validator
        //     ->email('email')
        //     ->requirePresence('email', 'create')
        //     ->notEmpty('email', 'Please enter Email')
        //     ->allowEmptyString('email', false);

        $validator
        ->email('email')
        ->requirePresence('email','create')
        ->notBlank('email', 'An email is required')
        ->add('email', 'unique', [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Email address entered is already in use'
             ]);

        $validator
            ->scalar('username')
            ->maxLength('username', 50)
            ->requirePresence('username', 'create')
            ->notEmpty('username', 'Please enter User name')
            ->allowEmptyString('username', false);

        $validator
            ->scalar('password')
            ->maxLength('password', 50)
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'Please enter Password')
            ->allowEmptyString('password', false);

         //Custom password confimation validator method
         $validator
         ->requirePresence('password_confirmation', 'create', 'Password is required!')
         ->notEmpty('password_confirmation', 'Please confirm your password!')
         ->add(
             'password_confirmation',
             'custom',
             [
                 'rule' => function ($value, $context) {
                         if (isset($context['data']['password']) && $value == $context['data']['password']) {
                             return true;
                         }
                         return false;
                     },
                 'message' => 'Sorry, password did not match with confirmed password!Please,Try again!'
             ]
         );

        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmpty('address', 'Please enter address')
            ->allowEmptyString('address', false);

        $validator
            ->scalar('city')
            ->maxLength('city', 50)
            ->requirePresence('city', 'create')
            ->notEmpty('city', 'Please enter city')
            ->allowEmptyString('city', false);

        $validator
            ->scalar('zipcode')
            ->maxLength('zipcode', 50)
            ->requirePresence('zipcode', 'create')
            ->notEmpty('zipcode', 'Please enter zipcode')
            ->allowEmptyString('zipcode', false);

        $validator
            ->scalar('gender')
            ->maxLength('gender', 50)
            ->requirePresence('gender', 'create')
            ->notEmpty('gender', 'Please select gender')
            ->allowEmptyString('gender', false);


        $validator
            ->scalar('mobie_phone')
            ->maxLength('mobie_phone', 50)
            ->requirePresence('mobie_phone', 'create')
            ->notEmpty('mobie_phone', 'Please enter contact number')
            ->allowEmptyString('mobie_phone', false);

        $validator
            ->allowEmptyString('is_featured', false);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));

        return $rules;
    }

//For getting the role id

    public function getUserRoleID($roleName)
    {
       $userTable = TableRegistry::getTableLocator()->get('roles');
       $user = $userTable->find()->select(['id'])->where(['name' =>$roleName])->toArray();
       $userId = $user[0]['id'];
       return $userId;
    }

/*For get userRoles id */

    public function getRolesID($id)
    {
        $userTable = TableRegistry::getTableLocator()->get('user_roles');
        $userRoleIdSelect = $userTable->find()->select(['id'])->where(['user_id' =>$id])->first();
        return $userRoleIdSelect;
    }

    public function getLoggedInUserID($id)
    {
        $userLoginID = TableRegistry::getTableLocator()->get('users');
        $userLoginIDSelect = $userLoginID->find()->select(['id'])->where(['id' =>$id])->first();
        return $userLoginIDSelect;
    }
    public function save_member_role($user_id){
        $roleId = $this->getUserRoleID('member');
        $userTableRegistry = TableRegistry::getTableLocator()->get('user_roles');
        $userTable = $userTableRegistry->newEntity();
        $userTable->user_id= $user_id;
        $userTable->role_id = $roleId;
        $userTableSave = $userTableRegistry->save($userTable);
        
    }
    
    public function newUserSupport($user_id){
        
        $mediasTable = TableRegistry::get('medias');
        $medias = $mediasTable->newEntity();
        $medias->user_id = $user_id;
        $medias->status = 1; //approved
        $medias->type = 3;  //type:profile image
        $mediasTable->save($medias);

        $profilesTable = TableRegistry::get('Profiles');
        $profiles = $profilesTable->newEntity();
        $profiles->user_id = $user_id;
        $profiles->media_id = $medias->id;
        $profilesTable->save($profiles);
    }

    public function getUser(\Cake\Datasource\EntityInterface $profile) {
        // Make sure here that all the required fields are actually present
        if (empty($profile->email)) {
            throw new \RuntimeException('Could not find email in social profile.');
        }
    
        // Check if user with same email exists. This avoids creating multiple
        // user accounts for different social identities of same user. You should
        // probably skip this check if your system doesn't enforce unique email
        // per user.
        $user = $this->find()
            ->where(['email' => $profile->email])
            ->first();
    
        if ($user) {
            return $user;
        }
    
        // Create new user account
        $user = $this->newEntity([
            'first_name'=> ($profile->first_name)?$profile->first_name:$profile->email,
            'last_name'=> ($profile->last_name)?$profile->last_name:$profile->email,
            'email' => $profile->email,
            'password' => $profile->identifier,
            'password_confirmation'=>$profile->identifier,
            'gender' =>($profile->gender)?($profile->gender[0]=='m')?'0':'1':'1',
            'username'=>$profile->email,
            'mobie_phone' =>($profile->phone)?$profile->phone:'',
            'zipcode' => '',
            'city' => '',
            'address' => '',
            'state_id' => '11',
            'country_id' => '101',
            ]);
        $user = $this->save($user);
        if ($user) {
            $this->save_member_role($user->id);
            $this->newUserSupport($user->id);
        }    
        else {
            throw new \RuntimeException('Unable to save new user');
        }
    
        return $user;
    }

    //match password validation 

    public function matchPasswords($data)
    {
        if($data['password'] == $this->request->getData(['User']['password_confirmation']))
        {
             return true;
        }
        else
        {
            echo "Password and Confirm Password Not Matched ";
        }
    }
}
