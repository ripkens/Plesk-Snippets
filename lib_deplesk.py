#!/usr/bin/env python
import sys
import base64
from Crypto.Cipher import AES

key = open('/etc/psa/private/secret_key', 'rb').read()

for pw in sys.argv[1:]:
    lead, typ, iv, ct = pw.split('$')
    iv = base64.b64decode(iv)
    ct = base64.b64decode(ct)
    assert typ == 'AES-128-CBC'
    plain = AES.new(key, mode=AES.MODE_CBC, IV=iv).decrypt(ct).rstrip(b'\0')
    print(plain.decode('utf8'))
    
