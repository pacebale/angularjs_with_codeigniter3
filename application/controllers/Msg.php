<?php
class Msg extends CI_Controller {
    public function index() 
    {
        $data = $this->message->all();
        $this->render($data);
    }
    public function create() 
    {
        $data['title'] = $this->input->post('data')['title'];
        $this->message->create($data);
        $this->refresh();
    }

    public function show($id) 
    {
        $data = $this->message->find($id);
        $this->render($data);
    }

    public function update($id) {
        $data['title'] = $this->input->post('data')['title'];
        $this->message->update($id, $data);
        $this->refresh();
    }
    public function delete($id) 
    {
        $this->message->delete($id);
        $this->refresh();
    }

    private function refresh()
    {
        $this->render($this->message->all());
    }

    private function render($data)
    {
        echo json_encode($data);
    }
}
