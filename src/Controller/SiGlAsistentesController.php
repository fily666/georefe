<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SiGlAsistentes Controller
 *
 * @property \App\Model\Table\SiGlAsistentesTable $SiGlAsistentes
 *
 * @method \App\Model\Entity\SiGlAsistente[] paginate($object = null, array $settings = [])
 */
class SiGlAsistentesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['SaEstados', 'Creators', 'Modifiers']
        ];
        $siGlAsistentes = $this->paginate($this->SiGlAsistentes);

        $this->set(compact('siGlAsistentes'));
        $this->set('_serialize', ['siGlAsistentes']);
    }

    /**
     * View method
     *
     * @param string|null $id Si Gl Asistente id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $siGlAsistente = $this->SiGlAsistentes->get($id, [
            'contain' => ['SaEstados', 'Creators', 'Modifiers']
        ]);

        $this->set('siGlAsistente', $siGlAsistente);
        $this->set('_serialize', ['siGlAsistente']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $siGlAsistente = $this->SiGlAsistentes->newEntity();
        if ($this->request->is('post')) {
            $siGlAsistente = $this->SiGlAsistentes->patchEntity($siGlAsistente, $this->request->getData());
            if ($this->SiGlAsistentes->save($siGlAsistente)) {
                $this->Flash->success(__('The si gl asistente has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The si gl asistente could not be saved. Please, try again.'));
        }
        $saEstados = $this->SiGlAsistentes->SaEstados->find('list', ['limit' => 200]);
        $creators = $this->SiGlAsistentes->Creators->find('list', ['limit' => 200]);
        $modifiers = $this->SiGlAsistentes->Modifiers->find('list', ['limit' => 200]);
        $this->set(compact('siGlAsistente', 'saEstados', 'creators', 'modifiers'));
        $this->set('_serialize', ['siGlAsistente']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Si Gl Asistente id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $siGlAsistente = $this->SiGlAsistentes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $siGlAsistente = $this->SiGlAsistentes->patchEntity($siGlAsistente, $this->request->getData());
            if ($this->SiGlAsistentes->save($siGlAsistente)) {
                $this->Flash->success(__('The si gl asistente has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The si gl asistente could not be saved. Please, try again.'));
        }
        $saEstados = $this->SiGlAsistentes->SaEstados->find('list', ['limit' => 200]);
        $creators = $this->SiGlAsistentes->Creators->find('list', ['limit' => 200]);
        $modifiers = $this->SiGlAsistentes->Modifiers->find('list', ['limit' => 200]);
        $this->set(compact('siGlAsistente', 'saEstados', 'creators', 'modifiers'));
        $this->set('_serialize', ['siGlAsistente']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Si Gl Asistente id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $siGlAsistente = $this->SiGlAsistentes->get($id);
        if ($this->SiGlAsistentes->delete($siGlAsistente)) {
            $this->Flash->success(__('The si gl asistente has been deleted.'));
        } else {
            $this->Flash->error(__('The si gl asistente could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
