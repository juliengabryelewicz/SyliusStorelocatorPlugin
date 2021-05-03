<?php

declare(strict_types=1);

namespace Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Page\Admin\Storelocator;

use Sylius\Behat\Page\Admin\Crud\CreatePage as BaseCreatePage;
use Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Behaviour\ContainsErrorTrait;

class CreatePage extends BaseCreatePage implements CreatePageInterface
{
    use ContainsErrorTrait;

    public function fillField(string $field, string $value): void
    {
        $this->getDocument()->fillField($field, $value);
    }

    public function fillName(string $name): void
    {
        $this->getDocument()->fillField('Name', $name);
    }
}
