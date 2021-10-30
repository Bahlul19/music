<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;

use Cake\ORM\Entity;


/**
 * User Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $token
 * @property string $address
 * @property string $city
 * @property string $zipcode
 * @property string $mobie_phone
 * @property string $photo
 * @property string $photo_dir
 * @property int $state_id
 * @property int $country_id
 * @property bool $is_active
 * @property bool $is_featured
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\UserRole[] $user_roles
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'username' => true,
        'password' => true,
        'password_confirmation' => true,
        'address' => true,
        'city' => true,
        'zipcode' => true,
        'gender' => true,
        'mobie_phone' => true,
        'photo' => true,
        'photo_dir' => true,
        'state_id' => true,
        'country_id' => true,
        'created' => true,
        'modified' => true,
        'state' => true,
        'country' => true,
        'user_roles' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
   
    protected $_hidden = [
        'password',
        'token'
    ];
    
/*
    protected $_hidden = [
        'password'
    ];
*/
    protected function _setPassword($password) 
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
}
