#!/bin/bash

ROOT_DIR=$(dirname $0)/..

mkdir -p $ROOT_DIR/build
tar c $ROOT_DIR/{bin,chef,scripts,tools,webroot,yii} | bzip2 -9 > $ROOT_DIR/build/mathed.tar.bz2
