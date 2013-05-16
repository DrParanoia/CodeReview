<?php

namespace Acme\DemoBundle\Tests\Manager;

use Acme\DemoBundle\Manager\PrimeManager;

class PrimeManagerTest extends \PHPUnit_Framework_TestCase {

	protected function isPrime($value) {
		for($i = 2; $i < $value; $i++) {
			if($value % $i === 0) {
				return false;
			}
		}
		return true;
	}

	public function testIsPrime() {
		$this->assertFalse($this->isPrime(4));
		$this->assertFalse($this->isPrime(8));
		$this->assertFalse($this->isPrime(9));

		$this->assertTrue($this->isPrime(2));
		$this->assertTrue($this->isPrime(3));
		$this->assertTrue($this->isPrime(7));
	}

	public function testRangeFromZero() {
		$primeManager = new PrimeManager();
		$range = range(0, 2000);

		$filteredPrimes = $primeManager->selectOnlyPrimes( $range );

		foreach($filteredPrimes as $primeNumber) {
			if($this->assertTrue($this->isPrime($primeNumber))) {
				echo $primeNumber." <<< IS NOT A PRIME!\n";
			}
		}				
	}

    public function testAllPrimes() {

		$primeManager = new PrimeManager();

		$range = range(2, 2000);

		$filteredPrimes = @$primeManager->selectOnlyPrimes( $range );

		foreach($filteredPrimes as $primeNumber) {
			if($this->assertTrue($this->isPrime($primeNumber))) {
				echo $primeNumber." <<< IS NOT A PRIME!\n";
			}
		}
    }

    public function testGivenPrimes() {
    	$primeManager = new PrimeManager();

    	$primes = Array(3, 7, 11, 19,);

    	$filteredPrimes = $primeManager->selectOnlyPrimes( $primes );

		foreach($filteredPrimes as $primeNumber) {
			$this->assertTrue($this->isPrime($primeNumber));
		}
    }

    public function testPrimeCount() {
    	$primeManager = new PrimeManager();

    	$primes = range(2, 3571);

    	$filteredPrimes = $primeManager->selectOnlyPrimes( $primes );

		$this->assertEquals( count($filteredPrimes), 500);
    }    
}

?>