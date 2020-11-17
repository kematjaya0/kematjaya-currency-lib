<?php

namespace Kematjaya\Currency\Tests;

use Kematjaya\Currency\KmjCurrencyBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class KmjKernelTest extends Kernel
{
    public function registerBundles()
    {
        return [
            new KmjCurrencyBundle()
        ];
    }
    
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        
    }
}
