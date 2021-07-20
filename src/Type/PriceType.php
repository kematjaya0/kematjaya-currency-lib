<?php

namespace Kematjaya\Currency\Type;

use Kematjaya\Currency\Lib\CurrencyFormatInterface;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceType extends MoneyType 
{   
    /**
     * 
     * @var CurrencyFormatInterface
     */
    private $currencyFormat;

    public function __construct(CurrencyFormatInterface $currencyFormat)
    {
        $this->currencyFormat = $currencyFormat;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        
        $resolver->setDefaults([
            'invalid_message' => 'The selected issue does not exist',
            'currency' => $this->currencyFormat->getCurrencySymbol()
        ]);
    }
    
}
