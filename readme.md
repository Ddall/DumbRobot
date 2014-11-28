#DdxDr
First attempt at a Trading bot, the result is quite Dumb (hense the name).

## First start

* composer update ``php composer update``
* doctrine update ``php app\console doctrine:schema:update --force``
* load fixtures    ``php app\console doctrine:fixtures:load --append``
* load tradingpairs ``php app\console kraken:tradingpairs:update``
* Enable at least one trading pair.
* run market update ``php app\console kraken:tradehistory:update``
