#!/bin/sh
find ./stocks/ -type f -not -name 'placeholder.png' -delete
find ./Profile_Pics/ -type f -not \( -name 'default64.png' -or -name 'default128.png' -or -name 'default512.png' \) -delete

sudo mysql ProjetWeb < base.sql