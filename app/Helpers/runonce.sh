#!/bin/bash

SL
/usr/bin/mkdir -p /etc/ldap
/usr/bin/echo "TLS_CACERT      /etc/ssl/certs/ca-certificates.crt" > /etc/ldap/ldap.conf
