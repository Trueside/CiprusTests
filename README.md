# CiprusTests
Homework for Cyprus 

## Install Java ver.8+

## Run command 
## composer install

## To up selenium hub run command 
## java -jar selenium-server.jar -role hub -hubConfig HubConfig.json

## To up selenium node run command 
## java -jar -Dwebdriver.chrome.driver="chromedriver.exe" -Dwebdriver.gecko.driver="geckodriver.exe" selenium-server.jar -role node -nodeConfig NodeConfig.json

## To start test1 run command
## $ vendor\bin\codecept.bat run acceptance CheckTrailerCest

## To start test2 run command
## $ vendor\bin\codecept.bat run phpbrowser CheckSitesChangesCest