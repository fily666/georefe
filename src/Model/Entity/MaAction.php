<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MaAction Entity
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $controller_id
 * @property int $creator_id
 * @property int $status_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\MaController $ma_controller
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\MaGeneral $ma_general
 */
class MaAction extends Entity
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
        '*' => true,
        'id' => false
    ];
}
