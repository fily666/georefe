<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SiDatosBasico Entity
 *
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property int $id_tipo_documento
 * @property string $documento
 * @property string $email
 * @property string $direccion
 * @property string $telefono1
 * @property string $telefono2
 * @property string $celular
 * @property string $fotografia
 * @property float $map_latitud
 * @property float $map_longitud
 * @property int $status_id
 * @property int $creator_id
 * @property int $modifier_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Status $status
 * @property \App\Model\Entity\Creator $creator
 * @property \App\Model\Entity\Modifier $modifier
 */
class SiDatosBasico extends Entity
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
