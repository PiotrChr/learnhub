#!/usr/bin/env bash

timestamp=$( date +%d-%m-%Y_%H-%M-%S )

elasticDir="/srv/www/elasticq/"
elasticOutput="$elasticDir$timestamp.json"

bold=$(tput bold)
normal=$(tput sgr0)
