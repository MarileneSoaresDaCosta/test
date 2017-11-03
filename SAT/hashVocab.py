#!/usr/bin/env python
import json
import hashlib

def createHash(string):
	b = bytearray()
	b.extend(string.encode())
	m = hashlib.sha256()
	m.update(b)
	return m.hexdigest()



inputFile = 'SATvocab.txt'
outputFile = 'SATvocabHashed.txt'

# delete previous contents
open(outputFile, 'w').close()

data = []
with open(inputFile) as f:
    for line in f:
        data.append(json.loads(line))



for a in data:
	a['hash'] = createHash(a['definition'])
	# print(a)

	with open(outputFile, 'a') as fj:
		fj.write(json.dumps(a)+"\n")
















