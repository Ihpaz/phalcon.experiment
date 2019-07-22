<?php

namespace Application\Controllers;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Manager;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Db\ResultInterface;
use \DataTables\DataTable;


class BarangController extends ControllerBase
{
    public function initialize()
    {
        
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
          $this->view->form; 
    }

    public function addAction()
    {
        $this->session->conditions = null;
        $barcode = $this->getAutonumberAction();
        $this->view->form = new \BarangForm((object)['kodebarcode'=>$barcode],['edit'=>false]); 
    }

    public function showAction()
    {
        $this->view->disable();
   
        $array  = $this->modelsManager->createQuery("SELECT * FROM Barang")
        ->execute()->toArray();

        for($x=0;$x<count($array);$x++)
        {
            $array[$x]['action']="<center><a href='/barang/edit/".$array[$x]['kodebarcode']."' class='btn-info btn-sm'>Edit</a> ||   <a href='/barang/delete/".$array[$x]['kodebarcode']."' class='btn-danger btn-sm'>Delete</a></button></center>";
        }
      
     
        $dataTables = new DataTable();
        $dataTables->fromArray($array)->sendResponse();
    
            
    }

    /**
     * SearchBarang based on current criteria
     */
    

    /**
     * Shows the form to create a new barang
     */
    public function newAction()
    {
        $this->view->form = new \BarangForm(null, ['edit' => true]);
    }

    /**
     * Edits a barang based on its id
     */
    public function editAction($id)
    {
      
        if (!$this->request->isPost()) {

            $barang =\Barang::findFirst("kodebarcode='". $id."'");
           
            if (!$barang) {
                $this->flash->error("Barang was not found");

                return $this->dispatcher->forward(
                    [
                        "controller" => "barang",
                        "action"     => "index",
                    ]
                );
            }
        
            $this->view->form = new \BarangForm($barang, ['edit' => true]);
        }
    }

    /**
     * Creates a new barang
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "barang",
                    "action"     => "index",
                ]
            );
        }

        $form = new \BarangForm;
        $barang= new \Barang;

        $data = $this->request->getPost();
        
        if (!$form->isValid($data,$barang)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "barang",
                    "action"     => "index",
                ]
            );
        }

        if ($barang->save() == false) {
            foreach ($barang->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "barang",
                    "action"     => "index",
                ]
            );
        }

        $form->clear();
       
        $this->response->redirect('/barang/index');
        // $this->flash->success("Barang was created successfully");

        // return $this->dispatcher->forward(
        //     [
        //         "controller" => "barang",
        //         "action"     => "index  ",
        //     ]
        // );
    }

    /**
     * Saves current barang in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "barang",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("kodebarcode", "string");
        $barang =\Barang::findFirst("kodebarcode='". $id."'");
        if (!$barang) {
            $this->flash->error("Barang does not exist");

            return $this->dispatcher->forward(
                [
                    "controller" => "barang",
                    "action"     => "index",
                ]
            );
        }

        $form = new \BarangForm;

        $data = $this->request->getPost();
        if (!$form->isValid($data, $barang)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "barang",
                    "action"     => "index",
                ]
            );
        }

        if ($barang->save() == false) {
            foreach ($barang->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "barang",
                    "action"     => "index",
                ]
            );
        }

        $form->clear();

        $this->flash->success("Barang was updated successfully");

        

        return $this->dispatcher->forward(
            [
                "controller" => "barang",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a barang
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $barang =\Barang::findFirst("kodebarcode='". $id."'");
        if (!$barang) {
            $this->flash->error("Barang was not found");

            return $this->dispatcher->forward(
                [
                    "controller" => "barang",
                    "action"     => "index",
                ]
            );
        }

        if (!$barang->delete()) {
            foreach ($barang->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "barang",
                    "action"     => "search",
                ]
            );
        }

        $this->flash->success("Barang was deleted");

        return $this->dispatcher->forward(
            [
                "controller" => "barang",
                "action"     => "index",
            ]
        );
    }

    public function getAutonumberAction()
    {
        $barcode = $this->modelsManager->createQuery('SELECT kodebarcode FROM Barang order by kodebarcode DESC  LImit 1'
        )->execute();

        if($barcode->count() >0)
        {
            $data=$barcode->toArray()[0]['kodebarcode'];
            $newbarcode=intval(substr($data,2,4))+1;
			$newbarcode="B".substr("0000",1,(4-strlen($newbarcode))).$newbarcode;
        }
        else
        {
            $newbarcode='B0001';
        }

        return $newbarcode;
    }
}
