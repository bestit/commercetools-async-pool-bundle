<?php

namespace BestIt\CTAsyncPoolBundle\EventListener;

use BestIt\CTAsyncPool\PoolAwareTrait;
use BestIt\CTAsyncPool\PoolInterface;

/**
 * Flushes the pool of async request on view rendering.
 * @author blange <lange@bestit-online.de>
 * @package BestIt\CTAsyncPoolBundle
 * @subpackage EventListener
 * @version $id$
 */
class FlushPoolOnView
{
    use PoolAwareTrait;

    /**
     * FlushPoolOnView constructor.
     * @param PoolInterface $pool
     */
    public function __construct(PoolInterface $pool)
    {
        $this->setPool($pool);
    }

    /**
     * Flushes the pool on view rendering.
     * @return void
     */
    public function onKernelView()
    {
        $pool = $this->getPool();

        if (count($pool)) {
            $pool->flush();
        }
    }
}
