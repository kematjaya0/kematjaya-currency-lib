<?php

namespace Kematjaya\Currency\Type;

use Kematjaya\Currency\Lib\CurrencyFormatInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
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
            'currency' => $this->currencyFormat->getCurrencySymbol(),
            'prefix' => '',
            'suffix' => '',
            'cents-separator' => '.'
        ]);
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(
            new CallbackTransformer(
                function ($value) {
                    
                    return $value;
                }, function (?string $value) {
                    if (null === $value) {
                        
                        return 0;
                    }
                    
                    return $this->currencyFormat->priceToFloat($value);
                }
            )
        );
    }
    
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);
        
        if (false === strpos($view->vars['money_pattern'], $this->currencyFormat->getCurrencySymbol())) {
            $view->vars['money_pattern'] = sprintf("%s %s", $this->currencyFormat->getCurrencySymbol(), $view->vars['money_pattern']);
        }
        
        $view->vars['prefix'] = $options['prefix'];
        $view->vars['suffix'] = $options['suffix'];
        $view->vars['cents_separator'] = $options['cents-separator'];
        $view->vars['scale'] = isset($options['scale']) ? $options['scale'] : 0;
    }
}
