<?php

namespace BestIt\CTAsyncPoolBundle\Tests\EventListener;

use BestIt\CTAsyncPool\PoolInterface;
use BestIt\CTAsyncPoolBundle\EventListener\FlushPoolOnView;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class FlushPoolOnViewTest extends TestCase
{
    /**
     * The tested class.
     * @var FlushPoolOnView
     */
    private $fixture = null;

    /**
     * The mocked pool class.
     * @var PoolInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private $pool = null;

    /**
     * Sets up the test.
     * @return void
     */
    public function setUp()
    {
        $this->fixture = new FlushPoolOnView($this->pool = static::createMock(PoolInterface::class));
    }

    /**
     * Checks if the pool is not flushed, if it is empty.
     * @covers FlushPoolOnView::onKernelView()
     * @return void
     */
    public function testOnKernelViewEmpty()
    {
        $this->pool
            ->expects(static::once())
            ->method('count')
            ->willReturn(0);

        $this->pool
            ->expects(static::never())
            ->method('flush');

        $this->fixture->onKernelView();
    }

    /**
     * Checks if the pool is flushed, if it is not empty.
     * @covers FlushPoolOnView::onKernelView()
     * @return void
     */
    public function testOnKernelViewFilled()
    {
        $this->pool
            ->expects(static::once())
            ->method('count')
            ->willReturn(1);

        $this->pool
            ->expects(static::once())
            ->method('flush');

        $this->fixture->onKernelView();
    }
}
