<?php
class YoutubeController extends YoutubeAppController {
    public $default = [
        'url' => 'https://www.youtube.com/embed/MmB9b5njVbA',
        'highlighted' => 1
    ];

    public function index() {
        $this->set('title_for_layout', $this->Lang->get('YOUTUBE__TITLE'));

        $this->loadModel('Youtube.YoutubeConfiguration');
        $this->config_default($this->YoutubeConfiguration->getConfig());

        $video = $this->Youtube->find('first', array('conditions' => array('highlighted' => 1)));
        $videos = $this->Youtube->find('all', array('limit' => '20', 'order' => 'id desc'));

        $this->set(compact('videos', 'video'));
    }

    public function admin_index(){
        if($this->isConnected AND $this->User->isAdmin()) {
            $this->layout = 'admin';

            $this->loadModel('Youtube.YoutubeConfiguration');
            $this->config_default($this->YoutubeConfiguration->getConfig());

            $video = $this->Youtube->find('first', array('conditions' => array('highlighted' => 1)));
            $videos = $this->Youtube->find('all', array('conditions' => array('highlighted' => 0)));

            $this->set(compact('videos', 'video'));
        }else {
            $this->redirect('/');
        }
    }

    public function admin_add_video(){
        $this->autoRender = false;
        if($this->isConnected AND $this->User->isAdmin()) {
            if($this->request->is('ajax')) {
                if(!empty($this->request->data['youtube_url'])) {
                    if(!filter_var($this->request->data['youtube_url'], FILTER_VALIDATE_URL) === FALSE) {
                        $this->loadModel('Youtube.YoutubeConfiguration');
                        $this->Youtube->create();
                        $this->Youtube->set(['url' => $this->edit_url($this->request->data['youtube_url'])]);
                        $this->Youtube->save();

                        $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('YOUTUBE__ADD__SUCCESS'))));
                    }else{
                        $this->response->body(json_encode(array('statut' => false, 'msg' => $this->Lang->get('YOUTUBE__ADD__FAILED__URL'))));
                    }
                }else{
                    $this->response->body(json_encode(array('statut' => false, 'msg' => $this->Lang->get('YOUTUBE__ADD__FAILED'))));
                }
            } else {
                throw new ForbiddenException();
            }
        }
    }
    
    public function admin_delete_video($id = false){
        $this->autoRender = false;
        if($this->isConnected AND $this->User->isAdmin()) {
            if($this->request->is('get')) {
                if($id != false) {

                    $event = new CakeEvent('beforeDeleteYoutube', $this, array('youtube_id' => $id, 'user' => $this->User->getAllFromCurrentUser()));
                    $this->getEventManager()->dispatch($event);
                    if($event->isStopped()) {
                        return $event->result;
                    }

                    $this->loadModel('Youtube.Youtube');
                    $this->Youtube->delete($id);
                    $this->History->set('DELETE_YOUTUBE', 'youtube');
                    $this->Session->setFlash($this->Lang->get('YOUTUBE__DELETE__SUCCESS'), 'default.success');
                    $this->redirect(array('controller' => 'youtube', 'action' => 'index', 'admin' => true));

                }else {
                    $this->redirect(array('controller' => 'youtube', 'action' => 'index', 'admin' => true));
                }
            } else {
                throw new ForbiddenException();
            }
        }
    }

    public function admin_edit_video(){
        $this->autoRender = false;
        if($this->isConnected AND $this->User->isAdmin()) {
            if($this->request->is('ajax')) {
                if(!empty($this->request->data['main_youtube_url'])) {
                    if(!filter_var($this->request->data['main_youtube_url'], FILTER_VALIDATE_URL) === FALSE) {
                        $this->loadModel('Youtube.YoutubeConfiguration');

                        $new_url = $this->edit_url($this->request->data['main_youtube_url']);
                        $this->Youtube->updateAll(array('url' => "'".$new_url."'"), array('highlighted' => 1));

                        $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('YOUTUBE__ADD__EDIT'))));
                    }else{
                        $this->response->body(json_encode(array('statut' => false, 'msg' => $this->Lang->get('YOUTUBE__ADD__FAILED__URL'))));
                    }
                }else{
                    $this->response->body(json_encode(array('statut' => false, 'msg' => $this->Lang->get('YOUTUBE__ADD__FAILED'))));
                }
            } else {
                throw new ForbiddenException();
            }
        }
    }
    
    private function edit_url($url){
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $id)) {
            $id = $id[1];
        }
        return 'https://www.youtube.com/embed/'.$id;
    }

    private function config_default($bool){
        if($bool){
            $this->Youtube->create();
            $this->Youtube->set($this->default);
            $this->Youtube->save();
        }
    }
}
