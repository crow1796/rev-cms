<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
	public function tearDown(){
		Mockery::close();
	}
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testCartAdding()
    {
    	$cart = Mockery::mock('App\Cart');
    	$product = Mockery::mock('App\Product');
    	$cart->shouldReceive('addProduct')
    			->once()
    			->andReturn('Product Added Successfully.');
    	$this->assertEquals($cart->addProduct($product), 'Product Added Successfully.');
    }

    public function testUserOrders(){
    	$user = Mockery::mock('App\User');
    	$user->shouldReceive('orders')
    			->once()
    			->andReturn([Mockery::mock('App\Order'), Mockery::mock('App\Order')]);

    	$order = $user->orders()[0];
    	$order->shouldReceive('carts')
    				->once()
    				->andReturn([Mockery::mock('App\Cart'), Mockery::mock('App\Cart')]);

    	$cart = $order
					->carts()[0];

    	$cart->shouldReceive('totalPayables')				
    				->once()
    				->andReturn(500.00);

    	$order->shouldReceive('pay')
    			->once()
    			->andReturn(true);

    	$this->assertEquals($cart->totalPayables(), 500);
    	$this->assertEquals($order->pay(), true);
    }
}
