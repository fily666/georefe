<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Email\Email;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'username', 'password' => 'password'],
                ],
            ],
            'loginRedirect' => [
                'controller' => 'Home',
                'action' => 'index',
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
            ],
            'unauthorizedRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
            ],
            'authError' => 'No esta autorizado para realizar esta acción.',
        ]);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['sendMail', 'login', 'logout', 'search']);
    }

    public function isAuthorized($user)
    {
        if (isset($user['permissions'][$this->request->params['controller']])) {
            if (in_array($this->request->params['action'], $user['permissions'][$this->request->params['controller']])) {
                return true;
            }
        } else {
            return false;
        }
        return false;
    }

    public function pr($array)
    {
        pr(json_decode(json_encode($array), true));
    }

    public function properties($id)
    {
        $modModel = 'MaPropiedades';
        $this->loadModel($modModel);
        $listObjX = $this->$modModel->find('list', ['id' => 'id', 'valueField' => 'valor'])
            ->where(['padre_id' => $id, 'status_id' => 1])
            ->order(['id' => 'ASC'])
            ->toArray();
        return $listObjX;
    }

    public function propertiesOrderbyValue($id)
    {
        $modModel = 'MaPropiedades';
        $this->loadModel($modModel);
        $listObjX = $this->$modModel->find('list', ['id' => 'id', 'valueField' => 'valor'])
            ->where(['padre_id' => $id, 'status_id' => 1])
            ->order(['valor' => 'ASC'])
            ->toArray();
        return $listObjX;
    }

    public function estadosCategoria($categoria)
    {
        $modModel = 'MaStatus';
        $this->loadModel($modModel);
        $listObjX = $this->$modModel->find('list', ['id' => 'id', 'valueField' => 'value'])
            ->where(['categoria' => $categoria])
            ->order(['id' => 'ASC'])
            ->toArray();
        return $listObjX;
    }

    //FUNCION PARA ENVIAR CORREO DE CONTRASEÑAS
    public function sendMail($to, $subject, $id)
    {
        $email = new Email();
        $email->transport('gmail1');

        $url = $this->properties(1160)[1161];
        $email->viewVars(['id' => base64_encode($id), 'url' => $url]);
        $email->emailFormat('html')
            ->template('default', 'default')
            ->from(['jhonfcuevas@gmail.com' => 'Admin Sin Muros'])
            ->to($to)
            ->subject($subject)
            ->send();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    //FUNCION PARA ENVIAR CORREO DE APROBACION Y/O NO APROBACION
    public function sendMail2($to, $to2, $subject, $observation)
    {
        $email = new Email();
        $email->transport('gmail1');
        $email->viewVars(['observation' => $observation]);
        $email->emailFormat('html')
            ->template('default_1', 'default_1')
            ->from(['jhonfcuevas@gmail.com' => 'Admin Gaia'])
            ->to($to)
            ->addTo($to2)
            ->subject($subject)
            ->send();
    }

    /**
     * QueryGN
     *
     * @param string $name The name of the method being called.
     * @param array $arguments The arguments to pass to the method.
     * @return mixed A result array if successful, false otherwise.
     */
    public function queryGN($name = null, $arguments = [])
    {
        $arguments = isset($arguments[0]) ? $arguments[0] : $arguments;
        if ($this->config['cache'] === true) {
            $cacheKey = md5(serialize($arguments));
            if ($results = Cache::read($cacheKey)) {
                return $results;
            }
        }
        $url = 'http://api.geonames.org/searchJSON?' . http_build_query($arguments) . '&username=' . $name;
        try {
            if ($response = file_get_contents($url)) {
                if ($results = json_decode($response, true)) {
                    if ((isset($results['status']['message'])) && (isset($results['status']['value']))) {
                        throw new CakeException($results['status']['message'], $results['status']['value']);
                    } else {
                        if ($this->config['cache'] === true) {
                            Cache::write($cacheKey, $results);
                        }
                        return $results;
                    }
                }
            }
        } catch (CakeException $e) {
            echo $e->getMessage() . "\n";
        }
        return false;
    }

    public function listCountries()
    {
        $this->loadModel('Countries');
        $countriesx = $this->Countries->find('list', ['keyField' => 'iso3166alpha2', 'valueField' => 'country'])->order(['country' => 'ASC']);

        $countries["CO"] = "Colombia";
        foreach ($countriesx as $key => $countrie) {
            $countries[$key] = $countrie;
        }
        return $countries;
    }

    public function listDepartments($idCountry)
    {
        $this->loadModel('Departments');
        return $this->Departments->find('list', ['keyField' => 'cod_dane', 'valueField' => 'title'])->where(['country_id' => $idCountry]);
    }

    //ESTA FUNCION REALIZA LA BUSQUEDA DE LOS DATOS REQUERIDOS PARA EL AUTOCOMPLETAR Y
    // RECIBE, LOS CARACTERES ENVIADOS DESDE EL INPUT,  EL MODELO, CAMPO DE KEY Y CAMPO DE VALUE, PARA ENVIARSELO A LA FUNCION getData()
    public function search($searchWord, $model, $keyField, $valueField)
    {
        $tmpArray = array();
        /**
         * Obtengo los datos almacenados en el array
         */
        $data = $this->getData($model, $keyField, $valueField);
        /*
         * Recorro el array para ver si hay palabras que empiecen con lo que viene
         * por parametros
         */
        foreach ($data as $word) {
            // obtengo el tamaño de la palabra que se busca.
            $searchWordSize = strlen($searchWord);
            // corto la palabra que viene del array y la dejo del mismo tamaño que
            // la que se busca de manera de poder comparar.
            $tmpWord = substr($word, 0, $searchWordSize);
            // si son iguales la guardo para devolverla
            if (strtolower($tmpWord) == strtolower($searchWord)) {
                // guardo la palabra original sin cortar.
                $tmpArray[] = $word;
            }
        }
        return json_encode($tmpArray);
    }

    //ESTA FUNCION RECIBE EL MODELO, CAMPO DE KEY Y CAMPO DE VALUE, PARA RETORNAR UNA LISTA BUSCADA EN LA BD
    public function getData($model, $keyField, $valueField)
    {
        $this->loadModel($model);
        $result = $this->$model->find('list', ['keyField' => $keyField, 'valueField' => $valueField])->toArray();
        // asort($result);
        return $result;
    }

    //Convertir numero a letras
    public function numleter($numero)
    {
        $valor = array('Un', 'Dos', 'Tres', 'Cuatro', 'Cinco', 'Seis', 'Siete', 'Ocho',
            'Nueve', 'Diez', 'Once', 'Doce', 'Trece', 'Catorce', 'Quince', 'Dieciséis', 'Diecisiete', 'Dieciocho', 'Diecinueve',
            'Veinte', 'Veintiuno', 'Veintidos', 'Veintitres', 'Veinticuatro', 'Veinticinco',
            'Veintiséis', 'Veintisiete', 'Veintiocho', 'Veintinueve', 'Treinta');
        return $valor[$numero - 1];
    }

}
