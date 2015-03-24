<?php

namespace Test;

use DataFeed\Store\FeedStore;
use DataFeed\FeedHandle;

class TestFeedHandle extends \PHPUnit_Framework_TestCase
{

	private function getMockStore() {
		$store = $this->getMockBuilder('DataFeed\Store\FeedStore')->getMock();

		return $store;
	}

	public function testOverrides() {
		$store = $this->getMockStore();

		$name = 'handle';
		$url = 'http://example.com/feed';

		$feed = new FeedHandle($this->getMockBuilder('DataFeed\Store\FeedStore')->getMock(),
			$this->getMockBuilder('DataFeed\Cache\FeedCache')->getMock(), $name, $url);

		$this->assertEquals($feed->getName(), $name);
		$this->assertEquals($feed->getURL(), $url);
		$this->assertEquals($feed->getInterval(), 24 * 60);

		$oURL = 'https://example.com/feed2';
		$oInterval = 1;

		$feed->setOURL( $oURL );
		$feed->setOInterval( $oInterval );

		$this->assertEquals($feed->getURL(), $oURL);
		$this->assertEquals($feed->getInterval(), $oInterval);

		$feed->setOURL( null );
		$feed->setOInterval( null );

		$this->assertEquals($feed->getName(), $name);
		$this->assertEquals($feed->getURL(), $url);
		$this->assertEquals($feed->getInterval(), 24 * 60);

	}

}