#!/bin/sh
if [ $# != "1" ]; then
    echo Usage:
    echo $0 branch
    exit 1
fi


BRANCH=$1
BASEDIR=./
GITSERVER=github.com
GITSSHUSER=git
PROJECTNAME=srit/intrabytes.git
DATE=`date +%y%m%d%H%M%S`
DEPLOYPATH=${BASEDIR}${DATE}

echo "create new release folder ${DATE}"
mkdir ${DEPLOYPATH}

echo "getting project from git"
git clone ${GITSSHUSER}@${GITSERVER}:${PROJECTNAME} -b ${BRANCH} ${DATE}
rm -rf ${DATE}/.git

echo "clear tmp cache"
rm -rf ${DEPLOYPATH}/tmp/*
chmod 777 ${DEPLOYPATH}/tmp/

rm -rf ${DEPLOYPATH}/cache/*
chmod 777 ${DEPLOYPATH}/cache/

echo "set chmod to log"
chmod 777 ${DEPLOYPATH}/logs/

echo "deploy done!"

exit