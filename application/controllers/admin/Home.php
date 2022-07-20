<?php
defined('BASEPATH') OR exit ('No direct script access allowed');



class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if(empty($admin)) {
            $this->session->set_flashdata('msg', 'Your session has been expired');
            redirect(base_url().'admin/login/index');
        }
        $this->load->model('Admin_model');
        $this->load->model('Store_model');
        $this->load->model('Menu_model');
        $this->load->model('User_model');
        $this->load->model('Order_model');
        $this->load->model('Category_model');
    }
    public function index() {
        $data['countStore'] = $this->Store_model->countStore();
        $data['countDish'] = $this->Menu_model->countDish();
        $data['countUser'] = $this->User_model->countUser();
        $data['countOrders'] = $this->Order_model->countOrders();
        $data['countCategory'] = $this->Category_model->countCategory();
        $data['countPendingOrders'] = $this->Order_model->countPendingOrders();
        $data['countDeliveredOrders'] = $this->Order_model->countDeliveredOrders();
        $data['countRejectedOrders'] = $this->Order_model->countRejectedOrders();

        $resReport = $this->Admin_model->getResReport();
        $data['resReport'] = $resReport;

        $dishReport = $this->Admin_model->dishReport();
        $data['dishReport'] = $dishReport;
        $this->load->view('admin/partials/header');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/partials/footer');
    }

    public function resReport() {
        $resReport = $this->Admin_model->getResReport();
        $data['resReport'] = $resReport;
        $this->load->view('admin/reports/res_report', $data);
    }
    
    public function dishesReport() {
        $dishReport = $this->Admin_model->dishReport();
        $data['dishReport'] = $dishReport;
        $this->load->view('admin/reports/dish_report', $data);
    }

    public function usersReport() {
        echo "user";
    }

    public function ordersReport() {
        $resReport = $this->Admin_model->getResReport();
        $data['resReport'] = $resReport;

        $this->load->view('admin/partials/header');
        $this->load->view('admin/reports/res_report', $data);
        $this->load->view('admin/partials/footer');
    }
}
