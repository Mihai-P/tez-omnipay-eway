#!/bin/sh

mkdir -p ./reports
mkdir -p ./documents/apigen

if [ -z "$1" ]; then
    apigen \
    --title 'Onmipay eWay 3.1 Rapid Gateway API documentation' \
    --source ./src \
    --destination ./documents/apigen \
    --report ./reports/apigen.xml

#
# Left here for further expansion, ignore this for the time being.
#
elif [ "$1" = "common" ]; then
    apigen \
    --title 'Omnipay eWay 3.1 Rapid Gateway API documentation' \
    --source ./src \
    --destination ./documents/apigen \
    --report ./reports/apigen.xml

fi
