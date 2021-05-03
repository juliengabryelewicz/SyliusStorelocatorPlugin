@shop_storelocators
Feature: Browsing Storelocators
    In order to get the list of storelocators
    As a Customer
    I want to see all storelocators

    Background:
        Given the store operates on a single channel in "United States"

    @ui
    Scenario: Browsing Storelocators
        Given there are 5 Storelocators in the store
        When I go to the storelocator page
        Then I should see 5 Storelocators
