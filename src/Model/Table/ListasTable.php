<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Listas Model
 *
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\BelongsToMany $Items
 *
 * @method \App\Model\Entity\Lista get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lista newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Lista[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lista|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lista patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lista[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lista findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ListasTable extends Table
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

        $this->setTable('listas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Items', [
            'foreignKey' => 'lista_id',
            'targetForeignKey' => 'item_id',
            'joinTable' => 'items_listas'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('acesso')
            ->maxLength('acesso', 255)
            ->requirePresence('acesso', 'create')
            ->notEmpty('acesso');

        $validator
            ->integer('lista_pai')
            ->requirePresence('lista_pai', 'create')
            ->allowEmpty('lista_pai');

        return $validator;
    }

    /**
     * Adicionar uma nova lista.
     */
    public function addList($acesso = null, $id_pai = null)
    {
        $lista = $this->newEntity();
        $lista = $this->patchEntity($lista, ['acesso' => $acesso . '/', 'lista_pai' => $id_pai]);

        $this->save($lista);

        return $lista;
    }

    /**
     * Verifica se o usuário adicionou '/' no final da url.
     */
    public function verificarAcesso($acesso = null)
    {
        if (is_null($acesso))
        {
            return [];
        }

        $id_anterior = null;
        $id_pai = null;
        $data = explode('/', $acesso);

        foreach($data as $key => $value)
        {
            if ($value == '')
            {
                break;
            }

            $obj = $this->find('all')
                ->where(['acesso' => $value . '/'])
                ->first();

            if (is_null($obj))
            {
                $obj = $this->addList($value, $id_anterior);
                $id_pai = $obj->lista_pai;
            }
            else
            {
                $id_pai = null;
            }

            $id_anterior = $obj->id;
            $acesso = $obj->acesso;
        }

        if (substr($acesso, -1) != '/')
        {
            $acesso = $acesso . '/';
        }

        return [
            'acesso' => $acesso,
            'id_pai' => $id_pai,
        ];
    }

    /**
     * Buscar as Listas filhas no banco de dados
     */
    public function pegarListasFilhas($lista_id)
    {
        $listas_filhas = $this->find('list', [
            'keyField' => 'id',
            'valueField' => 'acesso'
        ])->where(['lista_pai' => $lista_id])->distinct(['acesso'])->toArray();

        if (is_null($listas_filhas))
        {
            return [];
        }

        return $listas_filhas;
    }
}
