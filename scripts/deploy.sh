#!/bin/bash -ex

TEMP_DIR=$(mktemp -d)
TARGET_DIR=/var/www/mathed
PACKAGE=$TEMP_DIR/mathed.tar.bz2

wget http://jenkins.kiglics.hu/job/mathed-build/lastSuccessfulBuild/artifact/build/mathed.tar.bz2 -O $PACKAGE

mkdir -p $TARGET_DIR
(cd $TARGET_DIR && tar xfjv $PACKAGE)

chef-solo --no-color -c /home/ubuntu/chef/solo.rb

rm -rf $TEMP_DIR
