<?php

/**
 * This file is part of the kematjaya-currency-lib.
 */

namespace Kematjaya\Currency\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

/**
 * @package Kematjaya\Currency\DependencyInjection
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    
    public function getConfigTreeBuilder(): TreeBuilder 
    {
        $treeBuilder = new TreeBuilder('kmj_currency');
        $rootNode = $treeBuilder->getRootNode();
        
        $this->addCurrencyConfiguration($rootNode->children());
        
        return $treeBuilder;
    }
    
    protected function addCurrencyConfiguration(NodeBuilder $node):void
    {
        $node
            ->arrayNode('currency')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('code')->defaultValue('IDR')->end()
                        ->integerNode('cent_limit')->defaultValue(0)->end()
                        ->scalarNode('cent_point')->defaultValue('.')->end()
                        ->scalarNode('thousand_point')->defaultValue(',')->end()
                    ->end()
                ->end()
            ->end();
    }
}
