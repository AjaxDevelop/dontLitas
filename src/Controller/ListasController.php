<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

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
        $listas = $this->paginate($this->Listas, ['limit' => 10]);

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
        $data = $this->Listas->verificarAcesso($acesso);
        $filtro = ['acesso' => $data['acesso']];

        if (!is_null($data['id_pai']))
        {
            array_push($filtro, ['lista_pai' => $data['id_pai']]);
        }

        $lista = $this->Listas->find('all', [
            'contain' => ['Items']
        ])->where([$filtro])->first();

        $listas_filhas = $this->Listas->pegarListasFilhas($lista->id);

        $data = [
            'lista' => $lista,
            'listas_filhas' => $listas_filhas,
            'acesso' => $acesso
        ];

        $this->set('data', $data);
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
     */
    public function edit()
    {
        if ($this->request->is('post'))
        {
            $lista = $this->Listas->get($this->request->getData('id'), [
                'contain' => ['Listas']
            ]);

            $item = TableRegistry::get('Items')->getItem($this->request->getData('item'));

            if ($this->request->getData('action') == 'add')
            {
                $lista = $this->Listas->Items->link($lista, [$item]);
            }

            if ($this->request->getData('action') == 'delete')
            {
                $lista = $this->Listas->Items->unlink($lista, [$item]);
            }

            $this->set('_serialize', ['lista']);
        }
    }

}
