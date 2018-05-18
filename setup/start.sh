syncFolder="/srv/www/"
. $syncFolder'/setup/config.sh'

# ElasticSearch
sudo service elasticsearch start
# input <<EOF
# node.name: "Learnhub"
# cluster.name: "learnhub"
# index.number_of_shards: 1
# index.number_of_replicas: 0
# network.bind.host: localhost
# EOF

# echo input >>> ${elasticPath}parameters.yml

# sh ${elasticPath}'bin/elasticsearch'

