<?php
/**
 * Extension de formulaire d'ajout d'un block d'aide
 *
 * @param help : Message d'aide
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 *
 */

namespace Olix\AdminBundle\Form;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class HelpFormExtension  extends AbstractTypeExtension
{

    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractTypeExtension::buildView()
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['help'] = $options['help'];
    }


    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractTypeExtension::setDefaultOptions()
     * @deprecated Remove it when bumping requirements to SF 2.7+
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }


    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractTypeExtension::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'help' => null,
        ));
    }


    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\FormTypeExtensionInterface::getExtendedType()
     */
    public function getExtendedType()
    {
        return method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix')
            ? 'Symfony\Component\Form\Extension\Core\Type\FormType'
            : 'form' // SF <2.8 BC
        ;
    }

}