<?

class CustomersController extends Zend_Controller_Action
{
    private $_customersModel;

    public function init()
    {
        $this->_customersModel = new Application_Model_Customers();
    }

    public function indexAction()
    {
        $this->view->assign('customers', $this->_customersModel->getAll());
    }

    public function addAction()
    {
        $firstName = $this->getParam('first_name', null);
        $secondName = $this->getParam('second_name', null);

        if ($firstName || $secondName) {
            $this->_customersModel->insert([
                'first_name' => $firstName,
                'second_name' => $secondName,
            ]);

            $this->redirect('customers/index');
            return;
        } else {
            $this->render('edit');
        }
    }

    public function removeAction()
    {
        $id = (int) $this->getParam('id', null);

        if (!$id) {
            $this->indexAction();
            return;
        }

        $this->_customersModel->delete("id=$id");
        $this->forward('index');
    }

    public function editAction()
    {
        $id = (int) $this->getParam('id', null);
        if (!$id) {
            $this->redirect('customers/index');
            return;
        }

        $firstName = $this->getParam('first_name', null);
        $secondName = $this->getParam('second_name', null);
        $oldValues = $this->_customersModel->find($id)->getRow(0);

        if ($firstName || $secondName) {
            $newValues = [];
            if ($firstName && $firstName != $oldValues['first_name']) {
                $newValues['first_name'] = $firstName;
            }
            if ($secondName && $secondName != $oldValues['second_name']) {
                $newValues['second_name'] = $secondName;
            }
            $this->_customersModel->update($newValues, "id=$id");
            $this->redirect('customers/index');
        } else {
            $this->view->assign('id', $id);
            $this->view->assign('first_name', $oldValues['first_name']);
            $this->view->assign('second_name', $oldValues['second_name']);
            $this->render('edit');
        }
    }
}

