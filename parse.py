#/usr/bin/python
import re, urllib, sys
 
GRUBER_URLINTEXT_PAT = re.compile(ur'(?i)\b((?:https?://|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?\xab\xbb\u201c\u201d\u2018\u2019]))')
 
#for line in urllib.urlopen("http://daringfireball.net/misc/2010/07/url-matching-regex-test-data.text"):
#    print [ mgroups[0] for mgroups in GRUBER_URLINTEXT_PAT.findall(line) ]

#print str(sys.argv[1])

for word in sys.argv:
    result = re.search(GRUBER_URLINTEXT_PAT, word)
    if result:
        print result.group()
        
#if GRUBER_URLINTEXT_PAT.match(str(sys.argv[1])):
#print str(sys.argv[1])
        
