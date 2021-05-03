<?php

declare(strict_types=1);

namespace Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Context\Ui\Shop;

use Behat\Behat\Context\Context;
use Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Page\Shop\Storelocator\IndexPageInterface;
use Webmozart\Assert\Assert;

final class StorelocatorContext implements Context
{
    /** @var IndexPageInterface */
    private $indexPage;

    public function __construct(IndexPageInterface $indexPage)
    {
        $this->indexPage = $indexPage;
    }

    /**
     * @When I go to the storelocator page
     */
    public function iGoToTheStorelocatorPage()
    {
        $this->indexPage->open();
    }

    /**
     * @Then I should see :number Storelocators
     */
    public function iShouldSeeStorelocators(int $number)
    {
        Assert::true($this->indexPage->hasStorelocatorsNumber($number));
    }
}
