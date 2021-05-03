@managing_storelocators
Feature: Adding Storelocators
    In order to present storelocators in my store
    As an Administrator
    I want to be able to add new storelocators

    Background:
        Given I am logged in as an administrator
        And the store operates on a single channel in "United States"

    @ui
    Scenario: Adding storelocator
        When I go to the create storelocator page
        And I fill the Name with "Bonne Pioche"
        And I add it
        Then I should be notified that a new storelocator has been created

    @ui
    Scenario: Trying to add new storelocator with blank data
        When I go to the create storelocator page
        And I add it
        Then I should be notified that "Name" fields cannot be blank

    @ui
    Scenario: Trying to add new storelocator with too short data
        When I go to the create storelocator page
        And I fill the Name with "B"
        And I add it
        Then I should be notified that "Name" fields are too short