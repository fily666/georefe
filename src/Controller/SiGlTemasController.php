<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SiGlTemas Controller
 *
 * @property \App\Model\Table\SiGlTemasTable $SiGlTemas
 *
 * @method \App\Model\Entity\SiGlTema[] paginate($object = null, array $settings = [])
 */
class SiGlTemasController extends AppController
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
        $siGlTemas = $this->paginate($this->SiGlTemas);

        $this->set(compact('siGlTemas'));
        $this->set('_serialize', ['siGlTemas']);
    }

    /**
     * View method
     *
     * @param string|null $id Si Gl Tema id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $siGlTema = $this->SiGlTemas->get($id, [
            'contain' => ['SaEstados', 'Creators', 'Modifiers']
        ]);

        $this->set('siGlTema', $siGlTema);
        $this->set('_serialize', ['siGlTema']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $siGlTema = $this->SiGlTemas->newEntity();
        if ($this->request->is('post')) {
            $siGlTema = $this->SiGlTemas->patchEntity($siGlTema, $this->request->getData());
            if ($this->SiGlTemas->save($siGlTema)) {
                $this->Flash->success(__('The si gl tema has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The si gl tema could not be saved. Please, try again.'));
        }
        $saEstados = $this->SiGlTemas->SaEstados->find('list', ['limit' => 200]);
        $creators = $this->SiGlTemas->Creators->find('list', ['limit' => 200]);
        $modifiers = $this->SiGlTemas->Modifiers->find('list', ['limit' => 200]);
        $this->set(compact('siGlTema', 'saEstados', 'creators', 'modifiers'));
        $this->set('_serialize', ['siGlTema']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Si Gl Tema id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $siGlTema = $this->SiGlTemas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $siGlTema = $this->SiGlTemas->patchEntity($siGlTema, $this->request->getData());
            if ($this->SiGlTemas->save($siGlTema)) {
                $this->Flash->success(__('The si gl tema has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The si gl tema could not be saved. Please, try again.'));
        }
        $saEstados = $this->SiGlTemas->SaEstados->find('list', ['limit' => 200]);
        $creators = $this->SiGlTemas->Creators->find('list', ['limit' => 200]);
        $modifiers = $this->SiGlTemas->Modifiers->find('list', ['limit' => 200]);
        $this->set(compact('siGlTema', 'saEstados', 'creators', 'modifiers'));
        $this->set('_serialize', ['siGlTema']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Si Gl Tema id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $siGlTema = $this->SiGlTemas->get($id);
        if ($this->SiGlTemas->delete($siGlTema)) {
            $this->Flash->success(__('The si gl tema has been deleted.'));
        } else {
            $this->Flash->error(__('The si gl tema could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
