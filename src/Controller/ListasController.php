<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Listas Controller
 *
 * @property \App\Model\Table\ListasTable $Listas
 *
 * @method \App\Model\Entity\Lista[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        debug($slug);

        $listas = $this->paginate($this->Listas);

        $this->set(compact('listas'));
    }

    /**
     * View method
     *
     * @param string|null $id Lista id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($acesso = null)
    {
        $lista = $this->Listas->find('all', [
            'contain' => ['Items']
        ])->where(['Listas.acesso' => $acesso])->first();

        $this->set('lista', $lista);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lista = $this->Listas->newEntity();
        if ($this->request->is('post')) {
            $lista = $this->Listas->patchEntity($lista, $this->request->getData());
            if ($this->Listas->save($lista)) {
                $this->Flash->success(__('The lista has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lista could not be saved. Please, try again.'));
        }
        $items = $this->Listas->Items->find('list', ['limit' => 200]);
        $this->set(compact('lista', 'items'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lista id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lista = $this->Listas->get($id, [
            'contain' => ['Items']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lista = $this->Listas->patchEntity($lista, $this->request->getData());
            if ($this->Listas->save($lista)) {
                $this->Flash->success(__('The lista has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lista could not be saved. Please, try again.'));
        }
        $items = $this->Listas->Items->find('list', ['limit' => 200]);
        $this->set(compact('lista', 'items'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lista id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lista = $this->Listas->get($id);
        if ($this->Listas->delete($lista)) {
            $this->Flash->success(__('The lista has been deleted.'));
        } else {
            $this->Flash->error(__('The lista could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
