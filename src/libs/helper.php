<?php
require '../src/classes/database/Book.php';

function view(string $filename, array $data = []): void
{
    // create variables from the associative array
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once __DIR__ . '/../inc/' . $filename . '.php';
}

function loginCheck($data, $user)
{
    $object = $user->getBy($data, 'email');
    $hashed = (!empty($object))? $object->password : null;
    return password_verify( $data['password'], $hashed );   
}

function getTotalPrice() 
{
    $model = new Book;
    $price = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $book = $model->read($key);
        $price += $book->price;
    }
    return $price;
}

function insertOrders($orderDetails) 
{
    $model = new Order;
    $userId = $_SESSION['user']->id;
    foreach ($_SESSION['cart'] as $key => $value) {
        $data = [
            'book_id' => $key,
            'user_id' => $userId,
            'order_detail_id' => $orderDetails->id
        ];
        decreaseBookAmount($key);
        $model->insert($data);
    }
}

function decreaseBookAmount($bookId)
{
   $model = new Book;   
   $model->decreaseAmount($bookId);
}