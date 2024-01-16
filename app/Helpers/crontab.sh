#!/bin/bash

#/usr/bin/mysql -h 172.17.0.4 --user=root --password='lArRb3l' --database=sltimeclock --execute="update clockins set isopen = 0, signout = now(), signout_comments ='Automatically signed out by system', updated_at = now() where isopen = 1;"
