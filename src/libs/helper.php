<?php
require '../src/classes/database/Book.php';

/**
 * Renders php file
 * @return void
 */
function view(string $filename, array $data = [])
{
    // create variables from the associative array
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once __DIR__ . '/../inc/' . $filename . '.php';
}

/**
 * Check whether user is logged in
 * @param array $data
 * @param User $user
 * @return boolean
 */
function loginCheck($data, $user)
{
    $object = $user->getBy($data, 'email');
    $hashed = (!empty($object))? $object->password : null;
    return password_verify( $data['password'], $hashed );   
}

/**
 * Calculates total price of books in the shopping cart
 * @return decimal
 */
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

/**
 * Insert bought books in the database - creates orders
 * @param OrderDetail $orderDetail
 * @return void
 */
function insertOrders($orderDetail) 
{
    $model = new Order;
    $userId = $_SESSION['user']->id;
    foreach ($_SESSION['cart'] as $key => $value) {
        $data = [
            'book_id' => $key,
            'user_id' => $userId,
            'order_detail_id' => $orderDetail->id
        ];
        decreaseBookAmount($key);
        $model->insert($data);
    }
}

/**
 * Decreases the amount of bought book
 * @param int $bookId
 * @return void
 */
function decreaseBookAmount($bookId)
{
   $model = new Book;   
   $model->decreaseAmount($bookId);
}