# Banana Tracker

## Set Up
Run `composer install`. This is to install php unit.

## To Run
In oder to run, open the project in command line and navigate to the scripts directory. Run the BananaTrackerCommand.php script, passing in the JSON route.

## Example Command With Json
`php BananaTrackerCommand.php '[{
        "from": "Adolfo Suárez Madrid–Barajas Airport, Spain",
        "to": "London Heathrow, UK"
}, {
        "from": "Fazenda São Francisco Citros, Brazil",
        "to": "São Paulo–Guarulhos International Airport, Brazil"
}, {
        "from": "London Heathrow, UK",
        "to": "Loft Digital, London, UK"
}, {
        "from": "Porto International Airport, Portugal",
        "to": "Adolfo Suárez Madrid–Barajas Airport, Spain"
}, {
        "from": "São Paulo–Guarulhos International Airport, Brazil",
        "to": "Porto International Airport, Portugal"
}]'`

## To Run Tests
Make sure that you have ran `composer install` first. Navigate to the parent directory and run `./vendor/bin/phpunit tests`