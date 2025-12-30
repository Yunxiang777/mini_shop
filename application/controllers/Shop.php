<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Product_model $product_model
 * @property db $db
 * @property CI_Cart $cart
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 */
class Shop extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('product_model');
    }

    // 商品列表首頁
    public function index()
    {
        $data['products'] = $this->product_model->get_products();
        $this->load->view('header');
        $this->load->view('products', $data);
        $this->load->view('footer');
    }

    // 加入購物車
    public function add_to_cart($product_id)
    {
        $product = $this->product_model->get_product($product_id);
        $data = array(
            'id'      => $product->id,
            'qty'     => 1,
            'price'   => $product->price,
            'name'    => $product->name
        );
        $this->cart->insert($data);
        redirect('shop');
    }

    // 購物車頁面
    public function cart()
    {
        $this->load->view('header');
        $this->load->view('cart');
        $this->load->view('footer');
    }

    // 更新購物車
    public function update_cart()
    {
        $data = $this->input->post('cart');
        $this->cart->update($data);
        redirect('shop/cart');
    }

    // 清空購物車
    public function clear_cart()
    {
        $this->cart->destroy();
        redirect('shop/cart');
    }

    // 結帳頁面
    public function checkout()
    {
        if ($this->cart->total_items() == 0) {
            redirect('shop');
        }
        $this->load->view('header');
        $this->load->view('checkout');
        $this->load->view('footer');
    }

    // 處理結帳（存入資料庫）
    public function process_checkout()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', '姓名', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->checkout();
        } else {
            // 建立訂單
            $order_data = array(
                'customer_name' => $this->input->post('name'),
                'customer_email' => $this->input->post('email'),
                'total' => $this->cart->total()
            );
            $this->db->insert('orders', $order_data);
            $order_id = $this->db->insert_id();

            // 建立訂單項目
            foreach ($this->cart->contents() as $item) {
                $item_data = array(
                    'order_id' => $order_id,
                    'product_id' => $item['id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal']
                );
                $this->db->insert('order_items', $item_data);
            }

            // 清空購物車
            $this->cart->destroy();

            $this->load->view('header');
            $this->load->view('checkout_success');
            $this->load->view('footer');
        }
    }
}
