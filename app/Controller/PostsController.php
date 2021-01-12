<?php
class PostsController extends AppController {
	public $helpers = array('Html', 'Form');
	public $components = array('Flash');

	public function index() {
		$this->set('posts', $this->Post->find('all'));
	}

	public function view($id = null) {
		if (!$id) {
				throw new NotFoundException(__('Invalid post'));
		}

		$post = $this->Post->findById($id);
		if (!$post) {
				throw new NotFoundException(__('Invalid post'));
		}
		$this->set('post', $post);
	}

	public function add() {
		if ($this->request->is('post')) {
				$this->Post->create();
				if ($this->Post->save($this->request->data)) {
						$this->Flash->success(__('Your post has been saved.'));
						return $this->redirect(array('action' => 'index'));
				}
				$this->Flash->error(__('Unable to add your post.'));
		}
	}
}
