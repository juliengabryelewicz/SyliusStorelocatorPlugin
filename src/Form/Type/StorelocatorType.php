<?php

declare(strict_types=1);

namespace Jgabryelewicz\SyliusStorelocatorPlugin\Form\Type;

use Jgabryelewicz\SyliusStorelocatorPlugin\Form\Type\Translation\StorelocatorTranslationType;
use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

final class StorelocatorType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'jgabryelewicz_sylius_storelocator_plugin.ui.name',
                'required' => true
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'jgabryelewicz_sylius_storelocator_plugin.ui.image',
                'required' => false
            ])
            ->add('address', TextareaType::class, [
                'label' => 'jgabryelewicz_sylius_storelocator_plugin.ui.address',
                'required' => false
            ])
            ->add('email', TextType::class, [
                'label' => 'jgabryelewicz_sylius_storelocator_plugin.ui.email',
                'required' => false
            ])
            ->add('phone', TextType::class, [
                'label' => 'jgabryelewicz_sylius_storelocator_plugin.ui.phone',
                'required' => false
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'jgabryelewicz_sylius_storelocator_plugin.ui.enabled',
                'required' => false
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'label' => false,
                'entry_type' => StorelocatorTranslationType::class,
                'required' => false
            ])
            ->add('channels', ChannelChoiceType::class, [
                'label' => 'jgabryelewicz_sylius_storelocator_plugin.ui.channels',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }
}
