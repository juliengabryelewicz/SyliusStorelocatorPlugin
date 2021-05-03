@managing_storelocators
Feature: Editing a storelocator
    In order to change a storelocator
    As an Administrator
    I want to be able to edit a storelocator

    Background:
        Given I am logged in as an administrator
        And the store operates on a single channel in "United States"
        And there is an existing storelocator with "Bonne pioche" name

    @ui
    Scenario: Renaming a storelocator
        Given I want to modify the storelocator
        When I fill the name with "Nouveau Bonne pioche"
        And I edit it
        Then I should be notified that it has been successfully updated