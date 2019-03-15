<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SiGlAsistencias Controller
 *
 * @property \App\Model\Table\SiGlAsistenciasTable $SiGlAsistencias
 *
 * @method \App\Model\Entity\SiGlAsistencia[] paginate($object = null, array $settings = [])
 */
class SiGlAsistenciasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Creators', 'Modifiers']
        ];
        $siGlAsistencias = $this->paginate($this->SiGlAsistencias);

        $this->set(compact('siGlAsistencias'));
        $this->set('_serialize', ['siGlAsistencias']);
    }

    /**
     * View method
     *
     * @param string|null $id Si Gl Asistencia id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $siGlAsistencia = $this->SiGlAsistencias->get($id, [
            'contain' => ['Creators', 'Modifiers']
        ]);

        $this->set('siGlAsistencia', $siGlAsistencia);
        $this->set('_serialize', ['siGlAsistencia']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $siGlAsistencia = $this->SiGlAsistencias->newEntity();
        if ($this->request->is('post')) {
            $siGlAsistencia = $this->SiGlAsistencias->patchEntity($siGlAsistencia, $this->request->getData());
            if ($this->SiGlAsistencias->save($siGlAsistencia)) {
                $this->Flash->success(__('The si gl asistencia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The si gl asistencia could not be saved. Please, try again.'));
        }
        $creators = $this->SiGlAsistencias->Creators->find('list', ['limit' => 200]);
        $modifiers = $this->SiGlAsistencias->Modifiers->find('list', ['limit' => 200]);
        $this->set(compact('siGlAsistencia', 'creators', 'modifiers'));
        $this->set('_serialize', ['siGlAsistencia']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Si Gl Asistencia id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $siGlAsistencia = $this->SiGlAsistencias->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $siGlAsistencia = $this->SiGlAsistencias->patchEntity($siGlAsistencia, $this->request->getData());
            if ($this->SiGlAsistencias->save($siGlAsistencia)) {
                $this->Flash->success(__('The si gl asistencia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The si gl asistencia could not be saved. Please, try again.'));
        }
        $creators = $this->SiGlAsistencias->Creators->find('list', ['limit' => 200]);
        $modifiers = $this->SiGlAsistencias->Modifiers->find('list', ['limit' => 200]);
        $this->set(compact('siGlAsistencia', 'creators', 'modifiers'));
        $this->set('_serialize', ['siGlAsistencia']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Si Gl Asistencia id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $siGlAsistencia = $this->SiGlAsistencias->get($id);
        if ($this->SiGlAsistencias->delete($siGlAsistencia)) {
            $this->Flash->success(__('The si gl asistencia has been deleted.'));
        } else {
            $this->Flash->error(__('The si gl asistencia could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
