<?php

declare(strict_types=1);

namespace Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Sylius\Behat\NotificationType;
use FriendsOfBehat\PageObjectExtension\Page\SymfonyPageInterface;
use Sylius\Behat\Service\NotificationCheckerInterface;
use Sylius\Behat\Service\Resolver\CurrentPageResolverInterface;
use Sylius\Behat\Service\SharedStorageInterface;
use Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Page\Admin\Storelocator\CreatePageInterface;
use Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Page\Admin\Storelocator\IndexPageInterface;
use Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Page\Admin\Storelocator\UpdatePageInterface;
use Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Service\StringGeneratorInterface;
use Webmozart\Assert\Assert;

final class StorelocatorContext implements Context
{

    /** @var SharedStorageInterface */
    private $sharedStorage;

    /** @var CurrentPageResolverInterface */
    private $currentPageResolver;

    /** @var NotificationCheckerInterface */
    private $notificationChecker;

    /** @var IndexPageInterface */
    private $indexPage;

    /** @var CreatePageInterface */
    private $createPage;

    /** @var UpdatePageInterface */
    private $updatePage;

    /** @var StringGeneratorInterface */
    private $stringGenerator;

    public function __construct(
        SharedStorageInterface $sharedStorage,
        CurrentPageResolverInterface $currentPageResolver,
        NotificationCheckerInterface $notificationChecker,
        IndexPageInterface $indexPage,
        CreatePageInterface $createPage,
        UpdatePageInterface $updatePage,
        StringGeneratorInterface $stringGenerator
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->currentPageResolver = $currentPageResolver;
        $this->notificationChecker = $notificationChecker;
        $this->indexPage = $indexPage;
        $this->createPage = $createPage;
        $this->updatePage = $updatePage;
        $this->stringGenerator = $stringGenerator;
    }

    /**
     * @When I go to the create storelocator page
     */
    public function iGoToTheCreateStorelocatorPage()
    {
        $this->createPage->open();
    }

    /**
     * @When I fill the name with :name
     * @When I rename the name with :name
     */
    public function iFillTheNameWith(string $name)
    {
        $this->createPage->fillName($name);
    }

    /**
     * @When I fill the code with :code
     */
    public function iFillTheCodeWith(string $code)
    {
        $this->createPage->fillCode($code);
    }


    /**
     * @When I add it
     */
    public function iAddIt()
    {
        $this->createPage->create();
    }

    /**
     * @Then I should be notified that a new storelocator has been created
     */
    public function iShouldBeNotifiedThatANewStorelocatorHasBeenCreated()
    {
        $this->notificationChecker->checkNotification(
            'Success Storelocator has been successfully created.',
            NotificationType::success()
        );
    }

    /**
     * @Then I should be notified that :fields fields cannot be blank
     */
    public function iShouldBeNotifiedThatFieldsCannotBeBlank($fields)
    {
        $fields = explode(',', $fields);

        foreach ($fields as $field) {
            Assert::true($this->resolveCurrentPage()->containsErrorWithMessage(sprintf(
                '%s cannot be blank.',
                trim($field)
            )));
        }
    }

    /**
     * @Then I should be notified that :fields fields are too short
     */
    public function iShouldBeNotifiedThatFieldsAreTooShort($fields)
    {
        $fields = explode(',', $fields);

        foreach ($fields as $field) {
            Assert::true($this->resolveCurrentPage()->containsErrorWithMessage(sprintf(
                '%s must be at least %d characters long.',
                trim($field), 2
            )));
        }
    }

    /**
     * @When I go to the storelocator page
     */
    public function iGoToTheStorelocatorPage()
    {
        $this->indexPage->open();
    }

    /**
     * @When I delete this storelocator
     */
    public function iDeleteThisStorelocator()
    {
        $storelocator= $this->sharedStorage->get('storelocator');
        $this->indexPage->deleteStorelocator($storelocator->getName());
    }

    /**
     * @Then I should be notified that the storelocator has been deleted
     */
    public function iShouldBeNotifiedThatTheStorelocatorHasBeenDeleted()
    {
        $this->notificationChecker->checkNotification(
            'Storelocator has been successfully deleted.',
            NotificationType::success()
        );
    }

    /**
     * @Then I should see empty list of storelocators
     */
    public function iShouldSeeEmptyListOfStorelocators()
    {
        $this->resolveCurrentPage()->isEmpty();
    }

    /**
     * @Given I want to modify the storelocator
     */
    public function iWantToModifyTheStorelocator()
    {
        $storelocator= $this->sharedStorage->get('storelocator');
        $this->updatePage->open(['id' => $storelocator->getId()]);
    }

    /**
     * @When I edit it
     */
    public function iEditIt()
    {
        $this->updatePage->saveChanges();
    }

    /**
     * @Then I should be notified that it has been successfully updated
     */
    public function iShouldBeNotifiedThatItHasBeenSuccessfullyUpdated()
    {
        $this->notificationChecker->checkNotification(
            'Success Storelocator has been successfully updated.',
            NotificationType::success()
        );
    }


    /**
     * @return IndexPageInterface|CreatePageInterface|UpdatePageInterface|SymfonyPageInterface
     */
    private function resolveCurrentPage(): SymfonyPageInterface
    {
        return $this->currentPageResolver->getCurrentPageWithForm([
            $this->indexPage,
            $this->createPage,
            $this->updatePage
        ]);
    }
}
