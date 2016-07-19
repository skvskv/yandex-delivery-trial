Feature: A Trial
  In order to estimate a cost of a real estate
  as a service user
  I need to be able to search for it

    Scenario: Seraching for a real estate manually
      Given I have a symbolic link "/tmp/cost.csv" to a file named "tmp/cost.csv"
      And I have a symbolic link "/tmp/city.csv" to a file named "tmp/city.csv"
      Given I have a province identifier of "5"
      And for a real estate I have a room amount of "50"
      When I run interactively "app/cost.php"
      Then I should see "500000" in the output
