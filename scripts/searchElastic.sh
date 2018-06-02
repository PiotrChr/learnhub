#!/bin/bash
. /srv/www/scripts/bootstrap.sh

mkdir -p $elasticDir
jsonQuery="{'query':{'term':{'name':'link'}} }"
curl=$(curl -XGET http://localhost:9200/learnhub/_search?pretty=true -o $elasticOutput -d "$jsonQuery")
echo $curl

echo "\nOutput sent to ${bold}$elasticOutput${normal} \n"



