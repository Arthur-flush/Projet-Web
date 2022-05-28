#!/bin/sh
#move every image from tmp_images to NFTs

cp tmp_images/* stocks/

echo "reseting db"
sudo mysql ProjetWeb < base.sql
echo "populating db"
sudo mysql ProjetWeb < populate.sql

