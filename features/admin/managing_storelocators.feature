@managing_storelocators
Feature: Managing storelocators
    In order to present storelocators in my store
    As an Administrator
    I want to be able to remove existing storelocators

    Background:
        Given I am logged in as an administrator
        And the store operates on a single channel in "United States"

    @ui
    Scenario: Removing storelocator
        Given the store has a storelocator
        When I go to the storelocator page
        And I delete this storelocator
        Then I should be notified that the storelocator has been deleted
        And I should see empty list of storelocators