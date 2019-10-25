<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public $paginate = [
        'limit' => 5,
        'order' => [
            'Users.created' => 'desc'
        ],
        'paramType' => 'querystring'        
    ];


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->PagingSupport->inheritPostData();

        $query = $this->Users->find();
        if( !empty($this->request->data)){
            //データを検索する
            // $conditions = [];
             
            

            //カテゴリ名
            if(!empty($this->request->data['table_search'])){
                $query->where(['username like' => '%' . $this->request->data['table_search'] . '%'])
                ->orWhere(['formal_name like' => '%' . $this->request->data['table_search'] . '%']);

            
            }
        }         
        // debug($conditions);
        //$queryを渡してデータを取得
        $users = $this->paginate($query);        
        // $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }


}
