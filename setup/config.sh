mysqlPassword="asd"
phpVer="php7.2"
sources="setup/sources/"
syncFolder="/srv/www/"
server=$syncFolder"server/"
tmp=$syncFolder"tmp/"
elasticUrl="https://download.elastic.co/elasticsearch/release/org/elasticsearch/distribution/deb/elasticsearch/2.4.0/elasticsearch-2.4.0.deb"
elasticFilename="elasticsearch-2.4.0.deb"

# Output
RED='\033[0;31m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

BOLD=$(tput bold)
NORMAL=$(tput sgr0)

function msg {
    echo -e ${GREEN}"|-- "${1}${NC}
}
