<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class BookingController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->library('session');
        $this->call->model('BookingModel');
    }

    private function requireLogin()
    {
        if (!$this->session->has_userdata('user_id')) {
            redirect('lushcamp/login');
            exit;
        }
    }
 
    public function index()
    {
        $this->requireLogin();

        $page    = $_GET['page'] ?? 1;
        $q       = trim($_GET['q'] ?? '');
        $user_id = $_SESSION['user_id'];
        $role    = $_SESSION['role'];
        $is_admin = ($role === 'admin');

        $records = $this->BookingModel->page($q, 10, $page, $user_id, $is_admin);

        $data['bookings']   = $records['records'];
        $data['total_rows'] = $records['total_rows'];
        $data['page']       = $page;

        $this->call->view('lushcamp/bookings_data', $data);
    }

    public function create()
{
    $this->requireLogin();

    if ($this->io->method() === 'post') {

        $payment_image = null;

        if (!empty($_FILES['payment_image']['name'])) {
            // Set the upload directory (ensure this folder exists on your server)
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/payments/';

            // Check if the directory exists
            if (!is_dir($upload_dir)) {
                // Stop execution if folder does not exist
                echo "Upload folder does not exist. Please create: " . $upload_dir;
                return;
            }

            // Generate a unique filename
            $filename = uniqid() . '_' . basename($_FILES['payment_image']['name']);
            $target_file = $upload_dir . $filename;

            // Move the uploaded file
            if (move_uploaded_file($_FILES['payment_image']['tmp_name'], $target_file)) {
                $payment_image = $filename;
            } else {
                echo "Failed to upload the file. Check folder permissions.";
                return;
            }
        }

        // Prepare data for insertion
        $data = [
            'user_id'        => $_SESSION['user_id'],
            'type'           => $this->io->post('type'),
            'date'           => $this->io->post('date'),
            'time'           => $this->io->post('time'),
            'service'        => $this->io->post('service') ?: 'Check-in',
            'status'         => 'pending',
            'payment_image'  => $payment_image,
            'payment_status' => 'unverified'
        ];

        // Insert booking
        $this->BookingModel->insert($data);

        // Redirect to bookings page
        redirect('lushcamp/bookings');
    }

    // Load the create view
    $this->call->view('lushcamp/create_new');
}

    public function update($id)
    {
        $this->requireLogin();

        if ($_SESSION['role'] !== 'admin') {
            echo "Admin only!";
            return;
        }

        if ($this->io->method() === 'post') {
            $newdata = [
                'type'           => $this->io->post('type'),
                'date'           => $this->io->post('date'),
                'time'           => $this->io->post('time'),
                'service'        => $this->io->post('service'),
                'status'         => $this->io->post('status'),
                'payment_status' => $this->io->post('payment_status')
            ];

            $this->BookingModel->update($id, $newdata);
            redirect('lushcamp/bookings');
        }

        $booking = $this->BookingModel->find($id);

        if (!$booking) {
            echo "Booking not found!";
            return;
        }

        $this->call->view('lushcamp/update_booking', ['booking' => $booking]);
    }

    public function delete($id)
    {
        $this->requireLogin();

        if ($_SESSION['role'] !== 'admin') {
            echo "Admin only!";
            return;
        }

        $this->BookingModel->delete($id);
        redirect('lushcamp/bookings');
    }
}
