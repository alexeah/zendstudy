<?php

class OrderController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $order = new Application_Model_Order();
        $this->view->assign('orders', $order->getAll());
    }

    public function createAction()
    {
        $title = $this->getParam('title', false);
        $text = $this->getParam('text', null);
        if($title !== false)
        {
            $order = new Application_Model_Order();
            $order->insert(array(
                'title' => $title,
                'text' => $text
            ));
            $this->redirect('order/index');
        }
        $this->view->assign('text', $text);
        $this->render('edit');
    }

    public function viewAction()
    {
        //
    }

    public function updateAction()
    {
        $id = (int)$this->getParam('id', false);
        if($id)
        {
            $title = $this->getParam('title', false);
            $order = new Application_Model_Order();
            if($title !== false)
            {
                $text = $this->getParam('text', null);
                $order->update(array(
                    'title' => $title,
                    'text' => $text
                ), "id=$id");
                $this->redirect('order/index');
            }
            else
            {
                $data = $order->find($id)->getRow(0);
                $text = $data->text;
                $title = $data->title;
            }
            $this->view->assign('text', $text);
            $this->view->assign('title', $title);
            $this->render('edit');
        }
        else
        {
            $this->redirect('order/index');
        }
    }

    public function deleteAction()
    {
        $id = (int)$this->getParam('id', false);
        if($id)
        {
            $order = new Application_Model_Order();
            $order->delete("id=$id");
            $this->redirect('order/index');
        }
    }

}

