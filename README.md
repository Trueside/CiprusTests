# CiprusTests
Homework for Cyprus 

## Install PHP
## Install Java ver.8+

## Run command 
## php composer.phar install

## To up ChromeDriver run command
## chromedriver --url-base=/wd/hub

## To start test1 run command 

##(linux)
## $ vendor/bin/codecept.bat run phpbrowser CheckSitesChangesCest

##(Windows)
## $ vendor\bin\codecept.bat run phpbrowser CheckSitesChangesCest

## To start test2 run command 

##(linux)
## $ vendor/bin/codecept.bat run acceptance CheckTrailerCest

##(Windows)
## $ vendor\bin\codecept.bat run phpbrowser CheckSitesChangesCest

## To start test2 run command (Windows)
## $ vendor\bin\codecept.bat run acceptance CheckTrailerCest

## To up selenium hub run command 
## java -jar selenium-server.jar -role hub -hubConfig HubConfig.json

## To up selenium node run command 
## java -jar -Dwebdriver.chrome.driver="chromedriver.exe" -Dwebdriver.gecko.driver="geckodriver.exe" selenium-server.jar -role node -nodeConfig NodeConfig.json
