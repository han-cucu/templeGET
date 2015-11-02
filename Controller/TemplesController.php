<?php
//App::uses('AppController', 'Controller');
//App::import('Vendor', 'util/got');



class TemplesController extends AppController {
	public $uses = array("Temple","User","User_temple");
	public $helper = array("Html","Form","GoogleMap");
	public $components = array("Flash");

	public function about(){
		$this->set('title_for_layout','About');
	}

	public function add(){
		
		if ($this->request->is('post')){
			//フォームを送信した場合の処理
			if ($this->Temple->save($this->request->data)){
				//保存うまくいった場合
				$this->Flash->set('success!');//メッセージ表示
				$this->redirect(array('action'=>'index'));

				//This->redirect('http://www.yahoo.co.jp');
				//This->redirect('/post/index');
				//This->redirect(array('controller'=>'post');
			}else{
				//失敗した
				$this->Flash->set('Failed!');
			}
		}

	}
	
	
	public function delete($id) {
		if($this->request->is('get')){
			throw new MethodNotAllowedException();
		}

		if ($this->request->is('ajax')){
		//ajaxでのリクエストがあった
			if($this->Temple->delete($id)){
				$this->autoRender = false;//ctp割り当てない
				$this->autoLayout = false;//Layout/default.ctp割り当てない
				$response = array('id'=>$id);
				$this->header('Content-Type: application/json');
				echo json_encode($response);
				exit();
			}
		}
		$this->redirect('/');
	}
	

	
	public function edit($id = null) {
		$this->Temple->id = $id;

		if ($this->request->is('get')){
			//編集画面の処理
			$this->request->data = $this->Temple->read();//defaultdata
		}else{
			if ($this->Temple->save($this->request->data)){
				//保存うまくいった場合
				$this->Flash->set('success!');//メッセージ表示
				$this->redirect(array('action'=>'index'));

				//This->redirect('http://www.yahoo.co.jp');
				//This->redirect('/post/index');
				//This->redirect(array('controller'=>'post');
			}else{
				//失敗した
				$this->Flash->set('Failed!');
			}
		}
	}

	/*public function getaction() {
		$this->la = $lati;
		$this->la = $long;
		if ($this->request->is('get')){
			$this->Flash->set('got temple!');//メッセージ表示
			$this->redirect(array('action'=>'userpage'));
		}else{
				$this->Flash->set('got temple!');//メッセージ表示
				$this->redirect(array('action'=>'userpage'));
				//This->redirect('http://www.yahoo.co.jp');
				//This->redirect('/post/index');
				//This->redirect(array('controller'=>'post');
			}else{
				//失敗した
				$this->Flash->set('Failed!');
			}
		}
	}*/
	
	/*public function getaction(){
		
		debug($this->Auth->user('id'));

		$this->autoRender = false;//ctp割り当てない
		$this->autoLayout = false;//Layout/default.ctp割り当てない
		$temples = $this->Temple->find('all');//dbからtempleを読み込む
		
		$mylati=$this->params['url']['lati'];
    	$mylong=$this->params['url']['long'];
   		$mylati=$mylati*10000000;
   		$mylong=$mylong*10000000;
    
   		debug($mylati);
   		debug($mylong);
   		debug($temples);
   		
		foreach ($temples as $temple) : 
	        $templelati=$temple['Temple']['latitude']*10000000;
    	    $templelong=$temple['Temple']['longitude']*10000000;
        	$farlati=$mylati-$templelati;

        	if($farlati<10000 && $farlati > -10000){
            	$farlong=$mylong-$templelong;
            	if($farlong < 10000 && $farlong > -10000){

            		//成功時のdb処理
              		$data = array('Users_temples' => array('user_id' => $this->Auth->user('id'), 'temple_id' => $temple['Temple']['id']));
              		$fields = array('user_id', 'temple_id');
					$this->Users_temples->save($data, false, $fields);

					echo ('got temple!');
              		$this->Flash->set('got temple!');
              		$this->redirect(array('action'=>'userpage'));
            	}
       		}
   		endforeach;
			

    
	$this->redirect(array('action'=>'userpage'));

		//$data = array('Users_temples' => array('user_id' => 1, 'temple_id' => 1));
    	//$fields = array('user_id','temple_id');
    	//$this->Users_temples->save($data, false, $fields);//ここまで実行された10/21
    	
			
	}*/



	public function index(){

		$this->set('temples',$this->Temple->find('all'));//HTMLで使います HTML中では$postsという変数 中身は$this->Post->find('all')
		$this->set('title_for_layout','Temple List');
	}

	public function isAuthorized($user) {//Appcntrollerで書かれたルールを上書き
	    // auth登録ユーザーはアクセスできる
	    /*if ($this->action === 'add') {
	        return true;
	    }*/
	    if ($this->action === 'userpage') {
	        return true;
	    }
	    if ($this->action === 'templelist') {
	        return true;
	    }

	    // 投稿のオーナーは編集や削除ができる
	    /*if (in_array($this->action, array('edit', 'delete'))) {

	        $templeId = (int) $this->request->params['pass'][0];

	        if ($this->Temple->isOwnedBy($templeId, $user['id'])) {
	            return true;
	        }
	    }*/

	    return parent::isAuthorized($user);
	}

	public function templelist() {
        
        $this->set('temples',$this->Temple->find('all'));//HTMLで使います HTML中では$postsという変数 中身は$this->Post->find('all')
        $this->set('title_for_layout','Temple List');

        $params = array(
			'conditions' => array('id'=>$this->Auth->user('id'))
			);
		//$this->set('user_temples',$this->User->findById($this->Auth->user('id')));
		$this->set('user_temples',$this->User->find('all'));



    }

    public function userpage(){
		
    	$this->Auth->user();
		$this->set('temples',$this->Temple->find('all'));//HTMLで使います HTML中では$postsという変数 中身は$this->Post->find('all')
		//$this->set('user_temples',$this->User_temple->find('all'));
		$this->set('title_for_layout','Mypage');
		
		//urlに緯度経度を取得した場合
        if(isset($this->params['url']['lati'])&&isset($this->params['url']['long'])){
        	$temples = $this->Temple->find('all');
        	$mylati=$this->params['url']['lati'];
    		$mylong=$this->params['url']['long'];
   			$mylati=$mylati*10000000;
   			$mylong=$mylong*10000000;
    
   			//debug($mylati);
   			//debug($mylong);
   			//debug($temples);
   		
			foreach ($temples as $temple) : 
	        	$templelati=$temple['Temple']['latitude']*10000000;
    	    	$templelong=$temple['Temple']['longitude']*10000000;
        		$farlati=$mylati-$templelati;

        		if($farlati<10000 && $farlati > -10000){
            		$farlong=$mylong-$templelong;
            		if($farlong < 10000 && $farlong > -10000){

            			//成功時のdb処理
              			$data = array('user_temples' => array('user_id' => $this->Auth->user('id'), 'temple_id' => $temple['Temple']['id']));
              			$fields = array('user_id', 'temple_id');
						$this->User_temples->save($data, false, $fields);

						
              			$this->Flash->set('got '.$temple['Temple']['name'].'!!');
              			
              			
            		}
       			}
   			endforeach;
    	}
	}

	public function view($id = null) {

//		$this->Post->id = $id;
//		$this->set('post',$this->Post->read());

		$params = array(
			'conditions' => array('id'=>$id)
			);

		$this->set('temple',$this->Temple->find('first',$params));


	}


}
