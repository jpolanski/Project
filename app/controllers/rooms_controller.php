<?php
    class RoomsController extends ApplicationController {
    
        public function index () {
            $result = Room::readRoom($this->params[':type']) ;
            $photos = Room::searchPhotos($this->params[':type']); 
            $this->render(array('view' => 'rooms/index.phtml', 'room' => $result , 'photos' => $photos));
        }
    }
?>
