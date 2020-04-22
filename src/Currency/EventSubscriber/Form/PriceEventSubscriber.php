<?php

namespace Kematjaya\Currency\EventSubscriber\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Kematjaya\Currency\Lib\CurrencyFormat;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceEventSubscriber implements EventSubscriberInterface
{
    private $currencyFormat;
    private $name;
    
    public function __construct(CurrencyFormat $currencyFormat) 
    {
        $this->currencyFormat = $currencyFormat;
    }
    
    public function setName(string $name):self
    {
        $this->name = $name;
        
        return $this;
    }
    
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SUBMIT => 'preSubmit'
        ];
    }
    
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        if($this->name and isset($data[$this->name]))
        {
            $data[$this->name] = $data[$this->name] ? (float) $this->currencyFormat->PriceToFloat($data[$this->name]):0;
            $event->setData($data);
        }   
    }
}
