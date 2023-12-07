<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Utility\Hash;

class DocsTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('docs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Records', [
            'foreignKey' => 'record_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('size')
            ->requirePresence('size', 'create')
            ->notEmptyString('size');

        $validator
            ->scalar('url')
            ->maxLength('url', 255)
            ->requirePresence('url', 'create')
            ->notEmptyString('url');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['record_id'], 'Records'), ['errorField' => 'record_id']);

        return $rules;
    }

    public function getMyDocs($patient_id, $user_id, $user_level){
        $conditions=[];
        $conditions[]=['Records.owner_id'   => $user_id];
        $conditions[]=['Records.patient_id' => $patient_id];

        if ($user_level==2){
            $this->Bonds = TableRegistry::get('Bonds');
            $limit = $this->Bonds->getRecordDateLimit($patient_id, $user_id);
            $conditions[]=['Records.created <=' => $limit];
        }
        
        return $this->find()
            ->where($conditions)
            ->contain([
                'Records.TypeOfRecords',
                'Records.Owner.Profiles',
                ])
            ->all()
            ->toArray();
    }

    public function getShareDocs($patient_id, $user_id, $user_level){
        $conditions=[];
        $conditions[]=['Records.owner_id !='    => $user_id];
        $conditions[]=['Records.patient_id'     => $patient_id];
        $conditions[]=['Records.private'         => 0];

        if ($user_level==2){
            $this->Bonds = TableRegistry::get('Bonds');
            $limit = $this->Bonds->getRecordDateLimit($patient_id, $user_id);
            $conditions[]=['Records.created <=' => $limit];
        }
    
        return $this->find()
            ->where($conditions)
            ->contain([
                'Records.TypeOfRecords',
                'Records.Owner.Profiles',
                ])
            ->all()
            ->toArray();
    }

    public function getSummaryList($patient_id, $user_id, $user_level){
        $limit = 10;

        if ($user_level==2){
            $this->Bonds = TableRegistry::get('Bonds');
            $limitCreated = $this->Bonds->getRecordDateLimit($patient_id, $user_id);
        } else {
            $limitCreated = date('Y-m-d');
        }
    
        $condShared = [
            'Records.owner_id !='   => $user_id,
            'Records.patient_id'    => $patient_id,
            'Records.private'       => 0,
            'Records.created <='    => $limitCreated
        ];
        $shared = $this->find()
                ->where($condShared)
                ->order(['Docs.id' => 'DESC'])
                ->contain(['Records'])
                ->limit($limit)
                ->all()
                ->toArray();
        $ids_shared = [];
        foreach ($shared as $key => $obj) {
            $ids_shared[$obj['id']] = $obj['id'];
        }
        
        $condMy[] = [
            'Records.owner_id'      => $user_id,
            'Records.patient_id'    => $patient_id,
            'Records.created <='    => $limitCreated  
        ];
        if ($ids_shared){
            $condMy[] = ['Records.id NOT IN'=>$ids_shared];
        }

        $my = $this->find()
                ->where($condMy)
                ->order(['Docs.id' => 'DESC'])
                ->contain(['Records'])
                ->limit($limit)
                ->all()
                ->toArray();
        
        $all = array_merge($shared,$my);
        $all = Hash::sort($all, '{n}.id', 'DESC');
        $all = array_slice($all, 0, $limit);
        
        return $all;
    }

    public function getRuleView($id, $user_id, $user_role){

        $doc= $this->find()
            ->where([
                'Docs.id'=>$id
            ])
            ->contain(['Records'])
            ->first();

        if ($doc->record->owner_id = $user_id) {
            return true;
        }

        if (($user_role = 1) && ($doc->record->private = 0) && ($doc->record->patient_id = $user_id)) {
            return true;
        }

        if ($user_role = 2){
            $this->Bonds = TableRegistry::get('Bonds');
            if ($this->Bonds->isRuleExistBond($doc->record->patient_id, $user_id)){
                $limitDate = $this->Bonds->getRecordDateLimit($doc->record->patient_id, $user_id);
                if ($doc->record->created->i18nFormat('yyyy-MM-dd HH:mm:ss') <= $limitDate){
                    return true;
                }
            }
        }
        
        return false;
    
    }

    public function getRuleChange($id, $user_id){
        return $this->find()
            ->where([
                'Docs.id'=>$id,
                'Records.owner_id'=>$user_id
            ])
            ->contain(['Records'])
            ->count();
    }

    public function deleteDocAndRecord($id){
        $doc = $this->get($id);
        if ($this->delete($doc)) {
            $record = $this->Records->get($doc->record_id);
            return $this->Records->delete($record);
        } 
        return false;
    }
}
